<?php

require_once "config/roles.php";

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\BrandController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Controllers\OrderController;
use App\Services\Router;

/* Authentication routes and actions */
Router::page('/login', 'auth/login', auth: false);
Router::page('/register', 'auth/register', auth: false);
Router::action('/auth/login', AuthController::class, "login", true, auth: false);
Router::action('/auth/register', AuthController::class, "register", true, auth: false);
Router::action('/auth/logout', AuthController::class, "logout");

Router::page('/', 'products/index');

/* Brands routes and actions */
Router::action('/brands/action/index', BrandController::class, "index", role: ADMIN);
Router::action('/brands/action/available', BrandController::class, "available", true, role: ADMIN);
Router::action('/brands/action/show', BrandController::class, "show", true, role: ADMIN);
Router::action('/brands/action/create', BrandController::class, "create", role: ADMIN);
Router::action('/brands/action/store', BrandController::class, "store", true, role: ADMIN);
Router::action('/brands/action/edit', BrandController::class, "edit", true, role: ADMIN);
Router::action('/brands/action/update', BrandController::class, "update", true, role: ADMIN);
Router::action('/brands/action/delete', BrandController::class, "delete", true, role: ADMIN);
Router::page('/brands', 'brands/index', role: ADMIN);
Router::page('/brands/show', 'brands/show', role: ADMIN);
Router::page('/brands/create', 'brands/create', role: ADMIN);
Router::page('/brands/edit', 'brands/edit', role: ADMIN);

/* Categories routes and actions */
Router::action('/categories/action/index', CategoryController::class, "index", role: ADMIN);
Router::action('/categories/action/available', CategoryController::class, "available", true, role: ADMIN);
Router::action('/categories/action/show', CategoryController::class, "show", true, role: ADMIN);
Router::action('/categories/action/create', CategoryController::class, "create", role: ADMIN);
Router::action('/categories/action/store', CategoryController::class, "store", true, role: ADMIN);
Router::action('/categories/action/edit', CategoryController::class, "edit", true, role: ADMIN);
Router::action('/categories/action/update', CategoryController::class, "update", true, role: ADMIN);
Router::action('/categories/action/delete', CategoryController::class, "delete", true, role: ADMIN);
Router::page('/categories', 'categories/index', role: ADMIN);
Router::page('/categories/show', 'categories/show', role: ADMIN);
Router::page('/categories/create', 'categories/create', role: ADMIN);
Router::page('/categories/edit', 'categories/edit', role: ADMIN);

/* Products routes and actions */
Router::action('/products/action/index', ProductController::class, "index");
Router::action('/products/action/available', ProductController::class, "available", true, role: ADMIN);
Router::action('/products/action/show', ProductController::class, "show", true);
Router::action('/products/action/create', ProductController::class, "create", role: ADMIN);
Router::action('/products/action/store', ProductController::class, "store", true, true, role: ADMIN);
Router::action('/products/action/edit', ProductController::class, "edit", true, role: ADMIN);
Router::action('/products/action/update', ProductController::class, "update", true, true, role: ADMIN);
Router::action('/products/action/delete', ProductController::class, "delete", true, role: ADMIN);
Router::page('/products', 'products/index');
Router::page('/products/show', 'products/show');
Router::page('/products/create', 'products/create', role: ADMIN);
Router::page('/products/edit', 'products/edit', role: ADMIN);

/* Users routes and actions */
Router::action('/users/action/index', UserController::class, "index", role: MANAGER);
Router::action('/users/action/show', UserController::class, "show", true);
Router::action('/users/action/create', UserController::class, "create", role: ADMIN);
Router::action('/users/action/store', UserController::class, "store", true, role: ADMIN);
Router::action('/users/action/edit', UserController::class, "edit", true, role: ADMIN);
Router::action('/users/action/update', UserController::class, "update", true, role: ADMIN);
Router::action('/users/action/delete', UserController::class, "delete", true, role: ADMIN);
Router::page('/users', 'users/index', role: MANAGER);
Router::page('/users/show', 'users/show');
Router::page('/users/create', 'users/create', role: ADMIN);
Router::page('/users/edit', 'users/edit', role: ADMIN);

/* Orders routes and actions */
Router::action('/orders/action/index', OrderController::class, "index");
Router::action('/orders/action/show', OrderController::class, "show", true);
Router::action('/orders/action/order', OrderController::class, "order", true);
Router::action('/orders/action/store', OrderController::class, "store", true);
Router::action('/orders/action/delete', OrderController::class, "delete", true);

Router::page('/orders', 'orders/index');
Router::page('/orders/show', 'orders/show');


/* Errors routes */
Router::page('/operations/report', 'operations/report');


Router::enable();
