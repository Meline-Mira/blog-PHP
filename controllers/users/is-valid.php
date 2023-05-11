<?php

use App\Models\UserModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $userModel = new UserModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUser = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);

        $userModel->validateTheUser($idUser);
        $_SESSION['notif_users'] = $userModel->numberOfUsersNotValidated();

        header("Location: /users/list");
        die;
    }
} else {
    header("Location: /users/login");
}