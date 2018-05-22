<?php
	
    require_once("config.php");
	require_once("functions.php");
	$sql1 = "CREATE TABLE IF NOT EXISTS user_login(
		id INT(11) PRIMARY KEY AUTO_INCREMENT,
		first_name VARCHAR(255),
		last_name VARCHAR(255),
		username VARCHAR(255) UNIQUE,
		email VARCHAR(255) UNIQUE,
		password VARCHAR(255),
		signup_date DATE,
		profile_pic VARCHAR(255),
		num_posts INT(11),
		num_likes INT(11),
		user_closed VARCHAR(3),
		friend_array TEXT
	);";
	//echo $sql1;
	$query = query($sql1);
	confirm($query);
    



?>