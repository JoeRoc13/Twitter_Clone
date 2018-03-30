<?php

include('./header.php');

$stmt = $db->prepare("SELECT * from twitts");
$stmt->execute();

if(isset($_POST["twitt"])) {
  $stmt_twitt = $db->prepare("INSERT INTO twitts (uid, body, post_time) VALUES (?, ?, CURRENT_TIMESTAMP)");
  $stmt_twitt->bindValue(1, $_SESSION["_userdata"]["uid"]);
  $stmt_twitt->bindValue(2, $_POST["twitt"]);
  $stmt_twitt->execute();
}

if(isset($_POST["comment"])) {
  $comment = $_POST["comment"];
  $twittID = $_POST["twittID"];

  $postComment = $db->prepare("INSERT INTO comment (uid, tid, body, comment_time) VALUES (?, ?, ?, CURRENT_TIMESTAMP)");
  $postComment->bindValue(1, $_SESSION["_userdata"]["uid"]);
  $postComment->bindValue(2, $twittID);
  $postComment->bindValue(3, $comment);
  $postComment->execute();
}

echo "</div>";

?>

<?php if(isset($_SESSION["_userdata"])) { ?>
<div class="container">
  <div class="col-md-6 col-md-offset-3">

    <form id="formTwitt" class="form-group" action="index.php" method="post">
      <textarea id="twittBody" class="form-control" style="width: 100%;" placeholder="What's on your mind?" name="twitt" rows="4" cols="80"></textarea>
      <div style="padding-top:10px" class="pull-right"><button class="btn btn-primary" type="submit" name="button">Post</button></div>
    </form>
    <br>

    <h2 class="text-center">Recent activity</h2>
    <?php
      $getTwitts = $db->prepare("SELECT * FROM twitts ORDER BY `post_time` DESC");
      $getTwitts->execute();
      $i = 0;
      while($row = $getTwitts->fetch(PDO::FETCH_ASSOC)) {
        $getUsername = $db->prepare("SELECT username from user where uid = '" . $row["uid"] . "'");
        $getUsername->execute();
        $username = $getUsername->fetchColumn();
        $getComments = $db->prepare("SELECT * FROM comment WHERE tid = " . $row["tid"]);
        $getComments->execute();
        if($getComments->rowCount() > 0) {
          echo '<h3>' . $username . '</h3>
          <p>' . $row["body"] . '</p>
          <div>
            <span class="badge post-badge">Posted ' . $row["post_time"] . '</span><div class="pull-right"><button class="btn btn-xs btn-like btn-primary">Like</button></div>
          </div>
          <br>
          <form action="index.php" class="form-group" id="formComment" method="post">
            <textarea id="textarea-' . $i . '" class="form-control commentBody" style="width: 100%;" placeholder="Add a comment..." name="comment" rows="1"></textarea>
            <input type="hidden" value="' . $row["tid"] . '" name="twittID" />
          </form>
          <br>
          <div class="panel panel-default">';
          while($rowComments = $getComments->fetch(PDO::FETCH_ASSOC)) {
            $getCommentUsername = $db->prepare("SELECT username from user where uid = '" . $rowComments["uid"] . "'");
            $getCommentUsername->execute();
            $commentUsername = $getCommentUsername->fetchColumn();
            if($rowComments["uid"] == $_SESSION["_userdata"]["uid"]) {
              echo '<div class="panel-heading">
                      <strong>' . $commentUsername . '</strong> <span class="text-muted">commented ' . $rowComments["comment_time"] . '</span><span class="pull-right"><a href="deletecomment.php?cid=' . $rowComments["cid"] . '"><span class="glyphicon glyphicon-remove"></span></a></span>
                    </div>
                    <div class="panel-body">' . $rowComments["body"] . '</div>';
            } else {
              echo '<div class="panel-heading">
                      <strong>' . $commentUsername . '</strong> <span class="text-muted">commented ' . $rowComments["comment_time"] . '</span>
                    </div>
                    <div class="panel-body">' . $rowComments["body"] . '</div>';
            }
          }
          echo '</div><hr>';
        } else {
          echo '<h3>' . $username . '</h3>
          <p>' . $row["body"] . '</p>
          <div>
            <span class="badge post-badge">Posted ' . $row["post_time"] . '</span><div class="pull-right"><button class="btn btn-xs btn-like btn-primary">Like</button></div>
          </div>
          <br>
          <form action="index.php" class="form-group" id="formComment" method="post">
            <textarea id="textarea-' . $i . '" class="form-control commentBody" style="width: 100%;" placeholder="Add a comment..." name="comment" rows="1"></textarea>
            <input type="hidden" value="' . $row["tid"] . '" name="twittID" />
          </form>
          <br>
          <hr>';
        }
        $i++;
      }
    ?>
  </div>
</div>

<!-- COMMENTS
<div class="panel panel-default">
  <div class="panel-heading">
    <strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div> -->

<?php
  } else {
    header("Location: general.php");
  }
  include("./footer.php");
?>
