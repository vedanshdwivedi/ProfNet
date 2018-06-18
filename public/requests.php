<?php 
include("../resources/includes/index_header.php");

?>

<div class="main_column column" id="main_column">

	<h4>Friend Requests</h4>
	<?php
		$query = query("SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'");
		if(mysqli_num_rows($query) == 0){
			echo "You have no friend requests at this time!";
		}else{
			while($row = fetch($query)){
				$user_from = $row['user_from'];
				$user_from_obj = new User($connection, $user_from);
				echo $user_from_obj->getFirstAndLastName() . " sent you a friend request!";

				$user_from_friend_array = $user_from_obj->getFriendArray();
				if(isset($_POST['accept_request'.$user_from])){
					$add_friend_query = query("UPDATE user_login SET friend_array=CONCAT(friend_array,'$user_from,') WHERE username='$userLoggedIn'");
					$add_friend_query = query("UPDATE user_login SET friend_array=CONCAT(friend_array,'$userLoggedIn,') WHERE username='$user_from'");
					$delete_query = query("DELETE FROM friend_requests WHERE user_from = '$user_from' AND user_to='$userLoggedIn'");
					echo "You are now friends!";
					redirect("requests.php");
				}

				if(isset($_POST['ignore_request'.$user_from])){
					$delete_query = query("DELETE FROM friend_requests WHERE user_from = '$user_from' AND user_to='$userLoggedIn'");
					echo "Request Deleted!";
					redirect("requests.php");
				}

				?>

	<form action="requests.php" method="post">
		<input type="submit" name="accept_request<?php echo $user_from; ?>" value="Accept Request" id="accept_button">
		<input type="submit" name="ignore_request<?php echo $user_from; ?>" value="Delete Request" id="ignore_button">
		<hr>

	</form>

				<?php
			}
		}
	?>

	
	
</div>