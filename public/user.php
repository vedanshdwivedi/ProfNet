<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/header.php"); ?>
<?php if(!isset($_SESSION["user_id"])){
	//probably a GET request
	set_message("SESSION EXPIRED, LOGIN AGAIN");
	redirect("index.php");
	}
?>
<h1>Hello User</h1>
<a href="logout.php" class="button button-block">logout</a>
<?php require_once("../resources/footer.php"); ?>