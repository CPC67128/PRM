# PRM - Private Relationship Manager

## Présentation

### Historique

PRM (Private Relationship Manager) est une application web de gestion de contacts.

Ce projet a débuté en 1999, sous la forme d'une base de contacts Microsoft Access. De simple annuaire téléphonique, je l'ai fait évoluer peu à peu en rajoutant au fur et à mesure des fonctionnalités. J'utilise également ce projet pour tester de nouvelles librairies ou technologies.

L'application est actuellement en cours de réécriture avec Bootstrap 4.

### Fonctionnalités

* Gestion de contacts, d'entreprises et d'attributs
* Recherche générale
* Affichage des anniversaires
* Suivi (notes, actions à faire...)
* Fichiers liés
* Outils de gestion des données (export, nettoyage)

## Installation

### Prérequis

* Capacité à installer et à héberger une une application web
* Espace web disposant de PHP 7
* Une base de données MariaDB 10

Cette application peut être hébergée sur un [site Internet 1&1](http://www.1and1.fr/?kwk=16605005), sur un NAS Synology, un site en local via XAMPP ou WAMP, voir encore un site auto-hébergé sur un Raspberry Pi.

### Première installation

* Créer une base de données MariaDB:
  * Nom: « prm » (ou ce que vous voulez)
  * Interclassement: « utf8_general_ci »
* Télécharger l’archive de l’application sur GitHub, et la décompresser
* Sur votre site web, créer un répertoire « prm » (ou autre)
* Uploader les fichiers dans ce répertoire
* Editer le fichier ./configuration/configuration.php et remplir les paramètres requis (base de données…)
* Aller sur http://site web/prm/setup/
* Cliquer sur « Upgrade database » pour créer la structure de la base de données:
* Effacer le répertoire ./setup/ de votre répertoire d’installation
* Se rendre sur la page http://site web/prm/ et se connecter avec un des deux comptes en laissant le champ mot de passe vide
* Débuter par la configuration des utilisateurs, des comptes et des catégories depuis l’espace d’administration.

## Mise à jour

* Sauvegarder
  * Base de données
  * Répertoire prm de votre site web
* Dans ce dernier, effacer tout les sous-répertoires excepté ./configuration/
* Télécharger l’archive de l’application sur GitHub, et la décompresser
* Uploader les fichiers excepté le répertoire ./configuration/ sur votre site web
* Aller sur http://site web/prm/setup/
* Cliquer sur « Upgrade database » pour créer la structure de la base de données:
* Effacer le répertoire ./setup/ de votre répertoire d’installation

# Historique des versions

## Version 4

La version 4 supprime les écrans destinés au mobile.

[Lien](/projects/PRMv4.zip) vers une archive de la dernière version utilisant Dojo Toolkit.

## Version 3

La version 3 de PRM ajoute le framework [Dojo Toolkit](https://dojotoolkit.org/) afin d'offrir des écrans plus accueuillants.

La partie mobile de l'application utilise jQuery Mobile.

## Version 2

La version 2 de PRM migre la base de données Access des contacts en MySQL, et y associe une application web utilisant jQuery.

## Version 1

La version 1 est la base de données Access originale du projet.

# Development notes

## References

bootstrap-4.0.0-alpha.6-dist
https://v4-alpha.getbootstrap.com/

font-awesome-4.7.0
http://fontawesome.io/

jquery-3.2.1
https://jquery.com/

jQuery UI 1.12.1
http://jqueryui.com/

Theter 1.3.3
http://tether.io/
