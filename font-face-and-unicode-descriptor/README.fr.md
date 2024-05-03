# Utilisation de la règle @font-face et du descripteur unicode

__Read this in other languages:__ [English](README.md), [Français](README.fr.md)

## Description

PoC d'exploitation d'une injection CSS en utilisant la règle @font-face ainsi que le descripteur unicode afin de déterminer la présence de caractères alphanumériques (non sensible à la casse) au sein d'une balise HTML.

## Prérequis

- Pas de prérequis spécifique excepté la possibilité d'injecter du CSS.

## Configuration

Avant d'utiliser le PoC, configurer les valeurs suivantes :

```
// URL de l'injection
https://vulnerable.com/

// URL de l'attaquant afin de récupérer les caractères identifiés
https://attacker.com/
```

## Démo

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/font-face-and-unicode-descriptor/demo/font-face-and-unicode-descriptor.gif)