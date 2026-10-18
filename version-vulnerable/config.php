<?php
// Paramètres locaux par défaut de XAMPP. Modifiez-les si votre installation diffère.
$hote = '127.0.0.1';
$port = 3308; // Port configuré dans cette installation de XAMPP (modifiez-le si votre port diffère).
$nomBase = 'campusconnect';
$utilisateur = 'root';
$motDePasse = '';

try {
    $pdo = new PDO(
        "mysql:host=$hote;port=$port;dbname=$nomBase;charset=utf8mb4",
        $utilisateur,
        $motDePasse,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $erreur) {
    exit('Connexion impossible. Vérifiez MySQL et config.php, puis importez database.sql.');
}
