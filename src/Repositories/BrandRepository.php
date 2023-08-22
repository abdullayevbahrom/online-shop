<?php

namespace App\Repositories;

class BrandRepository
{
    public static function getAllBrands()
    {
        if ($_SESSION["user"]['role'] === USER || $_SESSION["user"]['role'] === MANAGER) {
            $sql = "SELECT * FROM brands WHERE brand_status = 1";
        } else {
            $sql = "SELECT * FROM brands";
        }
        $sql = "SELECT * FROM brands";
        $stmt = DB->prepare($sql);
        $stmt->execute();
        $brands = $stmt->fetchAll();

        return $brands;
    }

    public static function createBrand($brand_name)
    {
        if ($brand_name && !self::getBrandByName($brand_name)) {
            $brand_slug = str_replace(' ', '-', strtolower($brand_name));
            $sql = "INSERT INTO `brands` (`brand_name`, `brand_slug`) VALUES (?, ?)";
            $stmt = DB->prepare($sql);
            $brand = $stmt->execute([$brand_name, $brand_slug]);

            return $brand;
        }
        return false;
    }

    public static function getBrandByName($brand_name)
    {
        if ($brand_name) {
            $sql = "SELECT * FROM `brands` WHERE `brand_name` = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([$brand_name]);
            $brand = $stmt->fetch();

            return $brand;
        }
        return false;
    }

    public static function updateBrand($brand_id, $brand_name)
    {
        if ($brand_id && $brand_name && $old_brand = self::getBrandById(intval($brand_id))) {
            if ($old_brand->brand_name !== $brand_name && !self::getBrandByName($brand_name)) {
                $brand_slug = str_replace(' ', '-', strtolower($brand_name));
                $sql = "UPDATE `brands` SET `brand_name` = ?, `brand_slug` = ? WHERE `brand_id` = ?";
                $stmt = DB->prepare($sql);
                $brand = $stmt->execute([$brand_name, $brand_slug]);
                return $brand;
            }

            return true;
        }
        return false;
    }

    public static function updateBrandStatus($data)
    {
        $brand_id = intval($data["brand_id"]);
        $brand_status = intval($data["brand_status"]);

        $sql = "UPDATE `brands` SET `brand_status` = ? WHERE `brand_id` = ?";
        $stmt = DB->prepare($sql);
        $stmt->execute([$brand_status, $brand_id]);
    }

    public static function getBrandById($brand_id)
    {
        if ($brand_id) {
            $sql = "SELECT * FROM `brands` WHERE `brand_id` = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([intval($brand_id)]);
            $brand = $stmt->fetch();

            return $brand;
        }
        return false;
    }

    public static function deleteBrand($brand_id)
    {
        if ($brand_id && self::getBrandById(intval($brand_id))) {
            $sql = "DELETE FROM `brands` WHERE `brand_id` = ?";
            $stmt = DB->prepare($sql);
            $brand = $stmt->execute([intval($brand_id)]);

            return $brand;
        }
        return false;
    }
}
