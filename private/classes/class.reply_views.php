<?php

require_once("../private/initialize.php");

class ReplyViews  extends Views {

    // table name of the 
      public static $table_name    =    "reply_comments";
	  
	// database columns
      public static $id            =    "id";
      public static $post_id       =    "post_id";
      public static $comment_id    =    "comment_id";
      public static $user_id       =    "user_id";
      public static $reply_text    =    "reply";
	  public static $reply_time    = 	"reply_time";
	  

	  
	
	// provide the reply for a view

public static function reply_views($post_id = 0, $comment_id = 0, $reply = ""){
	
	 global $db;
	
	
	 
	// the insert query for the new comment	
	$query = "CALL reply_comment(?)";

	// prepare the new comment statement
	if(!($stmt= $db->prepare($query))){
		log_action(__CLASS__, " Query failed {$db->error} on line ".__LINE__." in file ".__FILE__);
		return false;
	} 
	
	$time = time();
	// assign the parameters
   $parameter = j([$post_id,$comment_id,$_SESSION["id"],$reply,$time]);
	// bind the parameters
	if(!$stmt->bind_param("s",$parameter)){
		log_action(__CLASS__," Query failed {$db->error} on line ".__LINE__." in file ".__FILE__);
         return false;
		}
		
	// execute the statement
	if(!$stmt->execute()){
		log_action(__CLASS__,"  Query failed {$db->error} on line ".__LINE__." in file ".__FILE__);
		return false;
	}
	
	// return a new_comment_id  in case the id is to be used to delete the comment
	$view_id = $stmt ->insert_id;
	  
	  if($result = $stmt->get_result()){
		    if($row = $result->fetch_assoc()){
			if(isset($row["LAST_INSERT_ID()"])  && $row["LAST_INSERT_ID()"] > 0){
		 
		//$view_info = self::get_reply($view_id,$post_id);
	    // to be used as the title attribute for the time paragraph in html	
	    $post_date  = strftime("%B, %e    %G  %I:%M %p",$time);
		
		// convert the time stamp from UNIX based timestamp to something more readable
       $formatted_reply_time = FetchPost::time_converter($time);
			print j(["reply_div_id" => "reply_div_{$row["LAST_INSERT_ID()"]}",
			"reply_id" => $row["LAST_INSERT_ID()"],
			"comment_id" => $comment_id,
			"reply" => $reply,
			"reply_time" =>$formatted_reply_time,
			"fullname" => $_SESSION["firstname"]." ".$_SESSION["lastname"],
			"reply_date" => $post_date]);
 }elseif(Isset($row["invalid_request"])){
	 log_action(__CLASS__," Query failed {$db->error} {$stmt->error}on line ".__LINE__." in file ".__FILE__);
	 print j(["false" => "Operation failed, please try again..."]);
	 return false;
 }else{
	  
	  log_action(__CLASS__," Query failed {$db->error} {$stmt->error}on line ".__LINE__." in file ".__FILE__);
	 print j(["false" => "Operation failed, please try again...if the problem persists refresh the page"]);
	 return false;
 }   
			}
	  }
	
 
}


  // get the reply for the view
  public static function get_reply($comment_id,$post_id = 0){
	  global $db;
	 
	  $post_id = (int)$post_id;
	   if(!isset($post_id) || $post_id < 1 || !is_integer($post_id)){
		 return false;
	   }
	 
	  $query = "SELECT * FROM ".self::$table_name." WHERE post_id = {$post_id} && id ={$comment_id} LIMIT 1";
	  $result = $db->query($query);
	  
	  if(!$result){
		  
		  log_action(__CLASS__," Query failed: {$db->error} on line ".__LINE__." in file ".__FILE__);
	  }
	  
	  
	   $record = [];
	  if($row = $result->fetch_array()){
		  for($x = 0;$x < 5 ; $x ++){
			   $record[$x] = $row[$x];
		  }
		 
return $record;
	}
	 
	 
  }// get_reply();









} 



?>