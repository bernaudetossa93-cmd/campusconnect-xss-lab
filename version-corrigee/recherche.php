<?php
require 'config.php';
require 'connexion.php';
$terme = trim($_GET['q'] ?? ''); // SOURCE : paramètre GET contrôlé par le visiteur.
$etudiants = [];
if ($terme !== '') {
    $recherche = $pdo->prepare('SELECT id, nom, filiere, description_profil AS description FROM etudiants WHERE nom LIKE :terme OR filiere LIKE :terme ORDER BY nom');
    $recherche->execute(['terme' => '%' . $terme . '%']);
    $etudiants = $recherche->fetchAll();
}
debutPage('Rechercher des étudiants');
?>
<form method="get" class="formulaire"><label for="q">Nom ou filière</label><input id="q" name="q" value="<?= e($terme) ?>"><button>Rechercher</button>
 </form>
<?php if ($terme !== ''): ?><p>Résultats pour « <?php
// CORRECTION : le terme issu de GET est encodé pour son contexte HTML.
echo e($terme);
?> »</p><?php endif; ?>
<?php foreach ($etudiants as $etudiant): ?><article class="publication"><h2><a href="profil.php?id=<?= (int) $etudiant['id'] ?>"><?= e($etudiant['nom']) ?></a></h2><p><?= e($etudiant['filiere']) ?> · <?= e($etudiant['description']) ?></p></article><?php endforeach; ?>
<?php finPage(); ?>
