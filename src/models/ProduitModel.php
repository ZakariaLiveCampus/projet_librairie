<?php

class ProduitModel
{
    public function tousLesProduits()
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        // Définition de la requête SQL pour récupérer tous les produits avec leurs informations et leur catégorie
        $query = "
            SELECT
                p.id as isbn,
                p.nom,
                p.description,
                p.prix,
                p.stock,
                c.nom as categorie_nom
            From produit p
            INNER JOIN categorie c ON p.id_categorie = c.id
        ";
        // Préparation et exécution de la requête
        $stmt = $db->getConnection()->prepare($query);
        $stmt->execute();
        // Retourne tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filtrerProduits($id_categorie = null, $prix_min = null, $prix_max = null)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        // Définition de la requête SQL de base pour filtrer les produits en fonction de leur catégorie/prix max/prix min
        $query = "
        SELECT
            p.id AS isbn,
            p.nom,
            p.description,
            p.prix,
            p.stock,
            c.nom AS categorie_nom
        FROM produit p
        INNER JOIN categorie c ON p.id_categorie = c.id
        ";

        // Ajout des conditions de filtre si elles sont spécifiées
        if (!empty($id_categorie)) {
            $query .= " AND p.id_categorie = :id_categorie";
        }
        if (!empty($prix_min)) {
            $query .= " AND p.prix >= :prix_min";
        }
        if (!empty($prix_max)) {
            $query .= " AND p.prix <= :prix_max";
        }

        // Préparation de la requête
        $stmt = $db->getConnection()->prepare($query);

        // Liaison des paramètres si les valeurs sont spécifiées
        if (!empty($id_categorie)) {
            $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_STR);
        }
        if (!empty($prix_min)) {
            $stmt->bindParam(':prix_min', $prix_min, PDO::PARAM_STR);
        }
        if (!empty($prix_max)) {
            $stmt->bindParam(':prix_max', $prix_max, PDO::PARAM_STR);
        }

        // Exécution de la requête
        $stmt->execute();
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterProduit($isbn, $nom, $description, $prix, $stock, $id_categorie)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Définition de la requête SQL pour insérer un nouveau produit
            $query = "
                INSERT INTO produit (id, nom, description, prix, stock, id_categorie)
                VALUES (:isbn, :nom, :description, :prix, :stock, :id_categorie)
            ";
            // Préparation de la requête
            $stmt = $db->getConnection()->prepare($query);

            // Liaison des paramètres
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_STR);

            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // Gestion des exceptions avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de l'ajout du produit : " . $e->getMessage());
        }
    }
    public function supprimerProduit($id)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Définition de la requête SQL pour supprimer un produit
            $stmt = $db->getConnection()->prepare("DELETE FROM produit WHERE id = :id");
            // Liaison du paramètre 'id'
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // Gestion des exceptions avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
        }
    }

    public function modifierProduit($id, $nom, $description, $prix, $stock, $isbn, $id_categorie)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Définition de la requête SQL pour mettre à jour un produits
            $query = "
                UPDATE produit 
                SET id = :isbn, nom = :nom, description = :description, prix = :prix, stock = :stock, id_categorie = :id_categorie
                WHERE id = :id
            ";
            // Préparation de la requête
            $stmt = $db->getConnection()->prepare($query);
            // Liaison des paramètress
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // Gestion des exceptions avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la modification du produit : " . $e->getMessage());
        }
    }

    public function trouverProduitParId($id)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        try {
            // Définition de la requête SQL pour récupérer un produit par son ID
            $stmt = $db->getConnection()->prepare("SELECT * FROM produit WHERE id = :id");
            // Liaison du paramètre 'id'
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            // Exécution de la requête
            $stmt->execute();
            // Retourne le produit sous forme de tableau associatif
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des exceptions avec un message d'erreur personnalisé
            throw new Exception("Erreur lors de la récupération du produit : " . $e->getMessage());
        }
    }
}
