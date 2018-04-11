<?php
  include("./header.php");

  if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $db->prepare("SELECT * FROM user WHERE username = '" . $username . "'");
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($password == $row['password']){
        echo "Logged in";
    } else {
      echo "Wrong Password";
    }
  }

?>
