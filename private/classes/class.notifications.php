<?php
require_once(PRIVATE_DIR.'initialize.php');





class Notifications extends DatabaseObject {

     
	 public static $table_name = 'notifications';
	 
	 public static $id           = 'notifications_id';
	 public static $post_id      = 'notifications_post_id';
	 public static $comment_id   = 'notifications_comment_id';
	 public static $reply_id     = 'notifications_post_id';
	 public static $user_id      = 'notifications_user_id';
   public static $firstname    = 'notifications_firstname';
   public static $lastname     = 'notifications_lastname';
   public static $type         = 'notifications_type';
   public static $time         = 'notifications_time';
	

	 //healper properties
	 public static $last_notification_check_time = "last_notifcation_check_time";




  public  static function send_notification($post_id =  "NULL",$comment_id = "NULL",$reply_id = "NULL",$type = ''){
	
		global $db;

		  if(!isset($_SESSION[user::$id]) || !isset($_SESSION[user::$firstname]) || !isset($_SESSION[user::$lastname])){
			
				 Errors::trigger_error(INVALID_SESSION);
				return false;
			}

	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,{$post_id},{$comment_id},{$reply_id},".$_SESSION[user::$id].",'".$_SESSION[user::$firstname]."','".$_SESSION[user::$lastname]."','".$type."',".time().") ON DUPLICATE KEY UPDATE ".self::$id." = ".self::$id." + 1";
	
	$result = $db->query($query);
	if(!$result){
		
 log_action(__CLASS__,"FAILED NOTIFICATION: post_id:{$post_id}, commment_id: {$comment_id}, reply_id: {$reply_id}, user_id: ".$_SESSION[user::$id]." type: {$type} ");
		return false;
	}else{

		return $db->insert_id;
	}
	
	$result->free();
	
	return false;
	
}// send_notification();	 




public static function get_latest_notifications(){
	
	
	global $db;

	if(!isset($_SESSION) || !isset($_SESSION[user::$id])){
        Errors::trigger_error(INVALID_SESSION);
		return;
		}
	


	$query = "
	SELECT ".self::$table_name.".* FROM ".self::$table_name." WHERE ".self::$user_id." IN (SELECT ".ConnectUsers::$followed_id." FROM ".ConnectUsers::$table_name.") || ".self::$post_id." IN (SELECT ".FollowPost::$post_id." FROM ".FollowPost::$table_name." WHERE ".FollowPost::$follower_id." = ".$_SESSION[user::$id].")";


	$query  = "SELECT notifications.*,views.commentor_id AS views_commentor_id, reply_views.user_id AS reply_views_user_id, post_table.uploader_id AS post_table_uploader_id FROM notifications JOIN follow_posts ON follow_posts_follower_id = notifications_user_id LEFT JOIN connect_users ON notifications_user_id = connect_users_followed_id LEFT JOIN post_table ON notifications_post_id = post_table.id LEFT JOIN views ON views.id = notifications_comment_id LEFT JOIN reply_views ON reply_views.id = notifications_reply_id WHERE (follow_posts_follower_id = ".$_SESSION[user::$id]." || connect_users_followed_id = ".$_SESSION[user::$id].")   ORDER BY notifications_time DESC ";

  if($result = $db->query($query)){

  
  if($result->num_rows > 0 && trim($db->error) == ""){
	  $array = [];
    while($row = $result->fetch_assoc()){
		  if(array_key_exists($row[self::$id],$array)){
   					continue;
			}
		$restructured_notifications_row = [];

		if(isset($row[self::$id]) && $row[self::$id] != null){
			
			$restructured_notifications_row["id"] = $row[self::$id];   
        
		}
		if(isset($row[self::$post_id]) && $row[self::$post_id] != null){
			
	     	$restructured_notifications_row["incident_id"] = $row[self::$post_id];	   
        
		}
		if(isset($row[self::$comment_id]) && $row[self::$comment_id] != null){
			
			$restructured_notifications_row["comment_id"] = $row[self::$comment_id];	   	   
        
		}
		if(isset($row[self::$reply_id]) && $row[self::$reply_id] != null){
			
			$restructured_notifications_row["reply_id"] = $row[self::$reply_id];
        
		}
		if(isset($row[self::$user_id]) && $row[self::$user_id] != null){
			
			$restructured_notifications_row["user_id"] = $row[self::$user_id];
        
		}
		
		if($row[self::$firstname] != null
		 && $row[self::$lastname] != null){
			
			$restructured_notifications_row["fullname"] = $row[self::$firstname] ." ".$row[self::$lastname];
        
		}
		
		if(isset($row[self::$type]) && $row[self::$type] != null){
			
			$restructured_notifications_row["notification_string"] = self::get_notification_type_string($row[self::$type],$row["post_table_uploader_id"],$row["views_commentor_id"],$row["reply_views_user_id"]);
            
		}
		if(isset($row[self::$time]) && $row[self::$time] != null){
			
			$restructured_notifications_row["time"] = $row[self::$time];
			   
        
		}




		$array[$row[self::$id]] = $restructured_notifications_row;
	}
	 
	echo "<pre>";
	print_r($array);
	echo  "</pre>";
  }


   unset($array);
   $result->free();

}else{
	echo $db->error." ".__LINE__;
	Errors::trigger_error(RE_INITIATE_OPERATION);
}

}//get_notifications();



	// get the notification type string
public static function get_notification_type_string($type = "",$uploader_id = NULL, $commentor_id = NULL, $replier_id = NULL){
 		if(trim($type) == "" || ($uploader_id  == NULL && $commentor_id == NULL && $replier_id == NULL)){
       return "Please Ignore This Notification.";
  }


   switch($type){

	case NEW_COMMENT: 
    if($commentor_id == $_SESSION[user::$id]){
  return " commented on your post ";
	}else{
	return	" commented on a post";
	}
 break;
	case EDITTED_COMMENT: 
		return " edited a comment ";
		break;

	 default: return "Please Ignore This Notification.";
	 

   }



}



public static function get_notification_template(){
	
	
	return "<div id='notification_template' class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=''>
		
		

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>".$_SESSION[user::$firstname]." ".$_SESSION[user::$lastname]."</strong> Ignore this notification
						</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>System time</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>";
}// get_notification_template();




// clear all the old notifications
public static function clear_old_notifications(){
	 global $db;
	 
	 // clear all notifications that are 6  months or more old
	 $db->query("DELETE FROM ".self::$tabl_name." WHERE ".self::$time." < ".(time() * 60 * 60 * 24* 7 * 4 * 6) - time());

if(trim($db->error) !=  ""){
	
	print j(["false" => "Operation failed."]);
	return;
}

print j(["true" => "Operation successful."]);
	
}





}
	











?>