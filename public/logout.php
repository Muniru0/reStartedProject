<?php

	require_once("../private/initialize.php");
	Session::after_successful_logout();
	redirect_to('login.php');
	return;
if(is_request_post() && request_is_same_domain()) {
	
  // is the csrf token valid and recent
  if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
	  
	// Do the logout processes and redirect to login page.
	log_action("logout","this is a log out action");
	after_successful_logout();
	redirect_to('login.php');
	
	
  }
}
      
?>
