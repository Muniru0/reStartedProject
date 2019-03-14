<?php

require_once("../private/initialize.php");

class LinkUsers Extends DatabaseObject{
	

  public static $table_name = "link_users";


  public static $id         = "id";
  public static $link      = "link";
  public static $linker_id  = "linker_id";
  public static $firstname  = "firstname";
  public static $lastname   = "lastname";
  public static $time       = "time";


  public static $session_string = "linked_users_ids";

  public static function link_user($user_id  = 0, $post_id = 0){
	   
	   global $db;

      if(isset($_SESSION[user::$id]) && $_SESSION[user::$id] > 0 && trim($_SESSION[user::$firstname]) != "" && trim($_SESSION[user::$lastname]) != "" ){

      }

	      $user_id = $db->real_escape_string($user_id);
		  $post_id = $db->real_escape_string($post_id);
		  
		  
	   $query = "CALL link_user({$user_id},".$_SESSION[user::$id].",".time().")";
      


	   if($db->multi_query($query)){
          
       log_action(__CLASS__,"passed 3".__LINE__);
			
			do{
        log_action(__CLASS__,"passed 2".__LINE__);
			if($result = $db->store_result()){
				
				 if($result->num_rows > 0){
			  if($row = $result->fetch_assoc()){
          log_action(__CLASS__,"passed 2".__LINE__);
				  if(isset($row) && $row["result"] > 0){
					  print j(["true" =>"success"]);
					  return;
				  }elseif(isset($row) && $row["result"] == 0){
					  
					  print j(["unlink" => "success"]);
					  return;
				  }elseif(trim($db->error) != ""){
				  log_action(__CLASS__,$db->error);
					  print j(["false" => "Sorry please refresh the page and try again there"]);
					  return;
				  }
			  }	
			
			}
				 }else{
					 log_action(__CLASS__,$db->error);
					 print j(["false" => "Please refresh the page and try again. here"]);
					 return;
				 }
			}while($db->more_results() && $db->next_result());
				  
	   }else{
      echo $db->error;
     }
   
   }// link_user();
	

}








