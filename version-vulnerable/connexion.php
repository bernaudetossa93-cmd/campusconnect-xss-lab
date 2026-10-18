<?php
// Cette fonction encode les caractères spéciaux pour les afficher comme du texte HTML.
function e(string $valeur): string
{
    return htmlspecialchars($valeur, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function debutPage(string $titre): void
{
    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= e($titre) ?> — CampusConnect</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js" defer></script>
    </head>
    <body>
    <header class="entete">
        <a class="marque" href="index.php">CampusConnect</a>
        <nav aria-label="Navigation principale">
            <a href="index.php">Accueil</a><a href="recherche.php">Étudiants</a>
            <a href="publier.php">Publier</a><a href="apercu.php">Aperçu</a>
        </nav>
    </header>
    <main class="contenu">
        <h1><?= e($titre) ?></h1>
    <?php
}

function finPage(): void
{
    echo '</main><footer class="pied">CampusConnect · Réseau étudiant</footer></body></html>';
}
