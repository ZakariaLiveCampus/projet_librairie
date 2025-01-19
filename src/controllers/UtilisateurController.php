<?php
require_once __DIR__ . '/../models/UtilisateurModel.php';
class UtilisateurController
{
  public function inscription()
  {
    // Vérifie si les données nécessaires sont présentes dans la requête POST
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
      $prenom = $_POST['prenom'];
      $nom = $_POST['nom'];
      $email = $_POST['email'];
      $mot_de_passe = $_POST['mot_de_passe'];

      // Vérifie si tous les champs sont remplis
      if (empty($prenom) || empty($nom) || empty($email) || empty($mot_de_passe)) {
        echo 'Veuillez remplir tous les champs';
        // Vérifie si le mot de passe respecte les règles de complexité
      } elseif (!$this->motDePasseValide($mot_de_passe)) {
        echo 'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.';
      } else {
        // Instanciation du modèle Utilisateur
        $utilisateurModel = new UtilisateurModel();

        // Vérifie si l'utilisateur avec cet email existe déjà
        $utilisateur = $utilisateurModel->trouverUtilisateurParEmail($email);

        if ($utilisateur) {
          echo 'Cet email est déjà utilisé';
        } else {
          // Crée un nouvel utilisateur via le modèle
          $utilisateur = $utilisateurModel->creerUtilisateur($prenom, $nom, $email, $mot_de_passe);

          if ($utilisateur) {
            // Redirection vers la page de connexion après inscription réussie
            header('Location: index.php?do=connexion');
            echo "L'inscription a bien été prise en compte !";
          } else {
            // Affiche un message d'erreur en cas d'échec de la création
            echo 'Une erreur est survenue lors de la création de votre compte';
          }
        }
      }
    }
    // Charge la vue d'inscription
    require_once __DIR__ . '/../views/inscription.php';
  }

  public function connexion()
  {
    // Vérifie si les données nécessaires sont présentes dans la requête POST
    if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
      $email = $_POST['email'];
      $mot_de_passe = $_POST['mot_de_passe'];

      // Vérifie si tous les champs sont remplis
      if (empty($email) || empty($mot_de_passe)) {
        echo 'Veuillez remplir tous les champs';
      } else {
        // Instanciation du modèle Utilisateur
        $utilisateurModel = new UtilisateurModel();

        // Recherche de l'utilisateur via son email
        $utilisateur = $utilisateurModel->trouverUtilisateurParEmail($email);

        if (!$utilisateur) {
          // Affiche un message si l'utilisateur n'existe pas
          echo 'Utilisateur introuvable.';
          // Vérifie si le mot de passe saisi correspond au hash stocké
        } elseif (!password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
          echo 'Mot de passe incorrect.';
        } else {
          // Stocke les informations de l'utilisateur dans la session
          $_SESSION['user'] = $utilisateur;
          // Redirection vers la page d'accueil après connexion réussie
          header('Location: index.php?do=accueil');
        }
      }
    }

    // Charge la vue de connexion
    require_once __DIR__ . '/../views/connexion.php';
  }

  private function motDePasseValide($mot_de_passe)
  {
    // Vérifie la longueur, la présence de majuscules, minuscules, chiffres et caractères spéciaux
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $mot_de_passe);
  }
}
