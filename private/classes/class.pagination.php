<?php

require_once("../private/initialize.php");



class Pagination extends DatabaseObject {
	
	
	
	
	
	// get infinite scroll	
public static function get_infinite_scroll($stream_type = "",$stream_type_id = null){
	
	
	
	
 global $db;

	  if(!isset($_SESSION)){
		 Errors::trigger_error(INVALID_SESSION);
		  return;
	  }
	  	  
	
	
	 $offset		    = 0;
	 $offset_upperbound = 0;
	  
	  if(isset($_SESSION) && isset($_SESSION[$stream_type])
		  && (int)$_SESSION[$stream_type] > 0){
			  $offset = $_SESSION[$stream_type] += 11;
			  $offset_upperbound = $offset + 11;
		  }elseif(!isset($_SESSION[$stream_type])){
			   $_SESSION[$stream_type] = 240;
			   $offset = 240;
		  }
		  
 $where_clause = "";
  $posts        = "";
  
  
	// provide a different where clause for each of the different
	//   types of streams
  if($stream_type == STREAM_HOME){
	  
	 
	   $posts = self::home_posts($offset,$offset_upperbound);
	  
  }elseif($stream_type == STREAM_PROFILE){
	   if($offset == 1){
		$where_clause = PostImage::$table_name.".".PostImage::$uploader_id." = {$stream_type_id} ORDER BY ".PostImage::$upload_time." DESC LIMIT 100";
		
	   }elseif($offsest > 1){
		   
		    $where_clause = PostImage::$table_name.".".PostImage::$id." >={$offset} && ".PostImage::$table_name.".".PostImage::$id."<= {$offset_upperbound} && ".PostImage::$table_name.".".PostImage::$uploader_id." = {$stream_type_id} ORDER BY ".PostImage::$upload_time." DESC LIMIT 100"; 
	   }
	   
	 $posts = self::profile_posts($where_clause);
  }elseif($stream_type == STREAM_SELF){
	  
	 
	  $posts = self::self_posts($offset,$offset_upperbound);
  }elseif($stream_type == STREAM_COMMUNITY){
	  $posts = self::community_posts($offset,$offset_upperbound);
  }
  
 if(!$posts){
	 
		   return;
	   }
	   
	   
	   
 // get the post comments
 $comments  = self::get_post_comments($offset,$offset_upperbound,$stream_type);
 
 
 $activities_user_ids = self::get_activities_user_ids($offset,$offset_upperbound);
 
 
 
 
 // now output the post that you just queried
 FetchPost::get_full_post($posts,$comments,$activities_user_ids["reactions"],$activities_user_ids["views"],$activities_user_ids["replys"],STREAM);
    $activities_user_ids = null;
	
	
	
}// get_infinite_scroll();
	

	// get the posts 
	public static function get_the_posts($where_clause = "",$offset = 0,$stream_type = null){
		global $db;
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
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
		
		print j(["pending"=>"waiting"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["pending"=>"waiting"]);
	
return false;	 
  }
  
  
 
 

 return $returned_array;
	}
	
	// the comments 
	public static function get_post_comments($offset =0 ,$offset_upperbound =0,$stream_type = ""){
		global $db;
		
		 if(class_exists("ReplyViews") && class_exists("user") && class_exists("Views")){

		 
	$comments = [];	 
		 
		 
$query = "SELECT ".Views::$table_name.".*,".ReplyViews::$table_name.".*,".Views::$table_name.".".Views::$id." AS ".Views::$alias_of_id.",".ReplyViews::$table_name.".".ReplyViews::$id." AS ".ReplyViews::$alias_of_id.", ".ReplyViews::$table_name.".".ReplyViews::$firstname." AS ".ReplyViews::$alias_of_firstname." ,".ReplyViews::$table_name.".".ReplyViews::$lastname." AS ".ReplyViews::$alias_of_lastname.",".Views::$table_name.".".Views::$firstname." AS ".Views::$alias_of_firstname.",".Views::$table_name.".".Views::$lastname." AS ".Views::$alias_of_lastname.",".Views::$table_name.".".Views::$post_id." AS ".Views::$alias_of_post_id." ,".ReplyViews::$table_name.".".ReplyViews::$post_id." AS ".ReplyViews::$alias_of_post_id.",".Views::$table_name.".".Views::$likes." AS ".Views::$alias_of_likes.",".ReplyViews::$table_name.".".ReplyViews::$likes." AS ".ReplyViews::$alias_of_likes." FROM  ".Views::$table_name." 
 LEFT JOIN  ".ReplyViews::$table_name." ON ".ReplyViews::$table_name.".".ReplyViews::$comment_id." = ".Views::$table_name.".".Views::$id."  WHERE  ".Views::$table_name.".".Views::$post_id." >={$offset} && ".Views::$table_name.".".Views::$post_id." <= {$offset_upperbound} LIMIT 5000";

 
  $results = $db->query($query);
  $row_count = $results->num_rows;
	
	
	if($db->error){

		log_action(__CLASS__,"Query: {$db->error} on line: ".__LINE__." in file: ".__FILE__);
		Errors::trigger_error(RETRY);
		Print j(["false"=>"Server Problem please try again later."]);
		return;
	}

	
// validate the returning of results	
 if($results->num_rows > 0){
	 

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
 }else{
	
	$query = "SELECT MIN(id) AS min_id FROM views WHERE id > ".((int)$_SESSION[$stream_type]." LIMIT 1000");
	 $result = $db->query($query); 
	   
	 if($result->num_rows > 0 && $row = $result->fetch_assoc()){
		  $_SESSION[$stream_type] = $row["min_id"];
		   $result->free();
	 }else{
		$_SESSION[$stream_type] = 0;
		print j(["pending" => "waiting"]);
		$result->free();
        	return;	
	 }
	
 } 

	}
	
	return $comments;
	}//get_the_comments
	

	
	
