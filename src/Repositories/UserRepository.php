<?php

namespace App\Repositories;

class UserRepository
{
    public static function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = DB->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

        return $users;
    }

    public static function createUser($data)
    {
        $phone = $data["phone"];
        $password = $data["password"];


        if (!empty($password) && !empty($phone)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $role = USER;
            $sql = "INSERT INTO users (phone, password, role) VALUES (?, ?, ?)";
            $stmt = DB->prepare($sql);
            $user = $stmt->execute([$phone, $password, $role]);

            return $user;
        }
        return false;
    }

    public static function updateUser($data)
    {
        if ($old_user = self::getUserById(intval($data["user_id"]))) {
            $user_id = intval($data["user_id"]);

            $phone = $data["phone"] ?? $old_user->phone;
            $password = $data["password"] === "**********" ? $old_user->password : password_hash($data["password"], PASSWORD_DEFAULT);

            $sql = "UPDATE users SET phone = ?, password = ? WHERE user_id = ?";
            $stmt = DB->prepare($sql);
            $user = $stmt->execute([$phone, $password, $user_id]);

            return $user;
        }
        return false;
    }

    public static function getUserById($user_id)
    {
        if ($user_id) {
            $sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
            $stmt = DB->prepare($sql);
            $stmt->execute([intval($user_id)]);
            $user = $stmt->fetch();

            return $user;
        }
        return false;
    }

    public static function getUserByPhone($phone)
    {
        if ($phone) {
            $sql = "SELECT * FROM users WHERE phone = ?";
            $stmt = DB->prepare($sql);
            $stmt->execute([$phone]);
            $user = $stmt->fetch();

            return $user;
        }

        return false;
    }

    public static function deleteUser($user_id)
    {
        if ($user_id && self::getUserById(intval($user_id))) {
            $sql = "DELETE FROM users WHERE user_id = ?";
            $stmt = DB->prepare($sql);
            $user = $stmt->execute([intval($user_id)]);
            return $user;
        }
        return false;
    }
}
