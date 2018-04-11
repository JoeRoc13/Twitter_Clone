<?php
  session_start();
  $db = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
