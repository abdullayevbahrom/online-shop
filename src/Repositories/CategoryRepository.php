<?php

namespace App\Repositories;

class CategoryRepository
{
    public static function getAllCategories()
    {
        if ($_SESSION["user"]['role'] === USER || $_SESSION["user"]['role'] === MANAGER) {
            $sql = "SELECT * FROM categories WHERE category_status = 1";
        } else {
            $sql = "SELECT * FROM categories";
        }
        $stmt = DB->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();

        return $categories;
    }

    public static function createCategory($category_name)
    {
        if ($category_name && !self::getCategoryByName($category_name)) {
            $category_slug = str_replace(' ', '-', strtolower($category_name));
            $sql = "INSERT INTO `categories` (`category_name`, `category_slug`) VALUES (?, ?)";
            $stmt = DB->prepare($sql);
            $category = $stmt->execute([$category_name, $category_slug]);

            return $category;
        }
        return false;
    }

    public static function getCategoryByName($category_name)
    {
        if ($category_name) {
            $sql = "SELECT * FROM `categories` WHERE `category_name` = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([$category_name]);
            $category = $stmt->fetch();

            return $category;
        }
        return false;
    }

    public static function updateCategory($category_id, $category_name)
    {
        if ($category_id && $category_name && $old_category = self::getCategoryById(intval($category_id))) {
            if ($old_category->category_name !== $category_name && !self::getCategoryByName($category_name)) {
                $category_slug = str_replace(' ', '-', strtolower($category_name));
                $sql = "UPDATE `categories` SET `category_name` = ?, `category_slug` = ? WHERE `category_id` = ?";
                $stmt = DB->prepare($sql);
                $category = $stmt->execute([$category_name, $category_slug, intval($category_id)]);
                return $category;
            }
            return true;
        }
        return false;
    }

    public static function updateCategoryStatus($data)
    {
        $category_id = intval($data["category_id"]);
        $category_status = intval($data["category_status"]);

        $sql = "UPDATE `categories` SET `category_status` = ? WHERE `category_id` = ?";
        $stmt = DB->prepare($sql);
        $stmt->execute([$category_status, $category_id]);
    }

    public static function getCategoryById($category_id)
    {
        if ($category_id) {
            $sql = "SELECT * FROM `categories` WHERE `category_id` = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([intval($category_id)]);
            $category = $stmt->fetch();

            return $category;
        }
        return false;
    }

    public static function deleteCategory($category_id)
    {
        if ($category_id && self::getCategoryById(intval($category_id))) {
            $sql = "DELETE FROM `categories` WHERE `category_id` = ?";
            $stmt = DB->prepare($sql);
            $category = $stmt->execute([intval($category_id)]);

            return $category;
        }
        return false;
    }
}
