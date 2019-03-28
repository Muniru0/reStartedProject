
<?php


require_once("../private/initialize.php");
/* if(isset($_POST["login"]) && !empty(trim($_POST["login"])) && (Boolean)trim($_POST["login"]) === true){
	
	    // CSRF tests passed--form was created by us recently.
   // retrieve the values submitted via the form
$email    =  user::$email    = $_POST['email'];
$password =  user::$password = $_POST['password'];
// validate the presence of the required fields  
if(validate_presence_on(["password","email"]) && is_email($email)){
// check that they are not being throttled before 
  //  
  if(throttle::throttle_user()){
    
  if(user::found_user()) {
    Session::after_successful_login();
          // if they are authenticated successfully
	   	 // then clear all the failed logins
        throttle::clear_failed_logins();
		 print j([true]);
      return;
} else {
throttle::record_failed_logins($email);
    // if the person is throttled or not give
	// the same information out
      $_POST = null;
        return ;
		    }
		}else{
// don't tell the person that he is being throttled
          print j(["false"=>"Throttled! Try again after 10mins"]);
          return;
		}
}

} */

if(!Session::before_every_protected_page()){
	return;
}


if(!Session::check_invalid_confirmatory_attempts()){
	return;
}




function is_ajax(){

	return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
}
if(is_ajax()){


// add the view 
if(isset($_POST["request_type"]) && $_POST["request_type"] == "add_comment" ){
	    
	$_POST["comment"] = h($_POST["comment"]);
		
	$_POST["comment"] = nl2br($_POST["comment"]);
		
      // check if the comment is empty or set	  
	  if(!isset($_POST["comment"]) || empty(trim($_POST["comment"]))){
		  print j(["false" => "Please comment can't be empty"]);
		
		  return false;
	  }   
	  
	 // check the length of the comment
	  if(!isset($_POST["comment"]) || (strlen($_POST["comment"]) > 4000)){
		  
		  print j(["false" => "Please the maximum number of characters for a comment is 4000"]);
		  return false;
	  }
	  
	  // cast/convert the post_id into an integer
	  $post_id = (int)$_POST["post_id"];
	  
	 // check if the comment is empty or set	  
	  if(!isset($post_id) || $post_id < 1 || !is_int($post_id)){
		  print j(["false" => "Please try again..."]);
		  return false;
	  }   
	 
	    
		  
		  // check to see if the post_id is in the post_ids array
		 if(!in_array($post_id,$_SESSION["post_ids"],true))
		 {
		    print j(["false" => "Please check the post and try again, if problem persist refresh the page."]); 
			return;
		 }
		 
		  Views::add_views($post_id,$_POST["comment"]);	

  
}
    elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) === "edit_post"){
        
        if(!isset($_SESSION) || !isset($_SESSION[user::$id])){
            Errors::trigger_error(INVALID_SESSION);
           return; 
        }
      
         $caption = h($_POST["caption"]);
         $title   = h($_POST["title"]);
         $post_id = $_POST["post_id"];
         $user_id = $_POST["user_id"];
         $log     = (float)$_POST["log"];
         $lat     = (float) $_POST["lat"];
         $location = h($_POST["location"]);
         
        
        if($user_id != $_SESSION[user::$id] || !in_array($post_id,$_SESSION[PostImage::$session_post_ids]) ||
          !is_float($lat) || $lat < 0 || $log < 0 || !is_float($log) || !is_string($location)){
          
          Errors::trigger_error(RETRY);
            return;
        }
        
      
        
        $caption = $db->real_escape_string(nl2br($caption));
        $title = $db->real_escape_string(nl2br($title));
        $location = $db->real_escape_string($location);		  
	
		// if(csrf_token_is_recent() && csrf_token_is_valid()){
              // check the length of the caption string        
        if(isset($caption) && !empty(trim($caption)) && strlen($caption) > 4000){
         print  j(["false" => "Please the maximum number of characters for the caption is <b>(4000)</b>"]);
           return;
        }
        // check the length of the title string
     if(!has_length("title",["max" => 100])){
        print  j(["false" => "Please the maximum number of characters for the title is <b>(50)</b>"]);
           return;
        }
        
         
  PostImage::edit_post($post_id,$caption,$title,$location,$lat,$lat);        
        
        
        
		}// edit_post();
		// delete post
elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) === "delete_post"){
   $post_id = (int)$_POST["post_id"];
   $user_id = (int) $_POST["user_id"];
   
   if($post_id < 0 || $user_id < 0){
	   print j(["false" => "Sorry server problem ,please try again"]);
	return;
}
   
   if(!in_array($post_id,$_SESSION["post_ids"],true) || $user_id !== (int)$_SESSION["id"]){
	   log_action(__CLASS__," user_id: ".$user_id." post: ".$post_id);
	print j(["false" => "Sorry server problem ,please try again here"]);
	return;
	}
	
//delete post
PostImage::delete_post($user_id,$post_id);
	
}// delete the post

 elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) == "connect_user" && isset($_POST["post_id"]) && $_POST["post_id"] > 0 && isset($_POST["user_id"]) > 0){
			
			$post_id = (int)$_POST["post_id"];
			$user_id = (int)$_POST["user_id"];
			
			if(!in_array($post_id,$_SESSION[PostImage::$session_post_ids])){
			
			  Errors::trigger_error(RETRY);
				return;
			}
			log_action(__CLASS__,"here".__LINE__);
			if(!in_array($user_id,$_SESSION[PostImage::$uploader_id])){
				log_action(__CLASS__,"here".__LINE__);
				 Errors::trigger_error(RETRY);
				return;
			}
			
			// link with this user
			PendingConnections::send_request($user_id);
			
	 
 }
 elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) == "follow_post" &&
        isset($_POST["post_id"]) && $_POST["post_id"] > 0 && (int)$_POST["user_id"] === 0 ){
			
			$post_id = (int)$_POST["post_id"];
			
		if(!in_array($post_id,$_SESSION[PostImage::$session_post_ids])){
			
				print j(["false"=>"Sorry please refresh the page and try again"]);
				return;
			}
		
			// link with this user
			FollowPost::follow_post($post_id );
			
	 
 }
// delete the view
elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) === "delete_comment"){

	 // cast the post and comment ids to integers  
	 $post_id    = (int) $_POST["post_id"];
	 $comment_id = (int) $_POST["comment_id"];
	 
	 // check if the ids of the post and comment are integers and set	  
	  if(!isset($post_id)    || $post_id < 1       || !is_int($post_id)  &&
		 !isset($comment_id) || $comment_id < 1 || !is_int($comment_id)){
		  print j(["false" => "Operation failed, Please try again..."]);
		  return false;
	  }   
	 
		 
// check to see if the post id is in the post ids array	  
        if(!in_array($comment_id,$_SESSION["comment_ids"],true) ||
		    !in_array($post_id,$_SESSION["post_ids"],true) )
		 {
			
			print j(["false" => "Please try again...if problem persist please refresh the page"]); 
			return;
		 }
		 
	 // delete the view from the database			
	 Views::delete_view($post_id,$comment_id);
	
	
	
}




// edit the view
elseif(isset($_POST["request_type"]) && $_POST["request_type"] === "edit_comment" || $_POST["request_type"] === "edit_reply"){

 
	  $comment =  nl2br($_POST["comment"],true);
    
		$flag = "";
		
		if(trim($_POST["request_type"]) === "edit_comment"){
  $flag = "view";
		}elseif(trim($_POST["request_type"]) === "edit_reply"){
			$flag = "reply";
		}
		
      // check if the comment is empty or set	  
	  if(!isset($comment) || empty(trim($comment))){
		  print j(["false" => "Please comment can't be empty"]);
		  
		  return false;
	  }   
	  
	 // check the length of the comment
	  if(!isset($comment) || (strlen($comment) > 4000)){
		  
		  print j(["false" => "Please the maximum number of characters for a comment is 4000"]);
		  return false;
	  }

	$postCommentID    = (int) $_POST["post_comment_id"];
	$commentReplyID   = (int) $_POST["comment_reply_id"];
	 
	 // check if the comment is empty or set	  
	   if(!isset($postCommentID) || $postCommentID < 1 || !is_int($postCommentID)  &&
		 !isset($postCommentID) || $postCommentID < 1 || !is_int($postCommentID)){
			 Errors::trigger_error(FAILED_OPERATION);
		 log_action("nutr","he");
		  return false;
	  }   
	 
		 if($flag === "view"){
// check to see if the post id is in the post ids array	  
if(!in_array($postCommentID,$_SESSION["post_ids"],true) ||
!in_array($commentReplyID,$_SESSION["comment_ids"],true))
{
log_action("neutral ajax file: ", $post_id." comment_id: ".$comment_id);
print j(["false" => "Operation failed, Please try again..."]); 
return;
}
		 }elseif($flag === "reply"){
// check to see if the post id is in the post ids array	  
if(!in_array($postCommentID,$_SESSION["comment_ids"],true) ||
!in_array($commentReplyID,$_SESSION["reply_ids"],true))
{
log_action(__CLASS__,$postCommentID." comment_id or reply id".$commentReplyID);
print j(["false" => "Operation failed, Please try again..."]); 
return;
}
		 }

		 
	// delete the view from the database			
	 Views::edit_view($postCommentID,$commentReplyID,$comment,$flag);


	
}


