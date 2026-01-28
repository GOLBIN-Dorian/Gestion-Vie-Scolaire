# 📘 Gestion Vie Scolaire - Système de Sanctions

Cette application web est destinée au personnel de vie scolaire d'un lycée pour gérer les incidents disciplinaires, les élèves, les classes et les professeurs.

## 🎯 Fonctionnalités principales

L'application est organisée autour de plusieurs modules clés définis dans le backlog :

* **Authentification & Sécurité** : Connexion, inscription du personnel et déconnexion sécurisée.
* **Tableau de bord (Dashboard)** : Vue d'ensemble après connexion pour naviguer vers les différentes fonctionnalités.
* **Gestion des Classes** : Création et consultation de la liste des classes par niveau (Seconde, Première, Terminale, BTS).
* **Gestion des Élèves** : Inscription des élèves avec suivi par classe et filtrage.
* **Gestion des Professeurs** : Enregistrement des enseignants et de leurs matières.
* **Gestion des Sanctions** : Création, modification et consultation des sanctions (Heures de colle, avertissements, etc.) associées à un élève et un professeur.

## 🛠 Technologies utilisées

* **Backend** : PHP 8.x avec une architecture MVC simplifiée.
* **Base de données** : MySQL 8.0.
* **Conteneurisation** : Docker & Docker Compose.
* **Gestion des dépendances** : Composer (Autoloading PSR-4).
* **Outils** : PHPMyAdmin pour la gestion de la base de données.

## 🚀 Installation et Lancement

### Prérequis

* Docker et Docker Compose installés sur votre machine.
* PHP et Composer (pour l'installation des dépendances).

### Étapes d'installation

1. **Clonage du projet** :
   **Bash**

   ```
   git clone <url-du-depot>
   cd Gestion-Vie-Scolaire
   ```
2. **Installation des dépendances PHP** :
   **Bash**

   ```
   composer install
   ```
3. **Lancement de l'environnement Docker** :
   L'application utilise Docker pour isoler la base de données et PHPMyAdmin.
   **Bash**

   ```
   docker-compose up -d
   ```
4. **Initialisation de la base de données** :
   Au premier lancement, le fichier `init.sql` est automatiquement exécuté pour créer les tables (`utilisateurs`, `eleves`, `classes`, `sanctions`, etc.) et insérer les données de test.

## ⚙️ Configuration

### Base de données

La configuration se trouve dans `src/config/database.php`. Par défaut, les paramètres sont :

* **Host** : `127.0.0.1` (ou `db` via Docker)
* **Port** : `3330`
* **Utilisateur** : `root`
* **Mot de passe** : `secret`
* **Base de données** : `db_sanctions`

### Accès aux outils

* **Application** : Accessible via votre serveur web local (ex: `http://localhost/public/index.php`).
* **PHPMyAdmin** : Accessible sur le port `8010` (`http://localhost:8010`).

## 📁 Structure du projet

* `public/` : Point d'entrée de l'application (`index.php`).
* `src/` : Cœur de l'application.
  * `controllers/` : Logique métier pour chaque fonctionnalité (Connexion, Sanctions, etc.).
  * `Repositories/` : Requêtes SQL pour l'accès aux données.
  * `Routing/` : Gestionnaire de routes.
  * `config/` : Configuration de la base de données.
* `templates/` : Fichiers de vues PHP (Layout et pages spécifiques).
* `documentation/` : User stories et backlog du projet.
* `init.sql` : Script de création de la base de données.

## 👤 Auteur

* **Dorian Golbin**
