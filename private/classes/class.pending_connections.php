<?php

require_once("../private/initialize.php");


class PendingConnections extends DatabaseObject{

    //  table and column columns names
    public static $table_name = "pending_connections";

    public static $id               = "id";
	public static $sender_id        = "sender_id";
    public static $receiver_id      = "receiver_id";
    public static $request_time     = "request_time";
    
    

    //alias of db columns
	public static $alias_of_id             = "pending_connections_id";
	public static $alias_of_sender_id       = "pending_connections_sender_id";
    public static $alias_of_receiver_id       = "pending_connections_receiver_id";
    public static $alias_of_request_time      = "pending_connections_request_time";
	




  // send a connection request to a another user
    public static function send_request($receiver_id = 0){

  global $db;

        if($receiver_id < 1){
            Errors::trigger_error(RETRY);
      return;
        }

   $notification_type = ""; 

        if(isset($_SESSION) && isset($_SESSION[user::$id]) && $_SESSION[user::$id] > 0 ){

              $query = "CALL user_connection_request(".$receiver_id.",".$_SESSION[user::$id].",".time().")";
            if($db->multi_query($query)){


                do{
                    if($result =  $db->store_result()){
                   if($row = $result->fetch_assoc()){
                      
                    if(isset($row["result"]) && $row["result"] > 0 
                     && isset( $row["response"]) && $row["response"] == CONNECTION_REQUEST_SENT){
                     print j([CONNECTION_REQUEST_SENT => "success"]);
                     $notification_type = CONNECTION_REQUEST_SENT;
                    log_action(__CLASS__,$row["response"].__LINE__);
                    }elseif(isset($row["response"]) && $row["response"] == CONNECTION_REQUEST_REVOKED){
                        print j([CONNECTION_REQUEST_REVOKED => "success"]);
                        $notification_type = CONNECTION_REQUEST_REVOKED;
                       
                    }elseif(isset($row["respnose"]) && $row["response"] == "invalid_connectionn"){
                        print j(["invalid_connection"=>"success"]);
                       
                    }elseif(isset($db->error) && trim($db->error) != "" ){
                        Errors::trigger_error(RETRY);
                       return;
                    }
                   }
                   $result->free();
                    }
                    

                }while($db->more_results() && $db->next_result());

            }elseif(trim($db->error) != ""){
            Errors::trigger_error(RETRY);
            }
        
        
        }else{
            Errors::trigger_error(INVALID_SESSION);
            return;
        }


  Notifications::send_notification("NULL","NULL","NULL",$notification_type);
    }//request_connection();


    
    


    public static function get_pending_connections(){
        global $db;
        $query = "SELECT COUNT(*),* FROM ".self::$table_name." WHERE ".self::$receiver_id."= ".$_SESSION[user::$id];
        
        $result = $db->query($query);
 
        while($row = $result->fetch_assoc()){
            $array[] =  $row;
        }

        $result->free();
     

        

      }



}





?>