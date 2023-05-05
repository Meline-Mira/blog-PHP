<?php

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = createCommentModel();
    $idComment = filter_input(INPUT_GET, 'id_comment', FILTER_SANITIZE_NUMBER_INT);
    $idPostInput = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    $currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
    $from = filter_input(INPUT_GET, 'from', FILTER_UNSAFE_RAW);
    $comment = $commentModel->getOneComment($idComment);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

        $commentModel->deleteComment($idComment);

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
    ]);
} else {
    header("Location: /users/login");
}