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
		  print j(["false" => "Please your request is invalid."]);
  		break;  
		  case INVALID_CSRF_TOKEN:
		  print j(["false" => "Invalid request, please refresh the page and try again."]);
  		break;  
  	
  	default:
  		# code...
  		break;
  }




 }//trigger_error();



}


?>