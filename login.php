<?php
session_start();
if(isset($_POST["username"]) && $_POST["password"]){
  $db = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');
  $username = $_POST["username"];
  $password = $_POST["password"];
  $stmt = $db->prepare("SELECT * from user where username = '" . $username . "'");

  $stmt->execute();


  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($password == $row['password']){
      $_SESSION["_userdata"] = $row;
      header("Location: ./profile.php");
    }
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form class="" action="login.php" method="post">
      <label for="username">Username:</label>
      <input type="text" name="username">
      <br/>
      <label for="password">Password:</label>
      <input type="password" name="password">
      <br/>
      <input type="submit" name="Submit" value="sign in">

    </form>
  </body>
</html>
