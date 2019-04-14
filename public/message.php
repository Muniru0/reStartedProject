
<?php

require_once("../private/initialize.php");

 Session::before_every_protected_page(); 



 
 
  if(is_request_post()){
  // if the request is a post and at the same time
  // from us
  if(request_is_same_domain()) {
	
    // is the csrf token valid and recent
    if(csrf_token_is_valid() && csrf_token_is_recent()) {
  
       
        
        
  // validate the presence of the required fields  
  if(validate_presence_on(["message_textarea"])){
  
  
     Messages::send_message();
     }  
  
  
    } else {
  
      Errors::trigger_error(RETRY);
      return;
   
      }
  
  
  
  
  }Errors::trigger_error(RETRY);
  return;
  }elseif(!is_request_get()){


      Errors::trigger_error(RETRY);
      return;
    if(!allowed_get_params([user::$id,user::$firstname,user::$lastname]) || !request_is_same_domain() ){
        Errors::trigger_error(INVALID_REQUEST);
       
    }
  }

?>


<!DOCTYPE html>
<html>
<head>
<link href="../public/assets/css/messages.css" rel="stylesheet" />

<title>

Send Message to <?php echo $_GET[user::$firstname]." ".$_GET[user::$lastname] ?>
</title>
</head>
<body>


<?php Messages::get_message_sending_template($_GET[user::$id]);?>




</body>



</html>


