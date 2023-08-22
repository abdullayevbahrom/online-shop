<?php

session_start();

require_once __DIR__ . "/vendor/autoload.php";
\App\Services\App::start();
require_once __DIR__ . "/router/routes.php";