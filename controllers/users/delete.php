<?php

use App\Models\UserModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $userModel = new UserModel();
    $idUser = filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $user = $userModel->getOneUserWithId($idUser);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUser = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);

        $userModel->deleteUser($idUser);
        $_SESSION['notif_users'] = $userModel->numberOfUsersNotValidated();

        header("Location: /users/list");
    }

    $twig = create_twig();

    echo $twig->render('/users/delete.html.twig', [
        'page' => "Suppression d'un utilisateur",
        'user' => $user
    ]);
} else {
    header("Location: /users/login");
}