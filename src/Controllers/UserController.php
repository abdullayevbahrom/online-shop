<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\Router;

class UserController
{
    public static function index()
    {
        $users = UserRepository::getAllUsers();
        if (!$users) {
            unset($_SESSION["users"]);
            $_SESSION["message"] = "No users available";
        } else {
            $_SESSION["users"] = $users;
        }

        Router::redirect('/users');
    }

    public static function show($data)
    {
        $user_id = $data["user_id"] ?? $_SESSION["user"]["user_id"];
        if ($user_id && $user = UserRepository::getUserById(intval($user_id))) {
            if ($user->role === ADMIN && $_SESSION["user"]["role"] === MANAGER) {
                Router::error(403);
                die();
            }
            $_SESSION["user-show"] = $user;
            unset($data["user_id"]);
            Router::redirect('/users/show');
            die();
        }

        unset($data["user_id"]);
        $_SESSION["message"] = "Unavailable User";
        Router::redirect('/users/action/index');
    }

    public static function create()
    {
        Router::redirect('/users/create');
    }

    public static function store($data)
    {
        if ($data["phone"] &&
            $data["password"] &&
            !UserRepository::getUserByPhone($data["phone"]) &&
            UserRepository::createUser($data)) {
            $_SESSION["message"] = "User created successfully";
            unset($data);
            Router::redirect('/users/action/index');
            die();
        }
        $_SESSION["message"] = "An error occurred while creating";
        unset($data);
        Router::redirect('/users/action/create');
    }

    public static function edit($data)
    {
        if (isset($data["PUT"]) &&
            $data["user_id"] &&
            $user = UserRepository::getUserById(intval($data["user_id"]))) {
            unset($data["PUT"], $data["user_id"]);
            $_SESSION["user-edit"] = $user;
            Router::redirect('/users/edit');
            die();
        }

        unset($data["PUT"], $data["user_id"]);
        $_SESSION["message"] = "Unavailable User";
        Router::redirect('/users/action/index');
    }

    public static function update($data)
    {
        if (isset($data["PUT"]) &&
            $data["user_id"] &&
            $data["phone"] &&
            UserRepository::updateUser($data)) {
            $_SESSION["message"] = "Successfully updated";
        } else {
            $_SESSION["message"] = "An error occurred while updating";
        }

        unset($data);
        Router::redirect('/users/action/index');
    }

    public static function delete($data)
    {
        if (isset($data["DELETE"]) && $data["user_id"] && UserRepository::deleteUser(intval($data["user_id"]))) {
            $_SESSION["message"] = "Successfully deleted";
        } else {
            $_SESSION["message"] = "An error occurred while deleting";
        }

        unset($data["DELETE"], $data["user_id"]);
        Router::redirect('/users/action/index');
    }
}
