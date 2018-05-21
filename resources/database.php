<?php
	
    require_once("config.php");
	require_once("functions.php");
	$sql1 = "CREATE TABLE IF NOT EXISTS user_login(
		id INT(11) PRIMARY KEY AUTO_INCREMENT,
		email VARCHAR(255) UNIQUE,
		firstname VARCHAR(255),
		lastname VARCHAR(255),
		password VARCHAR(255)
	);";
	$query = query($sql1);
	confirm($query);
    



?>