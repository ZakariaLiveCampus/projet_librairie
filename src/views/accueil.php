<?php
$title = "Bienvenue dans la Librairie"
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Librairie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            margin: 0;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #45a049;
            border-radius: 5px;
        }

        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        a,
        .action {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            color: black;
            text-decoration: none;
            border-radius: 5px;
        }

        .action {
            border: 1px black solid;
        }

        .action:hover {
            background-color: #45a049;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            height: 80px;
            resize: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 4px rgba(76, 175, 80, 0.5);
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1><?= $title ?></h1>
    <nav>
        <a href="?do=accueil">Accueil</a>
        <a href="?do=categorie">Voir la liste des catégories</a>
        <a href="?do=produit">Voir la liste des produits</a>
        <a href="?do=article">Voir les articles</a>
        <a href="?do=deconnexion">Se déconnecter</a>
    </nav>
    <main>
        <?= $content ?? '' ?>
    </main>
</body>

</html>