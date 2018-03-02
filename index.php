<?php

$db = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');

/*
  Query 1
 */
$stmt = $db->prepare("SELECT body FROM twitts WHERE tid = (SELECT MAX(tid) AS most_liked FROM (SELECT tid, COUNT(tid) mycount FROM thumb GROUP BY tid) t)");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "1. Find the post that has the most number of likes: <br  />" . $row["body"];

/*
  Query 2
 */
$stmt = $db->prepare("SELECT username FROM user WHERE uid = (SELECT following_id FROM follow GROUP BY following_id ORDER BY count(*) DESC LIMIT 1)");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<br />2. Find the person who has the most number of followers: <br  />" . $row["username"];

?>
