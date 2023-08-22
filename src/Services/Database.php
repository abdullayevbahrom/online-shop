<?php

namespace App\Services;

class Database
{
    public static function connect()
    {
        $config = require_once "config/db.php";

        if ($config["enable"]) {
            try {
                $pdo = new \PDO(
                    'mysql:host=' . $config["host"] . ';dbname=' . $config["db_name"] . ';charset=' . $config["charset"],
                    $config["username"],
                    $config["password"],
                    $config["options"]
                );
                return $pdo;
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                die();
            }
        }
    }
}