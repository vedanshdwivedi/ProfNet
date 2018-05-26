<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/header.php"); ?>
<?php require_once("../resources/log_handle.php"); ?>
<?php require_once("../resources/reg_handle.php"); ?>

<div class="images"> 
     <img src="css/profnet.jpg" class="logo"/> 
</div>
	
<div id="dialog" class="dialog dialog-effect-in">
  <div class="dialog-front">
    <div class="dialog-content">



    <!--LOGIN FORM-->
      <form id="login_form" class="dialog-form" action="register.php" method="POST">
        <fieldset>
          <legend>Log in</legend>
          <div class="form-group">
            <label for="user_username" class="control-label">Email:</label>
            <input type="text" id="user_username" class="form-control" name="log_email" autofocus/>
          </div>
          <div class="form-group">
            <label for="user_password" class="control-label">Password:</label>
            <input type="password" id="log_password" class="form-control" name="log_password"/>
          </div>
          <!--div class="text-center pad-top-20">
            <p>Have you forgotten your<br><a href="#" class="link"><strong>username</strong></a> or <a href="#" class="link"><strong>password</strong></a>?</p>
          </div-->
          <div class="pad-top-20 pad-btm-20">
            <input type="submit" class="btn btn-default btn-block btn-lg" value="Continue" name="log_submit">
          </div>
          <div class="text-center">
            <p>Do you wish to register<br> for <a href="#" class="link user-actions"><strong>a new account</strong></a>?</p>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <div class="dialog-back">
    <div class="dialog-content">
    <!--REGISTER FORM-->


      <form id="register_form" class="dialog-form" action="register.php" method="POST">
        <fieldset>
          <legend>Register</legend>
          <div class="form-group">
            <label for="user_username" class="control-label">First Name:</label>
            <input type="text" id="user_username" class="form-control" name="fname"/> 
          </div>
		  <div class="form-group">
            <label for="user_username" class="control-label">Last Name:</label>
            <input type="text" id="user_username" class="form-control" name="lname"/> 
          </div>
		  <div class="form-group">
            <label for="user_username" class="control-label">Email:</label>
            <input type="email" id="user_username" class="form-control" name="email"/> 
          </div>
          <div class="form-group">
            <label for="user_password" class="control-label">Password:</label>
            <input type="password" id="user_password" class="form-control" name="password"/>
          </div>
          <div class="form-group">
            <label for="user_cnf_password" class="control-label">Confirm password:</label>
            <input type="password" id="user_cnf_password" class="form-control" name="password2"/>
          </div>
          <div class="pad-btm-20">
            <input type="submit" class="btn btn-default btn-block btn-lg" value="Sign Up" name="reg_submit" />
          </div>
          <div class="text-center">
            <p>Return to <a href="#" class="link user-actions"><strong>log in page</strong></a>?</p>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
<?php require_once("../resources/footer.php"); ?>
