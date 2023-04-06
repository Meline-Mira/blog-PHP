<?php

declare(strict_types = 1);

namespace App;

use PDO;

class Database
{
    public function __construct(private PDO $pdo) {}

    public function fetchAll(string $sql, array $parameters = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($parameters);

        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne(string $sql, array $parameters = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($parameters);

        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $parameters = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($parameters);

        return $request->rowCount();
    }
}