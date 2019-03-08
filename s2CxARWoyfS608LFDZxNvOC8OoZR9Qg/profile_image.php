
<!DOCTYPE html>
  <html>

  <head>
  	
  	<title>Waves</title>

  </head>


<body>
<?php require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");after_successful_login();before_every_protected_page();


print_r($_SESSION);


?>


<p> WELCOME TO WAVES <?php echo h($_SESSION["firstname"]." ". $_SESSION["lastname"]);?> </p>


<p>Please upload your profile image: </p>

<?php

 
  if(isset($_POST["submit"])){
  

 
  

  if(user::update_profile_image("profile_image","file")){
   
 redirect_to("home.php");

  } 
 
}


?>
 
 

 <a href="home.php"> Skip </a>

   <form action="profile_image.php" method="POST" enctype="multipart/form-data">
   <input type="file" name="file[]" />
   <input type="submit" name="submit" value = "upload"/>
     </form>

</body>

  </html>

