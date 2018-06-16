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

	$sql2 = "CREATE TABLE IF NOT EXISTS posts(
		id INT(11) PRIMARY KEY AUTO_INCREMENT,
		body TEXT,
		added_by VARCHAR(60),
		user_to VARCHAR(60),
		date_added DATETIME,
		user_closed VARCHAR(3),
		deleted VARCHAR(3),
		likes INT(11)
	);";

	$query = query($sql2);
	confirm($query);



	$query = query("DROP TABLE IF EXISTS post_comments;");
	confirm($query);

	$sql3 = "CREATE TABLE IF NOT EXISTS comments(
		id INT(11) PRIMARY KEY AUTO_INCREMENT,
		post_body TEXT,
		posted_by VARCHAR(60),
		posted_to VARCHAR(60),
		date_added DATETIME,
		removed VARCHAR(3),
		post_id INT(11)
	);";

	$query = query($sql3);
	confirm($query);

	$sql4 = "CREATE TABLE IF NOT EXISTS likes(
		id INT(11) PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(60),
		post_id INT(11)
	);";

	$query = query($sql4);
	confirm($query);


	$sql5 = "CREATE TABLE IF NOT EXISTS friend_requests(
		id INT(11) PRIMARY KEY AUTO_INCREMENT,
		user_to VARCHAR(60),
		user_from VARCHAR(60)
	);";

	$query = query($sql5);
	confirm($query);
    



?>