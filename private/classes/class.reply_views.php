<?php

require_once("../private/initialize.php");



class ReplyViews  extends Views {

   // table name 
      public static $table_name    =    "reply_views";
	  
	// database columns
      public static $id            =    "id";
      public static $post_id       =    "post_id";
      public static $comment_id    =    "comment_id";
      public static $user_id       =    "user_id";
      public static $reply         =    "reply";
	  public static $reply_time    = 	"reply_time";
	  public static $firstname     =    "firstname";
	  public static $lastname      =    "lastname";
	 
	  public static $likes         = "likes";


	  // aliases of database columns
      public static $alias_of_id            =    "reply_views_id";
      public static $alias_of_post_id       =    "reply_views_post_id";
      public static $alias_of_comment_id    =    "reply_views_comment_id";
      public static $alias_of_user_id       =    "reply_views_user_id";
      public static $alias_of_reply_text    =    "reply_views_reply";
	  public static $alias_of_reply_time    = 	 "reply_views_reply_time";
	  public static $alias_of_firstname     =    "reply_views_firstname";
	  public static $alias_of_lastname      =    "reply_views_lastname";
	 
      public static $alias_of_likes         = "likes";
	  
	
	// provide the reply for a view

public static function reply_views($post_id = 0, $comment_id = 0, $reply = ""){
	
	 global $db;
	
  
	 
	// the insert query for the new comment	
	$query = "CALL reply_comment(?)";

	// prepare the new comment statement
	if(!($stmt= $db->prepare($query))){
	  Errors::trigger_error(RE_INTIATE_OPERATION);
		return false;
	} 
	
	$time = time();
	
	
	
	
	  if( !isset($_SESSION) || $_SESSION["id"] < 0 || !isset($_SESSION[user::$firstname]) || !isset($_SESSION[user::$lastname]) || empty(trim($_SESSION[user::$firstname])) || empty(trim($_SESSION["lastname"]))){
		  
			Errors::trigger_error(INVALID_SESSION);
		  return false;
	  }
	  
	  
	// assign the parameters
   $parameter = j([$post_id,$_SESSION[user::$firstname],$_SESSION[user::$lastname],$comment_id,$_SESSION[user::$id],$reply,$time]);
	// bind the parameters
	if(!$stmt->bind_param("s",$parameter)){
		Errors::trigger_error(INVALID_SESSION);
	return false;
		}
		
	// execute the statement
	if(!$stmt->execute()){
		Errors::trigger_error(INVALID_SESSION);
		return false;
	}
	
	// return a new_comment_id  in case the id is to be used to delete the comment
	$view_id = $stmt ->insert_id;
	  
	  if($result = $stmt->get_result()){
		    if($row = $result->fetch_assoc()){
			if(isset($row["new_reply_id"])  && $row["new_reply_id"] > 0 && $row["result"] == "successful"){
		 
		//$view_info = self::get_reply($view_id,$post_id);
	    // to be used as the title attribute for the time paragraph in html	
	    $post_date  = strftime("%B, %e    %G  %I:%M %p",$time);
	 
	 
	 
		// add the reply id to the array of reply_ids
		 $_SESSION["reply_ids"][] = (int)$row["new_reply_id"];
		// convert the time stamp from UNIX based timestamp to something more readable
       $formatted_reply_time = FetchPost::time_converter($time);
			print j(["new_reply_id" => "new_reply_{$row["new_reply_id"]}",
			"reply_id" => $row["new_reply_id"],
			"comment_id" => $comment_id,
			"reply" => $reply,
			"reply_time" =>$formatted_reply_time,
			"fullname" => $_SESSION[user::$firstname]." ".$_SESSION[user::$firstname],
			"reply_date" => $post_date]);

			Notifications::send_notification($post_id,$comment_id,$row["new_reply_id"],$_SESSION[user::$firstname],NEW_REPLY_COMMENT,$time);
 }elseif(Isset($row["invalid_request"])){
	 Errors::trigger_error(RETRY);
	
	 return false;
 }else{
	  
	 Errors::trigger_error(RE_INITIATE_OPERATION);
	return false;
 }   
			}
	  }
	
 
}


