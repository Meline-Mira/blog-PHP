<?php

namespace App\Models;

use App\Database;

class CommentModel
{
    public function __construct(private Database $database)
    {
    }

    public function addComment(string $content, int $idUser, int $updatedAt, int $idPost): array
    {
        return $this->database->execute('
        INSERT INTO posts(content, id_user, updated_at, id_post) 
        VALUES (:content, :id_user, :updated_at, :id_post)',
        ['content' => $content, 'id_user' => $idUser, 'updated_at' => $updatedAt, 'id_post' => $idPost]);
    }

    public function numberOfComments(int $idPost): int
    {
        $result = $this->database->fetchOne('SELECT COUNT(*) AS count FROM comments WHERE id_post = :id_post', ['id_post' => $idPost]);
        return $result['count'];
    }

    public function getCommentsForAPost(int $idPost): array
    {
        return $this->database->fetchAll('
        SELECT c.*, u.first_name, u.last_name FROM comments c
        LEFT JOIN users u ON c.id_user = u.id
        WHERE c.id_post = :id_post
        ORDER BY c.updated_at ASC',
        ['id_post' => $idPost]);
    }

    public function deleteComment(int $idComment): void
    {
        $this->database->execute('DELETE FROM comments WHERE id = :id', ['id' => $idComment]);
    }
}