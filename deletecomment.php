<?php
include("./header.php");

$cid = $_GET["cid"];
$stmt = $db->prepare("DELETE FROM comment WHERE cid = " . $cid);
$stmt->execute();
header("Location: index.php");

 ?>
