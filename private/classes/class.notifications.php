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


	 //get the counts for the number of notifications,pending connections,
    // number of each of the various communities latest posts
    public static function get_activities_counts($stream_type = null){
			global $db;
			
			
		 
			//this query is only for the notifications which you are following the post
			$query = "SELECT ".self::$table_name.".*,".user::$firstname.",".user::$lastname.",".PendingConnections::$request_time.",COUNT(*) AS count_pending_connections FROM ".PendingConnections::$table_name." JOIN ".user::$table_name." ON ".user::$table_name.".".user::$id." = ".PendingConnections::$sender_id." ".self::$table_name." LEFT JOIN ".FollowPost::$table_name." ON ".FollowPost::$post_id." = ".self::$post_id."  JOIN ".PostImage::$table_name."  ON  ".PostImage::$table_name.".".PostImage::$uploader_id." = ".$_SESSION[user::$id]." JOIN read_status ON (".self::$id." = read_status_notification_id  WHERE ".FollowPost::$follower_id." = ".$_SESSION[user::$id]." &&  ".self::$user_id." != ".$_SESSION[user::$id]." && read_status_notification_id != ".$_SESSION[user::$id]." && ".PendingConnections::$receiver_id." = ".$_SESSION[user::$id]." ;"; 
     log_action(__CLASS__,$query." on line: ".__LINE__);
		// count of the different type of posts that 
			$query .= "SELECT ".PostImage::$label.",".PostImage::$title.",".PostImage::$upload_time.",COUNT(*) AS count_labeled_posts FROM ".PostImage::$table_name." WHERE ".PostImage::$upload_time." > (".time()." - 5289000) GROUP BY ".PostImage::$label;
		   

			$activities_count_array = [];
			$activities_count_array["pending_connections"] = "";
			$activities_count_array["notifications_info"]["notifications"] = "";
			$activities_count_array["notifications_info"]["count"] = 0;
			$activities_count_array["label"][PostImage::$education] = "";
			$activities_count_array["label"][PostImage::$other] ="";
			$activities_count_array["label"][PostImage::$education] ="";
			$activities_count_array["label"][PostImage::$security]  = "";
			$activities_count_array["label"][PostImage::$sanitation] = "";
			$activities_count_array["label"][PostImage::$sol] ="";
			$activities_count_array["label"][PostImage::$work] ="";
			$activities_count_array["label"][PostImage::$health] = "";
			$activities_count_array["label"][PostImage::$transport] = "";
			$notifications_ids_array = [];
			$notifications = "";
			$recent_following = "";
			
			if($db->multi_query($query)){
				
		 do{
            
							if($result = $db->store_result()){
							
									while($row = $result->fetch_assoc()){
							$activities_count_array["notifications_info"]["count"] = ($result->num_rows > 0) ? $result->num_rows : 0;
							
					 if(isset($row["count_pending_connections"])){
						
									 $activities_count_array["pending_connections"] = $row["count_pending_connections"];
									 $activities_count_array["notifications_info"]["notifications"] .= "
									 <div id='' class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=''>
		
		  

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>".$row[user::$firstname]." ".$row[user::$lastname]."</strong> followed you
						</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='".FetchPost::fulldate($row[PendingConnections::$request_time])."'><span title='".FetchPost::fulldate($row[PendingConnections::$request_time])."'>".FetchPost::time_converter($row[PendingConnections::$request_time])."</span></small><span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'><i class='ps-icon-eye'></i><span>Mark as read</span></span></div></div></a></div>";

						}elseif(isset($row[self::$id]) && trim($row[self::$type]) != ""){
						 
								
											if(!in_array($row[Notifications::$id],$notifications_ids_array)){

											 $fullname = ($row[self::$type] != CONFIRM_POST || $row[self::$type] != REVERSE_CONFIRMED_POST ) ? $row[self::$firstname]." ".$row[self::$lastname]."  " : "";

											 // store the notifications ids to be able to count them later.
													$notifications_ids_array[] = $row[Notifications::$id];
										$mark_notifiation_as_read = "onclick=notifications.mark_as_read(this,'".$row[Notifications::$id]."')";
													// store the notifications		
													$notifications .="<div id='' class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
													<a class='ps-notification__inside' href='#'>
														
														<div class='ps-notification__body'>
															<div class='ps-notification__desc'>
																<strong>{$fullname}</strong>".self::get_notification_type_string($row[self::$type])."
																		</div>
												
															<div class='ps-notification__meta'>
																<small class='activity-post-age' data-timestamp='". FetchPost::fulldate($row[self::$time])."'><span title='". FetchPost::fulldate($row[self::$time])."'>".FetchPost::time_converter($row[self::$time])."</span></small>
												
																				<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'
{$mark_notifiation_as_read}																				>
																	<i class='ps-icon-eye'></i>
																	<span>Mark as read</span>
																</span>
																			</div>
														</div>
													</a>
												</div>";
													
											
											
						}
				// store the notifications inside the activities array	
				 $activities_count_array["notifications_info"]["count"] = count($notifications_ids_array);
				 $activities_count_array["notifications_info"]["notifications"] = $notifications;

				//  ["count" => count($notifications_ids_array), "notifications" => $notifications]; 

									}elseif(isset($row[PostImage::$label])){
									$activities_count_array["label"][$row[PostImage::$label]] =
									$row["count_labeled_posts"];
									}
							}
							}
					}while($db->more_results() && $db->next_result());
			}

return  $activities_count_array;
			
	}//get_activities_count();



  public static function get_notification_type_string($notification_type = ""){
		global $db;
	
     if($notification_type == CONFIRM_POST ){
			  return "A Post has being Confirmed";
		 }

     if( $notification_type == REVERSE_CONFIRMED_POST){
			   return "A post confirmation ahs bein reversed";
		 }

		if(trim($notification_type) == ""){
		
   return IGNORE_NOTIFICATION ;
		}

		switch($notification_type){

			case NEW_COMMENT :
			return " commented on a post ";
			break;
			case INCIDENT_POST :
			return " posted an new incident ";
			break;
			case NEW_POST :
			return " posted an new incident ";
			break;
			case EDIT_POST :
			return " edited a post ";
			break;
			case CONFIRM_POST :
			return " confirmed a post ";
			break;
			case REVERSE_CONFIRMED_POST :
			return " reversed the confirmation of a  post ";
			break;
			case FOLLOW_POST :
			return " followed a post ";
			break;
			case NEW_SUPPORT :
			return " supported a post ";
			break;
			case NEW_OPPOSE :
			return " oppose a post post ";
			break;
			case ALT_SUPPORT :
			return " now supports a post ";
			break;
			case ALT_OPPOSE :
			return " now opposes a post ";
			break;
			case NEW_REPLY_COMMENT :
			return " reply to a comment on a post ";
			break;
			case LIKE_COMMENT :
			return " liked a comment on a post ";
			break;
			case LIKE_REPLY :
			return " likeda reply to a comment ";
			break;
		 case EDIT_COMMENT :
			return " edited a comment on a post ";
			break;
		 
		   default : return IGNORE_NOTIFICATION;             
			             
			   
		}


	}

  public  static function send_notification($post_id =  0,$comment_id = 0,$reply_id = 0,$type = ''){
	
		global $db;

		  if(!isset($_SESSION[user::$id]) || !isset($_SESSION[user::$firstname]) || !isset($_SESSION[user::$lastname])){
			
				 Errors::trigger_error(INVALID_SESSION);
				return false;
			}

	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,{$post_id},{$comment_id},{$reply_id},".$_SESSION[user::$id].",'".$_SESSION[user::$firstname]."','".$_SESSION[user::$lastname]."','".$type."',".time().") ON DUPLICATE KEY UPDATE ".self::$id." = ".self::$id." + 1";
	
	$result = $db->query($query);
	if(!$result){
		
 log_action(__CLASS__,"($query) $db->error");
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
		
		$query = "SELECT * FROM notifications LEFT JOIN follow_posts ON follow_posts_post_id = notifications_post_id   WHERE follow_posts_follower_id = 4 &&  notifications_user_id != ".$_SESSION[user::$id].";"; 


		$query .= "SELECT * FROM notifications  JOIN connect_users ON connect_users_followed_id = notifications_user_id WHERE connect_users_follower_id = 4 && notifications_user_id != ".$_SESSION[user::$id];
			
		// $query .= "SELECT * FROM notifications JOIN views ON (views.id = notifications_comment_id || views.post_id = notifications_post_id) WHERE notifications_user_id != 4;";
			
		// $query .= "SELECT * FROM notifications JOIN reply_views ON (reply_views.id = notifications_reply_id || reply_views.post_id = notifications_post_id || reply_views.comment_id = notifications_comment_id)  WHERE notifications_user_id != 4";
	 
	 
		$array = [];
		if($db->multi_query($query)){
		 do{
				if($result = $db->store_result()){
						 while($row = $result->fetch_assoc()){
					if(!in_array($row["notifications_id"],$array)){
	 
					 $array[] =  $row["notifications_id"];
				 
			echo $row["notifications_id"]."<br />";
			echo $row["notifications_firstname"]." ".$row["notifications_lastname"]."<br />";
			echo $row["notifications_type"]."<br />";
			echo FetchPost::time_converter($row["notifications_time"])."<br /><br /><br />";
		
		
					}
			 
					
				}
			 
				$result->free();
			 }
	 
		 }while($db->more_results() && $db->next_result());
	
		}
	 
	 

}//get_notifications();




