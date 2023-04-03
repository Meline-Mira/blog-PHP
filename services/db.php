<?php

use App\Database;
use App\Models\BlogPostModel;
use App\Models\CommentModel;

function createPdo()
{
    try {
        return new \PDO('mysql:host=localhost;dbname=' . $_ENV['DATABASE_NAME'] . ';charset=utf8', $_ENV['DATABASE_USER'] , $_ENV['DATABASE_PASSWORD'] );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function createDatabase()
{
    return new Database(createPdo());
}

function blogPostManagement()
{
    return new BlogPostModel(createDatabase());
}

function commentManagement()
{
    return new CommentModel(createDatabase());
}
