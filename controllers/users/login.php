<?php

$userModel = createUserModel();

$errors = [];
$user = 'null';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $passwordInput = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $user = $userModel->getUser($emailInput);

    if ($emailInput === '' || $emailInput === false) {
        $errors[] = 'Un email est demandé.';
    }
    if ($passwordInput === '' || $passwordInput === false) {
        $errors[] = 'Un mot de passe est demandé.';
    }
    if ($user === false || !password_verify($passwordInput, $user['password']) || $user['valid'] === 0) {
        $errors[] = 'Les identifiants sont incorrects.';
    }

    if (!$errors) {
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        header("Location: /");
        die;
    }
}

$twig = create_twig();

echo $twig->render('/users/login.html.twig', [
    'page' => "Connexion à votre compte",
    'errors' => $errors
]);