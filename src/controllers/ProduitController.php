<?php
require_once __DIR__ . '/../models/ProduitModel.php';
require_once __DIR__ . '/../models/CategorieModel.php';

class ProduitController
{
    private $produitModel;
    private $categorieModel;

    public function listeProduits()
    {
        // Instanciation des modèles
        $this->produitModel = new ProduitModel();
        $this->categorieModel = new CategorieModel();

        // Récupération des filtres depuis la requête GET
        $id_categorie = filter_input(INPUT_GET, 'categorie_id');
        $prix_min = filter_input(INPUT_GET, 'prix_min', FILTER_VALIDATE_FLOAT);
        $prix_max = filter_input(INPUT_GET, 'prix_max', FILTER_VALIDATE_FLOAT);

        // Appel au modèle pour récupérer les produits filtrés
        $produits = $this->produitModel->filtrerProduits($id_categorie, $prix_min, $prix_max);
        // Récupération de la liste des catégories avec le nombre de produits associés
        $categories = $this->categorieModel->listeCategorieAvecNbProduits();

        // Chargement de la vue pour afficher les produits
        require_once __DIR__ . '/../views/produits/listeProduits.php';
    }

    public function ajouterProduit()
    {
        // Instanciation des modèles
        $this->produitModel = new ProduitModel();
        $this->categorieModel = new CategorieModel();

        // Vérifie si le formulaire a été soumis (méthode POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $isbn = filter_input(INPUT_POST, 'isbn');
            $nom = filter_input(INPUT_POST, 'nom');
            $description = filter_input(INPUT_POST, 'description');
            $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
            $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
            $id_categorie = filter_input(INPUT_POST, 'categorie_id');

            // Vérifie si les champs obligatoires sont remplis
            if (!empty($isbn) && !empty($nom) && !empty($description) && !empty($prix) && !empty($stock)) {
                // Ajout du produit via le modèle
                $this->produitModel->ajouterProduit($isbn, $nom, $description, $prix, $stock, $id_categorie);
                echo "Produit ajouté avec succès.";
                // Redirection vers la liste des produits après l'ajout
                header('Location: ?do=produit');
                return;
            } else {
                echo "Remplissez correctement les champs";
            }
        }
        // Récupération de la liste des catégories pour le formulaire d'ajout
        $categories = $this->categorieModel->listeCategorieAvecNbProduits();
        // Chargement de la vue pour ajouter un produit
        require_once __DIR__ . '/../views/produits/ajouterProduit.php';
    }

    public function supprimerProduit()
    {
        // Instanciation du modèle Produit
        $this->produitModel = new ProduitModel();

        // Récupération de l'identifiant du produit à supprimer
        $id = filter_input(INPUT_GET,  'id');

        if ($id) {
            // Suppression du produit si l'ID est valide
            $this->produitModel->supprimerProduit($id);
        } else {
            // Affiche un message d'erreur si l'ID est manquant
            echo "Id manquant pour la suppression";
            return;
        }
        // Redirection vers la liste des produitsaprès suppression
        header('Location: ?do=produit');
    }

    public function modifierProduit()
    {
        // Instanciation des modèles
        $this->produitModel = new ProduitModel();
        $this->categorieModel = new CategorieModel();

        // Récupération de l'identifiant du produit à modifier
        $id = filter_input(INPUT_GET, 'id');

        if ($id) {
            // Vérifie si le formulaire a été soumis (méthode POST)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupération des données du formulaire
                $nom = filter_input(INPUT_POST, 'nom');
                $isbn = filter_input(INPUT_POST, 'id');
                $description = filter_input(INPUT_POST, 'description');
                $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
                $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
                $id_categorie = filter_input(INPUT_POST, 'categorie_id');

                if (!empty($nom) && !empty($description) && !empty($prix) && !empty($stock)) {
                    // Modification du produit via le modèle
                    $this->produitModel->modifierProduit($id, $nom, $description, $prix, $stock, $isbn, $id_categorie);
                    echo "Produit modifié avec succès.";
                    // Redirection vers la liste des produits après modification
                    header('Location: ?do=produit');
                    return;
                } else {
                    // Affiche un message d'erreur en cas d'échec de la modification
                    echo "Erreur lors de la modification.";
                }
            }
            // Récupération des informations du produit à modifier
            $produit = $this->produitModel->trouverProduitParId($id);
            // Récupération de la liste des catégories pour le formulaire de modification
            $categories = $this->categorieModel->listeCategorieAvecNbProduits();
            // Chargement de la vue pour modifier un produit
            require_once __DIR__ . '/../views/produits/modifierProduit.php';
        } else {
            // Affiche un message d'erreur si l'ID est invalide
            echo "UUID invalide ou catégorie inexistante.";
        }
    }
}
