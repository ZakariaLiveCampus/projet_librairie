# Gestion de Librairie en PHP avec MongoDB

Ce projet est une application de gestion de librairie développée en PHP. Elle utilise MongoDB/MySQL et suit une architecture MVC (Modèle-Vue-Contrôleur). L'application permet de gérer des catégories, des produits, et des articles de blog.

---

## Fonctionnalités

### Gestion des catégories

- Ajouter une catégorie.
- Modifier une catégorie.
- Supprimer une catégorie.
- Lister les catégories existantes.

### Gestion des produits

- Ajouter un produit.
- Modifier un produit.
- Supprimer un produit.
- Lister les produits avec possibilité de :
  - Filtrer par catégorie.
  - Filtrer par prix.

### Gestion des articles de blog

- Ajouter un article avec les champs suivants :
- Modifier un article.
- Supprimer un article.
- Lister les articles avec possibilité de :
  - Filtrer par auteur.
  - Filtrer par tag.

### Authentification

- Inscription d'un utilisateur.
- Connexion et gestion de session.
- Redirection vers la page de connexion pour les utilisateurs non authentifiés.

---

## Structure du projet

- `public/` : Contient le fichier `index.php`, point d'entrée principal de l'application.
- `src/` :
  - `controllers/` : Contient les contrôleurs pour gérer les actions utilisateur.
  - `models/` : Contient les modèles pour interagir avec MongoDB.
  - `views/` : Contient les fichiers d'interface utilisateur pour chaque fonctionnalité.
  - `database/` : Contient la configuration de la connexion MongoDB.
- `vendor/` : Contient les dépendances installées via Composer.

---

## Prérequis

- PHP >= 8.0
- Serveur Apache ou autre serveur compatible avec PHP.
- MongoDB installé et configuré.
- Composer installé pour la gestion des dépendances.

---
