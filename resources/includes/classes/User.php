<?php
class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$user_details_query = mysqli_query($con, "SELECT * FROM user_login WHERE username='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
		$query = mysqli_query($this->con,"SELECT * FROM posts WHERE added_by = '{$this->user["username"]}'");
		$i = mysqli_num_rows($query);
		$query = mysqli_query($this->con,"UPDATE user_login SET num_posts = {$i} WHERE username='{$this->user["username"]}'");
	}

	public function getUsername() {
		return $this->user['username'];
	}

	public function getNumPosts() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT num_posts FROM user_login WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT first_name, last_name FROM user_login WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['first_name'] . " " . $row['last_name'];
	}

	public function isClosed() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT user_closed FROM user_login WHERE username='$username'");
		$row = mysqli_fetch_array($query);

		if($row['user_closed'] == 'yes')
			return true;
		else 
			return false;
	}

    public function isFriend($username_to_check){
		$usernameComa = ",".$username_to_check.",";
		if((strstr($this->user['friend_array'], $usernameComa)) || $username_to_check == $this->user['username']){
			return true;
		}else{
			return false;
		}
		
	}

	public function getProfilePic() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT profile_pic FROM user_login WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['profile_pic'];
	}

	public function didReceiveRequest($user_to){
		$user_from = $this->user['username'];
		$check_request_query = mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to = '$user_to' AND user_from='$user_from'");
		if(mysqli_num_rows($check_request_query) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function didSendRequest($user_from){
		$user_to = $this->user['username'];
		$check_request_query = mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to = '$user_to' AND user_from='$user_from'");
		if(mysqli_num_rows($check_request_query) > 0){
			return true;
		}else{
			return false;
		}
	}




}




?>