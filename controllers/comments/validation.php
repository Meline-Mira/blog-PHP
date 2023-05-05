<?php

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = createCommentModel();
    $comments = $commentModel->getCommentsForValidation();

    $twig = create_twig();

    echo $twig->render('/comments/validation.html.twig', [
        'page' => 'Gestion des commentaires',
        'comments' => $comments
    ]);
} else {
    header("Location: /");
}