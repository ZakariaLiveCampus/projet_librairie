<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Ajouter une catégorie";
?>

<form method="post" action="?do=categorie&action=ajouter">
    <label for="nom">Nom de la catégorie :</label>
    <input type="text" id="nom" name="nom" required>
    <button type="submit">Ajouter</button>
</form>

<a href="?do=categorie" class="action">Retour à la liste</a>