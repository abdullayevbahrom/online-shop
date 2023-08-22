<?php

namespace App\Controllers;

use App\Repositories\CategoryRepository;
use App\Services\Router;

class CategoryController
{
    public static function index()
    {
        $categories = CategoryRepository::getAllCategories();
        if (!$categories) {
            unset($_SESSION["categories"]);
            $_SESSION["message"] = "No categories available";
        } else {
            $_SESSION["categories"] = $categories;
        }

        Router::redirect('/categories');
    }

    public static function available($data)
    {
        CategoryRepository::updateCategoryStatus($data);
        Router::redirect('/categories/action/index');
        echo json_encode(["status" => "success"]);
    }

    public static function show($data)
    {
        if ($data["category_id"] && $category = CategoryRepository::getCategoryById(intval($data["category_id"]))) {
            $_SESSION["category"] = $category;
            unset($data["category_id"]);
            Router::redirect('/categories/show');
            die();
        }

        unset($data["category_id"]);
        $_SESSION["message"] = "Unavailable Category";
        Router::redirect('/categories/action/index');
    }

    public static function create()
    {
        $categories = CategoryRepository::getAllCategories();
        if (!$categories) {
            unset($_SESSION["categories"]);
            $_SESSION["message"] = "No categories available";
        } else {
            $_SESSION["categories"] = $categories;
        }

        Router::redirect('/categories/create');
    }

    public static function store($data)
    {
        if ($data["category_name"] && CategoryRepository::createCategory($data["category_name"])) {
            $_SESSION["message"] = "Category created successfully";
            unset($data["category_name"]);
            Router::redirect('/categories/action/index');
            die();
        }
        $_SESSION["message"] = "An error occurred while creating";
        unset($data["category_name"]);
        Router::redirect('/categories/action/create');
    }

    public static function edit($data)
    {
        if (isset($data["PUT"]) &&
            $data["category_id"] &&
            $category = CategoryRepository::getCategoryById(intval($data["category_id"]))) {
            unset($data["PUT"], $data["category_id"]);
            $_SESSION["category"] = $category;
            $_SESSION["categories"] = CategoryRepository::getAllCategories();
            Router::redirect('/categories/edit');
            die();
        }

        unset($data["PUT"], $data["category_id"]);
        $_SESSION["message"] = "Unavailable Category";
        Router::redirect('/categories/action/index');
    }

    public static function update($data)
    {
        if (isset($data["PUT"]) &&
            $data["category_id"] &&
            $data["category_name"] &&
            CategoryRepository::updateCategory(intval($data["category_id"]), $data["category_name"])) {
            $_SESSION["message"] = "Successfully updated";
        } else {
            $_SESSION["message"] = "An error occurred while updating";
        }

        unset($data["PUT"], $data["category_id"], $data["category_name"]);
        Router::redirect('/categories/action/index');
    }

    public static function delete($data)
    {
        if (isset($data["DELETE"]) && $data["category_id"] && CategoryRepository::deleteCategory(intval($data["category_id"]))) {
            $_SESSION["message"] = "Successfully deleted";
        } else {
            $_SESSION["message"] = "An error occurred while deleting";
        }

        unset($data["DELETE"], $data["category_id"]);
        Router::redirect('/categories/action/index');
    }
}
