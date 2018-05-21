<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/header.php"); ?>
<?php 
	//check whether any of the actions from login/signup happened
    if(isset($_POST["signup_submit"])){
    	//signup the user
    	$f = escape_string($_POST["first_name"]);
    	$l = escape_string($_POST["last_name"]);
    	$e = escape_string($_POST["email"]);
    	$p = escape_string($_POST["password"]);
 
		//check if email exists
		$query = query("SELECT * FROM user_login WHERE email='{$e}';");
		confirm($query);
		$result = fetch($query);
		if(mysqli_num_rows($query) > 0){
			set_message("Email Already Exists");
			redirect("index.php");
		}else{
			$query = query("INSERT INTO user_login(firstname,lastname,email,password)VALUES('{$f}','{$l}','{$e}','{$p}')");
			confirm($query);
			set_message("Signup Successful");
			redirect("index.php");
		}

    }else{
    	if(isset($_POST["login_submit"])){
    		//login action
    		$e = escape_string($_POST["email"]);
    	    $p = escape_string($_POST["password"]);
    	    //check if user exists
    	    $query = query("SELECT * FROM user_login WHERE email='{$e}';");
    	    confirm($query);
    	    $row = fetch($query);
    	    if(mysqli_num_rows($query) == 1){
    	    	//attempt login
    	    	if($row["password"] == $p){
    	    		//password match
    	    		set_message("Login Successful");
    	    		$_SESSION["user_id"] = $row["id"];
    	    		redirect("user.php");
    	    	}else{
    	    		//password mismatch
    	    		set_message("email/password mismatch");
    	    		redirect("index.php");
    	    	}
    	    }else{
    	    	//no user found
    	    	set_message("No user found");
    	    	redirect("index.php");
    	    }
    	}
    }
 ?>

  <div class="form">
  
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up </a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up</h1>
          <br><h2><?php display_message(); ?></h2>
          
          <form action="index.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name="first_name" autocomplete="off"  required />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name="last_name" autocomplete="off" required />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="email" autocomplete="off" required />
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name="password" autocomplete="off" required />
          </div>
          
          <button type="submit" class="button button-block" name="signup_submit"/>Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          <br><h2><?php display_message(); ?></h2>
          

          <!--login form-->
          <form action="index.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="email" autocomplete="off" required />
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" autocomplete="off" required />
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button type="submit" class="button button-block" name="login_submit"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <?php require_once("../resources/footer.php"); ?>
