<?php

require_once("../private/initialize.php");

if(!Session::before_every_protected_page()){
	return;
}
    // FetchPost::get_post_full_header_and_body();
    // return;


function is_ajax(){

    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
}


try {
	// check to see if the request is an ajax one
    if (is_ajax() && is_request_post()) {
		
		global $db;
		
	 // check if there are files to be uploaded	
	 $count = count($_FILES["file"]["name"]);
	  if( $count > 0)
	  {
		   $_POST["caption"] = h($_POST["caption"]);
		  
		   
		  $_POST["caption"] = $db->real_escape_string(nl2br($_POST["caption"]));
		  
	
		// if(csrf_token_is_recent() && csrf_token_is_valid()){
              // check the length of the caption string        
        if(isset($_POST["caption"]) && !empty(trim($_POST["caption"])) && strlen($_POST["caption"]) > 4000){
         print  j(["false" => "Please the maximum number of characters for the caption is <b>(4000)</b>"]);
           return;
        }
        // check the length of the title string
     if(!has_length("title",["max" => 100])){
        print  j(["false" => "Please the maximum number of characters for the title is <b>(50)</b>"]);
           return;
        }
        // if all the required fields have being populated
        if(PostImage::validate_post($_POST, $_FILES)) {
           if (PostImage::post($_FILES["file"],$_POST["title"],$_POST["caption"], $_POST["label"], $_POST["log"],$_POST["lat"],$count)){}
                
       }
   // }else{
// print j(["false"=> "Please try again(csrf token failure)"]);
       // }
	  }else{
	print j(["false" => "Please include files in your post"]);
           } 
}  else {
print j(["false" => "Please try again(INVALID REQUEST"]);
    }
}catch (Exception $e) {
// send me a mail
print j(["ERROR" => "An unexpected error occured! Please try again."]);
}

?>
