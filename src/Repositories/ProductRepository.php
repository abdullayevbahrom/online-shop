<?php

namespace App\Repositories;

class ProductRepository
{
    public static function getAllProducts()
    {
        if ($_SESSION['user']['role'] === ADMIN) {
            $sql = "SELECT p.*, b.brand_name, c.category_name FROM products p
                JOIN brands b ON b.brand_id = p.brand_id
                JOIN categories c ON c.category_id = p.category_id
                ORDER BY product_name";
        } else {
            $sql = "SELECT p.*, b.brand_name, c.category_name FROM products p
                JOIN brands b ON b.brand_id = p.brand_id
                JOIN categories c ON c.category_id = p.category_id
                WHERE p.product_status = 1 AND c.category_status = 1 AND b.brand_status = 1
                ORDER BY product_name";
        }
        
        $stmt = DB->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $products;
    }

    public static function createProduct($data, $files)
    {
        $category_id = intval($data["category_id"]);
        $brand_id = intval($data["brand_id"]);
        $product_name = $data["product_name"];
        $price = intval($data["price"]);
        
        if ($files["photo"]["tmp_name"] === "")  return false;

        $file_name = time() . '_' . $files["photo"]["name"];
        $path = "uploads/photos/" . $file_name;
            
        if (!self::getProductByName($product_name) && move_uploaded_file($files["photo"]["tmp_name"], $path)) {
            $path = '/' . $path;
            $sql = "INSERT INTO `products` (`product_name`, `brand_id`, `category_id`, `price`, `photo`) VALUES (?, ?, ?, ?, ?)";
            $stmt = DB->prepare($sql);
            $product = $stmt->execute([$product_name, $brand_id, $category_id, $price, $path]);

            return $product;
        }

        return false;
    }

    public static function getProductByName($product_name)
    {
        if ($product_name) {
            $sql = "SELECT * FROM `products` WHERE `product_name` = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([$product_name]);
            $product = $stmt->fetch();

            return $product;
        }
        return false;
    }

    public static function updateProduct($data, $files)
    {
        $product_id = intval($data["product_id"]);

        if (!$old_product = self::getProductById($product_id)) return false;

        $category_id = intval($data["category_id"]);
        $brand_id = intval($data["brand_id"]);
        $product_name = $data["product_name"] == $old_product->product_name ? null : $data["product_name"];
        $price = intval($data["price"]);
        
        if ($files["photo"]["tmp_name"] !== "") {
            if (file_exists(substr($old_product->photo, 1))) {
                unlink(substr($old_product->photo, 1));
            }
            $file_name = time() . '_' . $files["photo"]["name"];
            $path = "uploads/photos/" . $file_name;
            move_uploaded_file($files["photo"]["tmp_name"], $path);
            $path = '/' . $path;
        } else {
            $path = $old_product->photo;
        }

        if (!$product_name || !self::getProductByName($product_name)) {
            if (!$product_name) {
                $product_name = $old_product->product_name;
            }
            $sql = "UPDATE `products` 
                    SET `product_name` = ?, `category_id` = ?, `brand_id` = ?, `price` = ?, `photo` = ?
                    WHERE `product_id` = ?";
            $stmt = DB->prepare($sql);
            $product = $stmt->execute([$product_name, $category_id, $brand_id, $price, $path, $product_id]);

            return $product;
        }
        return false;
    }

    public static function updateProductStatus($data)
    {
        $product_id = intval($data["product_id"]);
        $product_status = intval($data["product_status"]);

        $sql = "UPDATE `products` SET `product_status` = ? WHERE `product_id` = ?";
        $stmt = DB->prepare($sql);
        $stmt->execute([$product_status, $product_id]);
    }

    public static function getProductById($product_id)
    {
        if ($product_id) {
            $sql = "SELECT p.*, b.brand_name, c.category_name FROM products p
                    JOIN brands b ON b.brand_id = p.brand_id
                    JOIN categories c ON c.category_id = p.category_id 
                    WHERE `product_id` = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([intval($product_id)]);
            $product = $stmt->fetch();

            return $product;
        }
        return false;
    }

    public static function deleteProduct($product_id)
    {
        if ($product_id && $deleted_product = self::getProductById(intval($product_id))) {
            if (file_exists(substr($deleted_product->photo, 1))) {
                unlink(substr($deleted_product->photo, 1));
            }
            $sql = "DELETE FROM `products` WHERE `product_id` = ?";
            $stmt = DB->prepare($sql);
            $product = $stmt->execute([intval($product_id)]);

            return $product;
        }
        return false;
    }
}
