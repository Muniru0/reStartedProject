<?php
require_once("../private/initialize.php");
// Put all of your general functions in this file

// header redirection often requires output buffering 
// to be turned on in php.ini.
function redirect_to($new_location) {
  header("Location: " . $new_location);
  exit;
}


 // Sanitize functions
// Make sanitizing easy and you will do it often



// Sanitize for JavaScript output
function j($string) {
  return json_encode($string);
}

// decode a json string
function jd($string){
    return json_decode($string);
}


function log_action($action="",$message=""){

$file = PRIVATE_DIR.SHARED_DIR."log.txt";

   if (!file_exists($file) || !is_writable($file)){
	file_put_contents($file, "Please this file is not writtable");
   } else{  
     $time = strftime("%e/%b/%Y %I:%M:%S %p",filemtime($file));
	 $content = "[".$time."] : [".$action."] | ".$message."\n";
     file_put_contents($file, $content,FILE_APPEND | LOCK_EX);
	 }
	   }

		   
      


// Core validation functions
// These need to be called from another validation function which 
// handles error reporting.
//
// For example:
//
$errors = [];
 function validate_presence_on($required_fields = []) {
// set a count variable to keep count of the errors
   global $errors;
    
   foreach($required_fields as $field) {

   	if(!isset($_POST[$field]) && $field == "label"){
    $_POST["label"] = $_POST["text_label"];
   	}
 if ($field != "date" && !has_presence($_POST[$field])) {
      $errors[] = "Please " . h(addslashes($field)) . " can't be blank()";
      
         
	 }
   }
 
    
   if(!empty($errors)){
       print j($errors);
       return false;
   }
     
   
  return true; 
 }

// * validate value has presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function has_presence($value) {
	$trimmed_value = trim($value);
	
  return isset($trimmed_value) && $trimmed_value !== "";
}

// * validate value has string length
// leading and trailing spaces will count
// options: exact, max, min
// has_length($first_name, ['exact' => 20])
// has_length($first_name, ['min' => 5, 'max' => 100])
function has_length($value, $options=[]) {
	if($options["max"] )
	{
		print j("integer found");
	}
	if(isset($options['max']) && (strlen($_POST[$value]) > (int)$options['max'])) {
	   print j(ucfirst($value)." must be atleast 8 characters.");
		return false;
	}
	if(isset($options['min']) && (strlen($_POST[$value]) < (int)$options['min'])) {
	  print j(ucfirst($value)." must be atleast 8 characters.");
		return false;
	}
	if(isset($options['exact']) && (strlen($_POST[$value]) != (int)$options['exact'])) {
		print j(ucfirst($value)." must be exactly as {$options["exact"]}");
		return false;
	}
	
	return true;
}

// * validate value has a format matching a regular expression
// Be sure to use anchor expressions to match start and end of string.
// (Use \A and \Z, not ^ and $ which allow line returns.) 
// 
// Example:
// has_format_matching('1234', '/\d{4}/') is true
// has_format_matching('12345', '/\d{4}/') is also true
// has_format_matching('12345', '/\A\d{4}\Z/') is false
function has_format_matching($value, $regex='//') {
	return preg_match($regex, $value);
}

// * validate value is a number
// submitted values are strings, so use is_numeric instead of is_int
// options: max, min
// has_number($items_to_order, ['min' => 1, 'max' => 5])
function has_number($value, $options=[]) {
	if(!is_numeric($value)) {
		return false;
	}
	if(isset($options['max']) && ($value > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && ($value < (int)$options['min'])) {
		return false;
	}
	return true;
}


function is_real_name($fields = []) {

   foreach($fields as $field){

   
   preg_match('/([^A-Za-z])/', trim($_POST[$field]),$matches);

  if(!empty($matches)){
    
    echo "Please ".h($field)." should contain only alphbets.";
   return false;
   
  }
   }
return true;	
}
// * validate value is inclused in a set
function has_inclusion_in($value, $set=[]) {
  return in_array($value, $set);
}

// * validate value is excluded from a set
function has_exclusion_from($value, $set=[]) {
  return !in_array($value, $set);
}

function is_email($email = ""){


  if(isset($email) && !empty(trim($email))){

  $dot = strpos($email,".");
  $at = strpos($email,"@");
 $filtered_email = filter_var($email,FILTER_VALIDATE_EMAIL); 
    
if($filtered_email === false || ($dot < 1) || ($at < 1)){
  $array = ["Please check the email ( ' ".$email." ' ) and try again!"];
      print j($array);
       $array = null;
         return false;
} 
      return true;
  }

}


function is_phone($number = 0){
 
 $number = $_POST[$number];
  
 if(isset($number) && !empty(trim($number))){

  
 $return = preg_match('/^[0-9]{10}+$/',$number);

  if(!$return){

   echo "INVALID number";

   return $return;
  }


  return $return;
 
 }
}


// redirect to the login page
function log_in_page(){

header("Location: ".PUBLIC_PATH."/login.php");
exit;
}

// display a page not found
function page_not_found(){
header("HTTP/1.1 404 Not Found");
exit;
}


function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}


function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if(!function_exists('money_format')) {
  function money_format($format, $number) {
    return '$' . number_format($number, 2);
  }
}

?>
