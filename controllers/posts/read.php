<?php

$model = createBlogPostModel();
$post = $model->getPostFromId(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$comment_model = createCommentModel();
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$commentsPerPost = 5;
$comments = array_reverse($comment_model->getMostRecentCommentsForAPost($idPost, $commentsPerPost));

$twig = create_twig();

echo $twig->render('/posts/read.html.twig', ['page' => $post['title'], 'post' => $post, 'comments' => $comments]);