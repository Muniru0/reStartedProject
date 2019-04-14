<?php

require_once("../private/initialize.php");



class Messages {
     
    public static $table_name      = "messages";
    public static $id              = "messages_id";
    public static $sender_id       = "messages_sender_id";
    public static $receiver_id     = "messages_receiver_id";
    public static $time            = "messages_time_sent";





// send message

public  static function send_message($receiver_id = 0,$message = ""){
	
    global $db;

      if(!isset($_SESSION[user::$id]) || !isset($_SESSION[user::$firstname]) || !isset($_SESSION[user::$lastname])){
        
             Errors::trigger_error(INVALID_SESSION);
            return false;
        }


         $receiver_id = $db->real_escape_string($receiver_id);
         $message     = $db->real_escape_string($message);

$query = "INSERT INTO ".self::$table_name." VALUES(NULL,".$_SESSION[user::$id].",{$receiver_id},{$message},".time()." ON DUPLICATE KEY UPDATE ".self::$id." = ".self::$id." + 1";

$result = $db->query($query);
if(!$result){
    
    Errors::trigger_error(RE_SEND_MESSAGE);

    return false;
}else{

    return $db->insert_id;
}

$result->free();

return false;

}// send_messages();	 


// get the message box template
public static function get_message_sending_template($receiver_id = 0){


    echo "<div id='receiver_box'></div>
    <div id='sender_box'></div>
    
	<footer>
    <form action='#' method='POST'>
        ".csrf_token_tag()."
    <input type='hidden' name='user_id' value='{$receiver_id}' />    
    <textarea cols='50' rows='3' name='message_textarea' placeholder='write your message' id= 'message_area' oninput='utility.resizeTextarea(this);'
oninput='enable_post_button();'	style='overflow:hidden; resize:none;'  ></textarea>
    <button type='submit' name='submit' id='send_message_button' disabled>Send <img src='assets/images/ajax-loader.gif' style='display:none;' /></button>
    </form> 
    </footer>
    <script src='assets/js/jquery.js'></script>
    <script src='assets/js/jquery-ui.min.js'></script>
    <script src='assets/js/utility.js'></script>
    <script src='assets/js/send_message.js'></script>
    <script>$('textarea').resizable();</script> ";
    
}





}