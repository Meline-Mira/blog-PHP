<?php

use App\Models\CommentModel;
use App\Models\UserModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $twig = create_twig();
    $userModel = new UserModel();
    $commentModel = new CommentModel();

    echo $twig->render('/admin.html.twig', [
        'page' => "Administration",
        'notif_comments' => $commentModel->numberOfCommentsNotValidated(),
        'notif_users' => $userModel->numberOfUsersNotValidated(),
    ]);
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}
