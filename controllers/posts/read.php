<?php

$model = createBlogPostModel();
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$post = $model->getPostFromId($idPost);

$commentModel = createCommentModel();
$currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$comments = $commentModel->getCommentsForAPost($idPost);

$error = $_SESSION['add_comment_form_error'] ?? null;

if ($error) {
    unset($_SESSION['add_comment_form_error']);
}

$twig = create_twig();

echo $twig->render('/posts/read.html.twig', [
    'page' => $post['title'],
    'post' => $post,
    'comments' => $comments,
    'current_page' =>$currentPage,
    'error' => $error
]);