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
					 if($row["result"] == "like_comment"){
            Notifications::send_notification($post_id,$user_id,LIKED_COMMENT,$time);
					 }elseif($row["result"] == "like_reply"){
						Notifications::send_notification($post_id,$user_id,LIKED_REPLY,$time);
					 }
			   }
			  return;
		  }
			 }
			 
			 $result->free();
		
	  }elseif($db->error != ""){
		  log_action(__CLASS__,$db->error);
			 
			return;
		 }
		 
		 
	 }while($db->more_results() && $db->next_result());
	
	 
	
}else{
	
	print j(["false"=>"Please try again later"]);	
	
}
	}// like();
	
	




 }


 ?>