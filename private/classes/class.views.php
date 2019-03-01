<?php

require_once(PRIVATE_DIR."initialize.php");

class Views extends DatabaseObject{

   public static $table_name   = "views";

   //columns in database
   public static $id           = "id";
   public static $post_id      = "post_id";
   public static $comment      = "comment";
   public static $commentor_id = "commentor_id";
   public static $comment_time = "comment_time";
   
   //columns aliases in database
   public static $alias_of_id           = "views_table_id";
   public static $alias_of_post_id      = "views_table_post_id";
   public static $alias_of_comment      = "views_table_comment";
   public static $alias_of_commentor_id = "views_table_commentor_id";
   public static $alias_of_comment_time = "views_table_comment_time";
   

   // get all the views for some specific post_ids
   public static function get_views_with_replys($post_id , $views_with_replys) {
	  
	   if(empty($post_id)  || $post_id < 1 ){
		   log_action(__CLASS__, " View with this post id is zero (".$post_id.") on line: ".__LINE__." in file: ".__FILE__);
		   print j(["false" =>"Sorry server problem,please try again, if problem persists refresh the page."]);
		   return;
		 
	   }
	   
	   if(!is_array($views_with_replys) || in_array(0,$views_with_replys)){
		   log_action(__CLASS__, "on one the views with the post id as (".$post_id.") has an index as zero or the array of views and replys is not an array on line: ".__LINE__." in file: ".__FILE__);
		   print j(["false" =>"Sorry server problem,please try again, if problem persists refresh the page."]);
		   return;
	}
	   
     	 
	 $views_and_viewsbox_template_string = "<div class='ps-comment comment-sidebar cstream-respond wall-cocs' id='wall-cmt-{$post_id}' >
		<div class='ps-comment-container comment-container ps-js-comment-container'> ";
		
		if(!empty($views_with_replys) && is_array($views_with_replys) 
			&&  (int)$post_id < 1 && isset($views_with_replys["postID_{$post_id}"])){
		
	   foreach($views_with_replys As $view => $replys){
		   $view_info = array_pop($view);
		   
		 $views_and_viewsbox_template_string .= "<div id='new_comment_'{$post_id} class='ps-comment-item cstream-comment stream-comment'  style='display:none;'>
	

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href=' ://demo.peepso.com/profile/demo/'>Patricia Currie</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p>".$views_info["comment"]." </p></div></span>
		</div>

		<div data-type='stream-more' class='cstream-more' ></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small class='activity-post-age' data-timestamp='1529076871'><span class='ps-js-autotime' data-timestamp='1529076871' title='".strftime("%B, %e    %G  %I:%M %p",$view_info["comment_time"])."'>".FetchPost::time_converter($view_info["comment_time"])."</span></small>

						<div id='act-like-497' class='ps-comment-links cstream-likes ps-js-act-like--497' data-count='1'>
				<a onclick='' href='#showLikes'>1 person likes this</a>			</div>

			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a  onclick='activity.comment_action_like(this, 497); return false;' href='#like' class='actaction-like ps-icon-thumbs-up'><span><span title='1 person likes this'>Like</span></span></a>
<a  onclick='comment.showReplyBox({$view_info["comment_id"]}); return false;' href='#reply' class='actaction-reply ps-icon-plus'><span>Reply</span></a>
<a  onclick='comment.prepare_edit_comment({$post_id},{$view_info["comment_id"]},this,'comment'}, this); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a  onclick='comment.delete_comment({$post_id},{$view_info["comment_id"]}); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>";
	   }
	   
	   
	   
	 
}


  $views_and_viewsbox_template_string .= " <div id='comment_area_wrapper_{$post_id}'  class='ps-comment-reply cstream-form stream-form wallform ps-js-comment-new'>
			
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
		</div></div>";
		
		
	   return $views_and_viewsbox_template_string;
   }// get_views_with_replys();
   
   
  public static function get_view($comment_id,$post_id = 0){
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
	 
	 
  }// get_view();
   
   
 // add a new comment to the database
  public static function add_views($post_id = 0,$comment = ""){

    global $db;
	
	$post_id = $db->real_escape_string($post_id);
	
	// the insert query for the new comment	
	$query = "INSERT INTO ".self::$table_name." VALUES(?,?,?,?,?)";
	// prepare the new comment statement
	if(!($stmt= $db->prepare($query))){
		log_action(__CLASS__, " Query failed {$db->error} on line ".__LINE__." in file ".__FILE__);
		return false;
	} 
	
	// assign the parameters
	$id = NULL;
	$time = time();
	$user_id = $_SESSION["id"] ? $_SESSION["id"] : 0;
	
	if($user_id === 0 || $id !== NULL || strlen($time) < 10 ){
		 print j(["false" =>"Something Unexpectedly went wrong, please refresh the page and try again"]);
		 
	 }
	
	// bind the parameters
	if(!$stmt->bind_param("iiisi",$id,$post_id,$_SESSION["id"],$comment,$time)){
		log_action(__CLASS__," Query failed {$db->error} on line ".__LINE__." in file ".__FILE__);
         return false;
		}
	// execute the statement
	if(!$stmt->execute()){
		log_action(__CLASS__,"  Query failed {$db->error} on line ".__LINE." in file ".__FILE__);
		return false;
	}
	// return a new_comment_id  in case the id is to be used to delete the comment
	$view_id = $stmt ->insert_id;
	if($view_id == true){
		 
		$view_info = self::get_view($view_id,$post_id);
	    $post_date  = strftime("%B, %e    %G  %I:%M %p",$view_info[4]);
		
        $_SESSION["comment_ids"][] = (int)$view_info[0];
    $view_info[4] = FetchPost::time_converter($view_info[4]);
	print j(["comment_div_id" => "new_comment_{$view_id}","comment_info" => $view_info,"fullname" => $_SESSION["firstname"]." ".$_SESSION["lastname"],"comment_date" => $post_date]);
 }else{
	 log_action(__CLASS__," Query failed {$db->error} on line ".__LINE__." in file ".__FILE__);
	 print j(["false" => "Sorry please re-comment..."]);
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
	    
	 // set the edit view as the default
	 if(!isset($option) || $option == null || trim($option) == "view"){
		 //set the query for the edit_view  routine
	  $query = "CALL edit_view('".j([$postCommentID,$commentReplyID,$_SESSION["id"],$commentReply,time()])."')";
	 }elseif(isset($option) && trim($option) != "" && trim($option) == "reply"){
		 // set the query for the edit_reply routine
		  $query = "CALL edit_reply('".j([$postCommentID,$commentReplyID,$_SESSION["id"],$commentReply,time()])."')";
	 }else{
		 print j(["false" => "Server problem, please refresh the page and try again if the problem persists."]);
		 return;
	 }
	 
	 if($db->error != ""){
		 log_action(__CLASS__," Query encountered an error: $db->error"." on line: ".__LINE__." in file: ".__FILE__);return;
	 }
	 
	 
  $result = $db->multi_query($query);
   do{
	   if($result = $db->store_result()){
		   if($row  = $result->fetch_assoc()){
			   // print back the result to the client side
			  print j(["true" => $row["comment"]]);
		   }
		}elseif(trim($db->error) != ""){
			 print j(["false" => "Server problem, please refresh the page and try again if the problem persist."]);
			log_action(__CLASS__," Query encountered an error: $db->error"." on line: ".__LINE__." in file ".__FILE__);
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
public static function delete_view ($postCommentID = 0 ,$commentReplyID = 0,$flag = ""){
	
	global $db;
	
    $postCommentID     = $db->real_escape_string($postCommentID);
    $commentReplyID    = $db->real_escape_string($commentReplyID);	
	
/* 	$post_id     = (int) $post_id;
	$comment_id  = (int) $comment_id; */
	
	 if(trim($flag) === "comment"){
	// query to delete a comment and it's associated replys
	$query  = "DELETE FROM ".self::$table_name." WHERE id = $commentReplyID && post_id = $postCommentID && commentor_id = ".$_SESSION["id"].";";
	$query .= "DELETE FROM ".ReplyViews::$table_name." WHERE post_id = {$postCommentID} && comment_id = {$commentReplyID} && user_id = ".$_SESSION["id"];
	
	// query to delete a reply
	}elseif(trim($flag) === "reply"){
	// query to be executed if the call was made to delete a reply
	$query  = "DELETE FROM ".ReplyViews::$table_name." WHERE id = $commentReplyID && comment_id = $commentReplyID && user_id = ".$_SESSION["id"];
	}
	  
	  if($db->multi_query($query)){
		  
		  do{
			  // echo $db->affected_rows;
			  // store first result
		  if($result = $db->use_result()){
			 // clean up the resources  
			$result->close();
		  }elseif(trim($db->error) != "")
			{
			// check if mysql does not return an empty string as a result since operations like insert and
			// delete will make multi_query return false
		    log_action(__CLASS__,"Query failed: $db->error on line :".__LINE__." in file: ".__FILE__);
				   print j(["false" => "Something went wrong Please try again... if problem persist refresh the page"]);
				   break;
			}
		  if(!$db->more_results() && $db->error == ""){
			  print j([true]);
            break;			  
		  }
		 }while($db->next_result());
		  
}else{
	print j(["false" => "Something went wrong please try again... if the problem persist refresh the page1"]);
}
	  
	
}





}




?>