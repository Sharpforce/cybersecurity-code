<?php
  header("X-Frame-Options: DENY");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style>
      h1 {
        color: <?php echo htmlspecialchars($_GET['color'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8") ?>;
      }
  </style>
  </head>
  <body>
    <h1>Popup attribute selectors iframe with password input</h1>
    <form method="POST" action="">
        <input type="password" name="password" value="qwerty">
        <input type="submit" name="currentPassword" value="Submit">
    </form>
  </body>
</html>