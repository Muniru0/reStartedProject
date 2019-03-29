<?php
require_once(PRIVATE_DIR.'initialize.php');





class Notifications extends DatabaseObject {

     
	 public static $table_name = 'notifications';
	 
	 public static $id           = 'notifications_id';
	 public static $post_id      = 'notifications_post_id';
	 public static $comment_id   = 'notifications_comment_id';
	 public static $reply_id     = 'notifications_post_id';
	 public static $user_id      = 'notifications_user_id';
     public static $firstname    = 'notifications_notification_firstname';
     public static $lastname     = 'notifications_notification_lastname';
     public static $type         = 'notifications_notification_type';
     public static $time         = 'notifications_notification_time';
	

	 //healper properties
	 public static $last_notification_check_time = "last_notifcation_check_time";

  public  static function send_notification($post_id =  "NULL",$comment_id = "NULL",$reply_id = "NULL",$user_id = 0,$type = ''){
	global $db;
	

	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,{$post_id},{$comment_id},{$reply_id},{$user_id},'".$type."',".time().")";
	

	if(!$db->query($query)){
        
		
		return false;
	}else{
		return $db->insert_id;
	}
	
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


  if($result = $db->query($query)){

  
  if($result->num_rows > 0 && trim($db->error) == ""){
	  $array = [];
    while($row = $result->fetch_assoc()){
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
		
		if(isset($row[self::$firstname]) && $row[self::$firstname] != null){
			
			$restructured_notifications_row["firstname"] = $row[self::$firstname];
        
		}
		if(isset($row[self::$lastname]) && $row[self::$lastname] != null){
			
			$restructured_notifications_row["lastname"] = $row[self::$lastname];
			   
        
		}

		if(isset($row[self::$type]) && $row[self::$type] != null){
			
			$restructured_notifications_row["notification_string"] = self::get_notification_type_string($row[self::$type]);
            
		}
		if(isset($row[self::$time]) && $row[self::$time] != null){
			
			$restructured_notifications_row["time"] = $row[self::$time];
			   
        
		}




		$array[] = $restructured_notifications_row;
	}
   
	print_r($array);
  }


   unset($array);
   $result->free();

}else{
	echo "$db->error";
	Errors::trigger_error(RE_INITIATE_OPERATION);
}

}//get_notifications();



	// get the notification type string
public static function get_notification_type_string($type = "",$user_id){
 		if(trim($type) == "" || $user_id < 1){
       return "Please Ignore This Notification.";
  }


   switch($type){

	case NEW_COMMENT: 
    if($user_id === $_SESSION[user::$id]){
   " commented on ";
	}

   }



}

public static function personal_styled_notification_template(){

	return "<div style='
    height: 3em;
    width: 100%;
    padding: 0.2em;
    border-bottom: 0.09em solid #efefef;
    padding-left: 0.6em;
    line-height: 1.2em;
    background: aliceblue;
    /* color: #8f2727; */
    /* display: inline-flex; */
    /* font-weight: 600; */
'><span style='
    color: #8f2727;
    font-weight: 600;
    height: 40%;
    margin-right: 0.5em;
    '>Yussif Muniru</span><p style='
    height: 40%;
    display: inline;
    font-size: 90%;
    '> commented on a sanitation incident: </p><p style='
    margin-top: 0.2em;
    text-align: center;
'>How can the world leave like this</p></div>";
}


public static function get_notification_template(){
	
	
	return "
	
<div class='ps-popover app-box' style='display:block;'>
<div class='ps-notifications' style='max-height: 40vh; overflow: auto;'>
<div class='ps-notification ps-notification--unread'>
   <a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
	   

	   <div class='ps-notification__body'>
		   <div class='ps-notification__desc'>
			   <strong>William</strong>
			   liked your comment on your post			</div>

		   <div class='ps-notification__meta'>
			   <small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

							   <span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
				   <i class='ps-icon-eye'></i>
				   <span>Mark as read</span>
			   </span>
						   </div>
	   </div>
   </a>
</div>
   
   
   <div class='ps-popover app-box' style='display: block;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'>


   </div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></div></div>";
}// get_notification_template();







}
	











?>