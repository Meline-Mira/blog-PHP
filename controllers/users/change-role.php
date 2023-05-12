<?php

use App\Models\UserModel;

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $userModel = new UserModel();
    $idUser = filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $user = $userModel->getOneUserWithId($idUser);

    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $role = filter_input(INPUT_POST, 'role', FILTER_UNSAFE_RAW);
        $idUser = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);

        if (empty($role)) {
            $error = 'Un rôle est demandé.';
        }

        if (!$error) {
            $userModel->changeTheUserRole($role, $idUser);

            header("Location: /users/list");
            die;
        }
    }

    $twig = create_twig();

    echo $twig->render('/users/change-role.html.twig', [
        'page' => "Changer le rôle d'un utilisateur",
        'user' => $user,
        'error' => $error
    ]);
} else {
    error("Vous n'êtes pas autorisé à accéder à cette page.", 403);
}