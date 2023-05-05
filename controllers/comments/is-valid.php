<?php

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = createCommentModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

        $commentModel->validateTheComment($idComment);

        header("Location: /comments/validation");
        die;
    }
} else {
    header("Location: /users/login");
}