<?php
	

	//Helper Functions

 //echo "from functions";
function redirect($value)
{
	header("Location: $value");
}

function set_message($m){
  if(!empty($m)){
    $_SESSION["message"] = $m;
  }else{
    $m="";
  }
}

function display_message(){
  if(isset($_SESSION["message"])){
			echo $_SESSION["message"];
			$_SESSION["message"] = null;
		}
}


function query($sql)
{
	global $connection;
	return mysqli_query($connection,$sql);
	//echo "<br>".$sql;
}

function confirm($result)
{
	global $connection;
	if(!$result){
		die("Query Failed : ".mysqli_error($connection));
	}
}

function escape_string($string)
{
	global $connection;
	return mysqli_real_escape_string($connection,$string);
}

function fetch($result){
	return mysqli_fetch_assoc($result);
}

function username($f,$l){
	global $connection;
	$u = strtolower($f)."_".strtolower($l);
	$i=0;
	$ch = 0;
	//check if it is unique
	$query = query("SELECT * FROM user_login WHERE username='{$u}'");
	if(mysqli_num_rows($query) != 0){
		$ch=1;
	}
	while($ch == 1){
		$u = $u.$i;
		$i += 1;
		$query = query("SELECT * FROM user_login WHERE username='{$u}'");
		if(mysqli_num_rows($query) != 0){
			$ch=1;
	    }else{
	    	$ch=0;
	    }
	}
	return $u;
}

function def_pic(){
	$rand = rand(1,16);
	switch ($rand) {
		case 1: $a = "images/profile_pics/default/head_alizrin.png";
					 break;
		case 2: $a = "images/profile_pics/default/head_amethyst.png";
					 break;
		case 3: $a = "images/profile_pics/default/head_belize_hole.png";
					 break;
		case 4: $a = "images/profile_pics/default/head_carrot.png";
					 break;
		case 5: $a = "images/profile_pics/default/head_deep_blue.png";
					 break;
		case 6: $a = "images/profile_pics/default/head_emerald.png";
					 break;
		case 7: $a = "images/profile_pics/default/head_green_sea.png";
					 break;
		case 8: $a = "images/profile_pics/default/head_nephritis.png";
					 break;
		case 9: $a = "images/profile_pics/default/head_pete_river.png";
					 break;
		case 10: $a = "images/profile_pics/default/head_pomegranate.png";
					 break;
		case 11: $a = "images/profile_pics/default/head_pumpkin.png";
					 break;
		case 12: $a = "images/profile_pics/default/head_red.png";
					 break;
		case 13: $a = "images/profile_pics/default/head_sun_flower.png";
					 break;
		case 14: $a = "images/profile_pics/default/head_turqoise.png";
					 break;
		case 15: $a = "images/profile_pics/default/head_wet_asphalt.png";
					 break;
		case 16: $a = "images/profile_pics/default/head_wisteria.png";
					 break;

		
		default:
			$a = "images/profile_pics/default/head_alizrin.png";
			break;
	}
	return $a;
}

function get_user_by_id($value){
	global $connection;
	$query = query("SELECT * FROM user_login WHERE id={$value};");
	confirm($query);
    if(mysqli_num_rows($query) == 1)
    {
    	//$user = fetch($query);
    	return $user;
    }else{
    	return false;
    }
}


?>