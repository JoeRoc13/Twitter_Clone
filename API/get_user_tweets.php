<?php
  include("./header.php");

  if(isset($_POST["username"])) {
    $stmt = $db->prepare("SELECT uid
                          FROM user
                          WHERE username = '" .$_POST["username"] . "'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $uid = $row["uid"];

    $stmt = $db->prepare("SELECT *
                          FROM twitts
                          WHERE uid = '" . $uid . "' 
                          ORDER BY post_time DESC");
    $stmt->execute();
    $response = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $response["success"] = true;
        $response["tweets"][] = array(
          "body" => $row["body"],
          "post_time" => $row["post_time"]
        );
    }

    echo json_encode($response);
  }

?>
