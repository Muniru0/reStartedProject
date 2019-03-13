
<?php

require_once("../private/initialize.php");

$id        = 0;
$firstname = "Yussif";
$lastname  = "Muniru";

 Session::before_every_protected_page(); 

 if(!is_get_request() || !request_is_same_domain()){
	
	redirect_to("page_not_found.php");
}
if(!allowed_get_params([user::$id])){
		
		redirect_to("page_not_found.php");
	}
$id        = $_GET[user::$id];


$result = DatabaseObject::select_one($id,user::$table_name);
  
   
 
$content = "";
 
$content  .= main_header(profile_header($firstname,$lastname));
echo $content  .= main_footer(); 


	

	  
	  
?>





