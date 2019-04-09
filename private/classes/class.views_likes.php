<?php 
 
 require_once("../private/initialize.php");

 class ViewsLikes Extends DatabaseObject {

 // table name
  public static $table_name       = "views_likes";
  


  // columns of the database 
   public static $id = "id";
   public static $post_id = "post_id";
   public static $comment_id = "comment_id";
   public static $user_id = "user_id";
   public static $firstname = "firstname";
   public static $lastname = "lastname";
   public static $likes_time = "likes_time";
   


// columns of the database 
   public static $alias_of_id = "views_table_likes_table_id";
   public static $alias_of_post_id = "views_table_likes_table_post_id";
   public static  $alias_of_comment_id = "views_table_likes_table_comment_id";
   public static $alias_of_user_id = "views_table_likes_table_user_id";
   public static $alias_of_firstname = "views_table_likes_table_firstname";
   public static $alias_of_lastname = "views_table_likes_table_lastname";
   public static $alias_of_likes_time = "views_table_likes_table_likes_time";


  // like a comment or a reply
    public static function like($post_id = 0,$comment_id = 0,$reply_id = 0,$flag = "like_comment"){
		
		
		 if(!isset($post_id) || $post_id < 1 || !is_int($post_id)
			 || !isset($_SESSION) || !isset($_SESSION["id"]) || !isset($_SESSION["firstname"]) || !isset($_SESSION["lastname"]) ){
			 return;
		 }
	
				
		global $db;
		   
		   if($flag = "like_comment"){
			   $flag = 2;
		   }elseif($flag = "like_reply"){
			   $flag = 3;
		   }else{
			   return;
		   }
		   
		   		
		// assign the reply or comment time
		$time = time();
		
        // set the like comment or reply query		
		 $query = "CALL like_comment_replys({$post_id},{$comment_id},{$reply_id},{$_SESSION["id"]},'{$_SESSION["firstname"]}','{$_SESSION["lastname"]}',{$time},{$flag})";

		  $notification_type = "";
		// perform the query	
		if($db->multi_query($query)){
			
	// fetch the result
	 do{
		 
		  if($result = $db->store_result()){
			    
			 while($row = $result->fetch_assoc()){
				   
		  if(isset($row["likes"]) && !empty($row["likes"]) ){
			  		
			  $likes = (int)$row["likes"];
			   if(is_int($likes)){
				  
					 print j(["likes" => $likes]);
				
					
			   }
			  
			}
			
			$notification_type = $row["result"];
		
			 }
			 
			 $result->free();
		
	  }elseif($db->error != ""){
			Errors::trigger_error(RETRY);
			 
			return;
		 }
		 
		 
	 }while($db->more_results() && $db->next_result());
	
	 
	
}else{
	
 Errors::trigger_error(RETRY);
 return false;
	
}

if(trim($notification_type) == LIKE_COMMENT){
	Notifications::send_notification($post_id,$comment_id,"NULL",LIKE_COMMENT);
 }elseif(trim($notification_type) == UNLIKE_COMMENT){
	Notifications::send_notification($post_id,$comment_id,"NULL",UNLIKE_COMMENT);
 }elseif(trim($notification_type) == LIKE_REPLY){
	Notifications::send_notification($post_id,$comment_id,$reply_id,LIKE_REPLY);
 }elseif(trim($notification_type) == UNLIKE_REPLY){
	Notifications::send_notification($post_id,$comment_id,$reply_id,UNLIKE_REPLY);
 }



	}// like();
	
	




 }


 ?>