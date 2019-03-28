
<?php

require_once("../private/initialize.php");

 Session::before_every_protected_page(); 

$firstname = "";
$lastname  =  "";
//  $id        = 0;
 


//  if(!is_get_request() || !request_is_same_domain()){
	 
	
// 	redirect_to("page_not_found.php");
// 	return;
// }
// if(!allowed_get_params([user::$id])){
	
// 		redirect_to("page_not_found.php");
// 		return;
// 	}  
	
//    $id = (int)$_GET[user::$id];
   
// 	if(!in_array($id,$_SESSION[PostImage::$uploader_id])){
		
// 		redirect_to("page_not_found.php");
// 	}
	
	

//    $result = DatabaseObject::find_one($id,user::$table_name);
//     if($result){
// 		if($row = $result->fetch_assoc()){
// 			$result = $row;
// 		}
		
// 	}else{
// 	redirect_to("page_not_found.php");
// 	 return;
// 	}
    

$_SESSION[STREAM_HOME] = 1;
$_SESSION[STREAM_SELF] = 1;

$firstname = $_SESSION[user::$firstname];
$lastsname = $_SESSION[user::$firstname];
 $request_type = "<input type='hidden' id='stream_type' value= ".STREAM_HOME." />";

$content = "";
 
$content  .= main_header(home_header($firstname,$lastname),$request_type);
 echo $content  .= main_footer(); 


	

	  
	  
?>





