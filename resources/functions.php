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
			$output = "<div class=\"message\">";
		    $output .= htmlentities($_SESSION["message"]);
		    $output .= "</div>";
			
			//clear message after use
			$_SESSION["message"] = null;
			
			echo $output;
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


?>