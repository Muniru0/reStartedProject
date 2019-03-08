<?php
require_once(PRIVATE_DIR.'initialize.php');





class Notifications extends DatabaseObject {

     
	 public static $table_name = 'notifications';
	 
	 public static $id         = 'id';
	 public static $post_id    = 'post_id';
	 public static $user_id    = 'user_id';
     public static $type       = 'type';
     public static $time       = 'time';



public  static function send_notification($post_id = '',$user_id = '',$type = '', $date = '')
{
	global $db;
	
	
	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,$post_id,$user_id,$type,$date)";
	
	if(!$db->query($query))
	{
		log_action(__CLASS__." Query failed: {$db->error} on line: ".__LINE__);
	}else{
		return $db->insert_id();
	}
	
	return false;
	
}// send_notification();	 



public function get_notifications($user_id){
	
	
	global $db;
	
	$query =" SELECT * FROM ".self::$table_name."";
	
}//get_notifications();


public function get_notification_template(){
	
	
	return "<div class='ps-popover app-box' style='display:none;'>
 <div class='ps-notifications' style='max-height: 40vh; overflow: auto;'>
 <div class='ps-notification ps-notification--unread' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='<?php echo $profile_image; ?>' alt='William Torres'>
			</div>
		</div>

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
</div>";
}// get_notification_template();





}
	











?>