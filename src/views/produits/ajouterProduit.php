<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Ajouter un produit";
?>

<form method="post" action="?do=produit&action=ajouter">
    <label for="isbn">ISBN :</label>
    <input type="text" id="isbn" name="isbn" max-lenght="13" required>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea>

    <label for="prix">Prix :</label>
    <input type="number" id="prix" name="prix" step="0.01" required>

    <label for="categorie">Catégorie :</label>
    <select name="categorie_id" id="categorie" required>
        <?php foreach ($categories as $categorie): ?>
            <option value="<?= htmlspecialchars($categorie['id']) ?>">
                <?= htmlspecialchars($categorie['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="stock">Stock :</label>
    <input type="number" id="stock" name="stock" required>

    <button type="submit">Ajouter</button>
</form>

<a href="?do=produit" class="action">Retour à la liste</a>