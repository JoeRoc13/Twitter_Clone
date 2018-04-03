<?php
include("./header.php");

// Fetch cid from URL and then execute DELETE query
$cid = $_GET["cid"];
$stmt = $db->prepare("DELETE FROM comment WHERE cid = " . $cid);
$stmt->execute();
header("Location: index.php");

 ?>
