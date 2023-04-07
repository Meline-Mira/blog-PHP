<?php

namespace App\Models;

use App\Database;

class CommentModel
{
    public function __construct(private Database $database)
    {
    }

    public function addComment(string $content, int $idUser, string $updatedAt, int $idPost)
    {
        $this->database->execute('
        INSERT INTO comments(content, id_user, updated_at, id_post, validated) 
        VALUES (:content, :id_user, :updated_at, :id_post, 0)',
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
        ORDER BY c.updated_at DESC',
        ['id_post' => $idPost]);
    }

    public function deleteComment(int $idComment): void
    {
        $this->database->execute('DELETE FROM comments WHERE id = :id', ['id' => $idComment]);
    }
}