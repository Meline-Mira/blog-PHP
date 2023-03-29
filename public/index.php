<?php

const BASE_PATH = __DIR__ . '/../';
require_once BASE_PATH . 'vendor/autoload.php';
require_once BASE_PATH . 'services/functions.php';

require_once __DIR__.'/../.env.example.php';
if (file_exists(__DIR__.'/../.env.local.php')) {
    require_once __DIR__.'/../.env.local.php';
}

require_once __DIR__.'/../services/symfony-mailer.php';
require_once __DIR__.'/../services/twig.php';

$router = new \App\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);