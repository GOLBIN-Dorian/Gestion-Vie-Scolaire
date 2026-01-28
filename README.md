Voici une version enrichie et structurée du fichier `README.md` pour votre projet, basée sur les fichiers fournis (backlog, structure technique, configuration Docker et base de données).

---

# 📘 Gestion Vie Scolaire - Système de Sanctions

Cette application web est une solution de gestion disciplinaire conçue pour le personnel de vie scolaire d'un lycée. Elle permet de centraliser le suivi des incidents, des élèves, des classes et des professeurs au sein d'une interface sécurisée.

## 🎯 Fonctionnalités principales

L'application est structurée autour de plusieurs modules clés issus du backlog produit :

* **Authentification & Sécurité** : Connexion sécurisée (US1), inscription des personnels (US2) et gestion de session (US4).
* **Tableau de Bord (Dashboard)** : Interface centrale permettant de visualiser les informations clés et de naviguer vers les outils de gestion (US25).
* **Gestion des Classes** : Création et consultation des classes organisées par niveaux (Seconde, Première, Terminale, BTS) (US5-1, US5-2).
* **Gestion des Élèves** : Inscription des élèves, suivi par classe et filtrage multicritères (US7-1, US7-2, US9).
* **Gestion des Professeurs** : Enregistrement des enseignants et de leurs matières pour l'attribution des sanctions (US10, US12).
* **Gestion des Sanctions** : Cycle de vie complet des sanctions (Heures de colle, avertissements, etc.) incluant la création et la consultation (US13, US16).

## 🛠 Technologies utilisées

* **Backend** : PHP 8.x avec une architecture MVC personnalisée et un système de routage dynamique.
* **Base de Données** : MySQL 8.0 gérant les relations entre utilisateurs, élèves, classes, professeurs et sanctions.
* **Conteneurisation** : Docker & Docker Compose pour un environnement de développement reproductible.
* **Gestion des dépendances** : Composer avec autoloading PSR-4 (Espace de nom : `App\`).
* **Administration DB** : PHPMyAdmin intégré pour la gestion simplifiée des données.

## 🚀 Installation et Lancement

### Prérequis

* Docker et Docker Compose.
* PHP 8.1+ et Composer (pour les dépendances locales).

### Étapes d'installation

1. **Clonage du projet** :
   **Bash**

   ```
   git clone <url-du-depot>
   cd Gestion-Vie-Scolaire
   ```
2. **Installation des dépendances** :
   **Bash**

   ```
   composer install
   ```
3. **Lancement de l'environnement Docker** :
   **Bash**

   ```
   docker-compose up -d
   ```

   *Note : Le script `init.sql` est automatiquement exécuté au premier lancement pour initialiser les tables et les données de test (niveaux, types de sanctions, etc.).*

## ⚙️ Configuration

### Base de données

La configuration par défaut est définie dans `src/config/database.php` mais peut être surchargée par des variables d'environnement via Docker :

* **Host** : `db` (inter-conteneur) ou `127.0.0.1` (local).
* **Port** : `3330`.
* **Utilisateur** : `root`.
* **Mot de passe** : `secret`.
* **Nom de la DB** : `db_sanctions`.

### Accès aux services

* **Application** : `http://localhost/public/index.php`
* **PHPMyAdmin** : `http://localhost:8010`

## 📁 Structure du projet

* `public/` : Point d'entrée unique (`index.php`).
* `src/` : Cœur de la logique.
  * `controllers/` : Contrôleurs gérant les requêtes et la logique métier.
  * `Repositories/` : Couche d'accès aux données (Requêtes SQL PDO).
  * `Routing/` : Système de routage gérant les actions de l'application.
  * `config/` : Fichiers de configuration (DB, etc.).
* `templates/` : Vues PHP utilisant un `layout.php` commun pour la structure HTML.
* `documentation/` : Détails des User Stories et du Backlog.

## 👤 Auteur

* **Dorian Golbin**
