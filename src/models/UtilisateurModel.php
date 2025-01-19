<?php

use Ramsey\Uuid\Uuid;

class UtilisateurModel
{
    public function trouverUtilisateurParEmail($email)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        // Définition de la requête SQL pour chercher un utilisateur par son email (avec limite 1)
        $sql = "SELECT * FROM Utilisateur WHERE email = :email LIMIT 1";
        // Préparation de la requête
        $statement = $db->getConnection()->prepare($sql);
        // Liaison du paramètre 'email' à la requête
        $statement->bindParam(':email', $email);
        // Exécution de la requête
        $statement->execute();
        // Récupération du résultat
        $result = $statement->fetchAll();
        // Si aucun résultat n'est trouvé, retourne null
        if (count($result) == 0) return null;
        // Retourne le premier utilisateur trouvé
        return $result[0];
    }

    public function creerUtilisateur($nom, $prenom, $email, $mot_de_passe)
    {
        // Obtention de l'instance de la base de données
        $db = Database::getInstance();
        // Génération d'un identifiant unique pour l'utilisateur avec UUID
        $id = Uuid::uuid4();
        // Hachage du mot de passe avant de le stocker dans la base de données
        $mot_de_passe_hashe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        // Définition de la requête SQL pour insérer un nouvel utilisateur
        $query = "
            INSERT INTO Utilisateur (id, nom, prenom, email, mot_de_passe, role) 
            VALUES (:id, :nom, :prenom, :email, :mot_de_passe, :role)
        ";
        // Préparation de la requête
        $stmt = $db->getConnection()->prepare($query);
        // Liaison des paramètres à la requête
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe_hashe);
        // Définition du rôle de l'utilisateur, ici par défaut "client"
        $stmt->bindValue(':role', "client");
        // Exécution de la requête
        $stmt->execute();
        // Retourne le nombre de lignes affectées par l'insertion (devrait être 1 si réussi)
        return $stmt->rowCount();
    }
}