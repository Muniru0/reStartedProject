<?php

class Errors{







 public static function trigger_error($error_msg = ""){


      if(trim($error_msg) == ""){
return;
      }


  switch ($error_msg) {
  	case RETRY:
  		print j(["false"=>"Please refresh the page and try again"]);
  		break;
		case INVALID_SESSION:
  		print j(["false"=>"login"]);
  		break;
		case UNEXPECTED_RETRY:
  		print j(["false"=>"Sorry, Something unexpectedly happened,please refresh the page and try again."]);
		  break;
		case UNIDENTIFIED_ERROR:
  		print j(["false"=>"Sorry, unidentified error please refresh the page and try again."]);
		  break;
		  case RE_INITIATE_OPERATION:
  		print j(["false"=>"Please refresh the page and try again, if the action wasn't successful "]);
  		break;  
		  case SERVER_PROBLEM:
		  print j(["false" => "Server problem, please refresh the page and try again if the problem persists."]);
  		break;  
		  case OPERATION_FAILED:
		  print j(["false" => "Operation failed, Please try again later."]);
  		break;  
		  case RE_SEND_MESSAGE:
		  print j(["false" => "Error sending your message please try again."]);
  		break;  
		  case INVALID_REQUEST:
		  print j(["false" => "Invalid request, refresh the page and try again."]);
  		break;  
		  case INVALID_CSRF_TOKEN:
		  print j(["false" => "Invalid request, please refresh the page and try again."]);
  		break;  
		  case GJA_ID:
		  print j(["false" => "Please only click the reporter toggle button if you are a registered member of GJA in real life. And provide Your valid GJA id."]);
  		break;  
		  case ALREADY_A_MEMBER:
		  print j(["false" => "Please only click the reporter toggle button if you are a registered member of GJA in real life. And provide Your valid GJA id."]);
  		break;  
		  case BLOCKED_REQUEST:
		  print j(["false" => BLOCKED_REQUEST]);
  		break;  
  	
  	default:
  	      print j(["false" => "Error, request interrupted please refresh the page and try again."]);
  		break;
  }




 }//trigger_error();



}


?>