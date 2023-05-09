<?php

if (isset ($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $postModel = createBlogPostModel();
    $idPostInput = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    $currentPageInput = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
    $post = $postModel->getPostFromId($idPostInput);

    $errors = [];
    $updatedAt = date("Y-m-d-H:i:s");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titleInput = filter_input(INPUT_POST, 'title', FILTER_UNSAFE_RAW);
        $summaryInput = filter_input(INPUT_POST, 'summary', FILTER_UNSAFE_RAW);
        $contentInput = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
        $imageDescriptionInput = filter_input(INPUT_POST, 'image_description', FILTER_UNSAFE_RAW);

        if (empty($titleInput)) {
            $errors[] = 'Un titre est demandé.';
        }
        if (strlen($titleInput) >= 250) {
            $errors[] = 'Le titre doit faire moins de 250 caractères.';
        }
        if (empty($summaryInput)) {
            $errors[] = 'Un chapô est demandé.';
        }
        if (empty($contentInput)) {
            $errors[] = 'Un contenu est demandé.';
        }
        if ($_FILES['image']['error'] === UPLOAD_ERR_INI_SIZE) {
            $errors[] = 'L\'image est trop lourde.';
        }
        if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE &&
            !in_array(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION), ['png', 'jpeg', 'jpg']) ||
            !in_array(exif_imagetype($_FILES['image']['tmp_name']), [IMAGETYPE_JPEG, IMAGETYPE_PNG])
            ) {
            $errors[] = 'Votre format d\'image n\'est pas accepté.';
        }
        if (empty($imageDescriptionInput)) {
            $errors[] = 'Une description de l\'image est demandé.';
        }
        if (strlen($imageDescriptionInput) >= 100) {
            $errors[] = 'La description de l\'image doit faire moins de 100 caractères.';
        }

        if (!$errors) {
            if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $imageUrl = '/uploads/' . md5(microtime(true)) . '-' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], BASE_PATH . 'public' . $imageUrl);
                $postModel->changeBlogPostImage($idPostInput, $imageUrl);
            }

            $postModel->editBlogPosts($idPostInput, $titleInput, $summaryInput, $contentInput, $imageDescriptionInput, $updatedAt);

            header("Location: /posts/read?id=" . $idPostInput . "&current_page=" . $currentPageInput);
            die;
        }
    }

    $twig = create_twig();

    echo $twig->render('/posts/edit.html.twig', [
        'page' => "Édition d'un blog post",
        'post' => $post,
        'current_page' => $currentPageInput,
        'errors' => $errors
    ]);
} else {
    header("Location: /users/login");
}