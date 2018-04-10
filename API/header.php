<?php
  session_start();
  $get_root = "/Twitter_Clone";
  $db = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Social Media Site</title>

    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo $get_root;?>">Twitter Clone</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="<?php echo $get_root;?>">Home</a></li>
          <li><a href="<?php echo $get_root;?>/general.php">General</a></li>
          <?php if(isset($_SESSION["_userdata"])) { ?>
            <li><a href="<?php echo $get_root;?>/messages.php">Messages</a></li>
            <li><a href="<?php echo $get_root;?>/follow.php">Follow</a></li>
          <?php }?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION["_userdata"])) { ?>
            <li><a href="#"><?= $_SESSION["_userdata"]["username"] ?></a></li>
            <li><a href="<?php echo $get_root;?>/logout.php"><span class="glyphicon glyphicon-user"></span> Log out</a></li>
          <?php } else {  ?>
            <li><a href="<?php echo $get_root;?>/signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="<?php echo $get_root;?>/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php } ?>
        </ul>
      </div>
    </nav>
