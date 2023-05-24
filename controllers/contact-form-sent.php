<?php

header("Refresh: 5;URL=/");
$twig = create_twig();

echo $twig->render('contact-form-sent.html.twig', ['page' => 'Formulaire envoyé']);
