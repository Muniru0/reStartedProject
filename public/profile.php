
<?php

require_once("../private/initialize.php");

 Session::before_every_protected_page(); 


 $id        = 0;
 


 if(!is_get_request() || !request_is_same_domain()){
	 
	
	redirect_to("page_not_found.php");
	return;
}
if(!allowed_get_params([user::$id])){
	
		redirect_to("page_not_found.php");
		return;
	}  
	
   $id = (int)$_GET[user::$id];
   
	if(!in_array($id,$_SESSION[PostImage::$uploader_id])){
		
		redirect_to("page_not_found.php");
	}
	
	

   $result = DatabaseObject::find_one($id,user::$table_name);
    if($result){
		if($row = $result->fetch_assoc()){
			$result = $row;
		}
		
	}else{
	redirect_to("page_not_found.php");
	 return;
	}
    
 $request_type = "<input type='hidden' id='stream_type' value='profile_{$id}' />";

$content = "";
 
$content  .= main_header(profile_header($result[user::$firstname],$result[user::$lastname]),$request_type);
 echo $content  .= main_footer(); 


	

	  
	  
?>





