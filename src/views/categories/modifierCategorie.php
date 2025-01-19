<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Modifier une catégorie";
?>

<form method="post" action="?do=categorie&action=modifier&id=<?= htmlspecialchars($categorie['id']) ?>">
    <label for="nom">Nom de la catégorie :</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($categorie['nom']) ?>" required>
    <button type="submit">Modifier</button>
</form>

<a href="?do=categorie" class="action">Retour à la liste</a>