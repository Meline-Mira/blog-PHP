<?php
header ("Refresh: 10;URL=/");
$twig = create_twig();

echo $twig->render('/users/waiting-for-validation.html.twig', ['page' => 'Compte utilisateur en cours de validation']);