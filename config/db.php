<?php

return [
    "enable" => true,
    "host" => 'mysql',
    "username" => 'root',
    "password" => 'secret',
    "db_name" => 'online_shop',
    "charset" => 'utf8mb4',
    "options" => [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
    ]
];