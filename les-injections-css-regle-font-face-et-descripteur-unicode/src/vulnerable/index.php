<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Règle @font-face et descripteur unicode</title>
        <style>
            h1 {
                color: <?php echo htmlspecialchars($_GET['color'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8") ?>;
            }
        </style>
    </head>
    <body>
        <h1>Injection CSS - récupération de la valeur d'un élément HTML via @font-face et descripteur unicode</h1>
        <span id="secret">s3cr3t</span>
    </body>
</html>