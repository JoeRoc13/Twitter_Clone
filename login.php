<?php
include('./header.php');

// Check to see if username and password is set, if it is, check to see if account exists
// and password is correct
if(isset($_POST["username"]) && isset($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $stmt = $db->prepare("SELECT * FROM user WHERE username = '" . $username . "'");

  $stmt->execute();


  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($password == $row['password']){
      $_SESSION["_userdata"] = $row;
      header("Location: ./index.php");
  } else {
    echo "Wrong Password";
  }
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <div class="col-md-6 col-md-offset-3">
			<h2>Sign in to your Twitter account</h2>
			<br />
      <p class="alert alert-danger" id="error-msg" hidden></p>
			<form data-toggle="validator" role="form" id="formSignUp" method="post">
			  <div class="form-group">
			    <input name="username" type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" class="form-control" id="username" placeholder="Username" required>
			    <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
          <input name="password" type="password" data-minlength="6" class="form-control" id="password" placeholder="Password" required>
          <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
			    <button id="btnSignUp" type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</form>
    </div>
  </body>
</html>
