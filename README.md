<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

# Gestion Des Loyers

Application web de gestion immobilière permettant de suivre les loyers, les charges et les transactions pour les propriétaires et gestionnaires immobiliers.

## 🎨 Charte Graphique

### Couleurs

- **Bleu Principal**: `#3B82F6` (bg-blue-500)
- **Vert**: `#10B981` (bg-green-500)
- **Violet**: `#8B5CF6` (bg-purple-500)
- **Gris Fond**: `#F3F4F6` (bg-gray-100)
- **Blanc**: `#FFFFFF` (bg-white)
- **Texte Principal**: `#1F2937` (text-gray-800)
- **Texte Secondaire**: `#4B5563` (text-gray-600)

### Typographie

- **Police principale**: Inter (via Tailwind CSS)
- **Tailles de texte**:
  - Titres: `text-3xl` (1.875rem)
  - Sous-titres: `text-xl` (1.25rem)
  - Texte courant: `text-base` (1rem)
  - Texte petit: `text-sm` (0.875rem)

### Composants

#### Cartes
```css
Classe: bg-white rounded-lg shadow-md p-6
```
- Fond blanc
- Coins arrondis (large)
- Ombre moyenne
- Padding interne de 1.5rem

#### Boutons
```css
Classe: px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600
```
- Padding horizontal: 1rem
- Padding vertical: 0.5rem
- Fond bleu avec effet hover plus foncé
- Texte blanc
- Coins arrondis (medium)

#### Icônes
- Utilisation de **Heroicons** (inclus dans Tailwind CSS)
- Taille standard: 24x24px (`w-6 h-6`)

## 📱 Interfaces Principales

### 1. Tableau de Bord

**Fonctionnalités** :
- Vue d'ensemble des statistiques clés
- Graphiques de suivi mensuel
- Liste des dernières transactions

**Composants** :
- Cartes de statistiques avec icônes
- Graphique ChartJS pour les données mensuelles
- Tableau responsive pour les transactions

### 2. Gestion des Loyers

**Fonctionnalités** :
- Liste des loyers avec filtres
- Formulaire d'ajout/modification
- Suivi des paiements

**Comportements** :
- Validation des formulaires côté client et serveur
- Confirmation pour les actions importantes
- Tri dynamique des données

### 3. Gestion des Charges

**Fonctionnalités** :
- Catégorisation des charges
- Suivi des dépenses
- Rapports mensuels

## 🚀 Installation

1. Cloner le projet
2. Installer les dépendances : `composer install && npm install`
3. Configurer le fichier `.env`
4. Générer la clé : `php artisan key:generate`
5. Lancer les migrations : `php artisan migrate`
6. Compiler les assets : `npm run dev`

## 📝 License

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).