public static function get_notification_template(){
	
	
	return "<div id='notification_template' class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=''>
		
		

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>".$_SESSION[user::$firstname]." ".$_SESSION[user::$lastname]."</strong> Ignore this notification
						</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>System time</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;' onclick='notification.mark_as_read()'>
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



public static function get_label_specific_notifications($label = ""){


	
	if(trim($label) == "" || !in_array(trim($label),COMMUNITIES)){
		print j(["empty" => "no_post"]);
					 return;
				}


				global $db;
		// count of the different type of posts that 
		$query = "SELECT ".PostImage::$label.",".user::$firstname.",".user::$lastname.",".PostImage::$title.",".PostImage::$upload_time.",".PostIMage::$title.",".PostImage::$upload_time.",".FetchPost::$filename." FROM ".PostImage::$table_name." JOIN ".user::$table_name." ON ".user::$table_name.".".user::$id." = ".PostImage::$table_name.".".PostImage::$uploader_id." JOIN ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  WHERE ".PostImage::$upload_time." > (".time()." - 5284000) && ".PostImage::$label." = '{$label}' GROUP BY ".PostImage::$table_name.".".PostImage::$id." ORDER BY  ".PostImage::$upload_time." DESC ";



		if($result = $db->query($query)){

			if($result->num_rows < 1){
				print j(["empty" => "no_post"]);
				return;
			}
  $notifications = [];
			while($row = $result->fetch_assoc()){
				
				if( is_array($row) && !empty($row)){
						 $row[FetchPost::$filename] = "<img src='../private/".UPLOADS_DIR.IMGS_THUMBS_DIR.$row[FetchPost::$filename]."' title='".$row[FetchPost::$filename]."' alt='' style='margin: 0 auto; border-radius:.7em;'";
						 $row[PostImage::$upload_time] = FetchPost::time_converter($row[PostImage::$upload_time]);
					$notifications[] = $row;
				}
				 
			}
		}elseif(trim($db->error) != ""){

	Errors::trigger_error(SERVER_PROBLEM);
		return;
	}
	print j($notifications);

}


public static function mark_as_read($notification_id = 0){
	global $db;


	if(isset($notification_id) && !empty($notification_id) && $notification_id != 0){
	    $sql_safe_notification_id = $db->real_escape_string($notification_id);
	 $query = "INSERT INTO read_status VALUES(NULL,{$sql_safe_notification_id},".$_SESSION[user::$id].")";

	$result = $db->query($query);
 
	if($db->affected_rows > 0){
	 print j(["response" => "success"]);
	 return;
	}
	}
	print j(["response" => "failed"]);
	return ;
}

}// get_label_specific_notifications();
	











?>