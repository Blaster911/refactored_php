<?php

require_once('libraries/utils.php');
require_once('libraries/models/Article.php');

class Article
{
    public function index()
    {
        $model = new Article();
        /**
         * 2. Récupération des articles
         */
        $articles = $model->findAll("created_at DESC");

        /**
         * 3. Affichage
         */
        $pageTitle = "Accueil";
        render('articles/index', compact('pageTitle', 'articles'));
    }
    public function show()
    {
        // montrer un article
    }
    public function delete()
    {
        // supprimer un article
    }
}
