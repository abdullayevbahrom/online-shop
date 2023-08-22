<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\Router;

class AuthController
{
    public function login($data)
    {
        $phone = $data["phone"];
        $password = $data["password"];

        if (empty($phone) && empty($password)) {
            $_SESSION["message"] = "Phone or password incorrect!!!";
            Router::redirect('/login');
            die();
        }

        $user = UserRepository::getUserByPhone($phone);

        if (!$user) {
            $_SESSION["message"] = "You are not registered. Please register.";
            Router::redirect('/register');
            die();
        }

        if (password_verify($password, $user->password)) {
            $_SESSION["user"] = [
                "user_id" => $user->user_id,
                "role" => $user->role,
                "phone" => $user->phone,
                "orders" => [],
            ];
            Router::redirect('/products/action/index');
            die();
        } else {
            $_SESSION["message"] = "Login or password incorrect!!!";
            Router::redirect('/login');
        }
    }

    public function register($data)
    {
        if (UserRepository::createUser($data)) {
            Router::redirect('/login');
            die();
        }
        Router::error(500);
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        Router::redirect('/login');
    }
}
