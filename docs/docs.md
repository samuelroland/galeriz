# Documentation

## First analysis
### Introduction
TODO


- [Documentation](#documentation)
  - [First analysis](#first-analysis)
    - [Introduction](#introduction)
    - [Goals](#goals)
    - [Initial planning](#initial-planning)
      - [MCD](#mcd)
      - [MLD](#mld)
    - [Available pages](#available-pages)
  - [Models](#models)
    - [Layout](#layout)
    - [Login](#login)
    - [Register](#register)
    - [All galleries](#all-galleries)
    - [Create a gallery](#create-a-gallery)
    - [Gallery details](#gallery-details)
  - [Analysis/Design](#analysisdesign)
    - [Concept](#concept)
    - [Tests](#tests)
      - [Where are these tests ?](#where-are-these-tests-)
      - [Prerequesite to run tests ?](#prerequesite-to-run-tests-)
      - [How to run tests ?](#how-to-run-tests-)
    - [Planification](#planification)
    - [Design elements](#design-elements)
  - [Realisation](#realisation)
    - [Remaining errors](#remaining-errors)
  - [Conclusion](#conclusion)
  - [Appendix](#appendix)
    - [Pré-TPI summary](#pré-tpi-summary)
    - [Work diary](#work-diary)

### Goals
TODO

### Initial planning
The planning consist of 7 sprints where every sprint is 1 week long. (I'm not using Scrum, but I just use the concept of sprints as parts of the project).  
The projects planning and tasks management is done with Github Issues and Github Projects. [This planning is also available here](https://github.com/samuelroland/galeriz/projects).
![Planning](./img/planning.png)

#### MCD
![MCD](MCD.png)
#### MLD
![MLD](MLD.png)

### Available pages

- All galleries: under menu section called `Panorama`
- Gallery details: all pictures in the gallery and the name of the author
- Author details: information about the author and a list of the associated categories
- Create a gallery: Create a new gallery without any picture
- Manage gallery's pictures: Upload new pictures, manage titles, delete existing ones and browse current pictures.

## Models
### Layout
![Layout model](models/Layout.png)

### Login
![Login](models/Login.png)

### Register
![Register](models/Register.png)

### All galleries
![salut](models/All_galleries.png)

### Create a gallery
![Create a gallery](models/Create_a_gallery.png)

### Gallery details
![Gallery details](models/Gallery_details.png)

## Analysis/Design
### Concept

Le concept complet avec toutes ses annexes :

Par exemple : 
•	Multimédia: carte de site, maquettes papier, story board préliminaire, …
•	Bases de données: interfaces graphiques, modèle conceptuel.
•	Programmation: interfaces graphiques, maquettes, analyse fonctionnelle…
•	…



### Tests
This section concerns how Galeriz is tested manually and programmatically. Samuel tests during the development if the features are working in his browser. The main testing part is made with automated tests written with `phpunit` (a php testing framework).

#### Where are these tests ?
Everything is in the `tests` folder in the repository. 

#### Prerequesite to run tests ?
As defined in the `phpunit.xml`, tests are runned against an in memory sqlite database. Each tests seed the database again (TODO: verify).

This lines at the bottom of `phpunit.xml` (root of the repos), define 2 environment variables. (TODO)
```xml
<env name="DB_DATABASE" value=":memory:"/>
<env name="DB_CONNECTION" value="sqlite"/>
```

#### How to run tests ?
I recommend you to setup a shortcut in your IDE to run the tests. I used this keyboard shorcut setting in VSCode to run `php artisan test tests/Feature` on `ctrl+t ctrl+t`
```json
{
    "key": "ctrl+t ctrl+t",
    "command": "workbench.action.terminal.sendSequence",
    "args": {
        "text": "php artisan test tests/Feature\u000D"
    }
}
```

Décrire la stratégie globale de test: 

•	types de des tests et ordre dans lequel ils seront effectués.
•	les moyens à mettre en œuvre.
•	couverture des tests (tests exhaustifs ou non, si non, pourquoi ?).
•	données de test à prévoir (données réelles ?).
•	les testeurs extérieurs éventuels.

### Planification 

Révision de la planification initiale du projet :

•	planning indiquant les dates de début et de fin du projet ainsi que le découpage connu des diverses phases. 
•	partage des tâches en cas de travail à plusieurs.

Il s’agit en principe de la planification définitive du projet. Elle peut être ensuite affinée (découpage des tâches). Si les délais doivent être ensuite modifiés, le responsable de projet doit être avisé, et les raisons doivent être expliquées dans l’historique.

### Design elements

Fournir tous les document de conception:

•	le choix du matériel HW
•	le choix des systèmes d'exploitation pour la réalisation et l'utilisation
•	le choix des outils logiciels pour la réalisation et l'utilisation
•	site web: réaliser les maquettes avec un logiciel, décrire toutes les animations sur papier, définir les mots-clés, choisir une formule d'hébergement, définir la méthode de mise à jour, …
•	bases de données: décrire le modèle relationnel, le contenu détaillé des tables (caractéristiques de chaque champs) et les requêtes.
•	programmation et scripts: organigramme, architecture du programme, découpage modulaire, entrées-sorties des modules, pseudo-code / structogramme…

Le dossier de conception devrait permettre de sous-traiter la réalisation du projet !

## Realisation
3.1	Dossier de réalisation

Décrire la réalisation "physique" de votre projet

•	les répertoires où le logiciel est installé
•	la liste de tous les fichiers et une rapide description de leur contenu (des noms qui parlent !)
•	les versions des systèmes d'exploitation et des outils logiciels
•	la description exacte du matériel
•	le numéro de version de votre produit !
•	programmation et scripts: librairies externes, dictionnaire des données, reconstruction du logiciel - cible à partir des sources.

NOTE : Evitez d’inclure les listings des sources, à moins que vous ne désiriez en expliquer une partie vous paraissant importante. Dans ce cas n’incluez que cette partie…

3.2	Description des tests effectués

Pour chaque partie testée de votre projet, il faut décrire:

•	les conditions exactes de chaque test
•	les preuves de test (papier ou fichier)
•	tests sans preuve: fournir au moins une description 

### Remaining errors

S'il reste encore des erreurs: 

•	Description détaillée
•	Conséquences sur l'utilisation du produit
•	Actions envisagées ou possibles

## Conclusion

Développez en tous cas les points suivants:

•	Objectifs atteints / non-atteints
•	Points positifs / négatifs
•	Difficultés particulières
•	Suites possibles pour le projet (évolutions & améliorations)


## Appendix

### Pré-TPI summary
5.2	Sources – Bibliographie

Liste des livres utilisés (Titre, auteur, date), des sites Internet (URL) consultés, des articles (Revue, date, titre, auteur)… Et de toutes les aides externes (noms)   

### Work diary
I wrote the diary in a separated file under [docs/WorkDiary.md](/docs/WorkDiary.md)


5.4	Manuel d'Installation

5.5	Manuel d'Utilisation

5.6	Archives du projet 
