SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:00";

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL UNIQUE,
  `category_slug` varchar(50) NOT NULL,
  `category_status` tinyint(3) unsigned NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `brand_name` varchar(50) NOT NULL UNIQUE,
  `brand_slug` varchar(50) NOT NULL,
  `brand_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL, 
  `order_status` tinyint(4) NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL UNIQUE,
  `photo` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `order_product` (
  `order_product_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`user_id`, `phone`, `role`, `password`) VALUES
(1, '901234567', 'admin', '$2y$10$ZXR75DbuYlbdZgPy1M5lqeyD7od7/EbO7OdMzMCup9nsq7MHaXQxu'),
(2, '911234567', 'manager', '$2y$10$ZXR75DbuYlbdZgPy1M5lqeyD7od7/EbO7OdMzMCup9nsq7MHaXQxu'),
(3, '921234567', 'user', '$2y$10$ZXR75DbuYlbdZgPy1M5lqeyD7od7/EbO7OdMzMCup9nsq7MHaXQxu');

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`, `category_status`) VALUES
(1,	'Laptop',	'laptop',	1),
(2,	'Telephones',	'telephones',	1),
(3,	'Smart Watch',	'smart-watch',	1),
(4,	'Bolalar kiyimlari',	'bolalar-kiyimlari',	0);

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_slug`, `brand_status`) VALUES
(1,	'Samsung',	'samsung',	1),
(2,	'Apple',	'apple',	1),
(3,	'Xiaomi',	'xiaomi',	1);

INSERT INTO `products` (`product_id`, `category_id`, `brand_id`, `product_name`, `photo`, `price`, `status`) VALUES
(1, 1, 1, 'Lenovo', '/assets/img/product.jpg', 4500000, 1),
(2, 2, 2, 'iPhone 14', '/assets/img/product.jpg', 14000000, 1),
(3, 3, 3, 'Smart Watch Pro', '/assets/img/product.jpg', 3200000, 1),
(4, 1, 1, 'Acer', '/assets/img/product.jpg',10000000, 1),
(5, 2, 2, 'iPad', '/assets/img/product.jpg',7800000, 1),
(6, 3, 3, 'Redmi 10 Pro', '/assets/img/product.jpg',5600000, 1);

COMMIT;