<?php

require_once("../private/initialize.php");


class LinkUsers Extends DatabaseObject{
	

  public static $table_name = "link_users";

  public static $id         = "id";
  public static $user_id    = "user_id";
  public static $linker_id  = "linker_id";
  public static $firstname  = "firstname";
  public static $lastname   = "lastname";
  public static $time       = "time";




 public static function link_user($user_id  = 0, $post_id = 0){
	   
	   global $db;
	   

      if(isset($_SESSION[user::$id]) && $_SESSION[user::$id] > 0 && trim($_SESSION[user::$firstname]) != "" && trim($_SESSION[user::$lastname]) != "" ){

      }

	      $user_id = $db->real_escape_string($user_id);
		  $post_id = $db->real_escape_string($post_id);
		  
		  
	   $query = "CALL link_user({$user_id},".$_SESSION[user::$id].",".time().")";
      


	   if($db->multi_query($query)){
          
       
			
			do{
			if($result = $db->store_result()){
				 if($result->num_rows > 0){
			  if($row = $result->fetch_assoc()){
				  if(isset($row) && $row["LAST_INSERT_ID()"] > 0){
					  print j(["true" =>"success"]);
					  return;
				  }elseif($result->affected_rows > 1 && $result->affected_rows == 1){
					  print j(["true" => "success"]);
				  }elseif(trim($db->error) != ""){
					  print j(["false" => "Sorry please refresh the page and try again"]);
					  return;
				  }
			  }	
			
			}
				 }
			}while($db->more_results() && $db->next_result());
				  
	   }
   
   }// link_user();
	

}








