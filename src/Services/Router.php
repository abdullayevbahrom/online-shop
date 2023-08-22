<?php

namespace App\Services;

use App\Middlewares\Auth;
use App\Middlewares\Permission;

class Router
{
    private static array $list = [];

    public static function page($uri, $page, $role = USER, $auth = true)
    {
        self::$list[] = [
            "uri" => $uri,
            "page" => $page,
            "role" => $role,
            "auth" => $auth
        ];
    }

    public static function action($uri, $class, $method, $formdata = false, $files = false, $role = USER, $auth = true)
    {
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "formdata" => $formdata,
            "files" => $files,
            "role" => $role,
            "auth" => $auth
        ];
    }

    public static function enable()
    {
        $query = $_GET['q'] ?? '';

        foreach (self::$list as $route) {
            if ($route["uri"] === '/' . $query) {
                if ($route["auth"]) {
                    Auth::is_auth();
                    Permission::is_user($route);
                } else {
                    Auth::has_user($route["uri"]);
                }

                Page::is_active($route["uri"]);

                if (isset($route["method"])) {
                    $action = new $route["class"];
                    $method = $route["method"];
                    if ($route["formdata"] && $route["files"]) {
                        $action->$method($_POST, $_FILES);
                    } elseif ($route["formdata"] && !$route["files"]) {
                        $action->$method($_POST);
                    } else {
                        $action->$method();
                    }
                    die();
                } else {
                    require_once "views/pages/" . $route["page"] . ".php";
                    die();
                }
            }
        }

        self::error(404);
    }

    public static function error($error)
    {
        require_once "views/errors/" . $error . ".php";
    }

    public static function redirect($uri)
    {
        header('Location: ' . $uri);
    }
}