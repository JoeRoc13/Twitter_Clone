<?php
  include('./header.php');

  if(isset($_POST["uid"])) {
    $uid = $_POST["uid"];
    $stmt = $db->prepare("SELECT *
                          FROM message
                          WHERE receiver_id = '" . $uid . "'
                          ORDER BY send_time DESC");
    $stmt->execute();

    $response = array();

    if($stmt->rowCount() > 0) {

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt2 = $db->prepare("SELECT username
                               FROM user
                               WHERE uid = '" . $row["sender_id"] . "'");
        $stmt2->execute();
        $sender_name = $stmt2->fetchColumn();

        $response["success"] = true;
          $response["messages"][] = array(
            "sender_id" => $row["sender_id"],
            "sender_name" => $sender_name,
            "body" => $row["body"],
            "send_time" => $row["send_time"]
          );
      }

    } else {
      $response = array(
        "success" => false,
        "error" => "No messages"
      );
    }
    echo json_encode($response);
  }
?>
