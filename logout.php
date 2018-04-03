<?php

// Unset session variables
session_start();
session_unset();
header("Location: ./index.php");
exit();
?>
