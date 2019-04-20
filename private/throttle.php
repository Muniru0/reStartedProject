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


global $db;

$query = " SELECT num_failed_logins,time_failed FROM ".Throttle::$table_name." WHERE email = ? LIMIT 1";

    // this function prepares the statement and returns it from the Mysql class
    // Use this for simpler straight-forward queries(from the sql class)
    $stmt = $db->prepare($query);

   if(!$stmt){

    return;
   }
     // bind the parameters
    $bind = $stmt->bind_param("s",$email);
    if(!$bind){
    
      return;


      }

    //execute the statemet
    $execute = $stmt->execute();
    if(!$execute){

    return;

    }

    // bind the result

$stmt->bind_result($failed_logins,$time_failed);

if($stmt->fetch()){

  return ["failed_logins" => $failed_logins,"time_failed" => $time_failed];
}else{

// return -1 to differentiate between having no rows {which will return 0} and
//  having an error in fetch the result
   return -1;
  }

}


public static function throttle_user(){
log_action(__CLASS__,'logging');
  $throttle_delay = 10;
  $throttle_time  = 60 * $throttle_delay;

 
  $throttle_info = throttle::failed_logins_info();
  
  $failed_logins      = throttle::$failed_logins     = $throttle_info["failed_logins"];
  $last_attempt_time  = throttle::$last_attempt_time = $throttle_info["time_failed"];
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
  
  $query = "INSERT INTO ".Throttle::$table_name." (email,num_failed_logins,ip,time_failed) VALUES (?,?,?,?)";
 

// prepare the statement
 $stmt = $sql->query($query);

 if(!$stmt){

  return false;
 }

$failed_logins = 1;
$time = time();

// bind param

if(!$stmt->bind_param("siss",$email,$failed_logins,$ip,$time)){
return false;
}

// execute the statement
if(!$stmt->execute()){

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


	global $db;
 $failed_logins =+ 1;
$query  = "UPDATE ".Throttle::$table_name." SET num_failed_logins = ? WHERE email = ? ";
    
// prepare the statement
$stmt = $db->prepare($query);


// bind the parameter
  if(!$stmt){

return false;
 
  }




 if(!$stmt->bind_param("is",$failed_logins,user::$email)){

return false;

 }

//execute the statement

if(!$stmt->execute()){

return false;
}


   }  



   


public static function clear_failed_logins($email = 0){

  global $db;

  $num_failed_logins = 0;

$query  = "UPDATE ".throttle::$table_name." SET num_failed_logins = $num_failed_logins  WHERE email = ?";
    
// prepare the statement
$stmt = $db->prepare($query);

if(!$stmt){


 log_action(__CLASS__,$db->error." LINE: ".__LINE__);
return ;
}
// bind the parameter
if(!$stmt->bind_param("s",$email)){
  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
return ;

}

//execute the statement
$execute = $stmt->execute();
  
if(!$execute){

  log_action(__CLASS__,$db->error." LINE: ".__LINE__);
return ;
   }
     
 
}


  }




?>