[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-24ddc0f5d75046c5622901739e7c5dd533143b0c8e959d652212380cedb1ea36.svg)](https://classroom.github.com/a/IsgiP3wT)
[![Open in Codespaces](https://classroom.github.com/assets/launch-codespace-7f7980b617ed060a017424585567c406b6ee15c891e84e1186181d67ecf80aa0.svg)](https://classroom.github.com/open-in-codespaces?assignment_repo_id=14919223)

# Projet Web Blabla Omnes - Groupe 1D

## Description

Ce projet est une application web de covoiturage développée dans le cadre du cours de développement web à l'ECE Lyon. L'application permet aux utilisateurs de publier des trajets, rechercher des covoiturages, gérer leur profil, effectuer des paiements, et plus encore.

## Fonctionnalités

- **Inscription et Connexion** : Création de comptes utilisateur avec gestion des profils.
- **Publication de Trajets** : Les utilisateurs peuvent publier des trajets avec détails comme départ, arrivée, date, heure, prix, etc.
- **Recherche de Trajets** : Recherche et réservation de covoiturages disponibles.
- **Gestion des Paiements** : Système de paiement intégré pour les réservations.
- **Administration** : Interface admin pour gérer les utilisateurs, plaintes, permis de conduire, etc.
- **Notifications** : Système de notifications pour les utilisateurs.
- **Profils Utilisateur** : Modification des informations personnelles, préférences, etc.

## Technologies Utilisées

- **Backend** : PHP
- **Frontend** : HTML, CSS, JavaScript
- **Base de Données** : MySQL
- **Serveur** : Apache (ou équivalent pour PHP)

## Installation

### Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Un serveur web (ex. Apache, Nginx)
- Composer (optionnel pour la gestion des dépendances PHP)

### Étapes

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/ECE-Lyon/projet-web-blabla-omnes-groupe-1d.git
   cd projet-web-blabla-omnes-groupe-1d
   ```

2. **Configurer la base de données** :
   - Créer une base de données MySQL.
   - Importer le fichier `bdd/blabla_omnes.sql` pour créer les tables.

3. **Configurer la connexion à la base de données** :
   - Modifier le fichier `connexion_bdd.php` avec vos informations de base de données (hôte, utilisateur, mot de passe, nom de la DB).
   - Pour MAMP (par défaut) : hôte `localhost:3306`, utilisateur `root`, mot de passe `root`, DB `blabla_omnes`.

4. **Lancer le serveur** :
   - Si vous utilisez un serveur local comme XAMPP, MAMP ou WAMP, placez le projet dans le dossier `htdocs` et démarrez Apache et MySQL.
   - Accédez à `http://localhost/projet-web-blabla-omnes-groupe-1d/index.html`.

## Utilisation

- Accédez à la page d'accueil `index.html`.
- Inscrivez-vous ou connectez-vous.
- Publiez un trajet via la section "Publier Trajet".
- Recherchez des trajets via "Recherche Trajet".
- Gérez votre profil dans la section "Profil".

## Structure du Projet

- `admin/` : Pages d'administration.
- `compte/` : Gestion des comptes utilisateur.
- `mes_trajets/` : Gestion des trajets personnels.
- `paiement/` : Système de paiement.
- `profil/` : Gestion des profils.
- `publier_trajet/` : Publication de nouveaux trajets.
- `recherche_trajet/` : Recherche de trajets.
- `signalisation/` : Signalement de problèmes.
- `bdd/` : Schéma de la base de données.
- `img/` : Images et icônes.
- `partials/` : Composants réutilisables (header, footer).

## Contributeurs

- Groupe 1D - ECE Lyon

## Licence

Ce projet est destiné à des fins éducatives. Consultez les termes de l'ECE Lyon pour toute utilisation.
