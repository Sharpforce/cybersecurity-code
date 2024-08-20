<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Règle @import</title>
    </head>
    <body>
        <h1>Récupération de la valeur d'un attribut d'un élément HTML via utilisation de la règle @import</h1>
        <h2>PoC #1 - Champ de type password</h2>
        <!-- "The <div> tag directly surrounding the form appears to be important for the successful execution of the attack." -->
        <div>
            <form method="POST" action="">
                <input type="password" name="password" value="qwerty">
                <input type="submit" name="currentPassword" value="Submit">
            </form>
        </div>

        <h2>PoC #2 - Champ de type hidden</h2>
        <!-- "The <div> tag directly surrounding the form appears to be important for the successful execution of the attack." -->
        <div>
            <form action="" method="POST">
                <input type="password" name="newPassword" placeholder="New Password">
                <input type="password" name="confirmNewPassword" placeholder="Confirm New Password">
                <!-- shorter csrf token due to URI too long error -->
                <input type="hidden" name="csrf-token" value="a5ccef6a-1f00-4a02-b16b-e4e9e517b223">
                <input type="submit" name="changePassword" value="Continue">
            </form>
        </div>
        <style>
            <?php echo htmlspecialchars($_GET['css'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8") ?>;
        </style>
    </body>
</html>