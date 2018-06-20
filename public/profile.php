<?php require_once("../resources/includes/index_header.php"); 
if(isset($_GET['profile_username'])){
	$username = $_GET['profile_username'];
	$user_details_query = query("SELECT * FROM user_login WHERE username='$username'");
	$user_array = fetch($user_details_query);
	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}

if(isset($_POST['remove_friend'])){
	$user = new User($connection, $userLoggedIn);
	$user->removeFriend($username);
}
if(isset($_POST['add_friend'])){
	$user = new User($connection, $userLoggedIn);
	$user->sendRequest($username);
}
if(isset($_POST['cancel_request'])){
	$user = new User($connection, $userLoggedIn);
	$user->cancelRequest($username);
}
if(isset($_POST['respond_request'])){
	redirect("requests.php");
}

?>


	<style type="text/css">
		.wrapper{
			margin-left: 0px;
			padding-left: 0px;
		}
	</style>
	<div class="profile_left">
		<img src="<?php echo $user_array['profile_pic']; ?>">
		<div class="profile_info">
			<p><?php echo "Posts : " . $user_array["num_posts"];  ?></p>
			<p><?php echo "Likes : " . $user_array["num_likes"];  ?></p>
			<p><?php echo "Friends : " . $num_friends; ?></p>
		</div>

		<form action="<?php echo $username; ?>" method="post">

			<?php
				$profile_user_obj = new User($connection, $username);
				if($profile_user_obj->isClosed()){
					redirect("user_closed.php");
				}
				$logged_in_user_obj = new User($connection, $userLoggedIn);
				if($userLoggedIn != $username){
					if($logged_in_user_obj->isFriend($username)){
						echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
					}else if($logged_in_user_obj->didReceiveRequest($username)){
						echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
					}else if($logged_in_user_obj->didSendRequest($username)){
						echo '<input type="submit" name="cancel_request" class="default" value="Cancel Request"><br>';
					}else{
						echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';
					}
				}
			?>


			

			
		</form>
		<input type="submit" class="deep_blue" data-toggle="modal" data-target="#post_form" value="Post Something">
	</div>
	<div class="profile_main_column column">
		<div class="posts_area"></div>
		<img id="loading" src="images/icons/loading.gif">

	</div>

<!-- Modal -->
<div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Speak Your Heart Out!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>


      <div class="modal-body">
        <p>This will appear on your friend's profile page and also on their newsfeed for your friends to see!</p>
        <form class="profile_post" action="" method="post">
        	<div class="form-group">
        		<textarea class="form_control" name="post_body"></textarea>
        		<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
        		<input type="hidden" name="user_to" value="<?php echo $username; ?>">
        	</div>
        </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
      </div>
    </div>
  </div>
</div>


<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';
	var profileUsername = '<?php echo $username; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "../resources/includes/ajax_load_profile_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();
			//$('#loading').show();
			console.log(page);

            
			if((document.body.scrollHeight == (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop) + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();


				var ajaxReq = $.ajax({
					url: "../resources/includes/ajax_load_profile_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>


</div><!--wrapper div-->
</body>
</html>