<?php
require 'config.php';
require 'connexion.php';

// Suppression simple d'une publication de démonstration (les commentaires liés sont supprimés par la clé étrangère).
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_id'])) {
    $suppression = $pdo->prepare('DELETE FROM publications WHERE id = ?');
    $suppression->execute([(int) $_POST['supprimer_id']]);
    header('Location: index.php');
    exit;
}
$requete = $pdo->query('SELECT publications.id, publications.contenu, publications.date_publication, etudiants.id AS etudiant_id, etudiants.nom FROM publications JOIN etudiants ON etudiants.id = publications.id_etudiant ORDER BY publications.date_publication DESC');
$publications = $requete->fetchAll();

debutPage('Fil étudiant');
?>
<p class="intro">Les nouvelles de la vie étudiante, partagées par la communauté du campus.</p>
<p><a class="bouton" href="publier.php">Écrire une publication</a></p>
<?php foreach ($publications as $publication): ?>
    <article class="publication">
        <h2><a href="profil.php?id=<?= (int) $publication['etudiant_id'] ?>"><?= e($publication['nom']) ?></a></h2>
        <time><?= e($publication['date_publication']) ?></time>
        <p><?= nl2br($publication['contenu']) ?></p>
        <a href="commentaires.php?id=<?= (int) $publication['id'] ?>">Voir les commentaires</a>
        <form method="post"><button class="lien-bouton" name="supprimer_id" value="<?= (int) $publication['id'] ?>">Supprimer</button></form>
    </article>
<?php endforeach; ?>
<?php finPage(); ?>
