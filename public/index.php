<?php

const BASE_PATH = __DIR__ . '/../';
require_once BASE_PATH . 'vendor/autoload.php';

require_once BASE_PATH . '.env.example.php';
if (file_exists(BASE_PATH . '.env.local.php')) {
    require_once BASE_PATH . '.env.local.php';
}

require_once BASE_PATH . 'services/services.php';

$router = new \App\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);