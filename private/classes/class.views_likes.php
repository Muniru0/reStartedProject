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
   public static $alias_of_id = "likes_table_id";
   public static $alias_of_post_id = "likes_table_post_id";
   public static  $alias_of_comment_id = "likes_table_comment_id";
   public static $alias_of_user_id = "likes_table_user_id";
   public static $alias_of_firstname = "likes_table_firstname";
   public static $alias_of_lastname = "likes_table_lastname";
   public static $alias_of_likes_time = "likes_table_likes_time";


  // like a comment or a reply
    public static function like($post_id = 0,$comment_id = 0,$flag = "like_comment",$reply_id = null){
		
		
		 if(!isset($post_id) || $post_id < 1 || !is_int($post_id)
			 || !isset($_SESSION) || !isset($_SESSION["id"]) || !isset($_SESSION["firstname"]) || !isset($_SESSION["lastname"]) ){
			 return;
		 }
		
		if($flag === "like_comment"){
			$flag = 2;
		}elseif($flag === "like_reply"){
			$flag = 3;
		}else{
			 print j(["false" => "Please try again"]);
			return;
		}
		
		global $db;
		
		// assign the reply or comment time
		$time = time();
		
        // set the like comment or reply query		
		 $query = "CALL like({$post_id},{$comment_id},{$reply_id},{$_SESSION["id"]},{$_SESSION["firstname"]},{$_SESSION["lastname"]},{$time},{$flag})";
	
		// perform the query	
		if($db->multi_query($query)){
			
	// fetch the result
	 do{
		 
		  if($row = $result->store_result()){
		  if(isset($row["likes"]) && !empty($row["likes"]) ){
			  $result = (int)$row["likes"];
			   if(is_int($result)){
				   print j(["likes" => $result]);
			   }
			  return;
		  }
		 elseif($db->error != ""){
			   print j(["false" => "Sorry operation failed"]);
			return;
		 }else {
			print j(["false" => "Sorry operation failed"]);
			return;
		 }
	  }
		 
		 
	 }while($db->more_results() && $db->next_result());
	
	 
	
}
	}// like();
	
	




 }


 ?>