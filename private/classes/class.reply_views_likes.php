<?php 
 
 require_once("../private/initialize.php");

 class ReplyViewsLikes Extends ViewsLikes {

 // table name
  public static $table_name       = "reply_views_likes";
 

  // columns of the database 
   public static $id = "id";
   public static $post_id = "post_id";
   public static $comment_id = "comment_id";
   public static $user_id = "user_id";
   public static $reply_id = "reply_id";
   public static $firstname = "firstname";
   public static $lastname = "lastname";
   public static $likes_time = "likes_time";
   


// columns of the database 
   public static $alias_of_id = "reply_views_likes_table_id";
   public static $alias_of_post_id = "reply_views_likes_table_post_id";
   public static  $alias_of_comment_id = "reply_views_likes_table_comment_id";
   public static $alias_of_user_id = "reply_views_likes_table_user_id";
   public static $alias_of_reply_id = "reply_views_likes_table_reply_id";
   public static $alias_of_firstname = "reply_views_likes_table_firstname";
   public static $alias_of_lastname = "reply_views_likes_table_lastname";
   public static $alias_of_likes_time = "reply_views_likes_table_likes_time";


  



 }


 ?>