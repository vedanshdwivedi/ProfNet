<?php require_once("../resources/header.php"); ?>
<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/reg_handle.php"); ?>
<?php require_once("../resources/log_handle.php"); ?>

   <!--login form-->
   <form action="register.php" method="post">
      <input type="email" name="log_email" autocomplete="off" placeholder="Email" required>
      <br>
      <input type="password" name="log_password" autocomplete="off" placeholder="Password" required>
      <br>
      <input type="submit" name="log_submit" value="Login">
      <br>
   </form>
   <br><br>


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
	</form>
<?php require_once("../resources/footer.php"); ?>