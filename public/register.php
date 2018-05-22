<?php require_once("../resources/header.php"); ?>
<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/reg_handle.php"); ?>
<?php require_once("../resources/log_handle.php"); ?>
<link rel="stylesheet" type="text/css" href="css/register_style.css">
<link rel="stylesheet" href="normalize.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/register.js"></script>
<body>
<div class="wrapper">
	<div class="login_box">
    <div class="login_header">
    	<h1>ProfNet</h1>
    	Login or Signup below!
    </div>
	
    	<div id="first">
	       <!--login form-->
		   <form class="form_code" action="register.php" method="post">
			      <input class="post_code1" type="email" name="log_email" autocomplete="off" placeholder="Email" required>
			      <br>
			      <input class="post_code2" type="password" name="log_password" autocomplete="off" placeholder="Password" required>
			      <br>
			      <input class="button" type="submit" name="log_submit" value="Login">
			      <br>
			      <a href="#" id="signup" class="signup">Need an Account? Register Here!</a>
		   </form>
	   </div>
	   <br><br>

	   <div id="second">
		   <!--signup form-->
			<form action="register.php" method="post">
				<input type="text" name="fname" autocomplete="off" placeholder="First Name" required>
				<br>
				<input type="text" name="lname" autocomplete="off" placeholder="Last Name" required>
				<br>
				<input type="email" name="email" autocomplete="off" placeholder="Email" required>
				<br>
				<input type="email" name="email2" autocomplete="off" placeholder="Confirm Email" required>
				<br>
				<input type="password" name="password" autocomplete="off" placeholder="Password" required>
				<br>
				<input type="password" name="password2" autocomplete="off" placeholder="Confirm Password" required>
				<br>

				<input type="submit" name="reg_submit" value="Register">
				<br>
				<a href="#" id="signin" class="signin">Already have an Account? Sign in Here!</a>
			</form>
		</div>
	</div>
</div>
<?php require_once("../resources/footer.php"); ?>