<?php

use App\Models\CommentModel;
use App\Models\UserModel;
use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

function create_twig(): Environment
{
    $loader = new FilesystemLoader(__DIR__ . '/../views');
    $twig = new Environment($loader, [
        'cache' => false,
        'debug' => true,
    ]);
    $twig->addExtension(new IntlExtension());
    $twig->addFunction(new TwigFunction('urlIs', 'urlIs'));
    $twig->addFunction(new TwigFunction('urlStartsWith', 'urlStartsWith'));
    $twig->addGlobal('post', $_POST);
    if (isset($_SESSION['email'])) {
        $twig->addGlobal('user_email', $_SESSION['email']);
        $twig->addGlobal('user_first_name', $_SESSION['first_name']);
        $twig->addGlobal('user_last_name', $_SESSION['last_name']);
        $twig->addGlobal('user_role', $_SESSION['role']);
        $twig->addGlobal('user_id', $_SESSION['id']);
        $twig->addGlobal('logged_in', true);
        if ($_SESSION['role'] === 'admin') {
            $commentModel = new CommentModel();
            $userModel = new UserModel();
            $twig->addGlobal('notif_comments', $commentModel->numberOfCommentsNotValidated());
            $twig->addGlobal('notif_users', $userModel->numberOfUsersNotValidated());
        }
    } else {
        $twig->addGlobal('logged_in', false);
    }

    return $twig;
}
