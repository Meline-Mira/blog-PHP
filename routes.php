<?php

$router->get('/', 'controllers/home.php');
$router->post('/', 'controllers/home.php');

$router->get('/contact-form-sent', 'controllers/contact-form-sent.php');

$router->get('/posts/read', 'controllers/posts/read.php');

$router->get('/posts/list', 'controllers/posts/list.php');

$router->post('/comments/add', 'controllers/comments/add.php');

$router->get('/comments/edit', 'controllers/comments/edit.php');
$router->patch('/comments/edit', 'controllers/comments/edit.php');