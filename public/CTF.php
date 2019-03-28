<?php require_once("../private/initialize.php"); 
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
	  
	 $("#sample-div").toggleClass("show_change");
	 
 });
	
      
 
 </script>
 
 
 <?php

 Pagination::get_post_comments();
 
 function test_calling_functions($id = 10000){global $db;
	 $result = $db->query("SELECT * FROM test LIMIT 1,2");
	 
	 if($result->num_rows > 0){
	 while($row = $result->fetch_assoc()){
		 echo $row["id"]."<br />";
	 }
	 }else{echo $db->error;}
 }
 
 
 die();
 test_calling_functions();
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
