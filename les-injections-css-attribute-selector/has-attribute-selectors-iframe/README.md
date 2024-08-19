# PoC - Les injections CSS - Attribute Selector

## Installation

```
$ docker-compose build
$ docker-compose up -d
```

## Description

PoC d'exploitation d'une injection CSS en utilisant la pseudo class has() afin de récupérer la valeur d'un attribut d'un élément HTML de type "password" ou "hidden".

## Limites

- Il existe certaines limites lorsque la valeur à récupérer commence par un chiffre. La valeur de sélection doit alors être entourée par de guillemets simples ou doubles et l'exploitation peut ne pas être possible dans le cas ou ces caractères sont filtrés par l'application.

## Démo

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/les-injections-css-attribute-selector/has-attribute-selectors-iframe/demo/demo_1.gif)

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/les-injections-css-attribute-selector/has-attribute-selectors-iframe/demo/demo_2.gif)

## Disclaimer

Cet outil est destiné uniquement à des fins éducatives et doit être utilisé uniquement dans des environnements de tests de pénétration autorisés. L'accès ou l'utilisation non autorisés de systèmes que vous ne possédez pas est illégal. L'auteur n'est pas responsable de toute utilisation abusive de cet outil.

## License

Ce projet est sous licence MIT.