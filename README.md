![Build Status](https://app.chipperci.com/projects/eb20ce27-c1e4-4296-ab5a-7c9aa4712214/status/master)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/opmvpc/prolog/Psalm?label=psalm)](https://github.com/opmvpc/prolog/actions?query=workflow%3APsalm+branch%3Amaster)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/opmvpc/prolog/Check%20&%20fix%20styling?label=style)](https://github.com/opmvpc/prolog/actions?query=workflow%3A%22Check+%26+fix+styling%22+branch%3Amaster)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/opmvpc/prolog/Laravel?label=laravel-tests)](https://github.com/opmvpc/prolog/actions?query=workflow%3ALaravel+branch%3Amaster)

# Prolog
App gestion et exécution de programmes prolog

## TO DO
### Tests
- [ ] tester les différentes pages
- [x] Chipper CI
- [x] stagging

### Features
- [x] intégration de l'auth et des équipes
- [x] show programme
- [x] gestion des droits d'acces aux modifs des programmes
- [x] copie d'un programme
- [x] anonymes peuvent créer? comment modifier
- [x] programmes public/teams
- [ ] Service d'import de données
- [ ] CRUD pour les ensembles de regles
- [ ] selection d'un ensemble de regles dans l'éditeur

### Nice to have
- [ ] Coloriser le code dans l'éditeur
- [ ] animations
- [ ] turbolinks
- [ ] filtres ou dashboard pour ne voir que les projets persos / teams

## Installation

### Prérequis

+ php 7.3
+ composer
+ mysql

### 1. cloner le repos

```bash
$ git clone https://github.com/opmvpc/biblio.git
$ cp biblio
```

**Guide officiel ici: https://laravel.com/docs/6.x#configuration**

### 2. Copier le fichier de config

```bash
$ cp .env.example .env
```

### 3. Créez une db "prolog", puis renseigner les infos dans le fichier .env

### 4. Installation avec composer

```bash
$ composer install
```

### 5. Générer la clé d'encryption

```bash
$ php artisan key:generate
```

### 6. Population de la DB

```bash
$ php artisan migrate:fresh --seed
```

### 7. Permissions
pas besoin avec laragon
```bash
$ sudo chmod -R g+w bootstrap/cache/
$ sudo chmod -R g+w storage/
```

### 8. upload fichiers

```bash
$ php artisan storage:link
```

### 9. assets js css dans une deuxieme fenetre de commande (pas besoin si on ne modifie pas le code js ou css)

```bash
$ npm install && npm run watch
```

Et normalement ça devrait fonctionner !

## Commandes
```bash
$ php artisan test       # lance les tests
$ composer psalm         # analyse statique
$ composer format        # format le code automatiquement
```
