<?php

use App\Models\CommentModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = new CommentModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

        $commentModel->validateTheComment($idComment);
        $_SESSION['notif_comments'] = $commentModel->numberOfCommentsNotValidated();

        header("Location: /comments/validation");
        die;
    }
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}