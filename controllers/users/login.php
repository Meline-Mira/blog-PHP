<?php

use App\Models\CommentModel;
use App\Models\UserModel;

$userModel = new UserModel();

$errors = [];
$user = 'null';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $passwordInput = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $user = $userModel->loginUser($emailInput);

    if (empty($emailInput)) {
        $errors[] = 'Un email est demandé.';
    }
    if (empty($passwordInput)) {
        $errors[] = 'Un mot de passe est demandé.';
    }
    if (!$user || !password_verify($passwordInput, $user['password'])) {
        $errors[] = 'Les identifiants sont incorrects.';
    }

    if (!$errors) {
        $comments = new CommentModel();
        $users = new UserModel();

        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['notif_comments'] = $comments->numberOfCommentsNotValidated();
        $_SESSION['notif_users'] = $users->numberOfUsersNotValidated();
        header("Location: /");
        die;
    }
}

$twig = create_twig();

echo $twig->render('/users/login.html.twig', [
    'page' => "Connexion à votre compte",
    'errors' => $errors
]);