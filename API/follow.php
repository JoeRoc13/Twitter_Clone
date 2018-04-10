<?php

include('./header.php');

$stmt = $db->prepare("SELECT *
                      FROM user
                      WHERE uid != " . $_SESSION["_userdata"]["uid"]);
$stmt->execute();

// Fetch other_uid and action from URL
if(isset($_GET["other_uid"]) && isset($_GET["action"])) {
  $other_uid = $_GET["other_uid"];
  // If the action is to follow a user, use a INSERT statement, else use a DELETE statement
  switch($_GET["action"]) {
    case "follow":
      $follow = $db->prepare("INSERT INTO follow (follower_id, following_id, follow_time)
                              VALUES (?, ?, CURRENT_TIMESTAMP)");
      $follow->bindValue(1, $_SESSION["_userdata"]["uid"]);
      $follow->bindValue(2, $other_uid);
      $follow->execute();
      header("Location: ./follow.php");
      break;
    case "unfollow":
      $unfollow = $db->prepare("DELETE FROM follow
                                WHERE follower_id = ?
                                AND following_id = ?");
      $unfollow->bindValue(1, $_SESSION["_userdata"]["uid"]);
      $unfollow->bindValue(2, $other_uid);
      $unfollow->execute();
      header("Location: ./follow.php");
      break;
    default:
      break;
  }
}

?>

<div class="container">
  <div class="col-md-4 col-md-offset-4">
    <h3>Who to follow/unfollow</h3>
    <br>
    <table class="table table-striped">
      <?php
        $getFollowingIDs = $db->prepare("SELECT following_id
                                         FROM follow
                                         WHERE follower_id = " . $_SESSION["_userdata"]["uid"]);
        $getFollowingIDs->execute();
        $followingArray = $getFollowingIDs->fetchAll(PDO::FETCH_COLUMN);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if(in_array($row["uid"], $followingArray)) {
            echo '<tr>
                    <td>' . $row["username"] . '</td>
                    <td class="text-right"><a href="follow.php?action=unfollow&other_uid=' . $row["uid"] . '" class="btn btn-primary btn-xs" role="button">Unfollow</a></td>
                  </tr>';
          } else {
            echo '<tr>
                    <td>' . $row["username"] . '</td>
                    <td class="text-right"><a href="follow.php?action=follow&other_uid=' . $row["uid"] . '" class="btn btn-primary btn-xs" role="button">Follow</a></td>
                  </tr>';
          }
        }
      ?>
    </table>
  </div>
</div>
