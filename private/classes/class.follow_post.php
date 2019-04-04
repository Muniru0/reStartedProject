<?php

require_once("../private/initialize.php");


class FollowPost Extends DatabaseObject{
	

  public static $table_name = "follow_posts";


  public static $id           = "follow_posts_id";
  public static $post_id      = "follow_posts_post_id";
  public static $follower_id  = "follow_posts_follower_id";
  public static $firstname    = "follow_posts_follower_firstname";
  public static $lastname     = "follow_posts_follower_lastname";
  public static $time         = "follow_posts_time";


  public static $session_string = "follow_posts_user_ids";

  public static function follow_post($post_id = 0){
	   
	   global $db;
	   

      if(!isset($_SESSION[user::$id]) || $_SESSION[user::$id] < 1 || trim($_SESSION[user::$firstname]) == "" || trim($_SESSION[user::$lastname]) == "" ){
		Errors::trigger_error(INVALID_SESSION);
		
		return;
      }

	 
		  $post_id = $db->real_escape_string($post_id);
		  
		  
	   $query = "CALL follow_posts({$post_id},".$_SESSION[user::$id].",'".$_SESSION[user::$firstname]."','".$_SESSION[user::$lastname]."',".time().")";
      


	   if($db->multi_query($query)){
          
       
			
			do{
			if($result = $db->store_result()){
				
				 if($result->num_rows > 0){
			  if($row = $result->fetch_assoc()){
				  if(isset($row) && $row["result"] == "following"){
					  print j(["follow_post" =>"success"]);
					  return;
				  }elseif(isset($row) && $row["result"] == "unfollowed"){
					  
					  print j(["unfollow_post" => "success"]);
					  return;
				  }elseif(isset($row) && $row["result"] == "invalid_request"){
					  
					print j(["invalid_request" => "success"]);
					return;
				}elseif(trim($db->error) != ""){
				 
					Errors::trigger_error(RETRY);
					  return;
				  }
			  }	
			
			}
				 }else{
					 
					Errors::trigger_error(RETRY);
					 return;
				 }
			}while($db->more_results() && $db->next_result());
				  
  }else{
	
  }
   
   }// link_user();
	

}








