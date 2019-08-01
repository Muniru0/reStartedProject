<?php require_once("../private/initialize.php"); 


$query = "SELECT notifications.*,firstname,lastname,sender_id,receiver_id,request_time FROM notifications  LEFT JOIN  pending_connections ON pending_connections.sender_id = notifications_user_id LEFT JOIN users ON users.id = sender_id LEFT JOIN follow_posts ON follow_posts_post_id = notifications_post_id LEFT JOIN post_table  ON  post_table.uploader_id = 1 LEFT JOIN read_status ON notifications_id = read_status_notification_id  WHERE follow_posts_follower_id = 1 &&  notifications_user_id != 1 && read_status_notification_id != 1 && receiver_id = 1 ";

$result = $db->query($query);

if($row = $result->fetch_assoc()){
    echo "<pre>";
	print_r($row);
	echo "</pre>";
}

?>
<!DOCTYPE html>
  <html>
      
    <head>
        <title>CTF</title>
       <!-- <script src = "assets/js/jquery.js" ></script> 
		<script src = "assets/js/jquery-ui.min.js" ></script> 
		<link rel="stylesheet" href= "assets/css/bootstrap.css" />
		-->
		<script src = "assets/js/jquery.js" ></script> 
		<script src = "assets/js/jquery-ui.min.js" ></script> 
		<link rel="stylesheet" href="assets/fonts/fontawesome5/css/all.css" />

</head>
 <body>
 <style>
 div {
  width: 60px;
  height: 60px;
  background-color: skyblue;
}

.moved {
  transform: translate(50px,60px); /* Equal to translateX(10px) */
  background-color: pink;
}

div {
  border: 1px solid red;
  transform: translate3d(12px, 90%, 0.2em);
  width: 140px;
  height: 60px;
}
.div {
  width: 60px;
  height: 60px;
  background-color: skyblue;
  
}

.moved {
  /* Equivalent to perspective(500px) translateX(10px) */
  transform: perspective(5px) translate3d(10px, 0, 0px);
  background-color: pink;
  transition: all .5s;
}

	

.show_change {
	display: block !important;
	transition: all 0.5s ease-in-out!important;
	position: relative;
	left: 50%;
	
	
}

 </style>
<button id="button" style="display:none;">Click</button>
 
 <script>
  /*  
 <button type="button" id="button">Click me</button>
 <div id="sample-div" class="test"> Simple div </div> 
  mutationObserver.observe(document.documentElement, {
  attributes: true,
  characterData: true,
  childList: true,
  subtree: true,
  attributeOldValue: true,
  characterDataOldValue: true
}); */
 $("#button").click(function(e){
	    let v = 1;
		 $("body").append("<p>" + v++ + "</p><h6>New append</h6>");
		 v = v++;
 });
	
      
 
 </script>
 
 <!-- /*
 <style>
 
 .test_div{

  width: 100px;
	height: 100px;
	background : skyblue;
	border-color: skyblue;
	border-radius: 5px;
	margin: 0px auto;
	-webkit-transition: all 0.5s ease-out;
	transition: all 0.5s ease-out ;
 }

 .test_div:hover{

 -webkit-transform: scale(1.1);
  transform: scale(1.1);


 }
 </style> */ -->
<style>

body{
	margin: 0px;
	border: 0px;
	padding: 0px;
	background: #f7f7f7;
}
.outer_wrapper{
width: 100%;
}

</style>
 


 
 <form action="logout.php" method="POST">
<input type="submit" name="submit" value="Log OUt" />
 </form> 
 

 <?php
		$query = "SELECT ".user::$firstname.",".user::$lastname.",COUNT(*) AS count_pending_connections FROM ".PendingConnections::$table_name." JOIN ".user::$table_name." ON ".user::$table_name.".".user::$id." = ".PendingConnections::$receiver_id." WHERE ".PendingConnections::$receiver_id." = ".$_SESSION[user::$id].";";
 echo $query;
	$result =  $db->query($query);
   echo $result->num_rows;
   echo $db->error;
	while($row = $result->fetch_assoc()){

	  echo "<pre>";
	  print_r($row);
	  echo "</pre>";

	}
	return;
//  echo password_hash("azizfahad1",PASSWORD_ARGON2ID);
  // $result = $db->query("SELECT notifications.* FROM notifications LEFT JOIN follow_posts ON follow_posts_post_id = notifications_post_id 	LEFT JOIN connect_users ON connect_users_followed_id = notifications_user_id  WHERE follow_posts_follower_id = 4 && connect_users_follower_id = 4 && notifications_user_id != 4"); 
	
//  $query = "SELECT * FROM notifications LEFT JOIN follow_posts ON follow_posts_post_id = notifications_post_id   WHERE follow_posts_follower_id = 4 &&  notifications_user_id != 4;"; 


//  $query .= "SELECT * FROM notifications  JOIN connect_users ON connect_users_followed_id = notifications_user_id WHERE connect_users_follower_id = 4 && notifications_user_id != 4; ";
	 
//  $query .= "SELECT * FROM notifications JOIN views ON (views.id = notifications_comment_id || views.post_id = notifications_post_id) WHERE notifications_user_id != 4;";
	 
