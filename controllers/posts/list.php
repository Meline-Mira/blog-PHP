<?php

use App\Models\BlogPostModel;

$model = new BlogPostModel();
$postsPerPage = 9;
$numberOfPosts = $model->numberOfPosts();
$currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$posts = $model->getPostsInPage($currentPage, $postsPerPage);
$pagination = new \App\Pagination($currentPage, $numberOfPosts, $postsPerPage, '/posts/list');

$twig = create_twig();

echo $twig->render('/posts/list.html.twig', ['page' => 'Liste des Blogs Posts', 'posts' => $posts, 'pagination' => $pagination]);
