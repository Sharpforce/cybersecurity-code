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
    <h1>Attribute selectors iframe with hidden input</h1>
    <form action="" method="POST">
        <input type="password" name="newPassword" placeholder="New Password">
        <input type="password" name="confirmNewPassword" placeholder="Confirm New Password">
        <input type="hidden" name="csrf-token" value="a5ccef6a-1f00-4a02-b16b-e4e9e517b223">
        <input type="submit" name="changePassword" value="Continue">
    </form>
  </body>
</html>