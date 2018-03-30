<?php
  include('./header.php');
  if(isset($_SESSION["_userdata"])){
    $uid = $_SESSION["_userdata"]["uid"];
    $stmt = $db->prepare("SELECT * from message where receiver_id = '" . $uid . "'");
    $stmt->execute();


    if($stmt->rowCount() > 0) {
      echo '<div class="container">
              <h1>Messages</h1>';
      echo "<table class='table table-striped'>
              <thead>
                <th>From</td>
                <th>Body</td>
                <th>Date</td>
              </thead>";

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt2 = $db->prepare("SELECT username from user where uid = '" . $row["sender_id"] . "'");
        $stmt2->execute();
        $sender_name = $stmt2->fetchColumn();
        echo "<tr><td>" . $sender_name . "</td><td>" . $row["body"] . "</td><td>" . $row["send_time"] . '</td></tr>';
      }
    } else {
      echo '<div class="container">
              <h1>Your message box is empty.</h1>
            </div>';
    }

    echo '</div>';
  } else {
    header("Location: ./login.php");
  }
?>
