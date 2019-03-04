<?php

require_once("../private/initialize.php");



class Pagination extends DatabaseObject {
	
	// get infinite scroll	
	public static function get_infinite_scroll($stream_type = ""){
	
 global $db;

	  if(!isset($_SESSION)){
		  print j(["false"=>"login"]);
		  return;
	  }
	  
	  if(!isset($_SESSION[$stream_type])){
		
return;		 
	  }

	   $_SESSION[$stream_type] = 220;
	$offset = (isset($_SESSION[$stream_type]) && isset($_SESSION[$stream_type]) && (int)$_SESSION[$stream_type] > 0) ? (int)$_SESSION[$stream_type] + 20 : (int)$_SESSION[$stream_type] = 220;
	
// $offset =(int)$_SESSION[$stream_type];

  $offset            = $_SESSION[$stream_type];
  $offset_upperbound = $offset + 10;
    $offset = 240;
	$offset_upperbound= 250;
   $posts = self::get_the_posts($offset,$offset_upperbound,$stream_type);	
   
   
// get the post comments
 $comments  = self::get_post_comments($offset,$offset_upperbound,$stream_type);
 
 
   // get the reactions user ids
  $reactions_user_ids = self::get_reactions_user_ids($offset,$offset_upperbound);
  
 
 // get the views user_ids
 $views_likes_user_ids = self::get_reply_likes_user_ids($offset,$offset_upperbound);
 
 
 // get the views user_ids
$reply_views_likes_user_ids = self::get_reply_likes_user_ids($offset,$offset_upperbound);

   

 FetchPost::get_full_post($posts,$comments,$reactions_user_ids,$views_likes_user_ids,$reply_views_likes_user_ids,STREAM);
   $returned_array     = null;
   $comments           = null;
   $post_ids_array     = null;
   $reactions_user_ids = null;
	
	
	
	
}// get_infinite_scroll();
	

