<?php
require_once __DIR__ . '/../models/CategorieModel.php';

class CategorieController
{
  private $categorieModel;

  public function listeCategories()
  {
    // Instanciation du modèle CategorieModel
    $this->categorieModel = new CategorieModel();

    // Récupère la liste des catégories avec le nombre de produits associés
    $categories = $this->categorieModel->listeCategorieAvecNbProduits();

    // Charge la vue pour afficher la liste des catégories
    require_once __DIR__ . '/../views/categories/listeCategories.php';
  }
  public function supprimerCategorie()
  {
    // Instanciation du modèle CategorieModel
    $this->categorieModel = new CategorieModel();

    // Récupère l'identifiant de la catégorie depuis la requête GET
    $id = filter_input(INPUT_GET, 'id');
    if ($id) {
      // Si un ID est fourni, appel de la méthode de suppression du modèle
      $this->categorieModel->supprimerCategorie($id);
    } else {
      // Affiche un message d'erreur si l'ID est manquant
      echo "ID manquant pour la suppression.";
      return;
    }
    // Redirection vers la liste des catégories après suppression
    header('Location: ?do=categorie');
  }
  public function modifierCategorie()
  {
    // Instanciation du modèle CategorieModel
    $this->categorieModel = new CategorieModel();

    // Récupère l'identifiant de la catégorie depuis la requête GET
    $id = filter_input(INPUT_GET, 'id');
    if ($id) {
      // Si la requête est une soumission de formulaire (POST)
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nouveauNom = filter_input(INPUT_POST, 'nom');

        if (!empty($nouveauNom)) {
          // Si le nouveau nom est valide, mise à jour de la catégorie
          $this->categorieModel->modifierCategorie($id, $nouveauNom);
          echo "Catégorie modifiée avec succès.";
          // Redirection vers la liste des catégories après modification
          header('Location: ?do=categorie');
          return;
        } else {
          // Affiche un message d'erreur si le nom est vide
          echo "Le nom de la catégorie ne peut pas être vide.";
        }
      }
      // Récupère les informations de la catégorie à modifier
      $categorie = $this->categorieModel->trouverCategorieParId($id);
      // Charge la vue pour le formulaire de modification
      require_once __DIR__ . '/../views/categories/modifierCategorie.php';
    } else {
      // Affiche un message d'erreur si l'ID est invalide ou non trouvé
      echo "UUID invalide ou catégorie inexistante.";
    }
  }
  public function ajouterCategorie()
  {
    // Instanciation du modèle CategorieModel
    $this->categorieModel = new CategorieModel();

    // Si la requête est une soumission de formulaire (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupère le nom de la nouvelle catégorie depuis la requête POST
      $nom = filter_input(INPUT_POST, 'nom');

      if (!empty($nom)) {
        // Si le nom est valide, ajout de la catégorie via le modèle
        $this->categorieModel->ajouterCategorie($nom);
        echo "Catégorie ajoutée avec succès.";
        // Redirection vers la liste des catégories après l'ajout
        header('Location: ?do=categorie');
        return;
      } else {
        // Affiche un message d'erreur si le nom est vide
        echo "Le nom de la catégorie ne peut pas être vide.";
      }
    }
    // Charge la vue pour le formulaire d'ajout
    require_once __DIR__ . '/../views/categories/ajouterCategorie.php';
  }
}
