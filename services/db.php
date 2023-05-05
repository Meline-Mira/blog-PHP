<?php

use App\Database;
use App\Models\BlogPostModel;
use App\Models\CommentModel;
use App\Models\UserModel;

function createPdo()
{
    // On utilise une variable statique pour être certain de n'instancier PDO qu'une seule fois
    static $instance;

    if (!$instance) {
        try {
            $instance = new \PDO('mysql:host=localhost;dbname=' . $_ENV['DATABASE_NAME'] . ';charset=utf8', $_ENV['DATABASE_USER'] , $_ENV['DATABASE_PASSWORD'] );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    return $instance;
}

function createDatabase()
{
    return new Database(createPdo());
}

function createBlogPostModel()
{
    return new BlogPostModel(createDatabase());
}

function createCommentModel()
{
    return new CommentModel(createDatabase());
}

function createUserModel()
{
    return new UserModel((createDatabase()));
}