//  $query .= "SELECT * FROM notifications JOIN reply_views ON (reply_views.id = notifications_reply_id || reply_views.post_id = notifications_post_id || reply_views.comment_id = notifications_comment_id)  WHERE notifications_user_id != 4";

	//this query is only for the notifications which you are following the post
	$query = "SELECT * FROM notifications LEFT JOIN follow_posts ON follow_posts_post_id = notifications_post_id  JOIN ".PostImage::$table_name."  ON  ".PostImage::$table_name.".".PostImage::$uploader_id." = ".$_SESSION[user::$id]."   WHERE follow_posts_follower_id = ".$_SESSION[user::$id]." &&  notifications_user_id != ".$_SESSION[user::$id].";"; 


	//this query is only for the notifications which you are following a user
				$query .= "SELECT * FROM notifications  JOIN connect_users ON connect_users_followed_id = notifications_user_id WHERE connect_users_follower_id = 4 && notifications_user_id != 4; ";

// count of the different type of posts that 
$query .= "SELECT ".PostImage::$label.",COUNT(*) AS count_labeled_posts FROM ".PostImage::$table_name." WHERE ".PostImage::$upload_time." > (".time()." - 5284000) GROUP BY ".PostImage::$label;
 $array = [];
 if($db->multi_query($query)){
  do{
		 if($result = $db->store_result()){
			    while($row = $result->fetch_assoc()){
						echo "<pre>";
						print_r($row);
						echo "</pre>";
			 if(!in_array($row["notifications_id"],$array)){

				$array[] =  $row["notifications_id"];
			
	 echo $row["notifications_id"]."<br />";
	 echo $row["notifications_firstname"]." ".$row["notifications_lastname"]."<br />";
	 echo $row["notifications_type"]."<br />";
	 echo FetchPost::time_converter($row["notifications_time"])."<br /><br /><br />";
 
 
			 }
		
       
		 }
		
		 echo "Num rows :".$result->num_rows;
		 $result->free();
		}

	}while($db->more_results() && $db->next_result());
echo "<pre>";
echo count($array);
print_r($array);
echo "</pre>";
 }




//  while($row = $result->fetch_assoc()){

// 	 echo $row["notifications_id"]."<br />";
// 	echo $row["notifications_firstname"]." ".$row["notifications_lastname"]."<br />";
// 	echo $row["notifications_type"]."<br />";
// 	echo FetchPost::time_converter($row["notifications_time"])."<br /><br /><br />";


//  }
//    echo $result->num_rows;
//  $result->free();
//echo password_hash(bin2hex(uniqid(random_bytes(100))),CRYPT_SHA256);

 die();
 echo "<pre>";
 print_r(Pagination::home_posts());
 echo "</pre>";
// 	$query  = "SELECT MAX(".PostImage::$id.") AS ".PostImage::$post_max_id." FROM ".PostImage::$table_name." WHERE ".PostImage::$id." < ".$_SESSION[STREAM_HOME];
// 	$db->query($query);



// 	  if($result = $db->query($query)){
// 	if($row = $result->fetch_assoc()){
	 
//      if($row[PostImage::$post_max_id] >= 1){
// 		echo "by the side";
// 			 // if there are still posts then get the immediate
// 			 // highest post id in the database following the highest post id 
// 			 // in the session.
//       $_SESSION[STREAM_HOME] = $row[PostImage::$post_max_id];
// 		 }elseif($_SESSION[STREAM_HOME] == 0 && $row[PostImage::$post_max_id] == NULL){
// 				 echo "here n";
// 				print j(["true" =>"no_posts"]);
// 				return false;
			 
// 			}elseif( $row[PostImage::$post_max_id] == NULL){
				  
// 				 print j(["true" => "no_more_posts"]);
// 				 return false;
// 			}
			
// 	}elseif(trim($db->error) != ""){

// 		Errors::trigger_error(RETRY);
// 		 return false;
// 		}

// 		}elseif(trim($db->error) != ""){
// 			log_action(__CLASS__,"db erorr::::::".$db->error);
// 			Errors::trigger_error(RETRY);
// 			 return false;
// 			}
// die();
// echo "<pre>";
//  Pagination::get_infinite_scroll(STREAM_HOME);
//  echo "</pre>";

// //Notifications::get_latest_notifications();

 function test_function($id = null){global $db;
	
	 $result = $db->query(" SELECT * FROM notifications JOIN follow_posts ON follow_posts_post_id = notifications_post_id LEFT JOIN connect_users ON connect_users_follower_id = 1");
	 
	 if($result->num_rows > 0){
		 $array = [];
	 while($row = $result->fetch_assoc()){
		echo "<pre>";
		print_r($row);
		echo "</pre>";
	 }

	
	 }else{echo $db->error;}
 }
 
 

 test_function();
 die();
  $a = explode("?","hello");
  if(count($a) > 1){
	echo "how to make things move";  
  }else{
	  echo "how to make";
  }
 die();
 echo "<i class='fal fa-user'></i>";
 
 echo "<a href=\"test_page.php?id=2&username='Yussif'&wrong_param='some_code'\">Link to test.php</a>";
