<?php

$postModel = createUserModel();

$errors = [];
$valid = 0;
$role = 'user';
$emailCompared = 'null';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $passwordInput = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $firstNameInput = filter_input(INPUT_POST, 'first_name', FILTER_UNSAFE_RAW);
    $lastNameInput = filter_input(INPUT_POST, 'last_name', FILTER_UNSAFE_RAW);
    $emailCompared = $postModel->getUser($emailInput);

    if ($firstNameInput === '' || $firstNameInput === false) {
        $errors[] = 'Un prénom est demandé.';
    }
    if ($lastNameInput === '' || $lastNameInput === false) {
        $errors[] = 'Un nom est demandé.';
    }
    if ($emailInput === '' || $emailInput === false) {
        $errors[] = 'Un email est demandé.';
    }
    if ($emailInput === $emailCompared['email']) {
        $errors[] = 'L\'email est incorrect.';
    }
    if ($passwordInput === '' || $passwordInput === false) {
        $errors[] = 'Un mot de passe est demandé.';
    }
    if (strlen($passwordInput) < 8) {
        $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
    }

    if (!$errors) {
        $password = password_hash($passwordInput, PASSWORD_DEFAULT);
        $postModel->createUser($emailInput, $password, $firstNameInput, $lastNameInput, $valid, $role);

        header("Location: /users/waiting-for-validation");
        die;
    }
}

$twig = create_twig();

echo $twig->render('/users/registration.html.twig', [
    'page' => 'Inscritpion',
    'emailCompared' => $emailCompared,
    'errors' => $errors
]);