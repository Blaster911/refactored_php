<?php

require_once('libraries/database.php');

class Comment
{
    public function findAllWithArticle(int $id): array
    {
        $pdo = getPdo();
        $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    public function find(int $id)
    {
        $pdo = getPdo();
        $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $commentaire = $query->fetch();
        return $commentaire;
    }

    public function delete(int $id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    public function insert(string $author, string $content, string $article_id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
