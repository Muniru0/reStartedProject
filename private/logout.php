<?php
	require_once("../private/initialize.php");
if( !is_request_post()     || !request_is_same_domain() || 
	!csrf_token_is_valid() || !csrf_token_is_recent()) {
	
  
 print j(["false"=>"Sorry,Please refresh the page and try again"]);

return;
}


    
// Do the logout processes and redirect to login page.
	Session::after_successful_logout();
	// log_action("logout","log out action");
	// print j(["true"=>"logout"]);
	redirect_to("../public/login.php");

     

	
?>
