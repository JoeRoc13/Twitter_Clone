<?php
  include('./header.php');

  $stmt = $db->prepare("SELECT username
                        FROM user
                        WHERE uid =
                          (SELECT following_id
                           FROM follow
                           GROUP BY following_id
                           ORDER BY count(*)
                           DESC LIMIT 1)");
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $response = array(
    "success" => true,
    "username" => $row["username"]
  );

  echo json_encode($response);

?>
