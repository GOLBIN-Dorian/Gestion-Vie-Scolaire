# 🏫 Gestion-Vie-Scolaire

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)

## 📋 Présentation
**Gestion-Vie-Scolaire** est une application web métier permettant de structurer et d'administrer les données d'un établissement scolaire. L'objectif est de centraliser la gestion des acteurs de l'école (Professeurs, Classes, Élèves) et d'assurer le suivi disciplinaire.

> Ce projet démontre la maîtrise des relations entre entités et la gestion de données complexes dans un environnement PHP/MySQL.

---

## 🚀 Fonctionnalités & Logique métier
L'application repose sur une gestion relationnelle complète :

- **Administration des Entités** : Création et gestion des **Professeurs**, des **Classes** et des **Élèves**.
- **Gestion des Affectations** : Capacité de lier chaque élément entre eux (affecter des élèves à une classe, organiser la structure pédagogique).
- **Module Disciplinaire** : Attribution de sanctions personnalisées aux élèves en fonction des incidents relevés.
- **Interface Unifiée** : Une plateforme unique pour piloter l'ensemble des données scolaires.

---

## 🛠 Détails Techniques
- **Architecture MVC** : Séparation rigoureuse du code (Modèles pour la DB, Vues pour l'affichage, Contrôleurs pour la logique).
- **Design Utility-First** : Utilisation de **Tailwind CSS** pour une interface moderne, intuitive et totalement responsive.
- **Base de Données Relationnelle** : Modèle MySQL conçu pour assurer l'intégrité des données lors des affectations (Élèves <-> Classes <-> Professeurs).
- **Sécurité** : Requêtes préparées avec **PDO** pour protéger l'application contre les failles SQL.


---

### Procédure
1. **Cloner le projet** :
   ```bash
   git clone [https://github.com/GOLBIN-Dorian/Gestion-Vie-Scolaire.git](https://github.com/GOLBIN-Dorian/Gestion-Vie-Scolaire.git)
