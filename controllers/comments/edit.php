<?php

use App\Models\CommentModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = new CommentModel();
    $idComment = filter_input(INPUT_GET, 'id_comment', FILTER_SANITIZE_NUMBER_INT);
    $idPostInput = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    $currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
    $from = filter_input(INPUT_GET, 'from', FILTER_UNSAFE_RAW);
    $comment = $commentModel->getOneComment($idComment);

    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contentInput = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
        $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

        if (empty($contentInput)) {
            $error = 'Un commentaire est demandé.';
        }

        if (!$error) {
            $commentModel->editCommentByAdmin($contentInput, $idComment);
            $_SESSION['notif_comments'] = $commentModel->numberOfCommentsNotValidated();

            if ($from === 'posts') {
                header("Location: /posts/read?id=" . $idPostInput . "&current_page=" . $currentPage . "#comments");
                die;
            } elseif ($from === 'validation'){
                header("Location: /comments/validation");
            }
        }
    }

    $twig = create_twig();

    echo $twig->render('/comments/edit.html.twig', [
        'page' => "Édition d'un commentaire",
        'comment' => $comment,
        'current_page' => $currentPage,
        'error' => $error,
        'from' => $from
    ]);
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}