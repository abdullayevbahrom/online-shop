<?php

namespace App\Controllers;

use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\Router;

class ProductController
{
    public static function index()
    {
        $products = ProductRepository::getAllProducts();
        if (!$products) {
            unset($_SESSION["products"]);
            $_SESSION["message"] = "No products available";
        } else {
            $_SESSION["products"] = $products;
        }

        Router::redirect('/products');
    }

    public static function available($data)
    {
        ProductRepository::updateProductStatus($data);
        Router::redirect('/products/action/index');
        echo json_encode(["status" => "success"]);
    }

    public static function show($data)
    {
        if ($data["product_id"] && $product = ProductRepository::getProductById(intval($data["product_id"]))) {
            $_SESSION["product"] = $product;
            unset($data["product_id"]);
            Router::redirect('/products/show');
            die();
        }

        unset($data["product_id"]);
        $_SESSION["message"] = "Unavailable Product";
        Router::redirect('/products/action/index');
    }

    public static function create()
    {
        $_SESSION["brands"] = BrandRepository::getAllBrands();
        $_SESSION["categories"] = CategoryRepository::getAllCategories();

        Router::redirect('/products/create');
    }

    public static function store($data, $files)
    {
        if ($data["product_name"] && ProductRepository::createProduct($data, $files)) {
            $_SESSION["message"] = "Product created successfully";
            unset($data["product_name"]);
            Router::redirect('/products/action/index');
            die();
        }
        $_SESSION["message"] = "An error occurred while creating";
        unset($data["product_name"]);
        Router::redirect('/products/action/create');
    }

    public static function edit($data)
    {
        if (isset($data["PUT"]) &&
            $data["product_id"] &&
            $product = ProductRepository::getProductById(intval($data["product_id"]))) {
            unset($data["PUT"], $data["product_id"]);
            $_SESSION["product"] = $product;
            $_SESSION["brands"] = BrandRepository::getAllBrands();
            $_SESSION["categories"] = CategoryRepository::getAllCategories();
            Router::redirect('/products/edit');
            die();
        }

        unset($data["PUT"], $data["product_id"]);
        $_SESSION["message"] = "Unavailable Product";
        Router::redirect('/products/action/index');
    }

    public static function update($data, $files)
    {
        if (isset($data["PUT"]) &&
            $data["product_id"] &&
            ProductRepository::updateProduct($data, $files)) {
            $_SESSION["message"] = "Successfully updated";
        } else {
            $_SESSION["message"] = "An error occurred while updating";
        }

        unset($data["PUT"], $data["product_id"], $data["product_name"]);
        Router::redirect('/products/action/index');
    }

    public static function delete($data)
    {
        if (isset($data["DELETE"]) && $data["product_id"] && ProductRepository::deleteProduct(intval($data["product_id"]))) {
            $_SESSION["message"] = "Successfully deleted";
        } else {
            $_SESSION["message"] = "An error occurred while deleting";
        }

        unset($data["DELETE"], $data["product_id"]);
        Router::redirect('/products/action/index');
    }
}