// reply to a comment
elseif(isset($_POST["request_type"]) && $_POST["request_type"] === "reply_comment"){
	
	global $db;
	$post_id    = (int)$db->real_escape_string($_POST["post_id"]);
	$comment_id = (int)$db->real_escape_string($_POST["comment_id"]);
	 log_action(__CLASS__,"here".__LINE__);
	  
	  
	  $_POST["reply"] = nl2br($_POST["reply"]);
		
      // check if the comment is empty or set	  
	  if(!isset($_POST["reply"]) || empty(trim($_POST["reply"]))){
		  print j(["false" => "Please reply can't be empty"]);
		
		  return false;
	  }   
	  
	 // check the length of the comment
	  if(!isset($_POST["reply"]) || (strlen($_POST["reply"]) > 4000)){
		  
		  print j(["false" => "Please the maximum number of characters for a reply is 4000"]);
		  return false;
	  }
	  
	 
	  
	 // check if the comment is empty or set	  
	  if(!isset($post_id)    || $post_id < 1    || !is_int($post_id) ||
		 !isset($comment_id) || $comment_id < 1 || !is_int($comment_id)){
			 
		  print j(["false" => "Please try again... if the problem persist refresh the page"]); 
		  return false;
	  }   
	
		  // check to see if the post_id is in the post_ids array
		 if(!in_array($post_id,$_SESSION["post_ids"]) || 
		    !in_array($comment_id,$_SESSION["comment_ids"]))
		 {
		    print j(["false" => "Please try again... if the problem persist refresh the page "]); 
			
			  print_r($_SESSION["comment_ids"]);
	 log_action(__CLASS__,"post id is an integer: {$post_id}, comment id is an integer: {$comment_id}");
	    
			return false;
		 }
		 
		 log_action(__CLASS__,"here".__LINE__);
		
		  ReplyViews::reply_views($post_id,$comment_id,$_POST["reply"]);	
	  
	  
	
	
}



// edit a reply for a comment
elseif(isset($_POST["edit_comment"]) && $_POST["edit_comment"] === "false"){
  
  
	  $reply =  nl2br($_POST["comment"],true);
    
	 
		
      // check if the comment is empty or set	  
	  if(!isset($reply) || empty(trim($reply))){
		  print j(["false" => "Please reply can't be empty"]);
		  
		  return false;
	  }   
	  
	 // check the length of the comment
	  if(!isset($reply) || (strlen($reply) > 4000)){
		  
		  print j(["false" => "Please the maximum number of characters for a comment is 4000"]);
		  return false;
	  }
    $comment_id  = (int) $_POST["post_id"];
	$reply_id    = (int) $_POST["comment_id"];
	
	 
	 // check if the comment is empty or set	  
	   if(!isset($reply_id) || $reply_id < 1 || !is_int($reply_id)  &&
		 !isset($comment_id) || $comment_id < 1 || !is_int($comment_id)){
		  print j(["false" => "Operation failed, Please try again..."]);
		  return false;
	  }   
     
	  /* echo $reply_id;
	  echo $comment_id;
	  print_r($_SESSION["comment_ids"]); */
//  check to see if the post id is in the post ids array	  
		 if(!in_array($comment_id,$_SESSION["comment_ids"],true) ||
   		    !in_array($reply_id,$_SESSION["reply_ids"],true))
		 {
			
		    print j(["false" => "Operation failed, Please try again..."]); 
			return false;
		 }
		 
		
	// edit the reply to the view from the database			
	 Views::edit_view($comment_id,$reply_id,$reply,"reply");
	
}

elseif(isset($_POST["request_type"]) && $_POST["request_type"] === "delete_reply"){
	
	 // cast the post and comment ids to integers  
	$comment_id   = (int) $_POST["post_id"];
	 $reply_id    = (int) $_POST["comment_id"]; 
	 
	 // check if the ids of the post and comment are integers and set	  
	  if(!isset($reply_id)    || $reply_id < 1       || !is_int($reply_id)  &&
		 !isset($comment_id) || $comment_id < 1 || !is_int($comment_id)){
		  print j(["false" => "Operation failed, Please try again... if problem persist refresh the page"]);
		  return false;
	  }   
	 
		 
// check to see if the post id is in the post ids array	  
        if(!in_array($comment_id,$_SESSION["comment_ids"],true) ||
		    !in_array($reply_id,$_SESSION["reply_ids"],true) )
		 {
			
			print j(["false" => "Please try again...if problem persist please refresh the page"]); 
			
		 }
		 
	 // delete the view from the database			
	 ReplyViews::delete_reply_view($comment_id,$reply_id);
	
}


