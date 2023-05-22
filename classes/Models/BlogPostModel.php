<?php

namespace App\Models;

use App\Database;

class BlogPostModel extends Database
{
    public function addPost(string $title, string $summary, string $content, string $imageUrl, string $imageDescription, int $idUser, string $updatedAt)
    {
        $this->execute('
        INSERT INTO posts(title, summary, content, image_url, image_description, id_user, updated_at) 
        VALUES (:title, :summary, :content, :image_url, :image_description, :id_user, :updated_at)',
        ['title' => $title, 'summary' => $summary, 'content' => $content, 'image_url' => $imageUrl, 'image_description' => $imageDescription, 'id_user' => $idUser, 'updated_at' => $updatedAt]);
    }

    public function editBlogPosts(int $idPost, string $title, string $summary, string $content, int $idUser, string $imageDescription, string $updatedAt): void
    {
        if ($idUser === -1) {
            $idUser = null;
        }

        $this->execute('
        UPDATE posts
        SET title = :title, summary = :summary, content = :content, id_user = :id_user, image_description = :image_description, updated_at = :updated_at 
        WHERE id = :id',
        ['id' => $idPost, 'title' => $title, 'summary' => $summary, 'content' => $content, 'id_user' => $idUser, 'image_description' => $imageDescription, 'updated_at' => $updatedAt]);
    }

    public function changeBlogPostImage(int $idPost, string $imageUrl): void
    {
        $this->execute('
        UPDATE posts
        SET image_url = :image_url
        WHERE id = :id',
            ['id' => $idPost, 'image_url' => $imageUrl]);
    }

    public function getPostsInPage(int $current_page, int $postsPerPage): array
    {
        $offset = ($current_page - 1) * $postsPerPage;

        return $this->fetchAll('
        SELECT p.*, u.first_name, u.last_name FROM posts p
        LEFT JOIN users u ON p.id_user = u.id
        ORDER BY p.updated_at DESC
        LIMIT '. ((int) $postsPerPage).
        ' OFFSET '. ((int) $offset));
    }

    public function numberOfPosts(): int
    {
        $result = $this->fetchOne('SELECT COUNT(*) AS count FROM posts');
        return $result['count'];
    }

    public function getPostFromId(int $idPost): array
    {
        return $this->fetchOne('
        SELECT p.*, u.first_name, u.last_name FROM posts p
        LEFT JOIN users u ON p.id_user = u.id 
        WHERE p.id = :id',
        ['id' => $idPost]);
    }

    public function deletePost(int $idPost): void
    {
        $this->execute('DELETE FROM posts WHERE id = :id', ['id' => $idPost]);
    }
}