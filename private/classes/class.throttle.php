<?php 

require_once(PRIVATE_DIR."initialize.php");


  class Throttle {


    // name of the table for the class
    private static $table_name = "throttle";
    private static $email = "email";
    public static  $failed_logins = "failed_logins";
    private static $ip            = "ip";
    private static $failure_time = "failure_time";


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

if(trim($email) == ""){

  return false;
}

$email = trim($email);

$query = " SELECT ".self::$failed_logins.",".self::$failure_time." FROM ".self::$table_name." WHERE ".self::$email." = ? ";


    // this function prepares the statement and returns it from the Mysql class
    // Use this for simpler straight-forward queries(from the sql class)
    $stmt = $db->prepare($query);

     if(!$stmt){
    log_action(__CLASS__,$db->error.__LINE__);
      return false;
	 }

   $email = (string)$email;

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
  
  

   $stmt_result = $stmt->get_result();
  

    if($stmt_result->num_rows <= 0){
  
      return [self::$failed_logins => 0,self::$failure_time => 0];
    }
  
    

	if($row = $stmt_result->fetch_array(MYSQLI_ASSOC)){
    
		$result = [self::$failed_logins => $row[self::$failed_logins],self::$failure_time => $row[self::$failure_time]];
	}else{
  
   
	return;
	}

 
 $stmt->close();
 $stmt_result->free();

 return  $result; 
}// failed_logins_info();


/**
 * 
 */

public static function check_user_throttling_state($email = ""){

  $throttle_delay = 10;
  $throttle_time  = 60 * $throttle_delay;
    
  if(trim($email) == ""){

    return false;
  }


  //
  $throttle_info = throttle::failed_logins_info($email);
  
 
  if(!is_array($throttle_info) || empty($throttle_info)){

    Errors::trigger_error(SERVER_PROBLEM);
return false;
  }
  
  $failed_logins         = $throttle_info[self::$failed_logins];
  $last_attempt_time     = $throttle_info[self::$failure_time];
  
  // check to see if the user is throttled
  if($failed_logins >= 20 && $failed_logins < 10000){
  
    // check to see if the throttle period has ended
  if(($last_attempt_time + $throttle_time) > time()){
    
    
// that means that they are still being throttled
  return $failed_logins;
  }
    // if the throttle time has elapsed then return
    // accept attempted logins again.
   return 0;
  }elseif($failed_logins >= 10000){
      BlackListedIps::addBlacklisted_ip($_SERVER["REMOTE_ADDR"]);
       Errors::trigger_error(BLOCKED_REQUEST);
     $_SESSION["message"] = "Request Blocked: Please our systems are noticing unusual traffic from your computer.Try again after some time.";
      die();
    return;
  }

  return $failed_logins;
   
	     }// throttle_user();
  
 


/**
 *
 * Records and increases the number of failed logins
 * 
 */


public  static function record_failed_login($email = ""){
    
	global $db;


  $ip = $_SERVER["REMOTE_ADDR"] ?? "";
  $ip = (string)$ip;
 
  if(trim($email) == ""){
  
    return false;
  }

 $email = trim($email);

  $query = "INSERT INTO ".Throttle::$table_name." (email,failed_logins,ip,failure_time) VALUES (?,?,?,?)";
 

// prepare the statement
 $stmt = $db->prepare($query);

 if(!$stmt){
log_action(__CLASS__,"$db->error".__LINE__);
return ;
 }

$failed_logins = 1;
$time = time();

// bind param
 $bind = $stmt->bind_param("siss",$email,$failed_logins,$ip,$time);
if(!$bind){
  log_action(__CLASS__,"$db->error".__LINE__);
  return false;

}

// execute the statement
if(!$stmt->execute()){
  log_action(__CLASS__,"$db->error".__LINE__);
 return false;


  }

  

  }



/**
 * increase(updates) the number of failed logins
 * @param $failed_logins: the number of times the 
 * user tried to login but failed
 */

public static function increase_failed_logins($email = ""){
   global $db;

   if(trim($email) == "" || !is_email($email)){

    return false;
   }
    
 
$query  = "UPDATE ".self::$table_name." SET ".self::$failed_logins." =  ".self::$failed_logins." + ? WHERE ".self::$email." = ? ";
    
// prepare the statement
$stmt = $db->prepare($query);


// bind the parameter
  if(!$stmt){
    log_action(__CLASS__,$db->error." LINE: ".__LINE__);
    
 return false;
  }

  $failed_logins_increment_number = 1;
// bind the params 
 if(!$stmt->bind_param("is",$failed_logins_increment_number,$email)){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
  return false;
 }
//execute the statement

if(!$stmt->execute()){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
  return false;
}


   } // increase_failed_logins()


  

   


public static function clear_failed_logins($email = 0){


  
  global $db;

  $failed_logins = 0;

$query  = "UPDATE  ".throttle::$table_name." SET ".self::$failed_logins." = ? WHERE ".self::$email." = ?";
    
// prepare the statement
$stmt = $db->prepare($query);

if(!$stmt){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
return false;
}

$failed_logins_clear_number = 0;

// bind the parameter
if(!$stmt->bind_param("is",$failed_logins_clear_number,$email)){
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