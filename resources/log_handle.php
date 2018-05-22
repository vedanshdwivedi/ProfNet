<?php
	
	if(isset($_POST["log_submit"])){
		$e = escape_string($_POST["log_email"]);
		$p = escape_string($_POST["log_password"]);
		$query = query("SELECT * FROM user_login WHERE email='{$e}';");
		confirm($query);
		if(mysqli_num_rows($query) == 0 ){
			set_message("User not found");
		}else{
			//attempt login
			$row = fetch($query);
			$query = query("UPDATE user_login SET user_closed='no' WHERE id={$row["id"]};");
			if($row["password"] == $p){
				set_message("Login Successful<br>"."Welcome ".$row["username"]);
				$_SESSION["username"] = $row["username"];
				$_SESSION["uid"] = $row["id"];
				redirect("index.php");
			}
		}
	}

?>