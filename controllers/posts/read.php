<?php

$model = createBlogPostModel();
$post = $model->getPostFromId(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$comment_model = createCommentModel();
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$comments = $comment_model->getCommentsForAPost($idPost);
$comments_number = $comment_model->numberOfComments($idPost);

$twig = create_twig();

echo $twig->render('/posts/read.html.twig', ['page' => $post['title'], 'post' => $post, 'comments' => $comments, 'comments_number' => $comments_number]);