<?php

require_once(PRIVATE_DIR."initialize.php");

class Views extends DatabaseObject{

   public static $table_name   = "views";

   //columns in database
   public static $id            = "id";
   public static $post_id       = "post_id";
   public static $comment       = "comment";
   public static $commentor_id  = "commentor_id";
   public static $comment_time  = "comment_time";
   public static $firstname     = "firstname";
   public static $lastname      = "lastname";
   public static $likes         = "likes";


   //columns aliases in database
   public static $alias_of_id            = "views_table_id";
   public static $alias_of_post_id       = "views_table_post_id";
   public static $alias_of_comment       = "views_table_comment";
   public static $alias_of_commentor_id  = "views_table_commentor_id";
   public static $alias_of_comment_time  = "views_table_comment_time";
   public static $alias_of_firstname     = "views_table_firstname";
   public static $alias_of_lastname      = "views_table_lastname";
   public static $alias_of_likes         = "views_table_likes";
	  
	  
	  
   // get all the views for some specific post_ids
   public static function get_views_with_replys($post_id = 0, $views_with_replys = [],$views_likes_user_ids = [],$reply_views_user_ids = []) {
	  
      
	   if(empty($post_id)  || $post_id < 1 ){
		  
		   print j(["false" =>"Sorry server problem,please try again, if problem persists refresh the page."]);
		   return;
		 
	   }
	   
	   if(!is_array($views_with_replys) || in_array(0,$views_with_replys)){
		  
		   print j(["false" =>"Sorry server problem,please try again, if problem persists refresh the page."]);
		   return;
	}
	   
     	 
	 $views_and_viewsbox_template_string = "<div class='ps-comment comment-sidebar cstream-respond wall-cocs' id='wall-cmt-{$post_id}' style='margin-top: -1.1%;' 	 >
		<div class='ps-comment-container comment-container ps-js-comment-container' style='max-height: 29em;
    overflow-y: scroll; '> ";
	
   if(isset($views_with_replys) && !empty($views_with_replys) && is_array($views_with_replys) &&  (int)$post_id > 0 ){
	   
	   foreach($views_with_replys As $index => $views){
	   if(!isset($index)){
		   continue;
	   }
	       
		   $views_info = array_pop($views);
		   if(!isset($_SESSION) || !isset($_SESSION["comment_ids"]) || !isset($_SESSION[user::$id])){
			   
			    Errors::trigger_error(RETRY);
				return false;
		   }
		   
		   
		   $toggle_likes_count = "";
		   $likes_count_string = "";
		   $user_like_status   = "";
			
		   //if there are no likes yet
		   if(isset($views_info[Views::$alias_of_likes]) && $views_info[Views::$alias_of_likes] < 1 ){
			    $toggle_likes_count = " style= 'display:none;'";
			   $likes_count_string .= "<span class='likes_count'></span></a>";
			 
		   }
		 

		 // if you are the only one who liked it
		   if(isset($views_info[Views::$alias_of_likes]) && (int)$views_info[Views::$alias_of_likes] === 1){
			   
			     if(isset($views_likes_user_ids[$views_info[Views::$alias_of_id]]) && array_key_exists($views_info[Views::$alias_of_id],$views_likes_user_ids)){
					
			   $likes_count_string .= "<span class='likes_count liked' title='you liked this'>1</span></a>";
			   $user_like_status = "liked";
			   
				 }
			   
			  
			   // if you are not the one person that liked this
		   }elseif(isset($views_info[Views::$alias_of_likes]) && (int)$views_info[Views::$alias_of_likes] === 1 && !in_array($_SESSION[user::$id],$views_likes_user_ids[$views_info[Views::$alias_of_id]])){
			   $likes_count_string .= "<span class='likes_count' title='1 person like this'> 1 </span></a>";
			  
		   }
		  
		   // if there are many likes but the user is not part of 
		   // those who liked that comment
			elseif(isset($views_info[Views::$alias_of_likes]) && (int)$views_info[Views::$alias_of_likes] > 1 && !in_array((int)$_SESSION[user::$id],$views_likes_user_ids[$views_info[Views::$alias_of_id]])){
			   $likes_count_string .= "<span class='likes_count' title='".self::convert_likes_number($views_info[Views::$alias_of_likes])." people like this'> ".self::convert_likes_number($views_info[Views::$alias_of_likes])."  </span></a>";
			  
			
		   }
		   
		   // many likes with the user as part of the likers
		   elseif(isset($views_info[Views::$alias_of_likes]) && (int)$views_info[Views::$alias_of_likes] > 1 && in_array((int)$_SESSION[user::$id],$views_likes_user_ids[$views_info[Views::$alias_of_id]])){
			   
			    $likes_count_string .= "<span class='likes_count  liked' title='".self::convert_likes_number($views_info[Views::$alias_of_likes])." people like this'> ".self::convert_likes_number($views_info[Views::$alias_of_likes])."  </span></a>";
				$user_like_status = "liked";
			 
		   }
		     
			 $comment_id = $views_info[Views::$alias_of_id];
			 if(!in_array((int)$comment_id,$_SESSION["comment_ids"])){
				 
		   $_SESSION["comment_ids"][] =(int)$comment_id;
			 }
		   
		 $views_and_viewsbox_template_string .= "<div id='new_comment_".$views_info[Views::$alias_of_id]."' class='ps-comment-item cstream-comment stream-comment'>
	

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href=\"../public/".PROFILE_PAGE."?id=".$views_info[Views::$commentor_id]."\">".$views_info[Views::$alias_of_firstname]."  ".$views_info[Views::$alias_of_lastname]."</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p>".$views_info["comment"]." </p></div></span>
		</div>

		<div data-type='stream-more' class='cstream-more' ></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small class='activity-post-age' data-timestamp='1529076871'><span class='ps-js-autotime' data-timestamp='1529076871' title='".strftime("%B, %e    %G  %I:%M %p",$views_info["comment_time"])."'>".FetchPost::time_converter($views_info["comment_time"])."</span></small>

						<div id='comment_likes_count_{$comment_id}' class='ps-comment-links cstream-likes ' {$toggle_likes_count}>
						
				<a href='#showLikes'>{$likes_count_string}	</div>

			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a onclick='reaction.like({$post_id},{$comment_id},0,this,\"comment\");'  href='#like' class='actaction-like ps-icon-thumbs-up {$user_like_status}'> <span>Like</span></a>
<a  onclick='comment.showReplyBox(".$views_info[Views::$alias_of_id]."); return false;' href='#reply' class='actaction-reply ps-icon-plus'><span>Reply</span></a>
<a  onclick='comment.prepare_edit_comment({$post_id},{$views_info[Views::$alias_of_id]}, this,\"comment\"); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a  onclick='comment.delete_comment({$post_id},".$views_info[Views::$alias_of_id]."); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>";
	  
	 
	  $replys_result = ReplyViews::get_reply_template($post_id,$views_info[Views::$alias_of_id],$views,$reply_views_user_ids);
	  if($replys_result){
		  $views_and_viewsbox_template_string  .= $replys_result;
	  }else{
		  return false;
	  }
	  
	   }
	   
	   
	   
	 
}



// the commentbox(the comment text area);
	$views_and_viewsbox_template_string .= " </div>
	
	<div id='comment_area_wrapper_{$post_id}'  class='ps-comment-reply cstream-form stream-form wallform ps-js-comment-new'>
			
			<div class='ps-textarea-wrapper cstream-form-input'>
				<div class='ps-tagging-wrapper'><div class='ps-tagging-beautifier'></div><textarea id='comment_area_{$post_id}' class='ps-textarea cstream-form-text ps-tagging-textarea' name='comment'  oninput='utility.resizeTextarea(this);' onkeypress='comment.on_text_field_change(this);' maxlength='4000' placeholder='Write a comment...' style='overflow:hidden;'></textarea></div>
				<div class='ps-commentbox__addons ps-js-addons'>
<div class='ps-commentbox__addon ps-js-addon-giphy' style='display:none'>
	<div class='ps-popover__arrow ps-popover__arrow--up'></div>
	<img class='ps-js-img' alt='photo' src=''>
	<div class='ps-commentbox__addon-remove ps-js-remove'>
		<i class='ps-icon-remove'></i>
	</div>
</div>
<div class='ps-commentbox__addon ps-js-addon-photo' style='display:none'>
	<div class='ps-popover__arrow ps-popover__arrow--up'></div>

	<img class='ps-js-img' alt='photo' src='' data-id=''>

	<div class='ps-loading ps-js-loading'>
		<img src='assets/images/ajax-loader.gif' alt='loading'>
	</div>

	<div class='ps-commentbox__addon-remove ps-js-remove'>
		<input type='hidden' id='_wpnonce_remove_temp_comment_photos' name='_wpnonce_remove_temp_comment_photos' value='3ca8a9ab47'><input type='hidden' name='_wp_http_referer' value='/peepsoajax/activity.show_posts_per_page'>		<i class='ps-icon-remove'></i>
	</div>
</div>
</div>
<div class='ps-commentbox-actions'>
<a title='Upload photos' class='ps-postbox__menu-item '><span style=' position: absolute; right: .2em; bottom: .1em; background-color: #E3E5E7; padding: 0.1em; font-size: .7em !important; border-radius: 5px; color: black;'>4000</span></a>
<a onclick='return false;' title='Send gif' href='#' class='ps-list-item ps-js-comment-giphy'></a>
</div>
			</div>
			<div class='ps-comment-send cstream-form-submit' style='display:none;'>
				<div class='ps-comment-loading' style='display:none;'>
					<img src='assets/images/ajax-loader.gif' alt=''>
					
				</div>
				<div class='ps-comment-actions' style='display:none;'>
					<button onclick='return comment.cancel_comment({$post_id},this);' class='ps-btn ps-button-cancel'>Clear</button>
					<button onclick='return comment.post_comment({$post_id},this);' class='ps-btn ps-btn-primary ps-button-action'>Post</button>
				</div>
			</div>
		</div>
	
	
	
	";
		
		
	   return $views_and_viewsbox_template_string;
   }// get_views_with_replys();
   
   
  public static function get_view($comment_id = 0,$post_id = 0){
	  global $db;
	 
	  $post_id = (int)$post_id;
	   if(!isset($post_id) || $post_id < 1 || !is_integer($post_id)){
		 return false;
	   }
	 // find aliases for the db columns just for the sake of security
	  $query = "SELECT ".self::$id." AS comment_id,".self::$post_id." AS incident_id,".self::$firstname.",".self::$lastname.",".self::$commentor_id.",".self::$comment.", ".self::$comment_time." ,".self::$likes." AS c_likes FROM ".self::$table_name." WHERE ".self::$post_id." = {$post_id} && id ={$comment_id} LIMIT 1";
	  $result = $db->query($query);
	  
	  if(!$result){
			Errors::trigger_error(RETRY);
		  return false;
		}
	  
	  
	 
	  if($row = $result->fetch_assoc()){
 
    return $row;

		}
		return [];
	 
  }// get_view();
   
   
 // add a new comment to the database
  public static function add_views($post_id = 0,$comment = ""){

    global $db;
	
	$post_id = $db->real_escape_string($post_id);
	
	
	if(!isset($_SESSION) || !isset($_SESSION[user::$id]) || $_SESSION[user::$id] < 1 || !isset($_SESSION[user::$firstname]) || !isset($_SESSION[user::$lastname]) || empty(trim($_SESSION[user::$lastname])) || empty(trim($_SESSION[user::$lastname]))){
		  
		Errors::trigger_error(INVALID_SESSION);
		 return false;
	 }
	 

	// the insert query for the new comment	
	$query = "INSERT INTO ".self::$table_name." VALUES(?,?,?,?,?,?,?,?)";

	// prepare the new comment statement
	$stmt = $db->prepare($query);


	if(!$stmt){
		Errors::trigger_error(RETRY);
	
		return false;
	} 

	
	// assign the parameters
	$id        = NULL;
	$time      = time();
	$user_id   = $_SESSION[user::$id];
	$firstname = $_SESSION[user::$firstname];
	$lastname  = $_SESSION[user::$lastname];
	$likes     = "likes + 1";


	// bind the parameters
	$bound_parameters = $stmt->bind_param("sissisii",$id,$post_id,$firstname,$lastname,$user_id,$comment,$time,$likes);
	if(!$bound_parameters){
		Errors::trigger_error(RE_INITIATE_OPERATION);
	
         return false;
		}
	// execute the statement
	if(!$stmt->execute()){
		Errors::trigger_error(RETRY);
		return false;
	}
	// return a new_comment_id  in case the id is to be used to delete the comment
	$view_id = $stmt ->insert_id;
	if($view_id == true){
		 
		$view_info = self::get_view($view_id,$post_id);
	    $post_date  = strftime("%B, %e    %G  %I:%M %p",$view_info["comment_time"]);
		    
        $_SESSION["comment_ids"][] = (int)$view_info["comment_id"];
    $view_info["c_time"] = FetchPost::time_converter($view_info["comment_time"]);
	print j(["comment_div_id" => "new_comment_{$view_id}","comment_info" => $view_info,"fullname" => $firstname." ".$lastname,"comment_date" => $post_date]);

	  Notifications::send_notification($post_id,$view_info["comment_id"],"NULL",$user_id,NEW_COMMENT);

		
 }else{
	Errors::trigger_error(RETRY);
	 return false;
 }   
    
 }// add_view();


// update the view being
public static function update_view($view_id = null,$post_id = null,$link_type = null){

   global $db;
   $view_id = $view_id;
  echo $view_id." ".$post_id." ".$link_type;
$info = json_encode([(int)$view_id,(int)$post_id,$link_type]);
$query = "CALL update_view(?)";


$stmt = self::S_query($query);

if(!$stmt){

	die("Preparation failed: update_view() Views || ".$db->error);

}


if(!$stmt->bind_param("s",$info)){

 die("Binding failed: update_view() Views || ".$stmt->error);
}

if(!$stmt->execute()){

 die("Execution failed: update_view() Views || ".$stmt->error);
}

// if(!$stmt->bind_result($result)){

//  die("binding failed: update_view() Views || ".$stmt->error);
// }

// if($stmt->fetch()){

//  return $result;
// }

return $stmt->get_result();

}//update_view();


// edit the view
public static function edit_view($postCommentID = 0,$commentReplyID = 0,$commentReply = "",$option = null){
 
	  global $db;
	    
	$commentReply = $db->real_escape_string(str_replace("\n","",$commentReply));
	 $query = "";
			
	 
	 if(!isset($_SESSION) || $_SESSION[user::$id] < 1 ){

	 }


	 $user_id = $_SESSION[user::$id];
	 $time    = time();
	 // set the edit view as the default
	 if(!isset($option) || $option == null || trim($option) == "view"){
		 //set the query for the edit_view  routine
	  $query = "CALL edit_view('".j([$postCommentID,$commentReplyID,$user_id,$commentReply,$time])."')";
	 }elseif(isset($option) && trim($option) != "" && trim($option) == "reply"){
		 // set the query for the edit_reply routine
		  $query = "CALL edit_reply('".j([$postCommentID,$commentReplyID,$user_id,$commentReply,$time])."')";
	 }else{
	
		  Errors::trigger_error(SERVER_ERROR);
		 return;
	 }
	 
	
	 
  $result = $db->multi_query($query);
   do{
	   if($result = $db->store_result()){
		   if($row  = $result->fetch_assoc()){
				// send the response to the client
				if(isset($row["comment"]) && trim($row["comment"]) != ""){
					print j(["true" => $row["comment"]]);
					// send an appropriate notification to the appropriate 
					Notifications::send_notification($postCommentID,$commentReplyID,$user_id,EDITTED_COMMENT,$time);
					return;
				}elseif(isset($row["reply"]) && trim($row["reply"]) != ""){
					print j(["true" => $row["reply"]]);
					// send an appropriate notification to the appropriate 
					Notifications::send_notification(NULL,$postCommentID,$commentReplyID,$user_id,EDITTED_REPLY,$time);
					return;
				}else{
					Errors::trigger_error(RETRY);
					return;
				}
			  
			 
			 }

			 
			 
		}elseif(trim($db->error) != ""){
	  Errors::trigger_error(SERVER_PROBLEM);
	  return;
		}
		
		
   }while($db->more_results() && $db->next_result()); 
  


}// edit_view();



// add a reaction to the view
public static function  add_view_reaction($info =""){

	global $db;


$info = explode("\\", $info);

$info[0] = $_SESSION["id"];
$info = implode("",$info);
 

$query = "CALL reaction_on_view(?)";


$stmt = self::S_query($query);

if(!$stmt){

 die("Prepartion failed: add_view_reaction(): Views.. ".$db->error." @ line ".__LINE__." on file ".__FILE__);
}

if(!$stmt->bind_param("s",$info)){

	die("Binding failed: add_view_reaction(): Views ".$stmt->error." on line ".__LINE__." in file :".__FILE__);

}

if(!$stmt->execute()){

	die("Execution failed: add_view_reaction(): Views ".$stmt->error." on line ".__LINE__." in file: ".__FILE__);
}

if(!$stmt->bind_result($support,$oppose)){

die("Binding result failed: add_view_reaction() : Views ".$stmt->error." on line ".__LINE__."in file ".__FILE__);
}

if($stmt->fetch()){

 return [$support,$oppose];
}
}


// delete a view
public static function delete_view ($post_id = 0 ,$comment_id = 0){
	
	global $db;
	
   
	
  if(!isset($_SESSION) || $_SESSION[user::$id] < 1){
	Errors::trigger_error(RETRY);
	return;
	}

	$post_id     = $db->real_escape_string($post_id);
	$comment_id    = $db->real_escape_string($comment_id);	
	$user_id      =  $_SESSION[user::$id];
	
	// query to delete a comment and it's associated replys
	$query  = "DELETE FROM ".self::$table_name." WHERE id = {$comment_id} && post_id = {$post_id} && commentor_id = {$user_id}";

	if($result = $db->query($query)){
    if($db->affected_rows == 1 && $db->error == ""){
				print j(["comment_delete"=>"success"]);
				Notifications::send_notification($post_id,$comment_id,"NULL",$user_id,$_SESSION[user::$firstname],$_SESSION[user::$lastname],DELETE_VIEW);
				return;
			}
		
}				
		
		Errors::trigger_error(RE_INITIATE_OPERATION);	


}// delete_view();




 // convert the number of likes 
   public static function convert_likes_number($likes = 0){
	     $thousand = 1000;
		 $million = 1000000;
	   
	    if(!isset($likes)  || $likes == 0){
			return;
		}elseif($likes < 1000){
			
			return $likes;
		}elseif($likes >= $thousand && $likes < $million){
		  return round($likes / $thousand,1,PHP_ROUND_HALF_UP)."k";
			
		}elseif($likes >= $million){
			 return round($likes / $thousand,1,PHP_ROUND_HALF_UP)."m";
		}
			
   

	 }//convert_likes_number();
	 










}




?>