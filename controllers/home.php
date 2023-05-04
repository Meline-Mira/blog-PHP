<?php

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageInput = filter_input(INPUT_POST, 'message', FILTER_UNSAFE_RAW);
    $confidentialityInput = filter_input(INPUT_POST, 'confidentiality', FILTER_UNSAFE_RAW);

    if (empty($messageInput)) {
        $errors[] = 'Un message est demandé.';
    }
    if ($confidentialityInput !== 'on') {
        $errors[] = 'Vous devez accepter la politique de confidentialité.';
    }

    if (empty($errors) && isset($_SESSION['id'])) {
        $mailer = create_mailer();
        $email = (new Email())
            ->from(new Address($_SESSION['email'], $_SESSION['first_name'] . ' ' . $_SESSION['last_name']))
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
