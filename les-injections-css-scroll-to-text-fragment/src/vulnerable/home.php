<?php
    session_start();
?>

<?php
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        if($_POST["username"] === "admin" && $_POST["password"] === "admin") {
            $_SESSION['role'] = "Administrateur";
        }
        else if($_POST["username"] === "john" && $_POST["password"] === "doe") {
            $_SESSION['role'] = "Utilisateur";
        }
        else {
            header("Location: index.php");
            exit;
        }
    }

    if (!isset($_SESSION['role'])) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Les injections CSS - Scroll-to-Text Fragment</title>
        <style>
            h1 {
                color: <?php echo htmlspecialchars($_GET['color'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8") ?>;
            }
        </style>
    </head>
    <body>
        <h1>Récupération de la présence de l'occurrence d'un mot via fonctionnalité de Scroll-to-Text Fragment</h1>
        <div>
            <?php echo '<p>Connecté en tant que ' . $_SESSION['role'] . '</p>'; ?>
        </div>
        <a href="logout.php">Se déconnecter</a>
    </body>
</html>