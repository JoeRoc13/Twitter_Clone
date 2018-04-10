<?php
include('./header.php');
if(isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["location"])) {
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $location = $_POST["location"];

  $stmt = $db->prepare("INSERT INTO user (username, password, email, location, regis_date)
                        VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
  $stmt->bindValue(1, $username);
  $stmt->bindValue(2, $password);
  $stmt->bindValue(3, $email);
  $stmt->bindValue(4, $location);
  $stmt->execute();
  header("Location: ./login.php");
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
			<h2>Join today.</h2>
			<br />
      <p class="alert alert-danger" id="error-msg" hidden></p>
			<form data-toggle="validator" role="form" id="formSignUp" method="post" action="signup.php">
				<div class="form-group">
			    <label for="inputEmail" class="control-label">Email</label>
			    <input name="email" type="email" pattern="[A-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="email" placeholder="Email" data-error="Invalid Email address." required>
			    <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
			    <label for="inputUsername" class="control-label">Username</label>
			    <input name="username" type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" class="form-control" id="username" placeholder="Username" required>
			    <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword" class="control-label">Password</label>
			    <div class="form-inline row">
			      <div class="form-group col-sm-6">
			        <input name="password" type="password" data-minlength="6" class="form-control" id="password" placeholder="Password" required>
			        <div class="help-block">Minimum of 6 characters</div>
			      </div>
			      <div class="form-group col-sm-6">
			        <input name="confirm" type="password" class="form-control" id="confirm" data-match="#password" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
			        <div class="help-block with-errors"></div>
			      </div>
			    </div>
			  </div>
        <div class="form-group">
			    <label for="inputLocation" class="control-label">Location</label>
			    <input name="location" type="text" class="form-control" id="location" placeholder="e.g. Lowell, MA" required>
			    <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
			    <button id="btnSignUp" type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</form>
			<div class="small">By signing up, you agree to the <a href='#'>Terms of Service</a> and <a href='#'>Privacy Policy</a>.</div>
    </div>
  </body>
</html>
