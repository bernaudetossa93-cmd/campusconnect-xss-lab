<?php
require 'config.php'; require 'connexion.php';
$publicationId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? ''); $contenu = trim($_POST['contenu'] ?? '');
    if ($nom !== '' && $contenu !== '' && mb_strlen($nom) <= 80 && mb_strlen($contenu) <= 1000) {
        $ajout = $pdo->prepare('INSERT INTO commentaires (id_publication, nom_auteur, contenu) VALUES (?, ?, ?)');
        $ajout->execute([$publicationId, $nom, $contenu]);
        header('Location: commentaires.php?id=' . $publicationId); exit;
    }
}
if (isset($_POST['supprimer_id'])) {
    $suppression = $pdo->prepare('DELETE FROM commentaires WHERE id = ? AND id_publication = ?');
    $suppression->execute([(int) $_POST['supprimer_id'], $publicationId]);
    header('Location: commentaires.php?id=' . $publicationId); exit;
}
$publicationReq = $pdo->prepare('SELECT contenu FROM publications WHERE id = ?'); $publicationReq->execute([$publicationId]); $publication = $publicationReq->fetch();
$liste = $pdo->prepare('SELECT id, nom_auteur, contenu, date_creation FROM commentaires WHERE id_publication = ? ORDER BY date_creation'); $liste->execute([$publicationId]);
debutPage('Commentaires');
?>
<?php if ($publication): ?><article class="publication"><h2>Publication</h2><p><?= e($publication['contenu']) ?></p></article>
<p><a href="index.php">Retour au fil</a></p>
<?php foreach ($liste as $commentaire): ?><article class="commentaire"><strong><?= e($commentaire['nom_auteur']) ?></strong> · <time><?= e($commentaire['date_creation']) ?></time><p><?= $commentaire['contenu'] ?></p><form method="post"><button class="lien-bouton" name="supprimer_id" value="<?= (int) $commentaire['id'] ?>">Supprimer</button></form></article><?php endforeach; ?>
<form method="post" class="formulaire"><h2>Ajouter un commentaire</h2><label for="nom">Nom fictif</label><input id="nom" name="nom" maxlength="80" required><label for="contenu">Commentaire</label><textarea id="contenu" name="contenu" maxlength="1000" required></textarea><button>Envoyer</button></form>
<?php else: ?><p>Publication introuvable.</p><?php endif; ?>
<?php finPage(); ?>
