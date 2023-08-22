<?php

namespace App\Controllers;

use App\Repositories\OrderRepository;
use App\Services\Router;

class OrderController
{
    public static function index()
    {
        $orders = OrderRepository::getAllOrders();
        if (!$orders) {
            unset($_SESSION["orders"]);
            $_SESSION["message"] = "No orders available";
        } else {
            $_SESSION["orders"] = $orders;
        }

        Router::redirect('/orders');
    }

    public static function show($data)
    {
        $order_products = OrderRepository::getOneOrder($data);
        if (!$order_products) {
            unset($_SESSION["order_products"]);
            $_SESSION["message"] = "No order products available";
        } else {
            $_SESSION["order_products"] = $order_products;
        }

        Router::redirect('/orders/show');
    }

    public static function store($data)
    {
        OrderRepository::createOrder($data);

        Router::redirect('/orders/action/index');
    }

    public static function order($data)
    {
        OrderRepository::updateOrderStatus($data);

        unset($data["order_id"]);
        Router::redirect('/orders/action/index');
    }

    public static function delete($data)
    {

        
        if (isset($data["DELETE"]) && !empty($data["order_id"]) && !empty($data["order_product_id"]) && OrderRepository::deleteOrderProduct($data)) {
            $_SESSION["message"] = "Successfully deleted";
        } elseif (isset($data["DELETE"]) && !empty($data["order_id"]) && OrderRepository::deleteOrder(intval($data["order_id"]))) {
            $_SESSION["message"] = "Successfully deleted";
            unset($data["order_product_id"]);
        } else {
            $_SESSION["message"] = "An error occurred while deleting";
        }

        Router::redirect('/orders/action/index');
        unset($data["DELETE"], $data["order_id"]);
    }
}
