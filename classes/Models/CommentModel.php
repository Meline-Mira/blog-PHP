<?php

namespace App\Models;

use App\Database;

class CommentModel
{
    public function __construct(private Database $database)
    {
    }

    public function getMostRecentCommentsForAPost(int $idPost, int $commentsPerPost, string $content, int $idUser, int $updatedAt): array
    {
        return $this->database->fetchAll('
        SELECT c.*, u.first_name, u.last_name FROM comments c
        LEFT JOIN users u ON c.id_user = u.id
        WHERE c.id_post = :id_post
        ORDER BY c.updated_at DESC 
        LIMIT :commentsPerPost',
        ['id_post' => $idPost, 'commentsPerPost' => $commentsPerPost, 'content' => $content, 'id_user' => $idUser, 'updated_at' => $updatedAt]);
    }
}