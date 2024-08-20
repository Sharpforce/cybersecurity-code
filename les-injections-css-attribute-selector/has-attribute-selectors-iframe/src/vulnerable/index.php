<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Attribute Selector</title>
        <style>
            h1 {
                color: <?php echo htmlspecialchars($_GET['color'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8") ?>;
            }
        </style>
    </head>
    <body>
        <h1>Récupération de la valeur d'un attribut d'un élément HTML via la pseudo-class CSS has()</h1>
        <h2>PoC #1 - Champ de type password</h2>
        <form method="POST" action="">
            <input type="password" name="password" value="qwerty">
            <input type="submit" name="currentPassword" value="Submit">
        </form>
        
        <h2>PoC #2 - Champ de type hidden</h2>
        <form action="" method="POST">
            <input type="password" name="newPassword" placeholder="New Password">
            <input type="password" name="confirmNewPassword" placeholder="Confirm New Password">
            <input type="hidden" name="csrf-token" value="a5ccef6a-1f00-4a02-b16b-e4e9e517b223">
            <input type="submit" name="changePassword" value="Continue">
        </form>
    </body>
</html>