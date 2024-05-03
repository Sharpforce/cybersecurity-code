# PoC - CSS Injection : Attribute Selectors, has() pseudo-class and @import rule

__Read this in other languages:__ [English](README.md), [Français](README.fr.md)

## Description

PoC to exploit a CSS injection using attribute selectors, the has() pseudo-class and the @import rule.

## Prerequisites

- The targeted site must be vulnerable to a CSS injection (or HTML injection with use of `<style></style>` tag).
- Only Chromium-based browsers are compatible (Tested on Chrome, Edge and Brave).

## Installation

The PoC requires the installation of the PECL `sync` extension:
```
$ apt-get update
$ apt-get install php-dev
$ pecl install sync
```

Then, add the extension in the file "php.ini" of PHP :
```
extension=sync.so
```

Restart the server.

## Configuration

Before using the PoC, configure the attack machine address:

```PHP
/* ==== CONFIG ==== */
$host = "http://192.168.56.102/css-injection/partie3/style-attack/";
```

## Demo

### Retrieving a value from a hidden field

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/has-attribute-selectors-import/demo/has-attribute-selectors-import.gif)