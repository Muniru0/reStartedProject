<?php

require_once("../private/initialize.php");

 Session::before_every_protected_page(); 


 $community_type       = "";
 


 if(!is_get_request() || !request_is_same_domain()){
	 
	
	redirect_to("page_not_found.php");
	return;
}
if(!allowed_get_params([STREAM_COMMUNITY])){
	
		redirect_to("page_not_found.php");
		return;
	}  
	
   $community_type = (string) $_GET[STREAM_COMMUNITY];
   
	if(!in_array(trim($community_type),COMMUNITIES)){
		
		redirect_to("page_not_found.php");
	}
	
	

 $_SESSION[STREAM_COMMUNITY] = 0;
 // these variables have to be set at run time 
 // else they will be undefined
 $activities_count["label"][PostImage::$transport] ="" ;
 $activities_count["label"][PostImage::$work] ="" ;
 $activities_count["label"][PostImage::$health] ="" ;
 $activities_count["label"][PostImage::$security] ="" ;
 $activities_count["label"][PostImage::$sanitation] ="" ;
 $activities_count["label"][PostImage::$other] ="" ;
 $activities_count["label"][PostImage::$education] ="" ;
 $activities_count["label"][PostImage::$sol] ="" ;
 $activities_count["pending_connections"] = "";
 $activities_count["count_notifications"] = "";

 $request_type = "<input type='hidden' id='stream_type' value='".STREAM_COMMUNITY."_{$community_type}' />";
 
$content = "";
 
$content  .= main_header(community_header($community_type),$request_type,$activities_count);
 echo $content  .= main_footer(); 


	

	  
	  
?>