  // get the reply for the view
  public static function get_reply($comment_id = 0,$post_id = 0){
	  global $db;
	 
	  $post_id = (int)$post_id;
	   if(!isset($post_id) || $post_id < 1 || !is_integer($post_id)){
		 return false;
	   }
	 
	  $query = "SELECT * FROM ".self::$table_name." WHERE post_id = {$post_id} && id ={$comment_id} LIMIT 1";
	  $result = $db->query($query);
	  
	  if(!$result){
		  
			Errors::trigger_error(RETRY);
	  }
	  
	  
	   $record = [];
	  if($row = $result->fetch_array()){
		  for($x = 0;$x < 5 ; $x ++){
			   $record[$x] = $row[$x];
		  }
		 
return $record;
	}
	 
	 
  }// get_reply();


  // edit the reply for the view
  public static function edit_reply($comment_id = 0,$reply_id = 0,$reply = ""){
	  
  }


  public static function get_reply_template($post_id = 0,$comment_id = 0,$replys = [],$likes_user_ids = []){
	      
	  if(!isset($replys) || !is_array($replys)){
		 
		  return "";
	  }
	  
	  // pull out the replys of the comments 
	  $replys = $replys["replys_{$comment_id}"];
	
	  $replys_string = "";
		   
		  $replys_string ="<div id='reply_wall_{$comment_id}' class='ps-comment ps-comment-nested reply-sidebar'>

<div class='ps-comment-container comment-container ps-js-comment-container' id='reply_container_{$comment_id}'>" ;
 
		    
        // order the replys by DESC(thus more recent ones // first)
			$replys = array_reverse($replys);
	  foreach($replys AS $index => $reply){
		   if(!isset($index) || empty($index)){
			   continue;
		   }
		   
  if(!isset($_SESSION) || !isset($_SESSION["reply_ids"]) || !is_array($_SESSION["reply_ids"]) || !isset($_SESSION[user::$id])){
	  
	   return false;
  }
    
	       $toggle_likes_count = "";
           $likes_count_string = "";
		   $user_like_status   = "";
		   
		   
		   // if there are no reply likes
		   if(isset($reply[ReplyViews::$alias_of_likes]) && $reply[ReplyViews::$alias_of_likes] < 1 ){
			   
			   $toggle_likes_count = "style = 'display:none;'";
			   $likes_count_string = "<span class='likes_count'></span></a>";
		   }
		   // if user is the only one who liked the reply
		   elseif(isset($reply[ReplyViews::$alias_of_likes]) && (int)$reply[ReplyViews::$alias_of_likes] === 1 && in_array($_SESSION[user::$id],$likes_user_ids)){
			   $likes_count_string = "<span class='likes_count liked' title='you liked this'> 1</span></a>";
			   $user_like_status = "liked";
			    
		   }
		   // if another user is the only one who liked the reply
		   elseif(isset($reply[ReplyViews::$alias_of_likes]) && (int)$reply[ReplyViews::$alias_of_likes] === 1 &&  !in_array($_SESSION[user::$id],$likes_user_ids) ){
				 
			   $likes_count_string = "<span class='likes_count' title= 'person liked this'>1</span></a>";
			   
		   }
		   //if the user is not  among the multi users that liked the reply
		   elseif(isset($reply[ReplyViews::$alias_of_likes]) && (int)$reply[ReplyViews::$alias_of_likes] > 1 && !in_array($_SESSION[user::$id],$likes_user_ids[$reply[ReplyViews::$alias_of_id]])){
			   
			   $likes_count_string = "<span class='likes_count' title='".parent::convert_likes_number($reply[ReplyViews::$alias_of_likes])." people likes this'>".parent::convert_likes_number($reply[ReplyViews::$alias_of_likes])."</span></a>";
			   
			   
			     
		   } 
		    // if user is among the multi users that liked the reply
 		   elseif(isset($reply[ReplyViews::$alias_of_likes]) && (int)$reply[ReplyViews::$alias_of_likes] > 1 && in_array($_SESSION[user::$id],$likes_user_ids[$reply[ReplyViews::$alias_of_id]])){
			   
			   $likes_count_string = "<span class='likes_count liked' title='".parent::convert_likes_number($reply[ReplyViews::$alias_of_likes])." people likes this'>".parent::convert_likes_number($reply[ReplyViews::$alias_of_likes])."</span></a>";
			   $user_like_status = "liked";
			   
			     
		   }
		  
		      
		   $reply_id = $reply[ReplyViews::$id];
		  
		        if(!in_array((int)$reply_id,$_SESSION["reply_ids"])){
				 
		   $_SESSION["reply_ids"][] =(int)$reply_id;
			 }
		   
		  
    
  $replys_string .= "<div id='new_reply_".$reply_id."' class='ps-comment-item cstream-comment stream-comment'>
	

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href=\"../public/".PROFILE_PAGE."?id=".$reply[ReplyViews::$user_id]."\" >".$reply[ReplyViews::$alias_of_firstname]." ".$reply[ReplyViews::$alias_of_lastname]."</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p>".$reply[ReplyViews::$reply]."</p></div></span>
		</div>

		<div class='cstream-more'></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small ><span class='ps-js-autotime'  title=".strftime("%B, %e    %G  %I:%M %p",$reply[ReplyViews::$reply_time]).">".FetchPost::time_converter($reply[ReplyViews::$reply_time])."</span></small>
			
			
			   <div id='reply_likes_count_".$reply_id."'  class='ps-comment-links cstream-likes ' {$toggle_likes_count}>
				<a href='#showLikesReply'>{$likes_count_string}</div>
						
			
    <div  class='ps-comment-links cstream-likes'  style='display:none'></div>
			
			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a  onclick='reaction.like({$post_id},{$comment_id},".$reply_id.",this,\"reply\"); return false;' href='#like' class='actaction-like ps-icon-thumbs-up {$user_like_status}'><span>Like</span></a>

<a onclick='comment.prepare_edit_comment({$comment_id},{$reply_id},this,\"reply\"); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a  onclick='comment.delete_comment({$comment_id},".$reply_id.",'reply'); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div> ";

		  
	  }
	

	
	 return $replys_string .="
</div>

	<div class='ps-comment-reply cstream-form stream-form wallform' data-type='stream-newcomment' data-formblock='true' style='display:none;' id='reply_area_wrapper_{$comment_id}'>
		
		<div class='ps-textarea-wrapper cstream-form-input'>
			<div class='ps-tagging-wrapper'><div class='ps-tagging-beautifier'></div><textarea id='reply_area_{$comment_id}' class='ps-textarea cstream-form-text ps-tagging-textarea' name='comment' oninput='utility.resizeTextarea(this);' onkeydown='comment.reply_field_change({$comment_id},this);' placeholder='Write a reply...' style='height: 37px;'></textarea><input type='hidden' class='ps-tagging-hidden' value=''><div class='ps-tagging-dropdown' style='display: none;'></div></div>
				

		</div>
		<div class='ps-comment-send cstream-form-submit' style='display: none;'>
			<div class='ps-comment-loading' style='display: none;'>
				<img src='assets/images/ajax-loader.gif' alt=''>
				<div> </div>
			</div>
			<div class='ps-comment-actions' style='display: none;'>
				<button onclick='comment.reply_cancel({$post_id},{$comment_id},this); return false;' class='ps-btn ps-button-cancel'>Clear</button>
				<button onclick='comment.reply_comment({$post_id},{$comment_id},this); return false;' class='ps-btn ps-btn-primary ps-button-action'>Post</button>
			</div>
		</div>
	</div>

</div>";
	  
  }

