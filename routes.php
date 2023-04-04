<?php

$router->get('/', 'controllers/home.php');
$router->post('/', 'controllers/home.php');

$router->get('/contact-form-sent', 'controllers/contact-form-sent.php');

$router->get('/posts/read', 'controllers/posts/read.php');