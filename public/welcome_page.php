<?php

require_once("../private/initialize.php");

if(!Session::before_every_protected_page()){
    if(!isset($_SERVER["HTTP_REFERER"]) || trim($_SERVER["HTTP_REFERER"]) === ""){
        redirect_to("page_not_found.php");
       }
       redirect_to($_SERVER["HTTP_REFERER"]);
       return false;
}



if(!is_request_get() || !request_is_same_domain()){
 if(!isset($_SERVER["HTTP_REFERER"]) || trim($_SERVER["HTTP_REFERER"]) === ""){
  redirect_to("page_not_found.php");
 }
 redirect_to($_SERVER["HTTP_REFERER"]);
 return false;
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?php echo $_SESSION[user::$firstname]." ".$_SESSION[user::$lastname]; ?> to SpeakUp</title>
    </head>
    
    
    <body>





    </body>
    
    </html>





