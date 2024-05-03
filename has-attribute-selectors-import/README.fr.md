# PoC - CSS Injection : Sélecteur d'attributs, pseudo-class has() et règle @import

__Read this in other languages:__ [English](README.md), [Français](README.fr.md)

## Description

PoC d'exploitation d'une injection CSS en utilisant les sélecteurs d'attribut, la pseudo-class has() et la règle @import.

## Prérequis

- Le site ciblé doit être vulnérable à une injection CSS (ou HTML avec l'utilisation de la balise `<style></style>`).
- Seuls les navigateurs basés sur Chromium sont compatibles (Testé sur Chrome, Edge et Brave).

## Installation

Le PoC nécessite l'installation de l'extension PECL `sync` :
```
$ apt-get update
$ apt-get install php-dev
$ pecl install sync
```

Puis, ajouter l'extension dans le fichier "php.ini" de PHP :
```
extension=sync.so
```

Redémarrer le serveur.

## Configuration

Avant d'utiliser le PoC, configurer la valeur de la machine d'attaque :

```PHP
/* ==== CONFIG ==== */
$host = "http://192.168.56.102/css-injection/partie3/style-attack/";
```

## Démo

### Récupération d'une valeur d'un champ de type hidden

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/has-attribute-selectors-import/demo/has-attribute-selectors-import.gif)