	// get the posts 
	public static function get_the_posts($offset = 0, $offset_upperbound = 0,$stream_type = ""){
		global $db;
		
		
  $query = " SELECT  ".user::$firstname.",".user::$lastname.",".user::$table_name.".".user::$user_category.",".PostImage::$table_name.".*,".FetchPost::$table_name.".*,".PostImage::$table_name.".".PostImage::$id." AS ".PostImage::$alias_of_id.",".FetchPost::$table_name.".".FetchPost::$id." AS ".FetchPost::$alias_of_id.",".Reaction::$table_name.".".Reaction::$user_id." AS ".Reaction::$alias_of_user_id.",".Reaction::$table_name.".".Reaction::$reaction_type." FROM ".PostImage::$table_name."
JOIN ".user::$table_name." ON 
".PostImage::$table_name.".".PostImage::$uploader_id." = ".user::$table_name.".id LEFT JOIN  ".FetchPost::$table_name." ON ".FetchPost::$table_name.".".FetchPost::$post_id." = ".PostImage::$table_name.".".PostImage::$id."  LEFT JOIN  ".Reaction::$table_name." ON ".Reaction::$table_name.".".Reaction::$post_id." =  ".PostImage::$table_name.".".PostImage::$id." WHERE ".PostImage::$table_name.".".PostImage::$id." >={$offset} && ".PostImage::$table_name.".".PostImage::$id."<= {$offset_upperbound}  LIMIT 200";

$results = $db->query($query);
	

$row_count = $results->num_rows;
	  
	if($db->error){
		echo $db->error;
		
	}
// validate the returning of results	
 if($results->num_rows > 0){
	 
 
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
		
}
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
	 log_action(__CLASS__,"Empty post (This is an emergency that needs special attention(check the query very well)) on line: ".__LINE__." in file ".__FILE__);
return;	 
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
		echo $db->error;
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
   public static function get_comments_likes_user_ids($offset = 0,$offset_upperbound = 0){
	    global $db;
		
		
 
 $views_likes_user_ids  = [];
 
 $query = "SELECT ".ViewsLikes::$table_name.".".ViewsLikes::$id." AS ".ViewsLikes::$alias_of_id.",".ViewsLikes::$post_id." AS ".ViewsLikes::$alias_of_post_id.",".ViewsLikes::$table_name.".".ViewsLikes::$comment_id."    AS ".ViewsLikes::$alias_of_comment_id.",".ViewsLikes::$table_name.".".ViewsLikes::$user_id." AS ".ViewsLikes::$alias_of_user_id.",".ViewsLikes::$table_name.".".ViewsLikes::$firstname." AS ".ViewsLikes::$alias_of_firstname.",".ViewsLikes::$table_name.".".ViewsLikes::$lastname." AS ".ViewsLikes::$alias_of_lastname.",".ViewsLikes::$table_name.".".ViewsLikes::$likes_time." AS ".ViewsLikes::$alias_of_likes_time." FROM ".ViewsLikes::$table_name." WHERE ".ViewsLikes::$post_id." >={$offset} && ".ViewsLikes::$post_id." <={$offset_upperbound};"; 
 
 $result = $db->query($query);
   while($row = $result->fetch_assoc()){
	    
				  if(isset($views_likes_user_ids[$row[ViewsLikes::$alias_of_id]])){
				 if(isset($row[ViewsLikes::$alias_of_user_id]) && isset($row[ViewsLikes::$alias_of_user_id]) && !in_array($row[ViewsLikes::$alias_of_user_id],$views_likes_user_ids[$row[ViewsLikes::$alias_of_id]])){
				  $views_likes_user_ids[$row[ViewsLikes::$alias_of_id]][] = $row[ViewsLikes::$alias_of_user_id];
	   
			  }
		}else{
			 $views_likes_user_ids[$row[ViewsLikes::$alias_of_id]][] = $row[ViewsLikes::$alias_of_user_id];
		}
   }
   
   $result->free();
		return $views_likes_user_ids;
   }   
	
	
	// get the replys likes user ids
	public static function get_reply_likes_user_ids($offset = 0,$offset_upperbound = 0){
		
		global $db;
		
	 $reply_views_likes_user_ids  = [];	 
	 
 $query  = "SELECT ".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$id." AS ".ReplyViewsLikes::$alias_of_id.",".ReplyViewsLikes::$post_id." AS ".ReplyViewsLikes::$alias_of_post_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$comment_id."    AS ".ReplyViewsLikes::$alias_of_comment_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$user_id." AS ".ReplyViewsLikes::$alias_of_user_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$firstname." AS ".ReplyViewsLikes::$alias_of_firstname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$lastname." AS ".ReplyViewsLikes::$alias_of_lastname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$likes_time."  AS ".ReplyViewsLikes::$alias_of_likes_time." FROM ".ReplyViewsLikes::$table_name." WHERE ".ReplyViewsLikes::$post_id." >={$offset} && ".ReplyViewsLikes::$post_id." <={$offset_upperbound}"; 

  /* if($db->multi_query($query)){
	  
	  do{
		  
		  if($result = $db->store_result()){
			  if($row = $result->fetch_assoc()){
				 $array[] = $row;
			  if(isset($row[ViewsLikes::$alias_of_id]) && isset($row[ViewsLikes::$alias_of_user_id]) && $row[ViewsLikes::$alias_of_id] > 0 && $row[ViewsLikes::$alias_of_user_id] > 0){
				  
				 
				  $views_likes_user_ids[$row[ViewsLikes::$alias_of_id]][] = $row[ViewsLikes::$alias_of_user_id];
			  }elseif(isset($row[ReplyViewsLikes::$alias_of_id]) && isset($row[ReplyViewsLikes::$alias_of_user_id]) && $row[ReplyViewsLikes::$alias_of_id] > 0 && $row[ReplyViewsLikes::$alias_of_user_id] > 0){
				  
				  $views_likes_user_ids[$row[ReplyViewsLikes::$alias_of_id]][] = $row[ReplyViewsLikes::$alias_of_user_id];
			  }elseif(trim($db->error) != ""){
				  
				   print j(["false" =>"Sorry please server problem"]);
				   return;
			  }else{
				  echo "entered here";
				  return;
			  }
			  
		  }
		  }
		  
	  }while($db->more_results() && $db->next_result());
	  
  } */
  
  $result = $db->query($query);
  $r = [];
   while($row = $result->fetch_assoc()){
	  
				
				
			
			 $reply_views_likes_user_ids[$row[ReplyViewsLikes::$alias_of_id]][] = $row[ReplyViewsLikes::$alias_of_user_id];
		
			
   }
   
   $result->free();
  
    return $reply_views_likes_user_ids ;
	}//get_reply_views_likes();
	
	
	// get the reactions user ids 
	public static function get_reactions_user_ids($offset = 0,$offset_upperbound =0){
		 global $db;
		   
		   
  // Get the reactions user ids to the incidents
  $query = "SELECT * FROM ".Reaction::$table_name." WHERE ".Reaction::$post_id." >= {$offset} && ".Reaction::$post_id."<= {$offset_upperbound}";
  
    $reactions_user_ids = [];
  $result = $db->query($query);
  
  if($db->error != ""){
	  print j(["false"=>"Server problem please refresh the page and try again"]);
	  return;
  }
  
  while($row = $result->fetch_assoc()){
	  $reactions_user_ids[$row[Reaction::$post_id]][$row[Reaction::$user_id]] = $row[Reaction::$reaction_type];
  }
  
  
  
  $result->free();
  
   return $reactions_user_ids;

	}
	
	
	

	
}

?>