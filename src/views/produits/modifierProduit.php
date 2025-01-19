<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Modifier un produit";
?>
<form method="post" action="?do=produit&action=modifier&id=<?= htmlspecialchars($produit['id']) ?>">
    <label for="id">ISBN :</label>
    <input type="text" id="id" name="id" value="<?= htmlspecialchars($produit['id']) ?>" required>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required><?= htmlspecialchars($produit['description']) ?></textarea>

    <label for="categorie">Catégorie :</label>
    <select name="categorie_id" id="categorie" required>
        <?php foreach ($categories as $categorie): ?>
            <option value="<?= htmlspecialchars($categorie['id']) ?>"
                <?= $produit['id_categorie'] === $categorie['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categorie['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="prix">Prix :</label>
    <input type="number" id="prix" name="prix" step="0.01" value="<?= htmlspecialchars($produit['prix']) ?>" required>

    <label for="stock">Stock :</label>
    <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($produit['stock']) ?>" required>

    <button type="submit">Modifier</button>
</form>

<a href="?do=produit" class="action">Retour à la liste</a>