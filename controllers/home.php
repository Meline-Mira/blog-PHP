<?php

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $firstNameInput = filter_input(INPUT_POST, 'first_name', FILTER_UNSAFE_RAW);
    $lastNameInput = filter_input(INPUT_POST, 'last_name', FILTER_UNSAFE_RAW);
    $messageInput = filter_input(INPUT_POST, 'message', FILTER_UNSAFE_RAW);
    $confidentialityInput = filter_input(INPUT_POST, 'confidentiality', FILTER_UNSAFE_RAW);

    if ($emailInput === null || $emailInput === false) {
        $errors[] = 'Une adresse email est demandée.';
    }
    if ($firstNameInput === '' || $firstNameInput === false) {
        $errors[] = 'Un prénom est demandé.';
    }
    if ($lastNameInput === '' || $lastNameInput === false) {
        $errors[] = 'Un nom est demandé.';
    }
    if ($messageInput === '' || $messageInput === false) {
        $errors[] = 'Un message est demandé.';
    }
    if ($confidentialityInput !== 'on') {
        $errors[] = 'Vous devez accepter la politique de confidentialité.';
    }

    if (empty($errors)) {
        $mailer = create_mailer();
        $email = (new Email())
            ->from(new Address($emailInput, $firstNameInput . ' ' . $lastNameInput))
            ->to('emeline.gineys@gmail.com')
            ->subject('Formulaire de contact')
            ->text($messageInput);

        $mailer->send($email);

        $success = true;

        header("Location: /contact-form-sent");
        die;
    }
}

$twig = create_twig();

echo $twig->render('home.html.twig', ['page' => 'Accueil', 'contact_form_success' => $success, 'errors' => $errors]);
