<?php

namespace App\Models;

use App\Database;

class BlogPostModel
{
    public function __construct(private Database $database)
    {
    }

    public function addPost(string $title, string $summary, string $content, string $imageUrl, string $imageDescription, int $idUser, string $updatedAt)
    {
        $this->database->execute('
        INSERT INTO posts(title, summary, content, image_url, image_description, id_user, updated_at) 
        VALUES (:title, :summary, :content, :image_url, :image_description, :id_user, :updated_at)',
        ['title' => $title, 'summary' => $summary, 'content' => $content, 'image_url' => $imageUrl, 'image_description' => $imageDescription, 'id_user' => $idUser, 'updated_at' => $updatedAt]);
    }

    public function updateBlogPosts(int $idPost, string $title, string $summary, string $content, string $updatedAt): void
    {
        $this->database->execute('
        UPDATE posts
        SET title = :title, summary = :summary, content = :content, updated_at = :updated_at 
        WHERE id = :id',
        ['id' => $idPost, 'title' => $title, 'summary' => $summary, 'content' => $content, 'updated_at' => $updatedAt]);
    }

    public function getPostsInPage(int $current_page, int $postsPerPage): array
    {
        $offset = ($current_page - 1) * $postsPerPage;

        return $this->database->fetchAll('
        SELECT p.*, u.first_name, u.last_name FROM posts p
        LEFT JOIN users u ON p.id_user = u.id
        ORDER BY p.updated_at DESC
        LIMIT '. ((int) $postsPerPage).
        ' OFFSET '. ((int) $offset));
    }

    public function numberOfPosts(): int
    {
        $result = $this->database->fetchOne('SELECT COUNT(*) AS count FROM posts');
        return $result['count'];
    }

    public function getPostFromId(int $idPost): array
    {
        return $this->database->fetchOne('
        SELECT p.*, u.first_name, u.last_name FROM posts p
        LEFT JOIN users u ON p.id_user = u.id 
        WHERE p.id = :id',
        ['id' => $idPost]);
    }

    public function deletePost(int $idPost): void
    {
        $this->database->execute('DELETE FROM posts WHERE id = :id', ['id' => $idPost]);
    }
}