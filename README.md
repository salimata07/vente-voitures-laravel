# VenteVoitures

Plateforme web de vente de voitures d'occasion en Mauritanie, développée avec **Laravel** et **Bootstrap**.

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)

## Aperçu

![Page d'accueil](docs/screenshots/home.png)
![Liste des voitures](docs/screenshots/cars-list.png)
![Détail d'une voiture](docs/screenshots/car-detail.png)

## Fonctionnalités

- Authentification complète (inscription, connexion, mot de passe oublié)
- Gestion des annonces (CRUD complet : ajout, modification, suppression)
- Upload de plusieurs photos par voiture avec galerie carousel
- Recherche et filtres avancés (marque, prix, type de carburant)
- Permissions par rôle (seul le vendeur peut modifier/supprimer son annonce)
- Design responsive (Bootstrap 5)
- Données de démonstration incluses (Seeder)

## Stack technique

- **Backend** : Laravel 13, PHP 8.3
- **Frontend** : Bootstrap 5, Blade
- **Base de données** : MySQL
- **Outils** : Composer, npm/Vite, Git

## Installation locale

```bash
# Cloner le projet
git clone https://github.com/salimata07/vente-voitures-laravel.git
cd vente-voitures-laravel

# Installer les dépendances
composer install
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Configurer la base de données dans .env, puis :
php artisan migrate
php artisan db:seed --class=CarSeeder
php artisan storage:link

# Compiler les assets et lancer le serveur
npm run build
php artisan serve
```

## Auteur

**Salamata Ba**
Étudiante en Master Sécurité Informatique
[LinkedIn](https://www.linkedin.com/in/salamata-ba-622496324) [GitHub](https://github.com/salimata07)
[TryHackMe](https://tryhackme.com/p/salamataba2002)
