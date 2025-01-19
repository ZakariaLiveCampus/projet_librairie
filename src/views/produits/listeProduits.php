<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Liste des produits";
?>
<form method="GET" action="">
    <input type="hidden" name="do" value="produit">
    <label for="categorie_id">Catégorie :</label>
    <select name="categorie_id" id="categorie_id">
        <option value="">Toutes les catégories</option>
        <?php foreach ($categories as $categorie): ?>
            <option value="<?= htmlspecialchars($categorie['id']) ?>"
                <?= isset($_GET['categorie_id']) && $_GET['categorie_id'] == $categorie['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categorie['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="prix_min">Prix Min :</label>
    <input type="number" step="0.01" name="prix_min" id="prix_min"
        value="<?= isset($_GET['prix_min']) ? htmlspecialchars($_GET['prix_min']) : '' ?>">

    <label for="prix_max">Prix Max :</label>
    <input type="number" step="0.01" name="prix_max" id="prix_max"
        value="<?= isset($_GET['prix_max']) ? htmlspecialchars($_GET['prix_max']) : '' ?>">

    <button type="submit">Filtrer</button>
</form>
<table>
    <thead>
        <tr>
            <th>Action</th>
            <th>ISBN</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit): ?>
            <tr>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <td>
                        <a href="?do=produit&action=supprimer&id=<?= htmlspecialchars($produit['isbn']) ?>"
                            onclick="return confirm('Êtes-vous sûr ?');">
                            Supprimer
                        </a>
                        <a href="?do=produit&action=modifier&id=<?= htmlspecialchars($produit['isbn']) ?>">Modifier</a>
                    </td>
                <?php else: ?>
                    <td>
                        Actions
                    </td>
                <?php endif; ?>

                <td><?= htmlspecialchars($produit['isbn']) ?></td>
                <td><?= htmlspecialchars($produit['nom']) ?></td>
                <td><?= htmlspecialchars($produit['description']) ?></td>
                <td><?= htmlspecialchars($produit['prix']) ?></td>
                <td><?= htmlspecialchars($produit['stock']) ?></td>
                <td><?= htmlspecialchars($produit['categorie_nom']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($_SESSION['user']['role'] === 'admin'): ?>
    <a href="?do=produit&action=ajouter" class="action">Ajouter un produit</a>
<?php endif; ?>