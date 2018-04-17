<?php
  include('./header.php');

  if(isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["location"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $location = $_POST["location"];

    $stmt = $db->prepare("INSERT INTO user (username, password, email, location, regis_date)
                          VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $password);
    $stmt->bindValue(3, $email);
    $stmt->bindValue(4, $location);
    $stmt->execute();

    if($stmt) {
      $getInfo = $db->prepare("SELECT uid, regis_date FROM user WHERE username = ?");
      $getInfo->bindValue(1, $username);
      $getInfo->execute();
      if($getInfo) {
        $row = $getInfo->fetch(PDO::FETCH_ASSOC);
        $result = array(
          "success" => true,
          "uid" => $row["uid"],
          "regis_date" => $row["regis_date"]
        );
      }
    } else {
      $result = array(
        "success" => false,
        "error" => "Unable to register account"
      );
    }

    echo json_encode($result);
  }

?>
