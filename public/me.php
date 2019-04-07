
<?php

require_once("../private/initialize.php");

if(!Session::before_every_protected_page()){
    return;
}
//Session::after_successful_logout();


$firstname = "";
$lastname  =  "";

    
if(isset($_SESSION) ){

// when the user refreshes the page set the stream variables 
// so that the posts can resume from the latest posts
$_SESSION[STREAM_HOME] = 0;
$_SESSION[STREAM_SELF] = 0;
$_SESSION[PostImage::$are_there_latest_posts] = true;
$firstname = $_SESSION[user::$firstname];
$lastsname = $_SESSION[user::$firstname];
}
 $request_type = "<input type='hidden' id='stream_type' value= ".STREAM_HOME." />";

$content = "";
 
$content  .= main_header(home_header($firstname,$lastname),$request_type);
 echo $content  .= main_footer(); 


	

	  
	  
?>





