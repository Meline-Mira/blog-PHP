<?php

use App\Models\CommentModel;

if (isset ($_SESSION['id'])) {
    $commentModel = new CommentModel();

    $error = null;
    $idUser = $_SESSION['id'];
    $updatedAt = date("Y-m-d-H:i:s");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contentInput = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
        $idPostInput = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);
        $currentPageInput = filter_input(INPUT_POST, 'current_page', FILTER_SANITIZE_NUMBER_INT);

        if (empty($contentInput)) {
            $error = 'Un commentaire est demandé.';
        }

        if (!$error) {
            $commentModel->addComment($contentInput, $idUser, $updatedAt, $idPostInput);

            header("Location: /posts/read?id=" . $idPostInput . "&current_page=" . $currentPageInput . "#comments");
        } else {
            $_SESSION['add_comment_form_error'] = $error;

            header("Location: /posts/read?id=" . $idPostInput . "&current_page=" . $currentPageInput . "#comments");
        }
    }
}
