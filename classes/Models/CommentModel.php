<?php

namespace App\Models;

use App\Database;

class CommentModel extends Database
{
    public function addComment(string $content, int $idUser, string $updatedAt, int $idPost)
    {
        $this->execute('
        INSERT INTO comments(content, id_user, updated_at, id_post, validated) 
        VALUES (:content, :id_user, :updated_at, :id_post, 0)',
        ['content' => $content, 'id_user' => $idUser, 'updated_at' => $updatedAt, 'id_post' => $idPost]);
    }

    public function getCommentsForAPost(int $idPost): array
    {
        return $this->fetchAll('
        SELECT c.*, u.first_name, u.last_name FROM comments c
        LEFT JOIN users u ON c.id_user = u.id
        WHERE c.id_post = :id_post AND c.validated = 1
        ORDER BY c.updated_at DESC',
        ['id_post' => $idPost]);
    }

    public function getCommentsForValidation(): array
    {
        return $this->fetchAll('
        SELECT c.*, u.first_name, u.last_name, p.title, p.summary FROM comments c
        LEFT JOIN users u ON c.id_user = u.id
        LEFT JOIN posts p ON c.id_post = p.id                                                         
        WHERE c.validated = 0
        ORDER BY c.id_post');
    }

    public function numberOfCommentsNotValidated(): int
    {
        $result = $this->fetchOne('SELECT COUNT(*) AS count FROM comments WHERE validated = 0');
        return $result['count'];
    }

    public function validateTheComment(int $idComment)
    {
        $this->execute('
        UPDATE comments
        SET validated = 1
        WHERE id = :id',
        ['id' => $idComment]);
    }

    public function getOneComment(int $idComment): array
    {
        return $this->fetchOne('
        SELECT c.*, u.first_name, u.last_name FROM comments c
        LEFT JOIN users u ON c.id_user = u.id
        WHERE c.id = :id',
        ['id' => $idComment]);
    }

    public function editCommentByAdmin(string $content, int $idComment)
    {
        $this->execute('
        UPDATE comments
        SET content = :content, validated = 1
        WHERE id = :id',
        ['content' => $content, 'id' => $idComment]);
    }

    public function deleteComment(int $idComment): void
    {
        $this->execute('DELETE FROM comments WHERE id = :id', ['id' => $idComment]);
    }
}