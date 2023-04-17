<?php

$model = createBlogPostModel();
$post = $model->getPostFromId(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$comment_model = createCommentModel();
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$comments = $comment_model->getCommentsForAPost($idPost);
$comments_number = $comment_model->numberOfComments($idPost);

$error = $_SESSION['add_comment_form_error'] ?? null;

if ($error) {
    unset($_SESSION['add_comment_form_error']);
}

$twig = create_twig();

echo $twig->render('/posts/read.html.twig', [
    'page' => $post['title'],
    'post' => $post,
    'comments' => $comments,
    'comments_number' => $comments_number,
    'current_page' =>$currentPage,
    'error' => $error
]);