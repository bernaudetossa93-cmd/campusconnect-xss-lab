<?php
require 'config.php'; require 'connexion.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$requete = $pdo->prepare('SELECT id, nom, filiere, description_profil AS description FROM etudiants WHERE id = ?');
$requete->execute([$id ?: 0]); $etudiant = $requete->fetch();
debutPage('Profil étudiant');
if ($etudiant): ?><section class="publication"><h2><?= e($etudiant['nom']) ?></h2><p><?= e($etudiant['filiere']) ?></p><p><?= e($etudiant['description']) ?></p></section>
<?php else: ?><p>Ce profil n’existe pas.</p><?php endif; ?>
<?php finPage(); ?>
