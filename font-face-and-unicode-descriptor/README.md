# Use of @font-face rule and the unicode descriptor

__Read this in other languages:__ [English](README.md), [Français](README.fr.md)

## Description

PoC to exploit a CSS injection using the @font-face rule and the unicode descriptor to determine the presence of alphanumeric characters (not case sensitive) within an HTML tag.

## Prerequisites

- No specific requirements except the ability to inject some CSS in the vulnerable web page.

## Configuration

Before using the PoC, adapt the following values:

```
// URL of the injection
https://vulnerable.com/?css={injection_here}

// URL of the attacker's machine to retrieve the identified characters
https://attacker.com/
```

## Demo

![](https://github.com/Sharpforce/PoC-CSS-injection/blob/master/font-face-and-unicode-descriptor/demo/font-face-and-unicode-descriptor.gif)