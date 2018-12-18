<?php
require_once(PRIVATE_DIR."initialize.php");
//// Blacklist functions
//
//// Check if an IP has been blacklisted.
//// Returns true or false.


function is_blacklisted_ip($ip) {
  
 global $db;

$query = "SELECT ip FROM blacklisted_ips WHERE ip = '{$ip}' LIMIT 1";

$result = $db->query($query);

if($row = $result->fetch_assoc()){
   
   echo $row['ip'];
   return true;
}
}
//
//// The function that actually performs the blocking.
function block_blacklisted_ips() {
	$request_ip = $_SERVER['REMOTE_ADDR'];
	if(isset($request_ip) && is_blacklisted_ip($request_ip)) {
		die("Request blocked");
	}
}
//
//// Add an IP address to the blacklist
//// Can be done automatically after a certain 
//// amount of bad behavior is reached.
//function add_ip_to_blacklist($ip) {
//	$record = ['ip' => sql_prep($ip)];
//	add_record_to_fake_db('blacklisted_ips', $record);
//	return true;
//}

?>
