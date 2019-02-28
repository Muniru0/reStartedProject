<?php

require_once(PRIVATE_DIR."initialize.php");





class Reaction extends DatabaseObject{


  public static $table_name      = "reactions";
  public static $reacion_column  = "reaction";

  public static $support     = "support";
  public static $oppose      = "oppose";
  public static $textarea    = "textarea";

  public static $checked     = "checked";
  public static $not_checked = "not_checked";

  // table column names
  public static $id       = "id";
  public static $post_id  = "post_id";
  public static $user_id  = "user_id";
  public static $reaction_type = "reaction_type";
  
  //Join query column aliases
  public static $alias_of_id       = "reactions_table_id";
  public static $alias_of_post_id  = "reactions_table_post_id";
  public static $alias_of_user_id  = "reactions_table_user_id";
  public static $alias_of_reaction_type = "reactions_table_reaction_type";






/**
*This is to insert a new reaction or update it if the 
*person happen to update/change his reaction
**/
public static function record_reaction($post_id = 0,$reactionType = 0){

global $db;



$query = "CALL  add_reactions(?)";
  
 
// prepare the statement
$stmt = $db->prepare($query); 

 if(!$stmt){

 log_action(__CLASS__," Preparation failed  {$stmt->error} ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
 
 print j(["false"=>" Sorry server problem please try again"]);
 return;
 }

/** find the correct bind statement and execute the 
 *  statement
 */
 

 if($_SESSION["id"] < 0){
	 
	print j(["false"=>" Sorry server problem please try again"]); 
	 return;
 }
$user_id = $_SESSION["id"];
 
 if(!isset($user_id) || $user_id < 1 ){
	  print j(["false"=>"Routine security checks,Please refresh the page and continue"]);
	  return;
  }

  $parameters = j([$post_id,$user_id,$reactionType]);
 if(!$stmt->bind_param("s",$parameters)){
  
 log_action(__CLASS__," Binding failed   {$stmt->error} ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
 
 print j(["false"=>" Sorry server problem please try again"]);
 return;

 }



// execute the query
 if(!$stmt->execute()){

 log_action(__CLASS__," Execution failed  {$stmt->error}  ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
 
 print j(["false"=>" Sorry server problem please try again"]);
 return;
 }
  

/* if(!$stmt->bind_result($support,$oppose)){

  log_action(__CLASS__," Preparation failed ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
 
 print j(["false"=>" Sorry server problem please try again"]);
 return;
} */
  
$result = $stmt->get_result();
     if($db->error === "" && $stmt->error === ""){
		 
	 
   if($row = $result->fetch_assoc()){
	    if((isset($row["support"]) && isset($row["oppose"]) && isset($row["id"])) && $row["id"] > 0 ){
			
 print j(["support" => "{$row["support"]}",
 "oppose"=>"{$row["oppose"]}","post_id"=>"{$row["id"]}"]);
		}
	 }
	 }else{
	    
	   print j(["empty"]);
	   
   }
   
  
   
   $stmt->free_result();
}//record_reaction()



/***
 * This is to increase the total number of reactions per post.
 * In the post table.
**/

public static function increase_total_num_reactions($reaction_state = "",$reaction,$post_id = NULL){
global $db;

$query = "";
$bind_param = false;


// if the person has never reacted to this and 
// the person reacted with a support
   if($reaction_state == self::$not_checked && $reaction == 1){

    
$query = "CALL support(?) ";

 
// die("reached the support for procedure...");
 // if the person has never reacted to this and 
// the person is reacting with an oppose
  }elseif($reaction_state == self::$not_checked && $reaction == 0){
      
      $query = "CALL oppose(?)";
    //  die("reached the oppose for procedure...");
// if the person opposed it and now updated it to a support 
  }elseif($reaction_state == self::$checked && $reaction == 1){


$query = " CALL increase_support(?) ";

 // die("First query post_table".$query);
// if the person supported it an now updated it to an oppose
  }elseif($reaction_state == self::$checked && $reaction == 0){


  	$query = " CALL increase_oppose(?)";
   // $bind_param = true;
 // die("Second query post_table".$query);

  }

$stmt = self::S_query($query);

if(!$stmt){

	die("Preparation failed: ".$db->error);

}

/** find the correct bind statement and execute the 
 *  statement
 */
if(!$stmt->bind_param("i",$post_id)){


	die("Binding failed: ".$db->error." ".$stmt->error);

}

if(!$stmt->execute()){


die("Execute failed: ".$db->error." ".$stmt->error);
}


//die("the execution has taken place...");
// bind the result query 
$result = $stmt->bind_result($support,$oppose);


if($stmt->fetch()){
  
    //die($support.$oppose.$post_id);
  // return the number of reactions and the type of reaction
  return [$support,$oppose,$post_id]; 
}else{
  //die("it is here");
	return false;
}



}//increase_total_num_reactions()
  





}

?>