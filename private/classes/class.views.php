<?php

require_once(PRIVATE_DIR."initialize.php");

class Views extends DatabaseObject{

   public static $table_name   = "views";

   //columns in database
   public static $id           = "id";
   public static $post_id      = "post_id";
   public static $comment      = "commnent";
   public static $commentor_id = "commentor_id";
   public static $comment_time = "comment_time";
   

   // get all the views for some specific post_ids
   public static function get_views($post_ids = [])
   {
	   global $db;
	   
	   $query = "SELECT * FROM ".self::$table_name." WHERE ";
	   foreach($post_ids as $post_id)
	{
		$query .= " post_id = {$post_id} ||";
		
	}
	
	 $query = substr_replace($query,'',-2, 2);
	  

     if(!$db->query($query))
	 {
		 log_ation(__CLASS__," Query failed with db error '{$db->error}' on line  ".__LINE__." on file ".__FILE__);
	 } 	  
	   
	   
   }// get_views();
   
   
   
   
   // add a new comment to the database
  public static function add_view($post_id = 0,$commentor_id = 0,$comment = "", $comment_time = 0){

    global $db;
	
	if((!isset($post_id) && $post_id < 1) || !is_array($post_ids))
		{
			return "";
			
		}
       
	$query = "INSERT INTO ".self::$table_name." VALUES(NULL,$post_id,$commentor_id,$comment,$comment_time) ";
	
   if(!$db->query($query))
   {
	   log_action(__CLASS__," Query failed on line "__LINE__." in file ".__FILE__);
	   print j(["false" => "Please is us not you please try again."]);
	   return false;
   }
   
   return $db->insert_id;
 

}




// update the view being
public static function update_view($view_id = null,$post_id = null,$link_type = null){

   global $db;
   $view_id = $view_id;
  echo $view_id." ".$post_id." ".$link_type;
$info = json_encode([(int)$view_id,(int)$post_id,$link_type]);
$query = "CALL update_view(?)";


$stmt = self::S_query($query);

if(!$stmt){

	die("Preparation failed: update_view() Views || ".$db->error);

}


if(!$stmt->bind_param("s",$info)){

 die("Binding failed: update_view() Views || ".$stmt->error);
}

if(!$stmt->execute()){

 die("Execution failed: update_view() Views || ".$stmt->error);
}

// if(!$stmt->bind_result($result)){

//  die("binding failed: update_view() Views || ".$stmt->error);
// }

// if($stmt->fetch()){

//  return $result;
// }

return $stmt->get_result();

}//update_view();



public static function edit_view($view_id = null,$post_id = null,$link_type = null,$view){


	global $db;
 
 $time = time();
 $info = json_encode([$view_id,$post_id,$link_type,$view,$time]);

	$query = "CALL edit_view(?)";


$stmt = self::S_query($query);

	if(!$stmt){

  die("Preparation failed: edit_view() Views|| ".$db->error);
	}

	if(!$stmt->bind_param("s",$info)){

  die("binding failed: edit_view() Views || ".$stmt->error);
	}

	if(!$stmt->execute()){

   die("Execution failed: edit_view() Views || ".$stmt->error);
	}

}




public static function  add_view_reaction($info =""){

	global $db;


$info = explode("\\", $info);
//$info = implode("/",$info);
$info[0] = $_SESSION["id"];
$info = implode("",$info);
 

$query = "CALL reaction_on_view(?)";


$stmt = self::S_query($query);

if(!$stmt){

 die("Prepartion failed: add_view_reaction(): Views.. ".$db->error." @ line ".__LINE__." on file ".__FILE__);
}

if(!$stmt->bind_param("s",$info)){

	die("Binding failed: add_view_reaction(): Views ".$stmt->error." on line ".__LINE__." in file :".__FILE__);

}

if(!$stmt->execute()){

	die("Execution failed: add_view_reaction(): Views ".$stmt->error." on line ".__LINE__." in file: ".__FILE__);
}

if(!$stmt->bind_result($support,$oppose)){

die("Binding result failed: add_view_reaction() : Views ".$stmt->error." on line ".__LINE__."in file ".__FILE__);
}

if($stmt->fetch()){

 return [$support,$oppose];
}
}


}




?>