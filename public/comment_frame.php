<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		*{
			font-size: 12;
			font-family: Arial, Helvetica, Sans-serif;
		}
	</style>
</head>
<body>
	<?php 
		require_once("../resources/config.php"); 
		include("../resources/includes/classes/User.php");
		include("../resources/includes/classes/Post.php");
	
		if(isset($_SESSION["username"])){
		$userLoggedIn = $_SESSION["username"];
		$query = query("SELECT * FROM user_login WHERE username='{$userLoggedIn}'");
		$user = fetch($query);
		}else{
			redirect("register.php");
		}
	?>

	<script>
		function toggle() {
			var element = document.getElementById("comment_section");
			if(element.style.display == "block")
				element.style.display = "none";
			else
				element.style.display = "block";
		}
	</script>

	<?php
		//Get id of post
		if(isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];
		}

		$user_query = query("SELECT added_by, user_to FROM posts WHERE id={$post_id}");
		$row = fetch($user_query);
		$posted_to = $row['added_by'];

		if(isset($_POST['postComment' . $post_id])){
			$post_body = $_POST['post_body'];
			$post_body = escape_string($post_body);
			$date_time_now = date("Y-m-d H:i:s");
			$insert_post = query("INSERT INTO comments VALUES('','{$post_body}','{$userLoggedIn}','{$posted_to}','{$date_time_now}','no',{$post_id})");
			confirm($insert_post);
			echo "<p>Comment Posted</p>";
		}
	?>
	<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="post">
		<textarea name="post_body"></textarea>
		<input type="submit" name="postComment<?php echo $post_id ?>" value="Post">
	</form>
	<!--Load Comments-->
	<?php
		$get_comments = query("SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id ASC");
		$count = mysqli_num_rows($get_comments);
		if($count != 0){
			while($comment = fetch($get_comments)){
				$comment_body = $comment['post_body'];
				$posted_to = $comment['posted_to'];
				$posted_by = $comment['posted_by'];
				$date_added = $comment['date_added'];
				$removed = $comment['removed'];

				$date_time_now = date("Y-m-d H:i:s");
				//Time of Post
				$start_date = new DateTime($date_added); //predefined class in php
				//Current Time
				$end_date = new DateTime($date_time_now);
				$interval = $start_date->diff($end_date); //Difference between dates
				if($interval->y >= 1){
					if($interval == 1)
						$time_message = $interval->y." year ago";// 1 year ago
					else
						$time_message = $interval->y." years ago";
				}else if($interval->m >= 1){
					if($interval->d == 0){
						$days = " ago";
					}else if($interval->d == 1){
						$days = $interval->d. " day ago";
					}else{
						$days = $interval->d. " days ago";
					}

					if($interval->d == 1){
						$time_message = $interval->m." month ".$days;
					}else{
						$time_message = $interval->m." month ".$days;
					}
				}else if($interval->d >= 1){
					if($interval->d == 1){
						$time_message = "Yesterday";
					}else{
						$time_message = $interval->d. " days ago";
					}
				}else if($interval->h >= 1){
					if($interval->h == 1){
						$time_message = $interval->h. " hour ago";
					}else{
						$time_message = $interval->h. " hours ago";
					}
				}else if($interval->i >= 1){
					if($interval->i == 1){
						$time_message = $interval->i. " minute ago";
					}else{
						$time_message = $interval->i. " minutes ago";
					}
				}else{
					if($interval->s < 30){
						$time_message = "Just Now";
					}else{
						$time_message = $interval->s. " seconds ago";
					}
				}

				//Timeframe ends
				$user_obj = new User($connection, $posted_by);


				?>
				<div class="comment_section">
					<a href="<?php echo $posted_by; ?>" target="_parent"><img src="<?php echo $user_obj->getProfilePic(); ?>" tile="<?php echo $posted_by; ?>" style="float: left;" height="30"></a>
			        <a href="<?php echo $posted_by; ?>" target="_parent"><b> <?php echo $user_obj->getFirstAndLastName(); ?> </b></a>
			        &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message. "<br>" . $comment_body; ?>
			        <hr>
			    </div>
				<?php


			}
		}else{
			echo "<center><br><br>No Comments to Show!</center>";
		}
	?>

	

</body>
</html>