<?php

namespace App\Repositories;

class OrderRepository
{
    public static function getAllOrders()
    {
        if ($_SESSION['user']['role'] === USER) {
            $user_id = $_SESSION['user']['user_id'];
            $sql = "SELECT o.order_id, o.order_status, u.phone, COUNT(*) as products, SUM(op.price) as price
                            FROM orders o 
                            JOIN users u ON u.user_id = o.user_id
                            JOIN order_product op ON op.order_id = o.order_id
                            WHERE u.user_id = $user_id
                            GROUP BY o.order_id
                            ORDER BY o.order_status";
        } else {
            $sql = "SELECT o.order_id, o.order_status, u.phone, COUNT(*) as products, SUM(op.price) as price
                            FROM orders o 
                            JOIN users u ON u.user_id = o.user_id
                            JOIN order_product op ON op.order_id = o.order_id
                            WHERE o.order_status = 1
                            GROUP BY o.order_id";
        }

        $stmt = DB->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll();

        return $orders;
    }

    public static function getOneOrder($data)
    {
        $order_id = intval($data['order_id']);

        if ($order_id) {
            $sql = "SELECT o.order_id, p.product_id, op.order_product_id, p.product_name, p.photo, op.price, op.quantity
                FROM orders o 
                JOIN users u ON u.user_id = o.user_id
                JOIN order_product op ON op.order_id = o.order_id
                JOIN products p ON p.product_id = op.product_id
                WHERE o.order_id = ?";
            $stmt = DB->prepare($sql);
            $stmt->execute([$order_id]);
            $order = $stmt->fetchAll();

            return $order;
        }
        return false;
    }

    public static function createOrder($data)
    {
        $user_id = $_SESSION['user']['user_id'];
        $sql = "SELECT order_id, order_status FROM orders WHERE order_status = 0 AND user_id = ? LIMIT 1";
        $stmt = DB->prepare($sql);
        $stmt->execute([$user_id]);
        $order = $stmt->fetch();
        $order_id = $order->order_id;

        if (!$order) {
            $sql = "INSERT INTO orders (`user_id`) VALUES (?)";
            $stmt = DB->prepare($sql);
            $order = $stmt->execute([$user_id]);
            $order_id = DB->lastInsertId();
        }

        if (!empty($data['product_id']) && !empty($data['price'])) {
            $sql = "INSERT INTO order_product (`order_id`, `product_id`, `price`) VALUES (?, ?, ?)";
            $stmt = DB->prepare($sql);
            $order = $stmt->execute([intval($order_id), intval($data['product_id']), intval($data['price'])]);

            return $order;
        }
        return false;
    }

    public static function updateOrderStatus($data)
    {
        $order_id = intval($data["order_id"]);

        $sql = "UPDATE `orders` SET `order_status` = ? WHERE `order_id` = ?";
        $stmt = DB->prepare($sql);
        $stmt->execute([1, $order_id]);
    }


    public static function deleteOrderProduct($data)
    {
        $order_product_id = $data["order_product_id"];
        $order_id = $data["order_id"];
        if ($order_product_id && $order_id) {
            $sql = "DELETE FROM `order_product` WHERE `order_product_id` = ?";
            $stmt = DB->prepare($sql);
            $order_product = $stmt->execute([intval($order_product_id)]);

            $sql = "SELECT order_id FROM `order_product` WHERE `order_id` = ?";
            $stmt = DB->prepare($sql);
            $order = $stmt->execute([intval($order_id)]);

            self::deleteOrder($order_id);

            return $order_product;
        }
        return false;
    }

    public static function deleteOrder($order_id)
    {
        if ($order_id) {
            $sql = "DELETE FROM `orders` WHERE `order_id` = ?";
            $stmt = DB->prepare($sql);
            $order = $stmt->execute([$order_id]);
            return $order;
        }

        return false;
    }
}
