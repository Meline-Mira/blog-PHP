<?php

$postModel = createBlogPostModel();

$errors = [];
$idUser = 1; // TODO : $user_id = $_SESSION...
$updatedAt = date("Y-m-d-H:i:s");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titleInput = filter_input(INPUT_POST, 'title', FILTER_UNSAFE_RAW);
    $summaryInput = filter_input(INPUT_POST, 'summary', FILTER_UNSAFE_RAW);
    $contentInput = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
    $imageDescriptionInput = filter_input(INPUT_POST, 'image_description', FILTER_UNSAFE_RAW);

    if ($titleInput === '' || $titleInput === false) {
        $errors[] = 'Un titre est demandé.';
    }
    if (strlen($titleInput) >= 250) {
        $errors[] = 'Le titre doit faire moins de 250 caractères.';
    }
    if ($summaryInput === '' || $summaryInput === false) {
        $errors[] = 'Un chapô est demandé.';
    }
    if ($contentInput === '' || $contentInput === false) {
        $errors[] = 'Un contenu est demandé.';
    }
    if ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = 'Une image est demandée.';
    }
    if ($_FILES['image']['error'] === UPLOAD_ERR_INI_SIZE) {
        $errors[] = 'L\'image est trop lourde.';
    }
    if (!in_array(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION), ['png', 'jpeg', 'jpg'])) {
        $errors[] = 'Votre format d\'image n\'est pas accepté.';
    }
    if ($imageDescriptionInput === '' || $imageDescriptionInput === false) {
        $errors[] = 'Une description de l\'image est demandé.';
    }
    if (strlen($imageDescriptionInput) >= 100) {
        $errors[] = 'La description de l\'image doit faire moins de 100 caractères.';
    }

    if (!$errors) {
        $imageUrl = '/uploads/' . md5(microtime(true)) . '-' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], BASE_PATH . 'public'. $imageUrl);

        $postModel->addPost($titleInput, $summaryInput, $contentInput, $imageUrl, $imageDescriptionInput, $idUser, $updatedAt);

        header("Location: /posts/list");
        die;
    }
}

$twig = create_twig();

echo $twig->render('/posts/add.html.twig', [
    'page' => "Ajout d'un blog post",
    'errors' => $errors
]);