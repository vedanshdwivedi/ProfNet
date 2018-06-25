<?php require_once("../resources/config.php"); 

include("../resources/includes/classes/User.php");
include("../resources/includes/classes/Post.php");?>
<?php
	
	if(isset($_SESSION["username"])){
		$userLoggedIn = $_SESSION["username"];
		$query = query("SELECT * FROM user_login WHERE username='{$userLoggedIn}'");
		$user = fetch($query);
	}else{
		redirect("register.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to ProfNet</title>
	<!--javascript-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<script src="js/bootbox.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/jcrop_bits.js"></script>
	<script src="js/jquery.Jcrop.js"></script>


	<!--CSS-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/jquery.Jcrop.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/normalize.css">
</head>
<body>

<div class="top_bar">
    <div class="images"> 
         <a href="index.php"><img src="images/profnet.jpg" class="logo"/> </a>
    </div>
	<nav>
		<a href="<?php echo $userLoggedIn; ?>" style="font-size: 24px;">
			<?php echo $user['first_name']; ?>
		</a>
		<a href="index.php">
			<i class="fa fa-home fa-2x"></i>
		</a>
		<a href="#">
		<i class="fa fa-envelope fa-2x"></i>
		</a>
		<a href="#">
			<i class="fa fa-bell fa-2x"></i>
		</a>
		<a href="requests.php">
			<i class="fa fa-users fa-2x"></i>
		</a>
		<a href="../About Us/about.html">
			<i class="fa fa-cog fa-2x"></i>
		</a>
		<a href="logout.php">
			<i class="fas fa-sign-out-alt fa-2x"></i>
		</a>
	</nav>
</div>
<div class="wrapper">