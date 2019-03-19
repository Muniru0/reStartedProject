
<?php

require_once("../private/initialize.php");

$community = "health";

 Session::before_every_protected_page(); 

 if(!is_get_request() || !request_is_same_domain()){
	 
	
	redirect_to("page_not_found.php");
	return;
}
 
  
 $request_type = "<input type='hidden' id='stream_type' value='community_".strtolower($community)."' />";

$content = "";
 
$content  .= main_header(community_header($community),$request_type);
 echo $content  .= main_footer(); 


	

	  
	  
?>





