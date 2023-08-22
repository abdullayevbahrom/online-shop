<?php

namespace App\Services;

class Page
{
    public static function part($part)
    {
        require_once "views/components/" . $part . ".php";
    }

    public static function is_active($uri)
    {
        $menus = ["brands", "categories", "products", "orders", "users"];
        foreach ($menus as $menu) {
            if (strlen($uri) > 1 && str_contains($uri, $menu)) {
                $res = ucfirst($menu);
                break;
            } else {
                $res = "Online Shop";
            }
        }
        $_SESSION["page"] = $res;
    }
}