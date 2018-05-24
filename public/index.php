<?php require_once("../resources/includes/index_header.php"); 
require_once("../resources/includes/classes/User.php"); 
require_once("../resources/includes/classes/Post.php"); 
display_message();

if(isset($_POST["post"])){
	$post = new Post($connection, $userLoggedIn);
	$post->submitPost($_POST["post_text"],"none");
}

?>
	<div class="user_details column">
			<a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user["profile_pic"]; ?>"></a>
			<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php
				echo $user["first_name"]." ".$user["last_name"];
			?></a>
			<br>
			<?php
				echo "Posts: ".$user["num_posts"]."<br>";
				echo "Likes: ".$user["num_likes"];
			?>
		</div>
	</div>
	<div class="main_column column">
		<form class="post_form" action="index.php" method="post">
			<textarea name="post_text" id="post_text" placeholder="Hey, what's next now?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>
		</form>
		<?php
			$post = new Post($connection, $userLoggedIn);
			$post->loadPostsFriends();
		?>
	</div>
</div><!--wrapper div-->
</body>
</html>