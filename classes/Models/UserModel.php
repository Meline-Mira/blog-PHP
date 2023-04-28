<?php

namespace App\Models;

use App\Database;

class UserModel
{
    public function __construct(private Database $database)
    {
    }

    public function createUser(string $email, string $password, string $firstName, string $lastName, string $role)
    {
        $this->database->execute('
        INSERT INTO users(email, password, first_name, last_name, role) 
        VALUES (:email, :password, :first_name, :last_name, :role)',
        ['email' => $email, 'password' => $password, 'first_name' => $firstName, 'last_name' => $lastName, 'role' => $role]);
    }

    function getUser ($email) : array|false
    {
        return $this->database->fetchOne('
        SELECT * FROM users
        WHERE email = :email',
        ['email' => $email]);
    }
}