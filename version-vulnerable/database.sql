CREATE DATABASE IF NOT EXISTS campusconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE campusconnect;

DROP TABLE IF EXISTS commentaires;
DROP TABLE IF EXISTS publications;
DROP TABLE IF EXISTS etudiants;

CREATE TABLE etudiants (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    filiere VARCHAR(120) NOT NULL,
    description_profil VARCHAR(500) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE publications (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    id_etudiant INT UNSIGNED NOT NULL,
    date_publication TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_publications_etudiants FOREIGN KEY (id_etudiant) REFERENCES etudiants(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE commentaires (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    id_publication INT UNSIGNED NOT NULL,
    nom_auteur VARCHAR(80) NOT NULL,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_commentaires_publications FOREIGN KEY (id_publication) REFERENCES publications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO etudiants (id, nom, filiere, description_profil) VALUES
(1, 'Amina Diallo', 'Informatique', 'Curieuse des bases de données et du développement web.'),
(2, 'Lucas Martin', 'Réseaux', 'Aime comprendre comment les systèmes communiquent.'),
(3, 'Sarah Nguyen', 'Design numérique', 'Étudie les interfaces accessibles et utiles.');

INSERT INTO publications (contenu, id_etudiant) VALUES
('Bienvenue sur le fil CampusConnect !', 1),
('Le club informatique organise une rencontre jeudi à la bibliothèque.', 2),
('Je partage bientôt mes notes sur les interfaces web accessibles.', 3);

INSERT INTO commentaires (contenu, id_publication, nom_auteur) VALUES
('Merci pour l’information !', 2, 'Amina Diallo'),
('À jeudi.', 2, 'Sarah Nguyen');
