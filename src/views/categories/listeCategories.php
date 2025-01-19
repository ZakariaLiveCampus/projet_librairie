<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Liste des catégories";
?>
<table>
    <thead>
        <tr>
            <th>Action</th>
            <th>Nom</th>
            <th>Nombre produits</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $categorie): ?>
            <tr>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <td>
                        <a href="?do=categorie&action=supprimer&id=<?= htmlspecialchars($categorie['id']) ?>"
                            onclick="return confirm('Êtes-vous sûr ?');">
                            Supprimer
                        </a>
                        <a href="?do=categorie&action=modifier&id=<?= htmlspecialchars($categorie['id']) ?>">Modifier</a>
                    </td>
                <?php else: ?>
                    <td>
                        Actions
                    </td>
                <?php endif; ?>
                <td><?= htmlspecialchars($categorie['nom']) ?></td>
                <td><?= htmlspecialchars($categorie['nombre_produits']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<a href="?do=categorie&action=ajouter" class="action">Ajouter une catégorie</a>
<?php endif; ?>