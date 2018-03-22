<?php
include('./header.php');
if(isset($_SESSION["_userdata"])) {
  echo "Logged in!";
}
else {
  echo "USER DIDNT SIGN IN GRRR";
}



 ?>
