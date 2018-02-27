<?php

$db = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');

$stmt = $db->prepare("SELECT body FROM twitts WHERE tid = (SELECT MAX(tid) AS most_liked FROM (SELECT tid, COUNT(tid) mycount FROM thumb GROUP BY tid) t)");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "1. Find the post that has the most number of likes: <br  />" . $row["body"];

?>