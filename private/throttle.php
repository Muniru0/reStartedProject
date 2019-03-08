<?php 



  class throttle {


    // name of the table for the class
    private static $table_name = "throttle";
    private static $failed_logins = 0;
    private static $last_attempt_time = 0;

/**
 * For quering the num of failed logins
 *
 *@param $email: the submitted email
 *@param $password: the submitted password
 *
 *return : the num of failed attempts or -1 {fetch()} failed
 *return : the time of the last failed login
 */


public static function failed_logins_info($email = "" , $password = "") {

global $sql;
global $db;

$query = " SELECT num_failed_logins,time_failed FROM ".Throttle::$table_name." WHERE email = ? LIMIT 1";

    // this function prepares the statement and returns it from the Mysql class
    // Use this for simpler straight-forward queries(from the sql class)
    $stmt = $sql->query($query);


     // bind the parameters
    $bind = $stmt->bind_param("s",$email);
    if(!$bind){
    log_action("Throttle User (): ", "Binding failed : ( " .$db->errno. " ) ".$db->error);
      }

    //execute the statemet
    $execute = $stmt->execute();
    if(!$execute){
    log_action("Throttle User() : ", "Execution failed : ( " .$db->errno. " ) ".$db->error);
    }

    // bind the result

$result = $stmt->bind_result($failed_logins,$time_failed);

if($stmt->fetch()){

  return [$failed_logins,$time_failed];
}else{

  log_action("num_of_failed_logins(): ", "Couldn't fetch the result: ( ".$db->errno." ) ".$db->error);
// return -1 to differentiate between having no rows {which will return 0} and
//  having an error in fetch the result
   return -1;
  }

}


public static function throttle_user($num_failed_logins = 0){

  $throttle_delay = 10;
  $throttle_time  = 60 * $throttle_delay;

  //
  $throttle_info = throttle::failed_logins_info();
  
  $failed_logins      = throttle::$failed_logins     = $throttle_info[0];
  $last_attempt_time  = throttle::$last_attempt_time = $throttle_info[1];
  // if the num of failed attempts is greater than 
  // or equal to 20
  if($failed_logins >= 20){
   
    // throttle them but check to see if the throttle time 
    // for has already elapsed
   //check to see if the time for the throttle
    // if any hasn't elapsed
  if(($last_attempt_time + $throttle_time) > time()){
    
    
// that means that they are still being throttled
  return false;
  }
 
 // now the throttle delay period is over    
return true;

  } else{

    // returning true here will enable the srcipt authenticate
    // the submitted data
  	return true;
  }
   
   
	     }
  
 


/**
 *
 * Records and increases the number of failed logins
 * 
 */


public  static function record_failed_logins($email = ""){
    global $sql;
	global $db;

$db = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
  $ip = $_SERVER["REMOTE_ADDR"];
  $ip = "$ip";
  $max_failed_attempts = 20;
  
  // if the number of failed logins is zero then record this as 1
 if(throttle::$failed_logins == 0){
  
  $query = "INSERT INTO ".Throttle::$table_name." (email,num_failed_logins,ip,time_failed) VALUES (?,?,?,?)";
 

// prepare the statement
 $stmt = $sql->query($query);

 if(!$stmt){

die("the statement failed to query: ".$db->errno);
 }

$failed_logins = 1;
$time = time();

// bind param
 $bind = $stmt->bind_param("siss",$email,$failed_logins,$ip,$time);
if(!$bind){

log_action("Throttle User: ", "Insert Binding failed : ( " .$db->errno. " ) ".$db->error);

}

// execute the statement
if(!$stmt->execute()){

log_action("Throttle User: ", "Execution failed : ( " .$db->errno. " ) ".$db->error);
return true;

  }

// elseif the number of failed logins is greater than zero then
// increase the number of failed logins by 1
}else{
     
     
    throttle::increase_failed_logins(throttle::$failed_logins);
    return false;

    }
  

  }



/**
 * increase(updates) the number of failed logins
 */

public static function increase_failed_logins($failed_logins = 0){

	global $sql;
	global $db;
 $failed_logins =+ 1;
$query  = "UPDATE ".Throttle::$table_name." SET num_failed_logins = ? WHERE email = ? ";
    
// prepare the statement
$stmt = $sql->query($query);


// bind the parameter
  if(!$stmt){

log_action("increase_failed_logins () : ".$db->error); 
 
  }


$bind = $stmt->bind_param("is",$failed_logins,user::$email);

 if(!$bind){

 log_action("increase_failed_logins () : ".$db->error); 
 }
//execute the statement
$execute = $stmt->execute();
  
if(!$execute){

log_action("Throttle User: ", "Execution failed : ( " .$db->errno. " ) ".$db->error);
}


   }  



   


public static function clear_failed_logins($email = 0){


  global $sql;
  global $db;

  $num_failed_logins = 0;

$query  = "UPDATE ".throttle::$table_name." SET num_failed_logins = $num_failed_logins  WHERE email = ?";
    
// prepare the statement
$stmt = $sql->query($query);

if(!$stmt){

die("Preparation failed: (".$db->errno." ) ". $db->error);
}
// bind the parameter
$bind = $stmt->bind_param("s",$email);

//execute the statement
$execute = $stmt->execute();
  
if(!$execute){

log_action("Throttle User: ", "Execution failed : ( " .$db->errno. " ) ".$db->error);
 
 return false; 
   }
     
 
}


  }




?>