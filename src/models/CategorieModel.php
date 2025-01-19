<?php

use Ramsey\Uuid\Uuid;

class CategorieModel
{
    public function listeCategorieAvecNbProduits()
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Préparation de la requête SQL pour récupérer les catégories avec le nombre de produits
            $stmt = $db->getConnection()->prepare("
            SELECT c.id, c.nom, COUNT(p.id) AS nombre_produits
            FROM categorie c
            LEFT JOIN produit p ON c.id = p.id_categorie
            GROUP BY c.id, c.nom
        ");
            // Exécution de la requête
            $stmt->execute();
            // Récupération des résultats sous forme de tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des erreurs avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la récupération du nombre de produits par catégorie : " . $e->getMessage());
        }
    }

    public function supprimerCategorie($id)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Préparation de la requête SQL pour supprimer une catégorie
            $stmt = $db->getConnection()->prepare("DELETE FROM categorie WHERE id = :id");
            // Liaison du paramètre 'id' à la requête
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // Gestion des erreurs avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
        }
    }

    public function trouverCategorieParId($id)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Préparation de la requête SQL pour récupérer les informations d'une catégorie par son ID
            $stmt = $db->getConnection()->prepare("SELECT * FROM categorie WHERE id = :id");
            // Liaison du paramètre 'id' à la requête
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
            // Récupération du résultat sous forme de tableau associatif
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des erreurs avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la récupération de la catégorie : " . $e->getMessage());
        }
    }

    public function modifierCategorie($id, $nouveauNom)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Préparation de la requête SQL pour modifier une catégorie
            $stmt = $db->getConnection()->prepare("UPDATE categorie SET nom = :nom WHERE id = :id");
            // Liaison des paramètres 'id' et 'nom' à la requête
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nouveauNom, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // Gestion des erreurs avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la modification de la catégorie : " . $e->getMessage());
        }
    }

    public function ajouterCategorie($nom)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Génération d'un ID unique pour la nouvelle catégorie
            $id = Uuid::uuid4();
            // Préparation de la requête SQL pour insérer une nouvelle catégorie
            $stmt = $db->getConnection()->prepare("INSERT INTO categorie (id, nom) VALUES (:id, :nom)");
            // Liaison des paramètres 'id' et 'nom' à la requête
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // Gestion des erreurs avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
        }
    }
}
