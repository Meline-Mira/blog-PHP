<?php

use App\Models\UserModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $userModel = new UserModel();
    $users = $userModel->getUsersList();

    $twig = create_twig();

    echo $twig->render('/users/list.html.twig', [
        'page' => 'Gestion des utilisateurs',
        'users' => $users
    ]);
} else {
    header("Location: /");
}