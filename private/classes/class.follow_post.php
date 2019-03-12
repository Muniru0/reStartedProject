<?php

require_once("../private/initialize.php");


class FollowPost Extends DatabaseObject{
	

  public static $table_name = "follow_posts";


  public static $id           = "id";
  public static $post_id      = "post_id";
  public static $follower_id  = "follower_id";
  public static $firstname    = "firstname";
  public static $lastname     = "lastname";
  public static $time         = "time";

  public static $alias_of_id           = "follow_posts_id";
  public static $alias_of_post_id      = "follow_posts_post_id";
  public static $alias_of_follower_id  = "follow_posts_follower_id";
  public static $alias_of_firstname    = "follow_posts_firstname";
  public static $alias_of_lastname     = "follow_posts_lastname";
  public static $alias_of_time         = "follow_posts_time";

  public static $session_string = "follow_posts_user_ids";

  public static function follow_post($post_id = 0){
	   
	   global $db;
	   

      if(isset($_SESSION[user::$id]) && $_SESSION[user::$id] > 0 && trim($_SESSION[user::$firstname]) != "" && trim($_SESSION[user::$lastname]) != "" ){

      }

	      $user_id = $db->real_escape_string($user_id);
		  $post_id = $db->real_escape_string($post_id);
		  
		  
	   $query = "CALL follow_posts({$post_id},".$_SESSION[user::$id].",".$_SESSION[user::$firstname].",".$_SESSION[user::$lastname].",".time().")";
      


	   if($db->multi_query($query)){
          
       
			
			do{
			if($result = $db->store_result()){
				
				 if($result->num_rows > 0){
			  if($row = $result->fetch_assoc()){
				  if(isset($row) && $row["result"] > 0){
					  print j(["true" =>"success"]);
					  return;
				  }elseif(isset($row) && $row["result"] == 0){
					  
					  print j(["unlink" => "success"]);
					  return;
				  }elseif(trim($db->error) != ""){
				  log_action(__CLASS__,$db->error);
					  print j(["false" => "Sorry please refresh the page and try again"]);
					  return;
				  }
			  }	
			
			}
				 }else{
					 log_action(__CLASS__,$db->error);
					 print j(["false" => "Please refresh the page and try again."]);
					 return;
				 }
			}while($db->more_results() && $db->next_result());
				  
	   }
   
   }// link_user();
	

}