  // get the comments likes user ids 
   public static function get_activities_user_ids($offset = 0,$offset_upperbound = 0){
	    global $db;
		
	

 $query = "SELECT ".ViewsLikes::$table_name.".".ViewsLikes::$id." AS ".ViewsLikes::$alias_of_id.",".ViewsLikes::$post_id." AS ".ViewsLikes::$alias_of_post_id.",".ViewsLikes::$table_name.".".ViewsLikes::$comment_id."    AS ".ViewsLikes::$alias_of_comment_id.",".ViewsLikes::$table_name.".".ViewsLikes::$user_id." AS ".ViewsLikes::$alias_of_user_id.",".ViewsLikes::$table_name.".".ViewsLikes::$firstname." AS ".ViewsLikes::$alias_of_firstname.",".ViewsLikes::$table_name.".".ViewsLikes::$lastname." AS ".ViewsLikes::$alias_of_lastname.",".ViewsLikes::$table_name.".".ViewsLikes::$likes_time." AS ".ViewsLikes::$alias_of_likes_time." FROM ".ViewsLikes::$table_name." WHERE ".ViewsLikes::$post_id." >={$offset} && ".ViewsLikes::$post_id." <={$offset_upperbound};";
 
 
 $query  .= "SELECT ".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$id." AS ".ReplyViewsLikes::$alias_of_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$reply_id." AS ".ReplyViewsLikes::$alias_of_reply_id.",".ReplyViewsLikes::$post_id." AS ".ReplyViewsLikes::$alias_of_post_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$comment_id."    AS ".ReplyViewsLikes::$alias_of_comment_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$user_id." AS ".ReplyViewsLikes::$alias_of_user_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$firstname." AS ".ReplyViewsLikes::$alias_of_firstname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$lastname." AS ".ReplyViewsLikes::$alias_of_lastname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$likes_time."  AS ".ReplyViewsLikes::$alias_of_likes_time." FROM ".ReplyViewsLikes::$table_name." WHERE ".ReplyViewsLikes::$post_id." >={$offset} && ".ReplyViewsLikes::$post_id." <={$offset_upperbound};"; 
 
 
  
 $query .= "SELECT * FROM ".Reaction::$table_name." WHERE ".Reaction::$post_id." >= {$offset} && ".Reaction::$post_id."<= {$offset_upperbound};";
  
 if(isset($_SESSION) && isset($_SESSION[user::$id])){
 $query .= " SELECT * FROM ".LinkUsers::$table_name." WHERE ".LinkUsers::$linker_id."
=".$_SESSION[user::$id]." || ".LinkUsers::$link." = ".$_SESSION[user::$id].";";


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
			  }elseif(isset($row[LinkUsers::$linker_id])){
				    
	if(isset($_SESSION) && isset($_SESSION[LinkUsers::$session_string])){
		if(!in_array((int)$row[LinkUsers::$linker_id],$_SESSION[LinkUsers::$session_string]) || !in_array((int)$row[LinkUsers::$link],$_SESSION[LinkUsers::$session_string])){
			
			
			   
			  if($row[LinkUsers::$link] != (int)$_SESSION[user::$id] && !in_array((int)$row[LinkUsers::$link],$_SESSION[LinkUsers::$session_string])){
				  
				  $_SESSION[LinkUsers::$session_string][] = (int)$row[LinkUsers::$link];
			  }elseif($row[LinkUsers::$linker_id] != (int)$_SESSION[user::$id] && !in_array((int)$row[LinkUsers::$linker_id],$_SESSION[LinkUsers::$session_string])){
				  
			$_SESSION[LinkUsers::$session_string] [] =(int)$row[LinkUsers::$linker_id];
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
 public static function self_posts($offset = 0,$offset_upperbound = 0){
	 	global $db;
		
		
		
		 $where_clause = ($offset == 1) ?
		 PostImage::$table_name.".".PostImage::$uploader_id."=".$_SESSION[user::$id]." ORDER BY ".PostImage::$upload_time." DESC LIMIT 100"
		 :
		 PostImage::$table_name.".".PostImage::$id." >={$offset} && ".PostImage::$table_name.".".PostImage::$id."<= {$offset_upperbound}  && ".PostImage::$uploader_id."=".$_SESSION[user::$id]." ORDER BY ".PostImage::$upload_time." DESC LIMIT 100" ;
	
		  
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE {$where_clause}";
  $post_ids_array = [];
$results = $db->query($query);
	

$row_count = $results->num_rows;
	  
	if($db->error){
		
		Errors:;trigger_error(RETRY);
		return;
	}
	
	
// validate the returning of results	
 if($row_count > 0){
	 
	
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
	  
	 
	 if($offset == 1){
	 $_SESSION[STREAM_SELF] = array_pop(sort($post_ids_array));
	 }
 }else{
	
	$query = "SELECT MIN(id) AS min_id FROM post_table WHERE uploader_id > ".((int)$_SESSION[user::$id]);
	 $result = $db->query($query); 
	
	 
	 if( $row = $result->fetch_assoc()){
		 
		 if( $row["min_id"] == null){
		
		 print j(["true" =>"upclose_empty"]);
		  return false;
	 }
	
		    $offset_upperbound = $_SESSION[STREAM_SELF] = $row["min_id"] + 11;
		  
		   self::self_posts($offset_upperbound - 11,$offset_upperbound); 
		   $result->free();
	 }else{
		$_SESSION[STREAM_SELF] = 0;
		
		print j(["pending"=>"shortage"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["pending"=>"waiting"]);
	
return false;	 
  }
  
  
 return $returned_array;
 }//self_posts();

 
 
 
 // get users own uploaed incidents	
 public static function community_posts($offset = 0 ,$offset_upperbound = 0){
	 	
		global $db;
		
		  $where_clause = PostImage::$table_name.".".PostImage::$id." >={$offset} && ".PostImage::$table_name.".".PostImage::$id."<= {$offset_upperbound}";
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE {$where_clause} ";

$results = $db->query($query);
	

echo $row_count = $results->num_rows;
	  
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
		
		print j(["pending"=>"waiting"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["pending"=>"waiting"]);
	
return false;	 
  }
  
  
 
 

 return $returned_array;
 }

 // get users own uploaed incidents	
 public static function profile_posts($where_clause = ""){
	 	global $db;
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
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
		
		print j(["pending"=>"waiting"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["pending"=>"waiting"]);
	
return false;	 
  }
  
  
 
 

 return $returned_array;
 }	
 
 
 // get users own uploaed incidents	
 public static function home_posts($offset = 0,$offset_upperbound = 0){
	 
	 	global $db;
		
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE ".PostImage::$table_name.".".PostImage::$id.">={$offset} && ".PostImage::$table_name.".".PostImage::$id." <={$offset_upperbound} ORDER BY ".PostImage::$upload_time." DESC LIMIT 100";
 
$results = $db->query($query);
	

$row_count = $results->num_rows;
	  
	if($db->error){
		
		Errors::trigger_error(RETRY);
		return;
	}
	
	
// validate the returning of results	
 if($row_count > 0){
	
	while($row = $results->fetch_assoc()){
		
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
	
	
	
 }else{
	 
	$query = "SELECT MIN(id) AS min_id FROM post_table WHERE id > ".((int)$_SESSION[STREAM_HOME]);
	 $result = $db->query($query); 
	  
	 if($row = $result->fetch_assoc()){
		 if($row["min_id"] == null && $_SESSION[STREAM_HOME == 1]){
			 
			 print j(["true" =>"no_posts"]);
			 return;
		 }elseif($row["min_id"] == null && $_SESSION[STREAM_HOME] > 1){
			 
			  print j(["true" => "no_more_posts"]);return;
		 }
		$offset_upperbound =  $_SESSION[STREAM_HOME] = $row["min_id"];
		  
		  self::home_posts($offset_upperbound - 11,$offset_upperbound);
		  return;
		   $result->free();
	 }
	 
	 else{
		$_SESSION[STREAM_HOME] = 1;
		
		print j(["pending"=>"waiting"]);
		$result->free();
        	return;	
	 }
	
 } 
  // check if the returned post is empty
  if(empty($returned_array)){
	print j(["pending"=>"waiting"]);
	
return false;	 
  }
  
  
 return $returned_array;
 }//home_posts();	 


}

?>