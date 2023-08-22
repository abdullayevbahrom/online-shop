<?php

namespace App\Middlewares;

use App\Services\Router;

class Auth
{
    public static function is_auth(): void
    {
        if (empty($_SESSION["user"])) {
            Router::redirect("/login");
            die();
        }
    }

    public static function has_user($uri): void
    {
        if (!empty($_SESSION["user"]) && ($uri === "/login" || $uri === "/register")) {
            Router::redirect("/");
            die();
        }
    }
}