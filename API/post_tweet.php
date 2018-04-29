<?php
  include('./header.php');

  if(isset($_POST["uid"]) && isset($_POST["tweet"])) {
    $stmt = $db->prepare("INSERT INTO twitts (uid, body, post_time)
                                VALUES (?, ?, CURRENT_TIMESTAMP)");
    $stmt->bindValue(1, $_POST["uid"]);
    $stmt->bindValue(2, $_POST["tweet"]);
    if($stmt->execute()) {
      $response["success"] = true;
    } else {
      $response["success"] = false;
    }

    echo json_encode($response);
  }

?>
