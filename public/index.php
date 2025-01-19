<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Define a base path for including files
$baseDir = __DIR__ . '/../src/';
require_once '../src/database/Database.php';

// Import the MongoDB class
require_once $baseDir . 'Database/MongoDB.php';
session_start();

$do = 'accueil';
$action = null;

if (isset($_GET['do'])) {
    $do = $_GET['do'];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if (!isset($_SESSION['user']) && $do !== 'connexion' && $do != 'article'  && $do !== 'inscription') {
    header('Location: index.php?do=connexion');
    exit;
}

switch ($do) {
    case 'accueil':  // Afficher la page d'accueil
        require $baseDir . 'views/accueil.php';
        break;
    case 'mongodb':  // Afficher la page d'accueil
        require $baseDir . 'controllers/MongodbController.php';
        $controller = new MongodbController();
        $controller->testMongo();
        break;
    case 'categorie':
        require $baseDir . 'controllers/CategorieController.php';
        $controller = new CategorieController();
        if ($action === 'supprimer') {
            $controller->supprimerCategorie();
        } elseif ($action === 'modifier') {
            $controller->modifierCategorie();
        } elseif ($action === 'ajouter') {
            $controller->ajouterCategorie();
        } else {
            $controller->listeCategories();
        }
        break;
    case 'produit':
        require $baseDir . 'controllers/ProduitController.php';
        $controller = new ProduitController();
        if ($action === 'supprimer') {
            $controller->supprimerProduit();
        } elseif ($action === 'modifier') {
            $controller->modifierProduit();
        } elseif ($action === 'ajouter') {
            $controller->ajouterProduit();
        } else {
            $controller->listeProduits();
        }
        break;
    case 'article': // Gestion des articles
        require $baseDir . 'controllers/ArticleController.php';
        $controller = new ArticleController();
        if ($action === 'supprimer') {
            $controller->supprimerArticle();
        } elseif ($action === 'modifier') {
            $controller->modifierArticle();
        } elseif ($action === 'ajouter') {
            $controller->ajouterArticle();
        } else {
            $controller->listeArticles();
        }
        break;
    case 'inscription':
        require $baseDir . 'controllers/UtilisateurController.php';
        $controller = new UtilisateurController();
        $controller->inscription();
        break;
    case 'connexion':
        require $baseDir . 'controllers/UtilisateurController.php';
        $controller = new UtilisateurController();
        $controller->connexion();
        break;
    case 'deconnexion':
        session_destroy();
        header('Location: index.php?do=connexion');
        break;
    default:
        http_response_code(404);
        echo 'Page introuvable !';
        break;
}
