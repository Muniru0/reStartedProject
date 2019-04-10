<?php

require_once("../private/initialize.php");



class Pagination extends DatabaseObject {
	
	private static $limit_posts_number = 50;
	
	
	
	// get infinite scroll	
public static function get_infinite_scroll($stream_type = "",$stream_type_id = null){
    
 global $db;

	  if(!isset($_SESSION)){
		 Errors::trigger_error(INVALID_SESSION);
		  return;
	  }
	  	 
	
	  // if the session variable for that specific stream type 
	  // is not set then set to it to 0
	   if(!isset($_SESSION[$stream_type])){
		
			   $_SESSION[$stream_type] = 0;
		}
		 
 $where_clause = "";
  $posts        = "";
  

	// provide a different where clause for each of the different
	//   types of streams
  if($stream_type == STREAM_HOME){
	  
	 
	   $posts = self::home_posts();
	  
  }elseif($stream_type == STREAM_PROFILE){
	   if($offset == 1){
		$where_clause = PostImage::$table_name.".".PostImage::$uploader_id." = {$stream_type_id} ORDER BY ".PostImage::$upload_time." DESC LIMIT 100";
		
	   }elseif($offsest > 1){
		   
		    $where_clause = PostImage::$table_name.".".PostImage::$id." >={$offset} && ".PostImage::$table_name.".".PostImage::$id."<= {$offset_upperbound} && ".PostImage::$table_name.".".PostImage::$uploader_id." = {$stream_type_id} ORDER BY ".PostImage::$upload_time." DESC LIMIT 100"; 
	   }
	   
	 $posts = self::profile_posts($where_clause);
  }elseif($stream_type == STREAM_SELF){
	  
	 
	  $posts = self::self_posts();
  }elseif($stream_type == STREAM_COMMUNITY){
	  $posts = self::community_posts($stream_type_id);
  }
  
  
 if(!$posts){
	 
		   return;
}
	   
 // get the post comments
 $comments  = self::get_post_comments();
 

   if($comments === false){
	  
	   return;
   }
 
 $activities_user_ids = self::get_activities_user_ids();
 
// echo "<pre>";
//  print_r($activities_user_ids["reactions"]);
//  echo "end of reactions";
//  print_r($activities_user_ids["views"]);
//  echo "end of views";
//  print_r($activities_user_ids["replys"]);
//  echo "end of replys";
//  echo "</pre>";
 
//  return;
 // now output the post that you just queried

 FetchPost::get_full_post($posts,$comments,$activities_user_ids["reactions"],$activities_user_ids["views"],$activities_user_ids["replys"],STREAM);
 
 unset($posts);
 unset($comments);
 unset($activities_user_ids);
	
	
}// get_infinite_scroll();
	

	
	// get the posts 
	public static function get_the_posts($where_clause = "",$offset = 0,$stream_type = null){
		global $db;
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE {$where_clause} ";

$results = $db->query($query);
	

$row_count = $results->num_rows;
	  
	if($db->error){
		
		Errors:;trigger_error(RETRY);
		return;
	}
	
	
// validate the returning of results	
 if($row_count > 0){
	 // initialize the post ids array variable to be used
	 // in the while loop
	 if($offset == 1){
	 $post_ids_array = [];
 }
	while($row = $results->fetch_assoc()){
		// get all the post ids to be sorted and the least one
		// to be set to the session variable of the stream type
		if($offset == 1){
		 $post_ids_array[] = $row[PostImage::$alias_of_id];
		}
	if(isset($reactions_user_ids) && array_key_exists($row[FetchPost::$post_id],$reactions_user_ids)){
		    if(isset($reactions_user_ids) && isset($reactions_user_ids[$row[FetchPost::$post_id]]) && !in_array($row[Reaction::$alias_of_user_id],$reactions_user_ids[$row[FetchPost::$post_id]])){
				$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
			}
		
	}else{
		$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
	}
	
	
	// accumulate and re-structure all the post and their respective files
	if(isset($returned_array) && array_key_exists($row[FetchPost::$post_id],$returned_array)){
	 
	if(isset($returned_array[$row[FetchPost::$post_id]]) &&
	array_key_exists("filenames_".$row[FetchPost::$post_id],
	$returned_array[$row[FetchPost::$post_id]])){
	 
				
 $returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
	
	}
	
	
	
	// else add the incident to the incidents array 	
}else{
	
		// with the post_table_id as the key
		$returned_array[$row[FetchPost::$post_id]][] = $row;
		$returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
		
		 if(!in_array((int)$row[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$row[PostImage::$uploader_id];
			  }
		
}
	}
	
	
	//get the least post id and set it to the session stream type 
	//variable to be used by the comments and activities_user_ids queries
	if($offset == 1){
	$_SESSION[$stream_type] = array_shift(sort($post_ids_array));
	}
 }else{
	
	$query = "SELECT MIN(id) AS min_id FROM post_table WHERE id > ".((int)$_SESSION[$stream_type]);
	 $result = $db->query($query); 
	 
	 if($result->num_rows > 0 && $row = $result->fetch_assoc()){
		  $_SESSION[$stream_type] = $row["min_id"];
		   $result->free();
	 }else{
		$_SESSION[$stream_type] = 0;
		
		print j(["true"=>"waiting"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["true"=>"waiting"]);
	
return false;	 
  }
  
  
 
 

 return $returned_array;
	}
	
	
	
	// the comments 
	public static function get_post_comments(){

		global $db;
		
		 if(class_exists("ReplyViews") && class_exists("user") && class_exists("Views")){

		
	$comments = [];	 
			
	  $offset_upperbound = isset($_SESSION[Session::$qr_upperbound]) ? "&& ".Views::$table_name.".".Views::$post_id." <= ".$_SESSION[Session::$qr_upperbound] : "" ;
		 
		 $query = "SELECT ".Views::$table_name.".*,".ReplyViews::$table_name.".*,
		 ".Views::$table_name.".".Views::$id." AS ".Views::$alias_of_id.",".ReplyViews::$table_name.".".ReplyViews::$id." AS ".ReplyViews::$alias_of_id.", ".ReplyViews::$table_name.".".ReplyViews::$firstname." AS ".ReplyViews::$alias_of_firstname." ,".ReplyViews::$table_name.".".ReplyViews::$lastname." AS ".ReplyViews::$alias_of_lastname.",".Views::$table_name.".".Views::$firstname." AS ".Views::$alias_of_firstname.",".Views::$table_name.".".Views::$lastname." AS ".Views::$alias_of_lastname.",".Views::$table_name.".".Views::$post_id." AS ".Views::$alias_of_post_id." ,".ReplyViews::$table_name.".".ReplyViews::$post_id." AS ".ReplyViews::$alias_of_post_id.",".Views::$table_name.".".Views::$likes." AS ".Views::$alias_of_likes.",".ReplyViews::$table_name.".".ReplyViews::$likes." AS ".ReplyViews::$alias_of_likes." FROM  ".Views::$table_name." 
  LEFT JOIN  ".ReplyViews::$table_name." ON ".ReplyViews::$table_name.".".ReplyViews::$comment_id." = ".Views::$table_name.".".Views::$id."  WHERE  ".Views::$table_name.".".Views::$post_id." >= ".$_SESSION[Session::$qr_lowerbound]."&& ".Views::$table_name.".".Views::$post_id." <= ".$_SESSION[Session::$qr_upperbound]." ORDER BY views.comment_time DESC  LIMIT 3000";


  $results = $db->query($query);
	$row_count = 0;
	 if(isset($results->num_rows)){
$row_count = $results->num_rows;
	 }

	

// validate the returning of results	
 if($row_count > 0){
	 

	while($row = $results->fetch_assoc()){

	
	// if the post id has being set 
if(isset($comments) && isset($comments["postID_".$row[Views::$alias_of_post_id]])){
	
	// if the comment is present add its replys
	if(isset($comments["postID_".$row[Views::$alias_of_post_id]]["viewsID_".$row[Views::$alias_of_id]])&&
	array_key_exists("viewsID_".$row[Views::$alias_of_id],$comments["postID_".$row[Views::$alias_of_post_id]])){
	 
	// add its replys 	
 $comments["postID_".$row[Views::$alias_of_post_id]]["viewsID_".$row[Views::$alias_of_id]]["replys_".$row[Views::$alias_of_id]][$row[ReplyViews::$alias_of_id]] = $row;
	
	// else add the comment and its accompanying reply
}else{
			 
		// with the post_table_id as the key
		$comments["postID_".$row[Views::$alias_of_post_id]]["viewsID_".$row[Views::$alias_of_id]]["replys_".$row[Views::$alias_of_id]][$row[ReplyViews::$alias_of_id]] = $row;
		$comments["postID_".$row[Views::$alias_of_post_id]]["viewsID_".$row[Views::$alias_of_id]][] = $row;
	}
	
	
// else set the post id and add both a comment then the reply
}else{
			  
		
		// with the post_table_id as the key
		$comments["postID_".$row[Views::$alias_of_post_id]]["viewsID_".$row[Views::$alias_of_id]]["replys_".$row[Views::$alias_of_id]][$row[ReplyViews::$alias_of_id]] = $row;
		$comments["postID_".$row[Views::$alias_of_post_id]]["viewsID_".$row[Views::$alias_of_id]][] = $row;
				
	   }
	   
	}// end_of_while loop;
 }elseif(trim($db->error) != ""){
	    Errors::trigger_error(RETRY);
		return false;
	
	
 } 

	}
	


	return $comments;
	}//get_post_comments();
	

	
	
  
  
  // get the comments likes user ids 
   public static function get_activities_user_ids(){
	    global $db;
		
	// comments query

			
	$offset_upperbound = isset($_SESSION[Session::$qr_upperbound]) ? "&& ".Views::$table_name.".".Views::$post_id." <= ".$_SESSION[Session::$qr_upperbound] : "" ;

 $query = "SELECT ".ViewsLikes::$table_name.".".ViewsLikes::$id." AS ".ViewsLikes::$alias_of_id.",".ViewsLikes::$post_id." AS ".ViewsLikes::$alias_of_post_id.",".ViewsLikes::$table_name.".".ViewsLikes::$comment_id."    AS ".ViewsLikes::$alias_of_comment_id.",".ViewsLikes::$table_name.".".ViewsLikes::$user_id." AS ".ViewsLikes::$alias_of_user_id.",".ViewsLikes::$table_name.".".ViewsLikes::$firstname." AS ".ViewsLikes::$alias_of_firstname.",".ViewsLikes::$table_name.".".ViewsLikes::$lastname." AS ".ViewsLikes::$alias_of_lastname.",".ViewsLikes::$table_name.".".ViewsLikes::$likes_time." AS ".ViewsLikes::$alias_of_likes_time." FROM ".ViewsLikes::$table_name." WHERE ".ViewsLikes::$post_id." >=".$_SESSION[Session::$qr_lowerbound]." {$offset_upperbound} ;";
 
 // replys likes query
 $query  .= "SELECT ".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$id." AS ".ReplyViewsLikes::$alias_of_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$reply_id." AS ".ReplyViewsLikes::$alias_of_reply_id.",".ReplyViewsLikes::$post_id." AS ".ReplyViewsLikes::$alias_of_post_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$comment_id."    AS ".ReplyViewsLikes::$alias_of_comment_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$user_id." AS ".ReplyViewsLikes::$alias_of_user_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$firstname." AS ".ReplyViewsLikes::$alias_of_firstname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$lastname." AS ".ReplyViewsLikes::$alias_of_lastname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$likes_time."  AS ".ReplyViewsLikes::$alias_of_likes_time." FROM ".ReplyViewsLikes::$table_name." WHERE ".ReplyViewsLikes::$post_id." >=".$_SESSION[Session::$qr_lowerbound]." {$offset_upperbound} ;"; 
 
 
  // reactions query
 $query .= "SELECT * FROM ".Reaction::$table_name." ".Reaction::$post_id." >=".$_SESSION[Session::$qr_lowerbound]."   {$offset_upperbound}  && ".Reaction::$user_id." = ".$_SESSION[user::$id].";";
	
 
 // community network query
 if(isset($_SESSION) && isset($_SESSION[user::$id])){
 $query .= " SELECT * FROM ".ConnectUsers::$table_name." WHERE ".ConnectUsers::$followed_id."
=".$_SESSION[user::$id]." || ".ConnectUsers::$follower_id." = ".$_SESSION[user::$id].";";

// follow post query;
$query .= " SELECT * FROM ".FollowPost::$table_name." WHERE ".FollowPost::$follower_id." = ".$_SESSION[user::$id];


 
 }

 


$views	    = [];
$replys     = [];
$reactions  = [];

  if($db->multi_query($query)){
	  
	  do{
		
		  if($result = $db->store_result()){
			  if($result->num_rows > 0){
			  while($row = $result->fetch_assoc()){
				  
				
			  if(isset($row[ViewsLikes::$alias_of_id]) && isset($row[ViewsLikes::$alias_of_user_id]) && $row[ViewsLikes::$alias_of_id] > 0 && $row[ViewsLikes::$alias_of_user_id] > 0){
				  
				
				  $views[$row[ViewsLikes::$alias_of_comment_id]][] = $row[ViewsLikes::$alias_of_user_id];
			  }
			  elseif(isset($row[ReplyViewsLikes::$alias_of_id]) && isset($row[ReplyViewsLikes::$alias_of_user_id]) && $row[ReplyViewsLikes::$alias_of_id] > 0 && $row[ReplyViewsLikes::$alias_of_user_id] > 0){
				  
				  $replys[$row[ReplyViewsLikes::$alias_of_reply_id]][] = $row[ReplyViewsLikes::$alias_of_user_id];
			  }elseif(isset($row[ConnectUsers::$followed_id])){
				    
	if(isset($_SESSION) && isset($_SESSION[ConnectUsers::$session_string])){
		if(!in_array((int)$row[ConnectUsers::$followed_id],$_SESSION[ConnectUsers::$session_string]) || !in_array((int)$row[ConnectUsers::$follower_id],$_SESSION[ConnectUsers::$session_string])){
			
			
			   
			  if($row[ConnectUsers::$follower_id] != (int)$_SESSION[user::$id] && !in_array((int)$row[ConnectUsers::$follower_id],$_SESSION[ConnectUsers::$session_string])){
				  
				  $_SESSION[ConnectUsers::$session_string][] = (int)$row[ConnectUsers::$follower_id];
			  }elseif($row[ConnectUsers::$followed_id] != (int)$_SESSION[user::$id] && !in_array((int)$row[ConnectUsers::$followed_id],$_SESSION[ConnectUsers::$session_string])){
				  
			$_SESSION[ConnectUsers::$session_string] [] =(int)$row[ConnectUsers::$followed_id];
			  }
						  
					  }
				  }
				  
			  }elseif(isset($row[Reaction::$reaction_type])){
				
				  $reactions[$row[Reaction::$post_id]][$row[Reaction::$user_id]] = $row[Reaction::$reaction_type];
			  }elseif(isset($row[FollowPost::$follower_id])){
				   
				  if(isset($_SESSION) && isset($_SESSION[FollowPost::$session_string])){
		
				  if(!in_array($row[FollowPost::$post_id],$_SESSION[FollowPost::$session_string])){
					   $_SESSION[FollowPost::$session_string][] = (int)$row[FollowPost::$post_id];
				  }
			  }
			  }
			  elseif(trim($db->error) != ""){
				  
				 Errors::trigger_error(RETRY);
				   return;
			  }else{

				  return;
			  }
			  
		  }
	  }
	  }
		  
	  }while($db->more_results() && $db->next_result());
	  
  } 
  	
  
  
 return ["views" =>$views,"replys"=>$replys,"reactions"=>$reactions];
   }
	
	

  
  
  // get users own uploaed incidents	
 public static function self_posts(){
	 	global $db;
		
	
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
  JOIN ".user::$table_name." ON 
 ".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE ".PostImage::$table_name.".".PostImage::$uploader_id."=".$_SESSION[user::$id]." ORDER BY ".PostImage::$upload_time." DESC LIMIT ".$_SESSION[STREAM_SELF].",30";
 
  $post_ids_array = [];
 $results = $db->query($query);
	if(trim($db->error) != ""){
		 
		Errors::trigger_error(RETRY);
		return;
	}
	
	$row_count = $results->num_rows;
	
	
// validate the returning of results	
 if($row_count > 0){
	
	while($row = $results->fetch_assoc()){
		// get all the post ids to be sorted and the least one
		// to be set to the session variable of the stream type
		 if(!in_array($row[PostImage::$alias_of_id],$post_ids_array)){
			 
		 $post_ids_array[] = $row[PostImage::$alias_of_id];
		 }
		
	if(isset($reactions_user_ids) && array_key_exists($row[FetchPost::$post_id],$reactions_user_ids)){
		    if(isset($reactions_user_ids) && isset($reactions_user_ids[$row[FetchPost::$post_id]]) && !in_array($row[Reaction::$alias_of_user_id],$reactions_user_ids[$row[FetchPost::$post_id]])){
				$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
			}
		
	}else{
		$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
	}
	
	
	// accumulate and re-structure all the post and their respective files
	if(isset($returned_array) && array_key_exists($row[FetchPost::$post_id],$returned_array)){
	 
	if(isset($returned_array[$row[FetchPost::$post_id]]) &&
	array_key_exists("filenames_".$row[FetchPost::$post_id],
	$returned_array[$row[FetchPost::$post_id]])){
	 
				
 $returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
	
	}
	
	
	
	// else add the incident to the incidents array 	
}else{
	
		// with the post_table_id as the key
		$returned_array[$row[FetchPost::$post_id]][] = $row;
		$returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
		
		 if(!in_array((int)$row[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$row[PostImage::$uploader_id];
			  }
		
}
	}
	  
	 // if the offset is 1 then equate the offset to
    //	 the highest id of the latest self query
	sort($post_ids_array);
	$_SESSION[Session::$qr_upperbound] = array_pop($post_ids_array);
	
    $_SESSION[Session::$qr_lowerbound] = array_shift($post_ids_array);
	$_SESSION[STREAM_SELF] += 30;
	
  // if the user has no more posts or no posts at all	
 }elseif($row_count < 1 && trim($db->error) == ""){
	if($_SESSION[STREAM_SELF] == 0){
			
			 print j(["true" =>"no_posts"]);
			 return;
		 }elseif( $_SESSION[STREAM_SELF] > 0){
			
			  print j(["true" => "no_more_posts"]);
			  return;
		 }
 }else{
	 Errors::trigger_error(RETRY);
 }
 
 
 
 return $returned_array;
 }//self_posts();

 
 
 
 // get users own uploaed incidents	
 
 public static function community_posts($community_type = ""){
	 	 
		 
		 echo "how are you";
		 return false;
		global $db;
     
     if(!isset($community_type) || trim($community_type) == ""){
         
           Errors::trigger_error(RETRY);
         return false;
     }
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE label = '{$community_type}' LIMIT ".$_SESSION[STREAM_COMMUNITY].",50 ";
   echo $query;
     return;
     $post_ids_array = [];
     $row_count = 0;
$results = $db->query($query);
	
 if($results){
     
$row_count = $results->num_rows;
	
 }
     
     
// validate the returning of results	
 if($row_count > 0){
	 
	while($row = $results->fetch_assoc()){
		// get all the post ids to be sorted and the least one
		// to be set to the session variable of the stream type
		
		 $post_ids_array[] = $row[PostImage::$alias_of_id];
	
	if(isset($reactions_user_ids) && array_key_exists($row[FetchPost::$post_id],$reactions_user_ids)){
		    if(isset($reactions_user_ids) && isset($reactions_user_ids[$row[FetchPost::$post_id]]) && !in_array($row[Reaction::$alias_of_user_id],$reactions_user_ids[$row[FetchPost::$post_id]])){
				$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
			}
		
	}else{
		$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
	}
	
	
	// accumulate and re-structure all the post and their respective files
	if(isset($returned_array) && array_key_exists($row[FetchPost::$post_id],$returned_array)){
	 
	if(isset($returned_array[$row[FetchPost::$post_id]]) &&
	array_key_exists("filenames_".$row[FetchPost::$post_id],
	$returned_array[$row[FetchPost::$post_id]])){
	 
				
 $returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
	
	}
	
	
	
	// else add the incident to the incidents array 	
}else{
	
		// with the post_table_id as the key
		$returned_array[$row[FetchPost::$post_id]][] = $row;
		$returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
		
		 if(!in_array((int)$row[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$row[PostImage::$uploader_id];
			  }
		
}
	}
	 if(!empty($post_ids)){
         
     sort($post_ids_array);
     $_SESSION[$qr_lowerbound] = array_shift($post_ids_array);
     $_SESSION[$qr_upperbound] = array_pop($post_ids_array);
     }
	
 }elseif($row_count < 1 && trim($db->error) == ""){
	
	  if($_SESSION[STREAM_COMMUNITY] == 0){
          print j(["true" =>"no_posts"]);
			 return;
      }elseif($_SESSION[STREAM_COMMUNITY] > 0){
          print j(["true" => "no_more_posts"]);
          return;
      }
	
 }else{
      
     Errors::trigger_error(RETRY);
     return false;
 } 
  
  
 return $returned_array;
 }// community_posts();
    
    
    
    

 
 // get users own uploaed incidents	
 public static function profile_posts($where_clause = ""){
	 	global $db;
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE {$where_clause} ";

$results = $db->query($query);
	

$row_count = $results->num_rows;
	  
	if($db->error){
		
		Errors:;trigger_error(RETRY);
		return;
	}
	
	
// validate the returning of results	
 if($row_count > 0){
	 // initialize the post ids array variable to be used
	 // in the while loop
	 if($offset == 1){
	 $post_ids_array = [];
 }
	while($row = $results->fetch_assoc()){
		// get all the post ids to be sorted and the least one
		// to be set to the session variable of the stream type
		if($offset == 1){
		 $post_ids_array[] = $row[PostImage::$alias_of_id];
		}
	if(isset($reactions_user_ids) && array_key_exists($row[FetchPost::$post_id],$reactions_user_ids)){
		    if(isset($reactions_user_ids) && isset($reactions_user_ids[$row[FetchPost::$post_id]]) && !in_array($row[Reaction::$alias_of_user_id],$reactions_user_ids[$row[FetchPost::$post_id]])){
				$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
			}
		
	}else{
		$reactions_user_ids[$row[FetchPost::$post_id]][$row[Reaction::$alias_of_user_id]] = $row[ Reaction::$reaction_type];
	}
	
	
	// accumulate and re-structure all the post and their respective files
	if(isset($returned_array) && array_key_exists($row[FetchPost::$post_id],$returned_array)){
	 
	if(isset($returned_array[$row[FetchPost::$post_id]]) &&
	array_key_exists("filenames_".$row[FetchPost::$post_id],
	$returned_array[$row[FetchPost::$post_id]])){
	 
				
 $returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
	
	}
	
	
	
	// else add the incident to the incidents array 	
}else{
	
		// with the post_table_id as the key
		$returned_array[$row[FetchPost::$post_id]][] = $row;
		$returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
		
		 if(!in_array((int)$row[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$row[PostImage::$uploader_id];
			  }
		
}
	}
	
	
	//get the least post id and set it to the session stream type 
	//variable to be used by the comments and activities_user_ids queries
	if($offset == 1){
	$_SESSION[$stream_type] = array_shift(sort($post_ids_array));
	}
 }else{
	
	$query = "SELECT MIN(id) AS min_id FROM post_table WHERE id > ".((int)$_SESSION[$stream_type]." LIMIT 1000");
	 $result = $db->query($query); 
	 
	 if($result->num_rows > 0 && $row = $result->fetch_assoc()){
		  $_SESSION[$stream_type] = $row["min_id"];
		   $result->free();
	 }else{
		$_SESSION[$stream_type] = 0;
		
		print j(["true"=>"waiting"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["true"=>"waiting"]);
	
return false;	 
  }
  
  
 
 

 return $returned_array;
 }	
 
    
  
    
    
  
 
 // get home posts
 public static function home_posts(){
	 
	 	global $db;
		
	
// 		if(isset($_SESSION[PostImage::$are_there_latest_posts])){
// 			//  if there are latest posts run the latest post query
// 			$query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id." FROM ".PostImage::$table_name."
// JOIN ".user::$table_name." ON 
// ".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  WHERE ".PostImage::$upload_time." >= ".$_SESSION[user::$last_logout_time]."  ORDER BY ".PostImage::$upload_time."   DESC LIMIT ".self::$limit_posts_number;

// 		}else{
// 			$a_week_before =  $_SESSION[user::$last_logout_time] - ( 60 * 60 * 24  * 5);
// 			// if there are no more latest posts run the normal query
// 			$query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id." FROM ".PostImage::$table_name."
// JOIN ".user::$table_name." ON 
// ".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id." WHERE ".PostImage::$upload_time." <= ".$a_week_before."  ORDER BY ".PostImage::$upload_time." DESC LIMIT ".$_SESSION[STREAM_HOME].",".self::$limit_posts_number;
// //	 $_SESSION[user::$last_logout_time] =  $a_week_before;
// 	 //log_action(__CLASS__,$query);
	 
// 		}

 
 $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id." WHERE  ".PostImage::$table_name.".".PostImage::$id." <= ".$_SESSION[STREAM_HOME]." && ".PostImage::$table_name.".".PostImage::$id." >= ".($_SESSION[STREAM_HOME] - 10)." ORDER BY ".PostImage::$upload_time." DESC LIMIT ".self::$limit_posts_number;
	

  $returned_array = [];
	$post_ids_array = [];
	
  $results = $db->query($query);
	

$row_count = $results->num_rows;


// incase of emergency my bullet proof vest	
 if($row_count < 1 ){
	
	// setup of a mini query to get the maximum post id just incase some posts ids couldn't be reached due to the the 10 posts ids interval
	$query  = "SELECT MAX(".PostImage::$id.") AS ".PostImage::$post_max_id." FROM ".PostImage::$table_name." WHERE ".PostImage::$id." < ".$_SESSION[STREAM_HOME];
	$db->query($query);

log_action("class",$query);
	  if($result = $db->query($query)){
	if($row = $result->fetch_assoc()){
		log_action(__CLASS__,$row[PostImage::$post_max_id]);
     if($row[PostImage::$post_max_id] >= 1){
			log_action(__CLASS__,$row[PostImage::$post_max_id]);
			 // if there are still posts then get the immediate
			 // highest post id in the database following the highest post id 
			 // in the session.
      $_SESSION[STREAM_HOME] = $row[PostImage::$post_max_id];
		 }elseif($_SESSION[STREAM_HOME] == -1 && $row[PostImage::$post_max_id] == NULL){
				
				print j(["true" =>"no_posts"]);
				return false;
			 
			}elseif($_SESSION[STREAM_HOME] == 0 && $row[PostImage::$post_max_id] == NULL){
				
				 print j(["true" => "no_more_posts"]);
				 return false;
			}
			
	}elseif(trim($db->error) != ""){

		Errors::trigger_error(RETRY);
		 return false;
		}

		}elseif(trim($db->error) != ""){
		
			Errors::trigger_error(RETRY);
			 return false;
			}

	$query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id." FROM ".PostImage::$table_name."
	JOIN ".user::$table_name." ON 
	".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  WHERE ".PostImage::$table_name.".".PostImage::$id." <= ".$_SESSION[STREAM_HOME]." && ".PostImage::$table_name.".".PostImage::$id." >= ".($_SESSION[STREAM_HOME] - 10)." ORDER BY ".PostImage::$upload_time." DESC LIMIT ".self::$limit_posts_number;
	$results = $db->query($query);
	

//  if($row_count < 1 && isset($_SESSION[PostImage::$are_there_latest_posts])){
// 	$a_week_before =  $_SESSION[user::$last_logout_time] - (60 * 60 * 24 * 5) ;
// 	$query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".PostImage::$table_name.".".PostImage::$files_count." AS ".PostImage::$alias_of_files_count.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id." FROM ".PostImage::$table_name."
// 	JOIN ".user::$table_name." ON 
// 	".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  WHERE ".PostImage::$upload_time." >= ".$a_week_before." && ".PostImage::$upload_time." <= ".$_SESSION[user::$last_logout_time]." ORDER BY ".PostImage::$upload_time." DESC LIMIT ".$_SESSION[STREAM_HOME].",".self::$limit_posts_number;
// 	$results = $db->query($query);
	
// 	unset($_SESSION[PostImage::$are_there_latest_posts]); 
// 	$_SESSION[user::$last_logout_time] = $a_week_before;

}elseif(trim($db->error) != ""){
 
	 Errors::trigger_error(RETRY);
	 return false;

} 



	while($row = $results->fetch_assoc()){
		 if(!in_array($row[PostImage::$alias_of_id],$post_ids_array)){
			  $post_ids_array[] = $row[PostImage::$alias_of_id];
		 }
	
	// accumulate and re-structure all the post and their respective files
	if(isset($returned_array) && array_key_exists($row[FetchPost::$post_id],$returned_array)){
	 
	if(isset($returned_array[$row[FetchPost::$post_id]]) &&
	array_key_exists("filenames_".$row[FetchPost::$post_id],
	$returned_array[$row[FetchPost::$post_id]])){
	 
				
 $returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
	
	}
	
	
	
	// else add the incident to the incidents array 	
}else{
	
		// with the post_table_id as the key
		$returned_array[$row[FetchPost::$post_id]][] = $row;
		$returned_array[$row[FetchPost::$post_id]]["filenames_".$row[FetchPost::$post_id]][$row[FetchPost::$alias_of_id]] = $row[FetchPost::$filename];
		
		// get all the uploader_ids to help validate post options like 
		// connect user
		 if(!in_array((int)$row[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$row[PostImage::$uploader_id];
			  }
		
}
	}
	
	 
	 $_SESSION[Session::$qr_lowerbound] = $_SESSION[STREAM_HOME] - 10;
	  
	 
	 $_SESSION[Session::$qr_upperbound] = $_SESSION[STREAM_HOME] ;

  
// //	 $_SESSION[STREAM_HOME] += 30;
if(($_SESSION[STREAM_HOME] - 10) >= 0){
	$_SESSION[STREAM_HOME] -= 10;
}else{
	$_SESSION[STREAM_HOME] = 0;
}
  
	
 
 //print_r($returned_array);
//  return false;
 return $returned_array;
 }//home_posts();	 


}

?>