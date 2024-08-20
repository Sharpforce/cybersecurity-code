# PoC - Les injections CSS - Règle @import

## Lien vers l'article complet

> On continue sur le sujet des injections CSS avec cette fois l'utilisation de la règle @import. L'objectif est toujours de récupérer des informations contenues dans les attributs HTML, mais cette fois, sans avoir besoin d'iframer la page vulnérable.

[https://sharpforce.gitbook.io/cybersecurity/mes-articles/2022/decembre/les-injections-css-regle-import](https://sharpforce.gitbook.io/cybersecurity/mes-articles/2022/decembre/les-injections-css-regle-import)

## Installation

```
$ docker-compose build
$ docker-compose up -d
```

![image](https://github.com/user-attachments/assets/130254a0-34a3-48aa-9c86-1ae961c8be69)

## Description

PoC d'exploitation d'une injection CSS en utilisant les sélecteurs d'attribut, la pseudo-class has() et la règle @import.

## Limites

- Le site ciblé doit être vulnérable à une injection CSS (ou HTML avec l'utilisation de la balise `<style></style>`) et @import nécessite d'être placé au début du fichier.
- Seuls les navigateurs basés sur Chromium sont compatibles (Testé sur Chrome, Edge et Brave).

## Démo

![](https://github.com/Sharpforce/cybersecurity-code/blob/master/les-injections-css-regle-import/demo/demo_1.gif)

![](https://github.com/Sharpforce/cybersecurity-code/blob/master/les-injections-css-regle-import/demo/demo_2.gif)

## Disclaimer

Cet outil est destiné uniquement à des fins éducatives et doit être utilisé uniquement dans des environnements de tests de pénétration autorisés. L'accès ou l'utilisation non autorisés de systèmes que vous ne possédez pas est illégal. L'auteur n'est pas responsable de toute utilisation abusive de cet outil.

## License

Ce projet est sous licence MIT.
