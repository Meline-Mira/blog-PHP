<?php

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = createCommentModel();
    $idComment = filter_input(INPUT_GET, 'id_comment', FILTER_SANITIZE_NUMBER_INT);
    $idPostInput = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    $currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
    $comment = $commentModel->getOneComment($idComment);

    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contentInput = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
        $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

        if ($contentInput === '' || $contentInput === false) {
            $error = 'Un commentaire est demandé.';
        }

        if ($error === null) {
            $commentModel->editCommentByAdmin($contentInput, $idComment);

            header("Location: /posts/read?id=" . $idPostInput . "&current_page=" . $currentPage . "#comments");
            die;
        }
    }

    $twig = create_twig();

    echo $twig->render('/comments/edit.html.twig', [
        'page' => "Édition d'un commentaire",
        'comment' => $comment,
        'current_page' => $currentPage,
        'error' => $error
    ]);
} else {
    header("Location: /users/login");
}