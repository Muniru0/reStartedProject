
<?php require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php"); ?>

<?php


// initialize variables to default values
$message = "";
$_SESSION["found_user"] = "";

if(request_is_post() && request_is_same_domain()) {
	
      if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
		  
		//if the csrf_token validation fails then redirect them to the sign up page.
		redirect_to("signup.php");
		
  	
  } else {
		
    // CSRF tests passed--form was created by us recently.
        
	
        $user  = new stdClass();
        $user = new user();

          
		user::$firstname  =  $_POST['firstname']   ;
        user::$lastname   =  $_POST['lastname']  ;
        user::$password    =  $_POST['password'];
		user::$email       =  $_POST['email']    ;
        user::$gov         =  $_POST['gov']  ;
	    user::$date        =  date("Y-m-d h:s:i",time());  
			
    //columns to validate presence on		
	$insertedColumns = ["firstname","lastname","email","password","gov"];
		

 //validate the submitted data 
   if(validate_presence_on($insertedColumns) &&
           has_length("password",['min' =>8, 'max' =>100])
        && is_email($_POST["email"]) 
        && has_length("firstname",['min' => 3, 'max' =>20])
        && has_length("lastname",['min' => 3, 'max' =>20])
        && is_real_name(["firstname","lastname"]) ) {
	    			
			
	//check whether the person has an account
 if(!user::found_user()){
            
       //if not then create one
	 	
      if($user->create()){

        if(!empty(trim($_FILES["file"]["name"][0]))){
        
    user::update_profile_image("profile_image","file");
        }
     // set the profile image before user sets one
    //redirect to the home page
   redirect_to("home.php");
				
 }else{

    // this means that there was a problem with user insertion
	$_SESSION["signup"] = "Server problem please try again";
}


	} else{

		//redirect them to the login page since they already 
		//have an account
		 $_SESSION["found_user"] = "Please log in, Your account is with Us."; 		
		 redirect_to("login.php");
		  	}
			}
		
				}
				  }
				    
				


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
  </head>
  <body>
    
    <?php
      if($message != "") {
     echo '<p>' . h($message) . '</p>';
      }
    ?>
    
    <p>Please Sign Up.</p>
    
<form action = "#"  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
			
      <?php echo csrf_token_tag(); ?>


                <div class="card login-card">

                    <h4 class="center">Create a free account!</h4>

                    <hr>
                    
                    <form>

                        <div class="form-group">
                            <input type="firstname" class="form-control" name="firstname" placeholder="First name" value="<?php echo h(user::$firstname); ?>">
                        </div>

                        <div class="form-group">
                            <input type="lastname" class="form-control" name="lastname" placeholder="Last name" value="<?php echo h(user::$lastname); ?>">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo h(user::$email); ?>">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Choose a password">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                        </div>

                        <div class="btn-padding">
                             <input type="submit" class="btn btn-success btn-block" name="submit" value="Sign Up" />
                        </div>

                    </form>

                </div>

			
		<input type="text" name="firstname" placeholder="firstname" value="<?php echo h(user::$firstname); ?>" /><br />
			<br />
	    <input type="text" name="lastname" placeholder="lastname" value="<?php echo h(user::$lastname); ?>" /><br />
			<br />
       
		<input type="text" name="email" placeholder="E-mail" value="<?php echo h(user::$email); ?>" /><br />
			 <br />
		Government: <input type="radio" name="gov" value="1" checked="<?php if(user::$gov == 1){echo "checked";}else{echo "";} ?>"/>   
		Public:     <input type="radio" name="gov" value="2" checked="<?php if(user::$gov == 2){echo "checked";}else{echo "";} ?>"/>
			<br /><br /><br />
			
        <input type="password" name="password" value="" />
			

	    <input type="file" name="file[]" value=""/>
        <input type="submit" class="btn btn-success btn-block" name="submit" value="Sign Up" />
</form>
    <br />

	<a href="forgot_password.php">I forgot my password.</a>
		
  </body>
</html>
