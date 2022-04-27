<?php

namespace Controllers;

require_once('libraries/utils.php');
require_once("libraries/autoload.php");

class Comment extends Controller
{
    protected $modelName = \Models\Comment::class;

    public function insert()
    {
        $articleModel = new \Models\Article();
        $commentModel = new \Models\Comment();
        $author = null;

        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        $content = null;
        if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
        }

        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        $article = $articleModel->find($article_id);

        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        $commentModel->insert($author, $content, $article_id);

        header('Location: article.php?id=' . $article_id);
        exit();
    }

    public function delete()
    {
        /**
         * 1. Récupération du paramètre "id" en GET
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification de l'existence du commentaire
         */
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        /**
         * 4. Suppression réelle du commentaire
         * On récupère l'identifiant de l'article avant de supprimer le commentaire
         */
        $article_id = $commentaire['article_id'];

        $this->model->delete($id);

        /**
         * 5. Redirection vers l'article en question
         */
        redirect("article.php?id=" . $article_id);
    }
}
