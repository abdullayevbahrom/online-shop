<?php

namespace App\Middlewares;

use App\Services\Router;

class Permission
{
    public static function is_user($route): void
    {
        if ($route["uri"] === "/users/action/index" && $_SESSION["user"]["role"] === "user") {
            Router::redirect('/users/action/show');
            die();
        }

        if ($_SESSION["user"]["role"] === MANAGER && $route["role"] === ADMIN) {
            Router::error(403);
            die();
        } elseif ($_SESSION["user"]["role"] === USER && ($route["role"] === ADMIN || $route["role"] === MANAGER)) {
            Router::error(403);
            die();
        }
    }
}