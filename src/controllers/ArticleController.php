<?php

require_once __DIR__ . '/../models/ArticleModel.php';

class ArticleController
{
    public function listeArticles()
    {
        $tag = isset($_GET['tag']) ? $_GET['tag'] : null;  // Filtre par tag
        $auteur = isset($_GET['auteur']) ? $_GET['auteur'] : null;  // Filtre par auteur

        $articleModel = new ArticleModel();
        try {
            // Récupérer les articles filtrés
            $articles = $articleModel->trouverArticlesParFiltres($tag, $auteur);

            // Charger la vue pour afficher la liste des articles
            require __DIR__ . '/../views/articles/listeArticles.php';
        } catch (Exception $e) {
            // En cas d'erreur, afficher un message d'erreur
            echo "Erreur lors de la récupération des articles : " . $e->getMessage();
        }
    }

    public function modifierArticle()
    {
        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];
            $articleModel = new ArticleModel();

            try {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Valider les données reçues
                    $titre = $_POST['titre'] ?? null;
                    $contenu = $_POST['contenu'] ?? null;

                    if (empty($titre) || empty($contenu)) {
                        throw new Exception("Le titre et le contenu sont obligatoires.");
                    }

                    // Modifier l'article avec les données du formulaire
                    $articleModel->modifierArticle($articleId, $_POST);

                    // Rediriger vers la liste des articles après modification
                    header('Location: index.php?do=article&message=modification-reussie');
                    exit();
                } else {
                    // Charger les données de l'article pour modification
                    $article = $articleModel->trouverUnArticleParId($articleId);
                    if (!$article) {
                        throw new Exception("Article introuvable.");
                    }

                    // Charger la vue pour modifier l'article
                    require __DIR__ . '/../views/articles/modifierArticle.php';
                }
            } catch (Exception $e) {
                // Afficher un message d'erreur
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            // Afficher une erreur si l'ID est manquant
            echo "ID d'article manquant.";
        }
    }

    public function ajouterArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Valider les données reçues
                $titre = $_POST['titre'] ?? null;
                $contenu = $_POST['contenu'] ?? null;

                if (empty($titre) || empty($contenu)) {
                    throw new Exception("Le titre et le contenu sont obligatoires.");
                }

                // Ajouter l'article via le modèle
                $articleModel = new ArticleModel();
                $articleModel->ajouterUnArticle($_POST);

                // Rediriger vers la liste des articles après ajout
                header('Location: index.php?do=article&message=ajout-reussi');
                exit();
            } catch (Exception $e) {
                // Afficher un message d'erreur
                echo "Erreur lors de l'ajout de l'article : " . $e->getMessage();
            }
        } else {
            // Charger la vue pour ajouter un article
            require __DIR__ . '/../views/articles/ajouterArticle.php';
        }
    }

    public function supprimerArticle()
    {
        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];
            $articleModel = new ArticleModel();

            try {
                // Supprimer l'article via le modèle
                $articleModel->supprimerArticle($articleId);

                // Rediriger vers la liste des articles après suppression
                header('Location: index.php?do=article&message=suppression-reussie');
                exit();
            } catch (Exception $e) {
                // Afficher un message d'erreur
                echo "Erreur lors de la suppression de l'article : " . $e->getMessage();
            }
        } else {
            // Afficher une erreur si l'ID est manquant
            echo "ID d'article manquant.";
        }
    }
}
