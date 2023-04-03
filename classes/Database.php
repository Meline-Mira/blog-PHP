<?php

namespace App;

class Database
{
    public function __construct(private \PDO $pdo) {}

    public function fetchAll(string $sql, array $parameters = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($parameters);

        return $request->fetchAll();
    }

    public function fetchOne(string $sql, array $parameters = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($parameters);

        return $request->fetch();
    }

    public function execute(string $sql, array $parameters = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($parameters);

        return $request->rowCount();
    }
}