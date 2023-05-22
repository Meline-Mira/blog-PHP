<?php

use App\Models\UserModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $userModel = new UserModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUser = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);

        $userModel->validateTheUser($idUser);

        header("Location: /users/list");
        die;
    }
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}