<?php

$twig = create_twig();

echo $twig->render('/mandatory-info.html.twig', [
    'page' => 'Informations obligatoires'
]);