 //template for each reply item 
 public static function get_reply_item($reply = ""){
	 
 if(!isset($reply) || trim($reply) == ""){
	  return;
 }
 
 
 
 
 
 }
	
 
// delete the a reply to a comment
 public static function delete_reply_view ($comment_id = 0 ,$reply_id = 0){
	
	global $db;
	
   
	
  if(!isset($_SESSION) || $_SESSION[user::$id] < 1){
	Errors::trigger_error(RETRY);
	return;
	}

	$comment_id     = $db->real_escape_string($comment_id);
	$reply_id       = $db->real_escape_string($reply_id);	
	$user_id        = $_SESSION[user::$id];
	
	// query to delete a comment and it's associated replys
	$query  = "DELETE FROM ".self::$table_name." WHERE id = {$reply_id} && post_id = {$comment_id} && commentor_id = {$user_id};";
	

	  
	  if($result = $db->query($query)){
		   if($row = $result->fetch_assoc()){
         if($db->affected_rows == 1){
				print j(["reply_delete"=>"success"]);
				Notifications::send_notification("NULL",$comment_id,$reply_id,$user_id,DELETE_REPLYVIEW,time());
				return;
				 }
			 }
		  
		  
}else{
	print j(["false" => "Something went wrong please try again... if the problem persist refresh the page1"]);
}
	  
	
}





 

} 



?>