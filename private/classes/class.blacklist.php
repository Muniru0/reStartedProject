<?php
require_once(PRIVATE_DIR."initialize.php");
//// Blacklist functions
//
//// Check if an IP has been blacklisted.
//// Returns true or false.


class BlackListedIps {

	public static $table_name = "blacklisted_ips";
	public static $id         = "id";
	public static $ip  		  = "ip";
	public static $blacklist_time = "blacklist_time";


	public static function addblacklisted_ip($ip = ""){

		global $db;

		if(trim($ip) == ""){
return;
		}

		$ip = $db->real_escape_string($ip);
		$query = "INSERT INTO ".self::$table_name." VALUES(NULL,{$ip},".time().")";
		$result = $db->query($query);

		return $db->affected_rows;
}

	public static function is_blacklisted_ip(){
  
		global $db;
		$ip = trim($_SERVER["REMOTE_ADDR"]);
		 
		if(trim($ip) == ""  || strlen($ip) < 1 ){
			die("Request Blocked (INVALID REQUEST INFORMATION)");
			return;
		}
		
	    $ip = $db->real_escape_string($ip);
	   $query = "SELECT ".self::$ip."  FROM ".self::$table_name." WHERE ".self::$ip." = '{$ip}' LIMIT 1";

	   $result = $db->query($query);
	   if($result->num_rows > 0){
 return true;
	   }
		
		  return false;
	   
	   }// is_blacklisted_ip();


	   //
	   //// The function that actually performs the blocking.
	   public static function block_blacklisted_ips() {
		
		   $request_ip = $_SERVER['REMOTE_ADDR'];
		   if(isset($request_ip) && self::is_blacklisted_ip()) {
			 
			   die("Request Blocked: Due to several bad attempts.");
			   return;
		   }
		  
	   }//block_blacklisted_ips();
	   

}



?>