elseif(isset($_POST["request_type"]) && (trim($_POST["request_type"]) === "like_comment" || trim($_POST["request_type"]) === "like_reply") ){
	
	
	 // cast the post and comment ids to integers  
	$post_id    = (int) $_POST["post_id"];
	$comment_id = (int) $_POST["comment_id"];
	$reply_id   = (int) $_POST["reply_id"];

	// check if the ids of the post and comment are integers and set	  
	  if(
		 !isset($comment_id) || $comment_id < 1 || !is_int($comment_id)){
		  print j(["false" => "Operation failed, Please try again... if problem persist refresh the page"]);
		  return false;
	  }  
	  
	  		 
// check to see if the post id is in the post ids array	  
        if(!in_array($comment_id,$_SESSION["comment_ids"],true))
		 {
			 echo $comment_id;
			 print_r($_SESSION["comment_ids"]);
			
			print j(["false" => "Please try again...if problem persist please refresh the page"]); 
			return;
		}

	   if($_POST["request_type"] === "like_reply"){
		     // check if the ids of the post and comment are integers and set	  
	  if(!isset($reply_id)    || $reply_id < 1       || !is_int($reply_id)){
		  print j(["false" => "Operation failed, Please try again... if problem persist refresh the page"]);
		  return false;
	  }   
	 
		 
	// check to see if the post id is in the post ids array	  
			if(!in_array($reply_id,$_SESSION["reply_ids"],true) )
			 {
				print j(["false" => "Please try again...if problem persist please refresh the page"]); 
				return false;
			 }
			 
	   }elseif($reply_id > 0){
		    print j(["false" =>"Please refresh the page and try again"]);
			return;
	   }
	 
	 

		
	 // call the add likes method to add the like for both the comment and the reply			
	
	  ViewsLikes::like($post_id,$comment_id,$reply_id,$_POST["request_type"]);
} // like comment or reply

// // edit reply
// elseif(isset($_POST["request_type"]) && (trim($_POST["request_type"]) === "like_reply")){
	
// 	  $post_id = $_POST["post_id"];
// 	  $comment_id = $_POST["comment_id"];
// 	  $reply      = $_POST["reply_id"];
	  
// 	  // check if the ids of the post and comment are integers and set	  
// 	  if(
// 		 !isset($comment_id) || $comment_id < 1 || !is_int($comment_id)){
// 		  print j(["false" => "Operation failed, Please try again... if problem persist refresh the page"]);
// 		  return false;
// 	  }  
	  
	 
	 
		 
// // check to see if the post id is in the post ids array	  
//         if(!in_array($comment_id,$_SESSION["comment_ids"],true))
// 		 {
			
// 			print j(["false" => "Please try again...if problem persist please refresh the page"]); 
// 		}

// 	// if the user is liking a reply then set the reply variables 
// 	// and make the necessary checks
// 	 if($_POST["request_type"] === "like_reply"){
// 		 $reply_id = (int)$_POST["reply_id"];
// 	     $flag     = "like_reply";
		  
// 	  // run this check only if the user is liking a reply 
// 	  if((!isset($reply_id) || $reply_id < 1  || !is_int($reply_id)) && $flag = "like_reply"){
// 		  print j(["false" => "Operation failed, Please try again... if problem persist refresh the page"]);
// 		  return false;
// 	  }  

//   // if the user is liking a reply check that the reply is present before
// 		if(!in_array($reply_id,$_SESSION["reply_ids"],true) && $flag = "like_reply")
// 		 {
			
// 			print j(["false" => "Please try again...if problem persist please refresh the page"]); 
// 		}
		 	  
	  
// 	 }

// }

