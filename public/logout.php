<?php require_once("../resources/config.php"); ?>
<?php 
	session_destroy();
	redirect("register.php");
?>
