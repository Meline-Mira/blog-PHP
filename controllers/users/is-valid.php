<?php

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $commentModel = createUserModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUser = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);

        $commentModel->validateTheUser($idUser);

        header("Location: /users/list");
        die;
    }
} else {
    header("Location: /users/login");
}