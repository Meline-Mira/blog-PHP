<?php

use App\Models\CommentModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = new CommentModel();
    $idComment = filter_input(INPUT_GET, 'id_comment', FILTER_SANITIZE_NUMBER_INT);
    $idPostInput = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    $currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
    $from = filter_input(INPUT_GET, 'from', FILTER_UNSAFE_RAW);
    $comment = $commentModel->getOneComment($idComment);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

        $commentModel->deleteComment($idComment);
        $_SESSION['notif_comments'] = $commentModel->numberOfCommentsNotValidated();

        if ($from === 'posts') {
            header("Location: /posts/read?id=" . $idPostInput . "&current_page=" . $currentPage . "#comments");
        } elseif ($from === 'validation'){
            header("Location: /comments/validation");
        }
    }

    $twig = create_twig();

    echo $twig->render('/comments/delete.html.twig', [
        'page' => "Suppression d'un commentaire",
        'comment' => $comment,
        'current_page' => $currentPage,
        'from' => $from
    ]);
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}