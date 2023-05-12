<?php

use App\Models\CommentModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = new CommentModel();
    $comments = $commentModel->getCommentsForValidation();

    $twig = create_twig();

    echo $twig->render('/comments/validation.html.twig', [
        'page' => 'Gestion des commentaires',
        'comments' => $comments
    ]);
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}