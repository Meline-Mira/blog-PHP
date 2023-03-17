<?php

require_once __DIR__.'/../vendor/autoload.php';

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__.'/../var/cache',
    'debug' => true,
]);
$function = new \Twig\TwigFunction('urlIs', 'urlIs');
$twig->addFunction($function);
echo $twig->render('home.html.twig', ['page' => 'Accueil']);
