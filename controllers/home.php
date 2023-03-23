<?php

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['email'])) {
        $errors[] = 'Une adresse email est demandée.';
    }
    if (empty($_POST['first-name'])) {
        $errors[] = 'Un prénom est demandé.';
    }
    if (empty($_POST['last-name'])) {
        $errors[] = 'Un nom est demandé.';
    }
    if (empty($_POST['message'])) {
        $errors[] = 'Un message est demandé.';
    }

    if (empty($errors)) {
        $mailer = create_mailer();
        $email = (new Email())
            ->from(new Address($_POST['email'], $_POST['first-name'] . ' ' . $_POST['last-name']))
            ->to('emeline.gineys@gmail.com')
            ->subject('Formulaire de contact')
            ->text($_POST['message']);

        $mailer->send($email);

        $success = true;
    }
}

$twig = create_twig();

echo $twig->render('home.html.twig', ['page' => 'Accueil', 'contact_form_success' => $success, 'errors' => $errors]);
