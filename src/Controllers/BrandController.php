<?php

namespace App\Controllers;

use App\Repositories\BrandRepository;
use App\Repositories\CpsRepository;
use App\Services\Router;

class BrandController
{
    public static function index()
    {
        $brands = BrandRepository::getAllBrands();
        if (!$brands) {
            unset($_SESSION["brands"]);
            $_SESSION["message"] = "No brands available";
        } else {
            $_SESSION["brands"] = $brands;
        }

        Router::redirect('/brands');
    }

    public static function available($data)
    {
        BrandRepository::updateBrandStatus($data);
        Router::redirect('/brands/action/index');
        echo json_encode(["status" => "success"]);
    }

    public static function show($data)
    {
        if ($data["brand_id"] && $brand = BrandRepository::getBrandById(intval($data["brand_id"]))) {
            $_SESSION["brand"] = $brand;
            unset($data["brand_id"]);
            Router::redirect('/brands/show');
            die();
        }

        unset($data["brand_id"]);
        $_SESSION["message"] = "Unavailable Brand";
        Router::redirect('/brands/action/index');
    }

    public static function create()
    {
        $brands = BrandRepository::getAllBrands();
        if (!$brands) {
            unset($_SESSION["brands"]);
            $_SESSION["message"] = "No brands available";
        } else {
            $_SESSION["brands"] = $brands;
        }

        Router::redirect('/brands/create');
    }

    public static function store($data)
    {
        if ($data["brand_name"] && BrandRepository::createBrand($data["brand_name"])) {
            $_SESSION["message"] = "Brand created successfully";
            unset($data["brand_name"]);
            Router::redirect('/brands/action/index');
            die();
        }
        $_SESSION["message"] = "An error occurred while creating";
        unset($data["brand_name"]);
        Router::redirect('/brands/action/create');
    }

    public static function edit($data)
    {
        if (isset($data["PUT"]) &&
            $data["brand_id"] &&
            $brand = BrandRepository::getBrandById(intval($data["brand_id"]))) {
            unset($data["PUT"], $data["brand_id"]);
            $_SESSION["brand"] = $brand;
            $_SESSION["brands"] = BrandRepository::getAllBrands();
            Router::redirect('/brands/edit');
            die();
        }
        unset($data["PUT"], $data["brand_id"]);
        $_SESSION["message"] = "Unavailable Brand";
        Router::redirect('/brands/action/index');
    }

    public static function update($data)
    {
        if (isset($data["PUT"]) &&
            $data["brand_id"] &&
            $data["brand_name"] &&
            BrandRepository::updateBrand(intval($data["brand_id"]), $data["brand_name"])) {
            $_SESSION["message"] = "Successfully updated";
        } else {
            $_SESSION["message"] = "An error occurred while updating";
        }

        unset($data["PUT"], $data["brand_id"], $data["brand_name"]);
        Router::redirect('/brands/action/index');
    }

    public static function delete($data)
    {
        if (isset($data["DELETE"]) && $data["brand_id"] && BrandRepository::deleteBrand(intval($data["brand_id"]))) {
            $_SESSION["message"] = "Successfully deleted";
        } else {
            $_SESSION["message"] = "An error occurred while deleting";
        }

        unset($data["DELETE"], $data["brand_id"]);
        Router::redirect('/brands/action/index');
    }
}