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
  	
  	default:
  		# code...
  		break;
  }




 }//trigger_error();



}


?>