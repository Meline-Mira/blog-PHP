<?php

namespace App\Models;

use App\Database;

class UserModel
{
    public function __construct(private Database $database)
    {
    }

    public function createUser(string $email, string $password, string $firstName, string $lastName, string $role = 'user')
    {
        $this->database->execute('
        INSERT INTO users(email, `password`, first_name, last_name, `role`) 
        VALUES (:email, :password, :first_name, :last_name, :role)',
        ['email' => $email, 'password' => $password, 'first_name' => $firstName, 'last_name' => $lastName, 'role' => $role]);
    }

    public function numberOfUsersNotValidated(): int
    {
        $result = $this->database->fetchOne('SELECT COUNT(*) AS count FROM users WHERE validated = 0');
        return $result['count'];
    }

    public function getUsersList(): array
    {
        return $this->database->fetchAll('
        SELECT * FROM users
        ORDER BY validated');
    }

    public function validateTheUser(int $idUser)
    {
        $this->database->execute('
        UPDATE users
        SET validated = 1
        WHERE id = :id',
        ['id' => $idUser]);
    }

    function getUser ($email) : array|false
    {
        return $this->database->fetchOne('
        SELECT * FROM users
        WHERE email = :email',
        ['email' => $email]);
    }

    function loginUser ($email)
    {
        return $this->database->fetchOne('
        SELECT * FROM users
        WHERE email = :email AND validated = 1',
        ['email' => $email]);
    }

    function getOneUserWithId ($idUser) : array|false
    {
        return $this->database->fetchOne('
        SELECT * FROM users
        WHERE id = :id',
        ['id' => $idUser]);
    }
    public function deleteUser(int $idUser): void
    {
        $this->database->execute('DELETE FROM users WHERE id = :id', ['id' => $idUser]);
    }

    public function changeTheUserRole(string $role, int $idUser)
    {
        $this->database->execute('
        UPDATE users
        SET role = :role
        WHERE id = :id',
        ['role' => $role, 'id' => $idUser]);
    }
}