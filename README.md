# README - Plateforme LINKUP

## 📋 Aperçu du Projet

LINKUP est une plateforme web innovante permettant aux utilisateurs de créer un profil personnalisé, de gérer leur identité numérique et de connecter facilement avec d'autres membres grâce à un système de recherche performant. Développée avec Laravel, l'application offre une expérience utilisateur sécurisée et intuitive.

---

## 🚀 Fonctionnalités Principales

### 🔐 Authentification et Sécurité
- **Inscription/Connexion sécurisées** avec validation des données
- **Récupération de mot de passe** par email
- **Authentification Laravel Breeze** pré-intégrée
- Protection CSRF et sécurisation des sessions

### 👤 Gestion du Profil Utilisateur
- **Pseudo unique** (non modifiable après création)
- **Modification des informations** :
  - Nom et prénom
  - Email (avec vérification optionnelle)
  - Photo de profil (upload et gestion)
- **Changement de mot de passe** avec vérification de l'ancien
- Interface de profil responsive et intuitive

### 🔍 Système de Recherche Avancée
- Recherche d'utilisateurs par **pseudo**
- Interface de recherche performante et rapide
- Résultats présentés de manière claire

---

## 🛠️ Technologies Utilisées

### Backend
- **Laravel 10+** (Framework PHP)
- **MySQL** (Base de données)
- **Laravel Breeze** (Système d'authentification)

### Frontend
- **Blade Templates** (Templating Laravel)
- **Tailwind CSS** (Stylisation)
- **JavaScript/ES6+**

### Développement
- **Composer** (Gestion des dépendances PHP)
- **Git** (Contrôle de version)

---

## 📁 Structure du Projet

```
linkup-platform/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/          # Contrôleurs d'authentification
│   │   │   ├── ProfileController.php
│   │   │   └── SearchController.php
│   │   │  
│   │   └── Middleware/
│   ├── Models/
│   │   └── User.php
│   │   
│   └── Services/              # Services métier
│
├── database/
│   ├── migrations/            # Migrations de base de données
│   └── seeders/               # Données de test
│
├── resources/
│   ├── views/
│   │   ├── auth/              # Vues d'authentification
│   │   ├── profile/           # Vues de profil
│   │   ├── search/            # Vues de recherche
│   │   └── layouts/           # Layouts principaux
│ 
│
├── public/
│   └── storage/               # Fichiers uploadés (photos de profil)
│
├── routes/
│   ├── web.php                # Routes web
│   └── auth.php               # Routes d'authentification
│
├── .env.example               # Variables d'environnement
├── composer.json
└── README.md
```
