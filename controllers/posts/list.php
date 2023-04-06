<?php

$model = createBlogPostModel();
$postsPerPage = 9;
$numberOfPosts = $model->numberOfPosts();
$currentPage = $_GET['current_page'] ?? 1;
$posts = $model->getPostsInPage($currentPage, $postsPerPage);
$pagination = new \App\Pagination($currentPage, $numberOfPosts, $postsPerPage, '/posts/list');

$twig = create_twig();

echo $twig->render('/posts/list.html.twig', ['page' => 'Liste des Blogs Posts', 'posts' => $posts, 'pagination' => $pagination]);