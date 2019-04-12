<?php

require_once("../private/initialize.php");

 Session::before_every_protected_page(); 



   




//  if( !is_get_request() || !is_post_request() || !request_is_same_domain()){
	 
	
// 	redirect_to("page_not_found.php");
// 	return;
// }

// if($_SERBEVR["REQUEST_METHOD"] === "GET"){


// if(!allowed_get_params([user::$id])){
	
// 		redirect_to("page_not_found.php");
// 		return;
// 	}  
	
// }

if(isset($_POST["submit"])){

    
  
    if(!csrf_token_is_valid() || !csrf_token_is_recent()){
        
        // redirect back to the previous page
    }
}


Messages::get_message_sending_template();

?>


