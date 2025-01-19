<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Liste des articles";
?>
<form method="get" action="index.php">
    <input type="hidden" name="do" value="article">
    <label for="tag">Filtrer par tag:</label>
    <input type="text" id="tag" name="tag" value="<?= isset($_GET['tag']) ? htmlspecialchars($_GET['tag']) : ''; ?>">

    <label for="auteur">Filtrer par auteur:</label>
    <input type="text" id="auteur" name="auteur" value="<?= isset($_GET['auteur']) ? htmlspecialchars($_GET['auteur']) : ''; ?>">

    <button type="submit">Filtrer</button>
</form>
<table>
    <thead>
        <tr>
            <th>Actions</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Contenu</th>
            <th>Date de création</th>
            <th>Tags</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                    <a href="index.php?do=article&action=supprimer&id=<?= $article['_id']; ?>">Supprimer</a>
                    <a href="index.php?do=article&action=modifier&id=<?= $article['_id']; ?>">Modifier</a>
                </td>
                <td><?= htmlspecialchars($article['titre']); ?></td>
                <td><?= htmlspecialchars($article['auteur']); ?></td>
                <td><?= htmlspecialchars($article['contenu']); ?></td>
                <td><?= $article['date_creation']->toDateTime()->format('Y-m-d H:i:s'); ?></td>
                <td>
                    <?php
                    // Convertir BSONArray en tableau PHP classique
                    $tags = is_array($article['tags']) ? $article['tags'] : iterator_to_array($article['tags']);
                    echo implode(', ', $tags);  // Utilisation de implode sur le tableau PHP
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php?do=article&action=ajouter">Ajouter un nouvel article</a>