<?php

function create_pdo()
{
    try {
        return new PDO('mysql:host=localhost;dbname=' . $_ENV['DATABASE_NAME'] . ';charset=utf8', $_ENV['DATABASE_USER'] , $_ENV['DATABASE_PASSWORD'] );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
