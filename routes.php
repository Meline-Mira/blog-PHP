<?php

$router->get('/', 'controllers/home.php');
$router->post('/', 'controllers/home.php');

$router->get('/contact-form-sent', 'controllers/contact-form-sent.php');

$router->get('/mandatory-info', 'controllers/mandatory-info.php');

//posts management

$router->get('/posts/add', 'controllers/posts/add.php');
$router->post('/posts/add', 'controllers/posts/add.php');

$router->get('/posts/list', 'controllers/posts/list.php');

$router->get('/posts/read', 'controllers/posts/read.php');

$router->get('/posts/edit', 'controllers/posts/edit.php');
$router->patch('/posts/edit', 'controllers/posts/edit.php');

$router->get('/posts/delete', 'controllers/posts/delete.php');
$router->delete('/posts/delete', 'controllers/posts/delete.php');

// admin

$router->get('/admin', 'controllers/admin.php');

//comments management

$router->post('/comments/add', 'controllers/comments/add.php');

$router->get('/comments/validation', 'controllers/comments/validation.php');

$router->patch('/comments/is-valid', 'controllers/comments/is-valid.php');

$router->get('/comments/edit', 'controllers/comments/edit.php');
$router->patch('/comments/edit', 'controllers/comments/edit.php');

$router->get('/comments/delete', 'controllers/comments/delete.php');
$router->delete('/comments/delete', 'controllers/comments/delete.php');

//users management

$router->get('/users/registration', 'controllers/users/registration.php');
$router->post('/users/registration', 'controllers/users/registration.php');

$router->get('/users/waiting-for-validation', 'controllers/users/waiting-for-validation.php');

$router->get('/users/list', 'controllers/users/list.php');

$router->patch('/users/is-valid', 'controllers/users/is-valid.php');

$router->get('/users/login', 'controllers/users/login.php');
$router->post('/users/login', 'controllers/users/login.php');

$router->get('/users/logout', 'controllers/users/logout.php');

$router->get('/users/delete', 'controllers/users/delete.php');
$router->delete('/users/delete', 'controllers/users/delete.php');

$router->get('/users/change-role', 'controllers/users/change-role.php');
$router->patch('/users/change-role', 'controllers/users/change-role.php');