// get the main stream infinite scroll
elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) === "scroll"){
	
	
	 
   
	  
	$allowed_scroll_parameters = [STREAM_HOME,STREAM_PROFILE,STREAM_COMMUNITY,STREAM_SELF];
        
	  $stream_type = explode("_",trim($_POST["stream_type"]));
   
	  $community_or_id      = 0;
	   
	  switch(trim($stream_type[0])){
		  case STREAM_HOME:
		  $stream = STREAM_HOME;
		  break; 
		  case STREAM_SELF:
		  $stream = STREAM_SELF;
		  break; 
		  case STREAM_PROFILE:
		  $stream = STREAM_PROFILE;
		  break; 
		  case STREAM_COMMUNITY:
		  $stream = STREAM_COMMUNITY;
		  break;
		  default:$stream = INVALID_STREAM_OPTION; return;
	  }
	  
	// if after splitting the stream type array the result is not 1 or two
  if((count($stream_type) != 2 && count($stream_type) != 1) || $stream == INVALID_STREAM_OPTION){
	    Errors::trigger_error(RETRY);
	  return;
  }

  
  // if the result is two
  if(count($stream_type)== 2 ){
	  
      $community_or_id = trim($stream_type[1]);
  }
   
    
  if(is_string($stream) && trim($stream) != "" && in_array(trim($stream),$allowed_scroll_parameters) && trim($stream) != STREAM_HOME && trim($stream) != STREAM_HOME){
      // incase you are getting posts for a visited profile
      // some ones profile that the user visited
      if($id = is_int($community_or_id)){
               if($id > 0){
                    $community_or_id = (int)$id;
               }else{
                   Errors::trigger_error(RETRY);
                   return;
               }
          //incase the user wants posts pertaining to a particular
          // community only
        }elseif(is_string($community_or_id)){
        
           if(trim($community_or_id) == "" || !in_array($community_or_id,COMMUNITIES)){
                   Errors::trigger_error(RETRY);
                   return;
               }
            
      }
      
    // when the stream type is profile
	Pagination::get_infinite_scroll($stream,$community_or_id);
	

	 }
elseif(is_string($stream) && trim($stream) != "" && in_array(trim($stream),$allowed_scroll_parameters)){
			
	// get the main infinite scroll for the sreaming of post
	Pagination::get_infinite_scroll(trim($stream),null);
	
	
	  }
	  else{
		  Errors::trigger_error(RETRY);
		  return;
	  }  
	  
	

	$allowed_scroll_parameters = null;
	 $_SESSION["scroll_ready_state"] = false;
}

elseif(isset($_POST) && isset($_POST["request_type"]) && (trim($_POST["request_type"]) === "confirm_post" || trim($_POST["request_type"]) === "reverse_confirmation")){
	
	//check the validity of the session
	if((int)$_SESSION["id"] < 1){
	 print j(["false"=>"Routine security checks, please just refresh and try again."]);
		return;
	}
	
	// check the eligibility of the person to confirm the post
	if((int)$_SESSION[user::$user_category] < 2 ){
		 print j(["false" =>"Invalid request,if the problem persists re-login"]);
		 return;
	}
	
	$post_id = (int)($_POST["post_id"]);
	if( $post_id < 1 || !in_array($post_id,$_SESSION["post_ids"])){
		 print j(["false" => "Invalid request,if the problem persists please re-login"]);
		 return;
	}

	//confirm the post
	PostImage::confirm_post($post_id,$_POST["request_type"]);
	
}
// reactions 
elseif(isset($_POST["reaction_param"]) && !empty($_POST["reaction_param"])){
	   
	   
	/*    echo "reaction type: ".$_POST["reaction_param"]." post_id: ".$_POST["post_id"];
	   return; */
	   
	if(!isset( $_POST["reaction_param"]) || !isset( $_POST["post_id"])){
	    print j(["false"=>"Please try again, if problem persists refresh the page"]);
		return;
   }
   $_POST["reaction_param"] = (int) $_POST["reaction_param"];
   $_POST["post_id"]        = (int) $_POST["post_id"];
  
   
   if(!is_int($_POST["reaction_param"]) || !is_int($_POST["post_id"])|| $_POST["reaction_param"] < 1 || $_POST["post_id"] < 1  ){
	   print j(["false"=>"Please try again, if problem persists refresh the page"]);
		return; 
   }
   
//record reaction for a post
Reaction::record_reaction($_POST["post_id"],$_POST["reaction_param"]);
 

}elseif(isset($_POST["request_type"]) && trim($_POST["request_type"]) === "get_latest_notifications"){
	
	
	  Notifications::get_latest_nofications();
}
elseif(isset($_POST["reaction_view"]) && !empty($_POST["reaction_view"])){


// a view of a post
print_r(Views::add_view($_POST["reaction_view"]));

}elseif(isset($_POST["view_reaction"]) && !empty($_POST["view_reaction"])){

//add a reaction to a view of a post
  print json_encode(Views::add_view_reaction($_POST["view_reaction"]));
}elseif(isset($_POST[""]) && !empty($_POST["get_views"])){

   //die($_POST["get_views"]);
  FetchPost::get_views($_POST["get_views"]);
 // print ShowPost::get_views();
}


else{
  log_action(__CLASS__,$_POST["request_type"]);
	print j(["false" => "Something Unexpectedly went wrong, please refresh the page and try again"]);
}

}
?>