//Pagination::get_infinite_scroll("mainstream"); 
 
 die();
 
 $offset = 220;
 $offset_upperbound = 250;
 
 $query = "SELECT ".ViewsLikes::$table_name.".".ViewsLikes::$id." AS ".ViewsLikes::$alias_of_id.",".ViewsLikes::$post_id." AS ".ViewsLikes::$alias_of_post_id.",".ViewsLikes::$table_name.".".ViewsLikes::$comment_id."    AS ".ViewsLikes::$alias_of_comment_id.",".ViewsLikes::$table_name.".".ViewsLikes::$user_id." AS ".ViewsLikes::$alias_of_user_id.",".ViewsLikes::$table_name.".".ViewsLikes::$firstname." AS ".ViewsLikes::$alias_of_firstname.",".ViewsLikes::$table_name.".".ViewsLikes::$lastname." AS ".ViewsLikes::$alias_of_lastname.",".ViewsLikes::$table_name.".".ViewsLikes::$likes_time." AS ".ViewsLikes::$alias_of_likes_time." FROM ".ViewsLikes::$table_name." WHERE ".ViewsLikes::$post_id." >={$offset} && ".ViewsLikes::$post_id." <={$offset_upperbound};";
 
 
 $query  .= "SELECT ".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$id." AS ".ReplyViewsLikes::$alias_of_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$reply_id." AS ".ReplyViewsLikes::$alias_of_reply_id.",".ReplyViewsLikes::$post_id." AS ".ReplyViewsLikes::$alias_of_post_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$comment_id."    AS ".ReplyViewsLikes::$alias_of_comment_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$user_id." AS ".ReplyViewsLikes::$alias_of_user_id.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$firstname." AS ".ReplyViewsLikes::$alias_of_firstname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$lastname." AS ".ReplyViewsLikes::$alias_of_lastname.",".ReplyViewsLikes::$table_name.".".ReplyViewsLikes::$likes_time."  AS ".ReplyViewsLikes::$alias_of_likes_time." FROM ".ReplyViewsLikes::$table_name." WHERE ".ReplyViewsLikes::$post_id." >={$offset} && ".ReplyViewsLikes::$post_id." <={$offset_upperbound};"; 
 
 $query .= " SELECT * FROM ".LinkUsers::$table_name." WHERE ".LinkUsers::$linker_id."
=4";

 $query .= "SELECT * FROM ".Reaction::$table_name." WHERE ".Reaction::$post_id." >= {$offset} && ".Reaction::$post_id."<= {$offset_upperbound}";


$views_likes_user_ids	     = [];
$reply_views_likes_user_ids  = [];
$linked_users         		 = [];
$reactions_user_ids    		 = [];

  if($db->multi_query($query)){
	  
	  do{
		  
		  if($result = $db->store_result()){
			  if($result->num_rows > 0){
			  while($row = $result->fetch_assoc()){
				 $array[] = $row; 
			  if(isset($row[ViewsLikes::$alias_of_id]) && isset($row[ViewsLikes::$alias_of_user_id]) && $row[ViewsLikes::$alias_of_id] > 0 && $row[ViewsLikes::$alias_of_user_id] > 0){
				  
				 
				  $views_likes_user_ids[$row[ViewsLikes::$alias_of_id]][] = $row[ViewsLikes::$alias_of_user_id];
			  }
			  elseif(isset($row[ReplyViewsLikes::$alias_of_id]) && isset($row[ReplyViewsLikes::$alias_of_user_id]) && $row[ReplyViewsLikes::$alias_of_id] > 0 && $row[ReplyViewsLikes::$alias_of_user_id] > 0){
				  
				  $reply_views_likes_user_ids[$row[ReplyViewsLikes::$alias_of_id]][] = $row[ReplyViewsLikes::$alias_of_user_id];
			  }elseif(isset($row[LinkUsers::$linker_id])){
				  $linked_users[$row[LinkUsers::$linker_id]] = $row;
			  }elseif(isset($row[Reaction::$reaction_type])){
				  $reactions_user_ids[$row[Reaction::$post_id]][$row[Reaction::$user_id]] = $row[Reaction::$reaction_type];
			  }
			  elseif(trim($db->error) != ""){
				  
				   print j(["false" =>"Sorry please server problem"]);
				   return;
			  }else{
				  echo "entered here";
				  return;
			  }
			  
		  }
	  }
	  }
		  
	  }while($db->more_results() && $db->next_result());
	  
  } 
  
  
  
  
  
  echo "<pre>";
 echo "views likes"."<br />";
print_R($views_likes_user_ids);
echo "reply views likes"."<br />";
print_r($reply_views_likes_user_ids);
echo "linked users"."<br />";
print_r($linked_users);  
  echo "</pre>";
 
 /* print_r(Pagination::get_reply_likes_user_ids(220,250)); */
/*  echo $_SESSION["id"];
if(in_array($_SESSION["id"],[4])){
	echo "us;";
}else{
	echo "e";
}
 Pagination::get_infinite_scroll("mainstream");  */
 ?>
 <i class="fal fa-check-circle"></i>
 </body>
  </html>
