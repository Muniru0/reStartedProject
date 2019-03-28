<?php
require_once(PRIVATE_DIR.'initialize.php');





class Notifications extends DatabaseObject {

     
	 public static $table_name = 'notifications';
	 
	 public static $id         = 'id';
	 public static $post_id    = 'post_id';
	 public static $user_id    = 'user_id';
     public static $type       = 'notification_type';
     public static $time       = 'notification_time';

	 public static $alias_of_id         = 'notifcations_table_id';
	 public static $alias_of_post_id    = 'notifcations_table_post_id';
	 public static $alias_of_user_id    = 'notifcations_table_user_id';
     public static $alias_of_type       = 'notifcations_table_notification_type';
     public static $alias_of_time       = 'notifcations_table_notification_time';
  

	 //healper properties
	 public static $last_notification_check_time = "last_notifcation_check_time";

public  static function send_notification($post_id =  "NULL",$comment_id = "NULL",$reply_id = "NULL",$user_id = 0,$type = '')
{
	global $db;
	

	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,{$post_id},{$comment_id},{$reply_id},{$user_id},'".$type."',".time().")";
	

	if(!$db->query($query)){
        
		
		return false;
	}else{
		return $db->insert_id;
	}
	
	return false;
	
}// send_notification();	 



public static function get_latest_notifications($user_id){
	
	
	global $db;
	
	$query =" SELECT COUNT(*),* FROM ".self::$table_name." WHERE ";
	
}//get_notifications();


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