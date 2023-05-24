<?php

declare(strict_types=1);

namespace App;

use PDO;

class Database
{
    public $database;

    public function __construct()
    {
        // On n'instancie PDO que s'il n'y a pas de connexion déjà existante
        if (!$this->database) {
            try {
                $this->database = new \PDO('mysql:host=localhost;dbname=' . $_ENV['DATABASE_NAME'] . ';charset=utf8', $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }

    public function fetchAll(string $sql, array $parameters = [])
    {
        $request = $this->database->prepare($sql);
        $request->execute($parameters);

        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne(string $sql, array $parameters = [])
    {
        $request = $this->database->prepare($sql);
        $request->execute($parameters);

        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $parameters = [])
    {
        $request = $this->database->prepare($sql);
        $request->execute($parameters);

        return $request->rowCount();
    }
}
