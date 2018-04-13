<?php
  include("./header.php");

  if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $db->prepare("SELECT * FROM user WHERE username = '" . $username . "'");
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($password == $row["password"]){
        $result = array(
          "success" => true,
          "uid" => $row["uid"],
          "username" => $row["username"],
          "email" => $row["email"],
          "location" => $row["location"],
          "regis_date" => $row["regis_date"]
        );
    } else {
      $result = array(
        "success" => false,
        "error" => "Incorrect username or password"
      );
    }

    echo json_encode($result);
  }

?>
