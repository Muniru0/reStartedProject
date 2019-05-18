
<?php

require_once("../private/initialize.php");

if(!Session::before_every_protected_page()){
    redirect_to("login.php");
    return;
}
//Session::after_successful_logout();


$firstname = "";
$lastname  =  "";

  

// when the user refreshes the page set the stream variables 
// so that the posts can resume from the latest posts
$_SESSION[STREAM_HOME] = 0;
$activities_counts = PostImage::get_activities_counts(STREAM_HOME);
$_SESSION[STREAM_SELF] = 0;
$_SESSION[PostImage::$are_there_latest_posts] = true;
$firstname = $_SESSION[user::$firstname];
$lastsname = $_SESSION[user::$firstname];



 $request_type = "<input type='hidden' id='stream_type' value= ".STREAM_HOME." />";

$content = "";
 
$content  .= main_header(home_header($firstname,$lastname),$request_type,$activities_counts);
 echo $content  .= main_footer(); 


	

	  
	  
?>





