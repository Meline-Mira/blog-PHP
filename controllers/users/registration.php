<?php

use App\Models\UserModel;

$userModel = new UserModel();

$errors = [];
$emailCompared = 'null';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $passwordInput = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $firstNameInput = filter_input(INPUT_POST, 'first_name', FILTER_UNSAFE_RAW);
    $lastNameInput = filter_input(INPUT_POST, 'last_name', FILTER_UNSAFE_RAW);
    $emailCompared = $userModel->getUser($emailInput);

    if (empty($firstNameInput)) {
        $errors[] = 'Un prénom est demandé.';
    }
    if (empty($lastNameInput)) {
        $errors[] = 'Un nom est demandé.';
    }
    if (empty($emailInput)) {
        $errors[] = 'Un email est demandé.';
    }
    if ($emailInput === $emailCompared['email']) {
        $errors[] = 'L\'email est incorrect.';
    }
    if (empty($passwordInput)) {
        $errors[] = 'Un mot de passe est demandé.';
    }
    if (strlen($passwordInput) < 8) {
        $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
    }

    if (!$errors) {
        $password = password_hash($passwordInput, PASSWORD_DEFAULT);
        $userModel->createUser($emailInput, $password, $firstNameInput, $lastNameInput);

        header("Location: /users/waiting-for-validation");
        die;
    }
}

$twig = create_twig();

echo $twig->render('/users/registration.html.twig', [
    'page' => 'Inscription',
    'emailCompared' => $emailCompared,
    'errors' => $errors
]);
