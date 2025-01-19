<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/librairie/src/views/accueil.php';
$title = "Modifier l'article";
if (isset($article)): ?>
    <form method="POST">
        <label for="titre">Titre</label><br>
        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($article['titre']); ?>" required><br><br>

        <label for="contenu">Contenu</label><br>
        <textarea id="contenu" name="contenu" required><?= htmlspecialchars($article['contenu']); ?></textarea><br><br>

        <label for="auteur">Auteur</label><br>
        <input type="text" id="auteur" name="auteur" value="<?= htmlspecialchars($article['auteur']); ?>" required><br><br>

        <label for="tags">Tags (séparés par des virgules)</label><br>
        <input type="text" id="tags" name="tags" value="<?php
                                                        // Convertir BSONArray en tableau PHP et utiliser implode
                                                        $tags = is_array($article['tags']) ? $article['tags'] : iterator_to_array($article['tags']);
                                                        echo htmlspecialchars(implode(', ', $tags));
                                                        ?>"><br><br>

        <button type="submit">Modifier</button>
    </form>
<?php else: ?>
    <p>Article introuvable.</p>
<?php endif; ?>
<a href="?do=article">Retour à la liste</a>