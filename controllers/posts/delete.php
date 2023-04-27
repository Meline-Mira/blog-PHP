<?php

$postModel = createBlogPostModel();
$idPostInput = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
$currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
$post = $postModel->getPostFromId($idPostInput);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPostInput = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);

    $postModel->deletePost($idPostInput);

    header("Location: /posts/list");
}

$twig = create_twig();

echo $twig->render('/posts/delete.html.twig', [
    'page' => "Suppression d'un Blog Post",
    'post' => $post,
    'current_page' => $currentPage,
]);