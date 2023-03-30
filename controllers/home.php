<?php

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_input = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $first_name_input = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_ADD_SLASHES);
    $last_name_input = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_ADD_SLASHES);
    $message_input = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_ADD_SLASHES);
    $confidentiality_input = filter_input(INPUT_POST, 'confidentiality', FILTER_SANITIZE_ADD_SLASHES);

    if ($email_input === null || $email_input === false) {
        $errors[] = 'Une adresse email est demandée.';
    }
    if ($first_name_input === '' || $first_name_input === false) {
        $errors[] = 'Un prénom est demandé.';
    }
    if ($last_name_input === '' || $last_name_input === false) {
        $errors[] = 'Un nom est demandé.';
    }
    if ($message_input === '' || $message_input === false) {
        $errors[] = 'Un message est demandé.';
    }
    if ($confidentiality_input !== 'on') {
        $errors[] = 'Vous devez accepter la politique de confidentialité.';
    }

    if (empty($errors)) {
        $mailer = create_mailer();
        $email = (new Email())
            ->from(new Address($email_input, $first_name_input . ' ' . $last_name_input))
            ->to('emeline.gineys@gmail.com')
            ->subject('Formulaire de contact')
            ->text($message_input);

        $mailer->send($email);

        $success = true;

        header("Location: /contact-form-sent");
        die;
    }
}

$twig = create_twig();

echo $twig->render('home.html.twig', ['page' => 'Accueil', 'contact_form_success' => $success, 'errors' => $errors]);
