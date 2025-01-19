<?php

use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;

class ArticleModel
{
    public function tousLesArticles()
    {
        $articlesCollection = MongoDBConnection::getInstance()->getDatabase()->articles; // Accès à la collection "articles"
        try {
            return $articlesCollection->find()->toArray(); // Retourne tous les documents
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des articles : " . $e->getMessage());
        }
    }

    public function trouverArticlesParFiltres($tag = null, $auteur = null)
    {
        $articlesCollection = MongoDBConnection::getInstance()->getDatabase()->articles;
        $filter = [];

        if ($tag) {
            $filter['tags'] = ['$in' => [$tag]]; // Vérifie si le tag existe dans le tableau "tags"
        }

        if ($auteur) {
            $filter['auteur'] = $auteur; // Filtrer par auteur exact
        }

        try {
            return $articlesCollection->find($filter)->toArray(); // Applique le filtre
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des articles filtrés : " . $e->getMessage());
        }
    }

    public function trouverUnArticleParId($id)
    {
        $articlesCollection = MongoDBConnection::getInstance()->getDatabase()->articles;
        try {
            return $articlesCollection->findOne(['_id' => new ObjectId($id)]); // Recherche par ID BSON
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération de l'article : " . $e->getMessage());
        }
    }

    public function ajouterUnArticle($data)
    {
        $articlesCollection = MongoDBConnection::getInstance()->getDatabase()->articles;

        // Validation des données
        if (empty($data['titre']) || empty($data['contenu']) || empty($data['auteur'])) {
            throw new Exception("Les champs titre, contenu et auteur sont obligatoires.");
        }

        try {
            // Insérer un nouvel article
            $articlesCollection->insertOne([
                'titre' => $data['titre'],
                'contenu' => $data['contenu'],
                'auteur' => $data['auteur'],
                'date_creation' => new UTCDateTime(), // Date actuelle
                'tags' => isset($data['tags']) ? array_map('trim', explode(',', $data['tags'])) : [] // Convertit les tags en tableau
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'article : " . $e->getMessage());
        }
    }

    public function modifierArticle($id, $data)
    {
        $articlesCollection =  MongoDBConnection::getInstance()->getDatabase()->articles;

        // Validation des données
        if (empty($data['titre']) || empty($data['contenu']) || empty($data['auteur'])) {
            throw new Exception("Les champs titre, contenu et auteur sont obligatoires.");
        }

        try {
            // Mise à jour de l'article
            $articlesCollection->updateOne(
                ['_id' => new ObjectId($id)], // Recherche par ID BSON
                ['$set' => [
                    'titre' => $data['titre'],
                    'contenu' => $data['contenu'],
                    'auteur' => $data['auteur'],
                    'tags' => isset($data['tags']) ? array_map('trim', explode(',', $data['tags'])) : [] // Transforme les tags
                ]]
            );
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification de l'article : " . $e->getMessage());
        }
    }

    public function supprimerArticle($id)
    {
        $articlesCollection =  MongoDBConnection::getInstance()->getDatabase()->articles;
        try {
            $articlesCollection->deleteOne(['_id' => new ObjectId($id)]); // Suppression par ID BSON
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression de l'article : " . $e->getMessage());
        }
    }
}
