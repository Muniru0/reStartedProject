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
  	
  	default:
  		# code...
  		break;
  }




 }//trigger_error();



}


?>