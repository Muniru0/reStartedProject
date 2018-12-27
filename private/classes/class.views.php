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
   

   // get all the views for some specific post_ids
   public static function get_views($post_ids = []) {
	   global $db;
	   
	   $query = "SELECT ".self::$table_name.".*,firstname,lastname FROM ".self::$table_name." JOIN ".Users::$table_name." ON ".Users::$table_name.".id = ".self::$table_name.".commentor_id WHERE ";
	   foreach($post_ids as $post_id)
	{
		$query .= " post_id = {$post_id} ||";
		
	}
	
	
	// remove the last '||' from the $query string.
	 $query = substr_replace($query,'',-2, 2);
	  

     if(!($result = $db->query($query)))
	 {
		 log_ation(__CLASS__," Query failed with db error '{$db->error}' on line  ".__LINE__." on file ".__FILE__);
	 } 	  
	   
	    $comments_template_string = "<div class='ps-comment cstream-respond wall-cocs' id='wall-cmt-482'";
	   while($row = $result->fetch_array(MYSQLI_ASSOC)){
		   
		 $comments_template_string .= "<div class=\"ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--482\" data-act-id=\"482\">
			<div id=\"comment-item-931\" class=\"ps-comment-item cstream-comment stream-comment\" data-comment-id=\"931\">
	<div class=\"ps-comment-body cstream-content\">
		<div class=\"ps-comment-message stream-comment-content\">
			<a class=\"ps-comment-user cstream-author\" href=\" ://demo.peepso.com/profile/william/\">{$row["firstname"]} {$row["lastname"]}</a>
			<span class=\"ps-comment__content\" data-type=\"stream-comment-content\"><div class=\"peepso-markdown\"><p>{$row['comment']}</p></div></span>
		</div>

		<div data-type=\"stream-more\" class=\"cstream-more\" data-commentmore=\"true\"></div>

		

		<div class=\"ps-comment-time ps-shar-meta-date\">
			<small class=\"activity-post-age\" data-timestamp=\"1529076577\"><span class=\"ps-js-autotime\" data-timestamp=\"1529076577\" title=\"".strftime("%B, %e   &nbsp; &nbsp; %G  %i:%M:%S %P",$row["comment_time"])."\">".self::time_converter($row["comment_time"])."</span></small>

						<div id=\"act-like-493\" class=\"ps-comment-links cstream-likes ps-js-act-like--493\" data-count=\"2\">
				<a onclick=\"return activity.show_likes(493);\" href=\"#showLikes\">2 people like this.</a>			</div>

			<div class=\"ps-comment-links stream-actions\" data-type=\"stream-action\">
				<span class=\"ps-stream-status-action ps-stream-status-action\">
					<nav class=\"ps-stream-status-action ps-stream-status-action\">
<a data-stream-id=\"931\" onclick=\"activity.comment_action_like(this, 493); return false;\" href=\"#like\" class=\"actaction-like liked ps-icon-thumbs-up\"><span><span title=\"2 people like this\">Like</span></span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_report(493); return false;\" href=\"#report\" class=\"actaction-report ps-icon-warning-sign\"><span>Report</span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_reply(493, 931, this, { id: 6, name: 'William Torres' }); return false;\" href=\"#reply\" class=\"actaction-reply ps-icon-plus\"><span>Reply</span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_edit(931, this); return false;\" href=\"#edit\" class=\"actaction-edit ps-icon-pencil\"><span>Edit</span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_delete(931); return false;\" href=\"#delete\" class=\"actaction-delete ps-icon-trash\"><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>


		</div>";
	   }
	   
	   $comments_template_string .= "<div class='ps-stream-actions stream-actions' data-type='stream-action'><nav class='ps-stream-status-action ps-stream-status-action'>
<a data-stream-id='498' onclick='return reactions.action_reactions(this, 498);' href='javascript:' class='ps-reaction-toggle--498 ps-reaction-emoticon-0 ps-js-reaction-toggle ps-icon-reaction'><span>Like</span></a>
<a data-stream-id='498' onclick='return activity.action_report(498);' href='#report' class='actaction-report ps-icon-warning-sign'><span>Report</span></a>
</nav>
</div>
  <div class=\"ps-comment cstream-respond wall-cocs\" id=\"wall-cmt-498\">
		<div class=\"ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--498\" data-act-id=\"498\">
					</div>

						<div id=\"act-new-comment-498\" class=\"ps-comment-reply cstream-form stream-form wallform ps-js-comment-new ps-js-newcomment-498\" data-id=\"498\" data-type=\"stream-newcomment\" data-formblock=\"true\">
			<a class=\"ps-avatar cstream-avatar cstream-author\" href=\" ://demo.peepso.com/profile/demo/\">
				<img data-author=\"4\" src=\" ://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg\" alt=\"\">
			</a>
			<div class=\"ps-textarea-wrapper cstream-form-input\">
				<div class=\"ps-tagging-wrapper\"><div class=\"ps-tagging-beautifier\"></div><textarea data-act-id=\"498\" class=\"ps-textarea cstream-form-text ps-tagging-textarea\" name=\"comment\" oninput=\"return activity.on_commentbox_change(this);\" placeholder=\"Write a comment...\" style=\"height: 35px;\"></textarea><input type=\"hidden\" class=\"ps-tagging-hidden\"><div class=\"ps-tagging-dropdown\"></div></div>
				<div class=\"ps-commentbox__addons ps-js-addons\">
<div class=\"ps-commentbox__addon ps-js-addon-giphy\" style=\"display:none\">
	<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>
	<img class=\"ps-js-img\" alt=\"photo\" src=\"\">
	<div class=\"ps-commentbox__addon-remove ps-js-remove\">
		<i class=\"ps-icon-remove\"></i>
	</div>
</div>
<div class=\"ps-commentbox__addon ps-js-addon-photo\" style=\"display:none\">
	<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>

	<img class=\"ps-js-img\" alt=\"photo\" src=\"\" data-id=\"\">

	<div class=\"ps-loading ps-js-loading\">
		<img src=\"assets/images/ajax-loader.gif\" alt=\"loading\">
	</div>

	<div class=\"ps-commentbox__addon-remove ps-js-remove\">
		<input type=\"hidden\" id=\"_wpnonce_remove_temp_comment_photos\" name=\"_wpnonce_remove_temp_comment_photos\" value=\"3ca8a9ab47\"><input type=\"hidden\" name=\"_wp_http_referer\" value=\"/peepsoajax/activity.show_posts_per_page\">		<i class=\"ps-icon-remove\"></i>
	</div>
</div>
</div>

			</div>
			<div class=\"ps-comment-send cstream-form-submit\" style=\"display:none;\">
				<div class=\"ps-comment-loading\" style=\"display:block;\">
					<img src=\"assets/images/ajax-loader.gif\" alt=\"\">
					<div> </div>
				</div>
				<div class=\"ps-comment-actions\" style=\"display:block;\">
					<button onclick=\"return activity.comment_cancel(498);\" class=\"ps-btn ps-button-cancel\">Clear</button>
					<button onclick=\"return activity.comment_save(498, this);\" class=\"ps-btn ps-btn-primary ps-button-action\" disabled=\"\">Post</button>
				</div>
			</div>
		</div>
			</div>

";
	   
   }// get_views();
   
   
   
   
 // add a new comment to the database
  public static function add_view($post_id = 0,$commentor_id = 0,$comment = "", $comment_time = 0){

    global $db;
	
	if((!isset($post_id) && $post_id < 1) || !is_array($post_ids))
		{
			return "";
			
		}
       
	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,$post_id,$commentor_id,$comment,$comment_time) ";
	
   if(!$db->query($query))
   {
	   log_action(__CLASS__," Query failed on line ".__LINE__." in file ".__FILE__);
	   print j(["false" => "Please is us not you please try again."]);
	   return false;
   }
   
   return $db->insert_id;
 

}




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



public static function edit_view($view_id = null,$post_id = null,$link_type = null,$view){


	global $db;
 
 $time = time();
 $info = json_encode([$view_id,$post_id,$link_type,$view,$time]);

	$query = "CALL edit_view(?)";


$stmt = self::S_query($query);

	if(!$stmt){

  die("Preparation failed: edit_view() Views|| ".$db->error);
	}

	if(!$stmt->bind_param("s",$info)){

  die("binding failed: edit_view() Views || ".$stmt->error);
	}

	if(!$stmt->execute()){

   die("Execution failed: edit_view() Views || ".$stmt->error);
	}

}




public static function  add_view_reaction($info =""){

	global $db;


$info = explode("\\", $info);
//$info = implode("/",$info);
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


}




?>