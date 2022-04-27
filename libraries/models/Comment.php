<?php

namespace Models;

require_once("libraries/autoload.php");

class Comment extends Model
{
    protected $table = "comments";

    public function findAllWithArticle(int $id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    public function insert(string $author, string $content, string $article_id): void
    {
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
