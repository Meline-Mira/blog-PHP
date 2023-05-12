<?php

function urlIs($value)
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $value;
}

function urlStartsWith($value)
{
    return str_starts_with(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $value);
}

function basePath($path)
{
    return BASE_PATH . $path;
}

function error(string $message, int $code)
{
    $twig = create_twig();
    http_response_code($code);
    echo $twig->render('error.html.twig', ['page' => 'Erreur', 'message' => $message, 'code' => $code]);

    die;
}
