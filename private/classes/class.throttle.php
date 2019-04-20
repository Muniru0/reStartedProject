<?php 

require_once(PRIVATE_DIR."initialize.php");


  class throttle {


    // name of the table for the class
    private static $table_name = "throttle";
    private static $email = "email";
    private static $failed_logins = "logins";
    private static $ip            = "ip";
    private static $failure_time = "failure_time";
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


public static function failed_logins_info($email = "" ) {


global $db;

$query = " SELECT failed_logins, failure_time FROM ".Throttle::$table_name." WHERE email = ? LIMIT 1";

    // this function prepares the statement and returns it from the Mysql class
    // Use this for simpler straight-forward queries(from the sql class)
    $stmt = $db->prepare($query);
     if(!$stmt){
      log_action(__CLASS__,$db->error." LINE: ".__LINE__);
      return false;
	 }

     // bind the parameters
    if(!$stmt->bind_param("s",$email)){
      log_action(__CLASS__,$db->error." LINE: ".__LINE__);
      return false;
      }

    //execute the statemet
    if(!$stmt->execute()){
      log_action(__CLASS__,$db->error." LINE: ".__LINE__);
      return false;
    }
	
	
	$result = $stmt->get_result();
	
	if($row = $result->fetch_assoc()){
		
		return [$row["failed_logins"],$row["failure_time"]];
	}else{
    log_action(__CLASS__,$db->error." LINE: ".__LINE__);
	return;
	}

    // bind the result
     $stmt->bind_result($failed_logins,$failure_time);
    
if($stmt->fetch()){

  return [$failed_logins,$failure_time];
}else{
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
  // Errors::trigger_error(RETRY);
// return -1 to differentiate between having no rows {which will return 0} and
//  having an error in fetch the result
   return false;
  }

}


public static function throttle_user(){

  $throttle_delay = 10;
  $throttle_time  = 60 * $throttle_delay;

  //
  $throttle_info = throttle::failed_logins_info(user::$email);
  
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
   
   
	     }// throttle_user();
  
 


/**
 *
 * Records and increases the number of failed logins
 * 
 */


public  static function record_failed_logins($email = ""){
    
	global $db;


  $ip = $_SERVER["REMOTE_ADDR"];
  $ip = "$ip";
  $max_failed_attempts = 20;
  
  // if the number of failed logins is zero then record this as 1
 if(throttle::$failed_logins == 0){
  
  $query = "INSERT INTO ".Throttle::$table_name." (email,failed_logins,ip,failure_time) VALUES (?,?,?,?)";
 

// prepare the statement
 $stmt = $db->prepare($query);

 if(!$stmt){

return ;
 }

$failed_logins = 1;
$time = time();

// bind param
 $bind = $stmt->bind_param("siss",$email,$failed_logins,$ip,$time);
if(!$bind){

  return false;

}

// execute the statement
if(!$stmt->execute()){

 return false;


  }
  
// elseif the number of failed logins is greater than zero then
// increase the number of failed logins by 1
}else{
     
     
    throttle::increase_failed_logins();
    return false;

    }
  

  }



/**
 * increase(updates) the number of failed logins
 * @param $failed_logins: the number of times the 
 * user tried to login but failed
 */

public static function increase_failed_logins(){
   global $db;
    
 $failed_logins =+ 1;
$query  = "UPDATE ".self::$table_name." SET ".self::$failed_logins." =  ".self::$failed_logins." + 1 WHERE ".self::$email." = ? ";
    
// prepare the statement
$stmt = $db->prepare($query);


// bind the parameter
  if(!$stmt){
    log_action(__CLASS__,$db->error." LINE: ".__LINE__);
    Errors::trigger_error(RETRY); 
 
  }

// bind the params 
 if(!$stmt->bind_param("s",user::$email)){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
  Errors::trigger_error(RETRY);
  return false;
 }
//execute the statement

if(!$stmt->execute()){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
  Errors::trigger_error(RETRY);
  return false;
}


   } // increase_failed_logins()


  

   


public static function clear_failed_logins($email = 0){


  
  global $db;

  $failed_logins = 0;

$query  = "UPDATE ".throttle::$table_name." SET failed_logins = ?  WHERE email = ?";
    
// prepare the statement
$stmt = $db->prepare($query);

if(!$stmt){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
return false;
}
// bind the parameter

if($stmt->bind_param("is",$failed_logins,$email)){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
}

//execute the statement
$execute = $stmt->execute();
  
if(!$execute){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
  Errors::trigger_error(RETRY);
 
 return false; 
   }
     
 
}


  }




?>