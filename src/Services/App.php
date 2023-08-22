<?php

namespace App\Services;

class App
{
    public static function start()
    {
        self::libs();
        self::db();
    }

    private static function libs()
    {
        $config = require_once "config/app.php";
        foreach ($config["libs"] as $lib) {
            require_once "libs/" . $lib . ".php";
        }
    }

    private static function db()
    {
        define("DB", Database::connect());
    }
}