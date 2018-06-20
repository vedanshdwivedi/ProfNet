<?php
	
	require_once("../config.php");
	if(isset($_GET['post_id']))
		$post_id = $_GET['post_id'];
	if($_POST['result'] == 'true'){
		$query = query("DELETE FROM posts WHERE id='$post_id'");
		$query = query("DELETE FROM comments WHERE post_id='$post_id'");
		$query = query("DELETE FROM likes WHERE post_id='$post_id'");
		$_POST['result'] == 'false';
		redirect("index.php");
	}

?>