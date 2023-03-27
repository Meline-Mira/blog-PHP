<?php

require_once __DIR__.'/../vendor/autoload.php';

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

require_once __DIR__.'/../.env.example.php';
if (file_exists(__DIR__.'/../.env.local.php')) {
    require_once __DIR__.'/../.env.local.php';
}

require_once __DIR__.'/../services/symfony-mailer.php';
require_once __DIR__.'/../services/twig.php';

if (urlIs('/')) {
    require_once __DIR__ . '/../controllers/home.php';
}

if (urlIs('/contact-form-sent')) {
    require_once __DIR__ . '/../controllers/contact-form-sent.php';
}