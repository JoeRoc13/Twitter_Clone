<?php
session_start();
if(isset($_SESSION["_userdata"])){
?>

  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Login</title>
    </head>
    <body>
      <form class="" action="logout.php" method="post">
        <input type="submit" name="Submit" value="log out">

      </form>
    </body>
  </html>
<?php
}
else {
  echo "USER DIDNT SIGN IN GRRR";
}



 ?>
