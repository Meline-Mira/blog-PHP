<?php

use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

function create_twig(): Environment
{
    $loader = new FilesystemLoader(__DIR__ . '/../views');
    $twig = new Environment($loader, [
        'cache' => false/*__DIR__ . '/../var/cache'*/,
        'debug' => true,
    ]);
    $twig->addExtension(new IntlExtension());
    $function = new TwigFunction('urlIs', 'urlIs');
    $twig->addFunction($function);
    $twig->addGlobal('post', $_POST);

    return $twig;
}
