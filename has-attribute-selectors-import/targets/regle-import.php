<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CSS Injection</title>
  </head>
  <body>
    <h1>Has attribute selectors iframe with @import rule</h1>
    <div>
      <form action="" method="POST">
          <input type="password" name="newPassword" placeholder="New Password">
          <input type="password" name="confirmNewPassword" placeholder="Confirm New Password">
          <input type="hidden" name="csrf-token" value="a5ccef6a-1f00-4a02-b16b-e4e9e517b223">
          <input type="submit" name="changePassword" value="Continue">
      </form>
    </div>
  <style>
    <?php
      echo htmlspecialchars($_GET['css'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
    ?>
    </style>
  </body>
</html>