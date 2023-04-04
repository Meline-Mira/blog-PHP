<?php

$model = blogPostManagement();
$post = $model->getPostFromId($_GET['id']);

$twig = create_twig();

echo $twig->render('/posts/read.html.twig', ['page' => $post['title'], 'post' => $post]);