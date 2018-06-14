<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<style type="text/css">
		body{
			background-color: #fff;
		}

		*{
			font-size: 12;
			font-family: Arial, Helvetica, Sans-serif;
		}

		form {
			position: absolute;
			top: 0;
		}
	</style>

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

		//Get id of post
		if(isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];
		}

		$get_likes = query("SELECT likes,added_by FROM posts WHERE id='$post_id'");
		$row = fetch($get_likes);
		$total_likes = $row['likes'];
		$user_liked = $row['added_by'];

		$user_details_query = query("SELECT * FROM user_login WHERE username='$user_liked'");
		$row = fetch($user_details_query);
		$total_user_likes = $row['num_likes'];

		//Like Button
		if(isset($_POST['like_button'])){
			$total_likes++;
			$query = query("UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
			$total_user_likes++;
			$user_likes = query("UPDATE user_login SET num_likes='$total_user_likes' WHERE username = '$user_liked'");
			$insert_user = query("INSERT INTO likes VALUES('','$userLoggedIn','$post_id')");

			//Insert Notification
		}


		//Unlike Button
		if(isset($_POST['unlike_button'])){
			$total_likes--;
			$query = query("UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
			$total_user_likes--;
			$user_likes = query("UPDATE user_login SET num_likes='$total_user_likes' WHERE username = '$user_liked'");
			$insert_user = query("DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
		}


		//Check for previous likes
		$check_query = query("SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
		$num_rows = mysqli_num_rows($check_query);

		if($num_rows > 0){
			echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
					<input type="submit" class="comment_like" name="unlike_button" value="Unlike">
					<div class="like_value">
					' . $total_likes . ' Likes
					</div>
					</form>
				';
		}else{
			echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
					<input type="submit" class="comment_like" name="like_button" value="Like">
					<div class="like_value">
					' . $total_likes . ' Likes
					</div>
					</form>
				';
		}
	?>

</body>
</html>