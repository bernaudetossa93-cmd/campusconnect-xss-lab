<?php
require 'config.php'; require 'connexion.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu'] ?? '');
    $etudiantId = filter_input(INPUT_POST, 'etudiant_id', FILTER_VALIDATE_INT);
    if ($contenu === '' || mb_strlen($contenu) > 2000 || !$etudiantId) { $message = 'Choisissez un profil et saisissez un texte de 1 à 2 000 caractères.'; }
    else {
        // La requête préparée protège les données SQL. Elle ne remplace pas l'encodage à l'affichage.
        $insertion = $pdo->prepare('INSERT INTO publications (contenu, id_etudiant) VALUES (?, ?)');
        $insertion->execute([$contenu, $etudiantId]);
        header('Location: index.php'); exit;
    }
}
$etudiants = $pdo->query('SELECT id, nom FROM etudiants ORDER BY nom')->fetchAll();
debutPage('Nouvelle publication');
?>
<?php if ($message): ?><p class="alerte"><?= e($message) ?></p><?php endif; ?>
<form method="post" class="formulaire"><label for="etudiant">Publier comme</label><select id="etudiant" name="etudiant_id" required><?php foreach ($etudiants as $etudiant): ?><option value="<?= (int) $etudiant['id'] ?>"><?= e($etudiant['nom']) ?></option><?php endforeach; ?></select>
<label for="contenu">Message</label><textarea id="contenu" name="contenu" maxlength="2000" required></textarea><button>Publier</button></form>
<?php finPage(); ?>
