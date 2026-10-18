# CampusConnect — laboratoire XSS

Ce dépôt contient deux versions d’une petite application PHP/MySQL utilisée pour comparer des failles XSS dans un cadre pédagogique :

- `version-vulnerable/` : exemples volontairement vulnérables ;
- `version-corrigee/` : protections appliquées aux mêmes fonctionnalités.

## Utilisation locale uniquement

La version vulnérable sert uniquement à un laboratoire local avec des données fictives. Ne déploie pas ce projet sur un hébergement public ni sur un serveur accessible depuis Internet. Les deux dossiers Apache contiennent une règle `Require local` pour limiter l’accès à l’ordinateur local.

## Prérequis

- Windows avec XAMPP (Apache, PHP et MySQL/MariaDB) ;
- PDO MySQL activé dans PHP ;
- phpMyAdmin pour importer le schéma fourni.

## Installation

1. Clone ou télécharge ce dépôt dans le dossier `htdocs` de XAMPP, par exemple `C:\xampp\htdocs\campusconnect-xss`.
2. Démarre **Apache** et **MySQL** depuis le panneau de contrôle XAMPP.
3. Dans phpMyAdmin, importe `version-vulnerable/database.sql` une fois. Le script crée la base `campusconnect` et réinitialise ses tables ; utilise une installation de démonstration, pas une base contenant des données à conserver.
4. Ouvre `config.php` dans les deux dossiers et vérifie le port MySQL, le nom d’utilisateur et le mot de passe de ton XAMPP. Le dépôt utilise par défaut `127.0.0.1`, le port `3308`, l’utilisateur `root` et un mot de passe vide. Beaucoup d’installations XAMPP utilisent le port `3306` : adapte les deux fichiers si nécessaire.
5. Ouvre les deux versions dans le navigateur :
   - `http://localhost/campusconnect-xss/version-vulnerable/`
   - `http://localhost/campusconnect-xss/version-corrigee/`

Si phpMyAdmin indique que la connexion est refusée, vérifie d’abord que MySQL est démarré et que le port indiqué dans les deux `config.php` correspond au port configuré dans XAMPP.

## Comparaison pédagogique

Teste uniquement les données fictives dans l’application locale. Compare les versions avec les mêmes entrées : la version vulnérable montre le comportement à risque ; la version corrigée traite les données comme du texte ou les protège au moment de l’affichage.

Le script SQL contient des commandes `DROP TABLE` pour remettre à zéro les tables d’exemple. Ne l’importe pas sur une base de données existante que tu souhaites conserver.
