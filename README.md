# 📚 Projet HPTP : Projet Harry Potter Symfony

Ce dépôt GitHub contient le code source du projet **HPTP**, une application construite avec le framework **Symfony** (PHP).

L'objectif de ce projet est d'explorer un domaine thématique (l'univers de Harry Potter) en appliquant les principes fondamentaux de l'ingénierie logicielle moderne.

---

## 🎯 Objectifs Pédagogiques pour l'Étudiant

En explorant ce dépôt, vous développerez une compréhension pratique des concepts suivants :

1.  **Architecture MVC :** Comprendre le rôle des Entités, Contrôleurs et Vues.
2.  **Framework Symfony :** Appréhender la structure d'un projet réel basé sur PHP.
3.  **Gestion de Données :** Voir comment les données sont modélisées et récupérées.
4.  **Collaboration :** Pratiquer Git pour le travail d'équipe (clonage, branches, pull requests).

---

## 🏗️ Architecture Détaillée du Projet (Modèle-Vue-Contrôleur)

Le projet suit l'architecture classique **MVC (Modèle-Vue-Contrôleur)**, enrichie par les **Services** pour la logique métier. Voici le rôle des principaux composants dans le contexte Symfony :

### 1. 🧱 Les Entités (M – Modèle)

* **Emplacement :** `src/Entity/`
* **Rôle :** Représentent les objets de l'application (ex: Personnage, Maison, Sortilège). Elles servent de modèle de données et sont directement liées aux tables de la base de données via l'ORM Doctrine.

### 2. 🚦 Les Contrôleurs (C – Contrôleur)

* **Emplacement :** `src/Controller/`
* **Rôle :** Reçoivent les requêtes HTTP (l'utilisateur accède à une URL), appellent la logique nécessaire (les Services), interagissent avec les Entités, et décident quelle page afficher. Ce sont les "chefs d'orchestre" de l'application.

### 3. ⚙️ Les Services (Logique Métier)

* **Emplacement :** Souvent dans `src/Service/`
* **Rôle :** Contiennent la logique applicative complexe et réutilisable (ex: les règles de tri, les calculs, les interactions avec des APIs externes ou des Repositories). Ils permettent de garder les Contrôleurs légers et de rendre la logique testable.

### 4. 🎨 Les Templates (V – Vue)

* **Emplacement :** `templates/`
* **Rôle :** Chargés de l'affichage final. Ils utilisent le moteur de template **Twig** pour générer le HTML en utilisant les données fournies par les Contrôleurs.

---

## 🛠️ Le point de départ pour développer son projet en 22 minutes (un Corte - Furiani, dans le stade)

### Prérequis

* **PHP** (version compatible avec Symfony).
* **Composer** (gestionnaire de dépendances PHP).
* **Git** pour cloner le dépôt.
* **Docker** (recommandé si vous utilisez les fichiers `compose.yaml`).

### 1. Clonage du Dépôt

Ouvrez votre terminal et récupérez le projet :

```bash
git clone [https://github.com/Ludovic2b/hptp.git](https://github.com/Ludovic2b/hptp.git)
cd hptp