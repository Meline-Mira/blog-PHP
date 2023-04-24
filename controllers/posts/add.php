<?php

$postModel = createBlogPostModel();

$error = null;
$idUser = 1; // TODO : $user_id = $_SESSION...
$updatedAt = date("Y-m-d-H:i:s");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titleInput = filter_input(INPUT_POST, 'title', FILTER_UNSAFE_RAW);
    $summaryInput = filter_input(INPUT_POST, 'summary', FILTER_UNSAFE_RAW);
    $contentInput = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
    $idUserInput = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $imageUrlInput = filter_input(INPUT_POST, 'image_url', FILTER_UNSAFE_RAW);
    $imageDescriptionInput = filter_input(INPUT_POST, 'image_description', FILTER_UNSAFE_RAW);

    if ($titleInput === '' || $titleInput === false) {
        $error = 'Un titre est demandé.';
    }
    if ($titleInput >= 250) {
        $error = 'Le titre doit faire moins de 250 caractères.';
    }
    if ($summaryInput === '' || $summaryInput === false) {
        $error = 'Un chapô est demandé.';
    }
    if ($contentInput === '' || $contentInput === false) {
        $error = 'Un contenu est demandé.';
    }
    if ($imageUrlInput === '' || $imageUrlInput === false) {
        $error = 'Une image est demandé.';
    }
    if (filesize($imageUrlInput) > 2e+6){
        $error = 'L\image est trop lourde.';
    }
    if ($imageDescriptionInput === '' || $imageDescriptionInput === false) {
        $error = 'Une description de l\'image est demandé.';
    }
    if ($imageDescriptionInput >= 100) {
        $error = 'La description de l\'image doit faire moins de 100 caractères.';
    }

    if ($error === null) {
        $postModel->addPost($titleInput, $summaryInput, $contentInput, $imageUrlInput, $imageDescriptionInput, $idUser, $updatedAt);

        header("Location: /posts/read?id=" . $idPostInput);
    } else {
        header("Location: /posts/add");
    }
}

$twig = create_twig();

echo $twig->render('/posts/add.html.twig', [
    'page' => "Ajout d'un blog post",
    'error' => $error
]);