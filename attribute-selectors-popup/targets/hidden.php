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
    <h1>Popup attribute selectors iframe with hidden input</h1>
    <form action="" method="POST">
        <input type="password" name="newPassword" placeholder="New Password">
        <input type="password" name="confirmNewPassword" placeholder="Confirm New Password">
        <!-- shorter csrf token due to URI too long error -->
        <input type="hidden" name="csrf-token" value="ab4f63f9ac65152575886860dde4">
        <input type="submit" name="changePassword" value="Continue">
    </form>
  </body>
</html>