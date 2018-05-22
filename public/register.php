<?php require_once("../resources/header.php"); ?>
<?php require_once("../resources/config.php"); ?>
<?php
   if(isset($_POST["submit"])){
   	//form submitted, process
   	//before processing, clean the values to avoid SQL Injections
   	$f = ucfirst(strtolower((escape_string($_POST["fname"]))));
   	$l = ucfirst(strtolower((escape_string($_POST["lname"]))));
   	$e = escape_string($_POST["email"]);
   	$e2 = escape_string($_POST["email2"]);
   	$p = escape_string($_POST["password"]);
   	$p2 = escape_string($_POST["password2"]);
   	$date = date("Y-m-d"); //current date
   	$u = username($f,$l);

   	//Profile Picture Assignment
   	$dp = def_pic();

   	if ($e == $e2) {
   		//checking if emails have not been taken
   		$query = query("SELECT * FROM user_login WHERE email = '{$e}';");\
   		confirm($query);
   		if(mysqli_num_rows($query) > 0){
   			set_message("Email already taken");
   			redirect("register.php");
   		}else{
   			//check if passwords match
   			if($p == $p2){
   				$query = query("INSERT INTO user_login (first_name,last_name,username,email,password,signup_date,profile_pic,num_posts,num_likes,user_closed,friend_array)VALUES('{$f}','{$l}','{$u}','{$e}','{$p}','{$date}','{$dp}',0,0,'no',',');");
   				confirm($query);
   				set_message("Registration Successful");
   				redirect("login.php");
   			}
   		}

   	}else{
   		echo "emails don't match";
   	}

   }  
   display_message();
?>
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
		<input type="submit" name="submit" value="Register">
	</form>
<?php require_once("../resources/footer.php"); ?>