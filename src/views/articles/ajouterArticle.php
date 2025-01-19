<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Ajouter un article";
?>

<form method="POST">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" required><br><br>

    <label for="contenu">Contenu :</label>
    <textarea name="contenu" id="contenu" required></textarea><br><br>

    <label for="auteur">Auteur :</label>
    <input type="text" name="auteur" id="auteur" required><br><br>

    <label for="tags">Tags (séparés par des virgules) :</label>
    <input type="text" name="tags" id="tags"><br><br>

    <button type="submit">Ajouter l'article</button>
</form>
<a href="?do=article">Retour à la liste</a>