

<?php
require_once(PRIVATE_DIR."shared/config.php");


class DatabaseObject  {
   




    public static function db_connect() {
    
    //open a connection to the mysqli db    
 $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) ;
     
     //check to see if the connection generated an error ,
     //die in that case.
  if ($db->connect_errno){
    //
    die("Database connection failed: ".$this->db->connect_error."(".mysqli_connect_errno().")");
    
}else{
       return $db;
}

    }

public static function find_all ($query = "" ,$table = "",$condition =""){
   if(isset($query) && !empty(trim($query))
           && isset($table) && !empty(trim($table))
           && isset($table) && !empty(trim($table)) ) {
    $query = "SELECT * FROM " . $table . " WHERE " . $condition;
  return $db->query($query);
       }else{
           return null;
       }

     }//find_all();
    
public static function find_one($id = 0){

       global $db;

    if(isset($id) && is_integer($id) && !is_null($id) ){
        $query = "SELECT * FROM ".self::$table_name." WHERE id = {$id}";

        return $db->query($query);
    }else{
        return null;
    }

}// find_one();

public function query ($query = ""){
  
global $db ;
 


if(isset($db) && $db != null){

 // prepare the statement

  $stmt = $db->prepare($query);
    if(!$stmt){
      
       log_action("DATBASE CLASS ERR: ","Couldn't prepare the statement in the query function");
       
    return null;

    }
   
 

    }
 return $stmt;
      }


// static version of query();

    public static function find_by_sql ($query=""){
           global $sql;
        $result = $sql->query($query);
         $object_array = [];
         while ($record = $sql->fetch_assoc ($result)) {
            
            $object_array[]= static::instantiate($record);
         }
         return $object_array;
        }
      
  

public static function count_all(){
   global $sql;
   $query = " SELECT COUNT(*) FROM ".static::$table_name;
    $result = $sql-> query($query);
    $row = $sql->fetch_array($result);
    return array_shift($row);
   }  
 
  public static function validate($value ="",$field){
   $sanitized = self::escape_value(trim($value));
   $errors =[];   
   if(!isset($sanitized) || empty($sanitized)){
      $errors["value"]= " $field can't be blank.";
      }
      if(strlen($sanitized) < 8 || strlen($sanitized) > 30){
         $errors["length"]=" $field has an invalid length.";
         }
         if(!empty($errors)){
        
   return $errors;
         }else{
            return null;
         }
   
  }



  public function create(){
    global $sql;
      
    // if the table name has being provided then use that
    // else use the table name of the class
    
      $attributes = $this->attribute();
       

       array_shift($attributes);

        $elements = count($attributes);
        $values = [];

        for ($x = 1; $x <= $elements; $x++) {
            
            $values[$x] = "?";  
            echo "YES"; 
        }

    $query = "  INSERT INTO ".$this->table_name."  (".  implode (", ", array_keys($attributes)).") VALUES (".implode(", ", array_values($values)).") ";
    
  $db = $sql->open_connection();
   $stmt = $db->prepare($query);

    if(!$stmt){

     die("Prepare failed: ( ".$db->errno." )". $db->error." --- ".$query);
    }
 

   $firstname  = user::$firstname;
   $lastname   = user::$lastname;
   $username   = user::$username;
   $email       = user::$email;
   $password    = password_hash(user::$password,PASSWORD_ARGON2I,
    ['memory_cost' => 30,'time_cost' => 50, 'threads' => 3]);;
   $gov         = user::$gov;
   $date        = user::$date;

  echo "they are called";
   $bind_result = $stmt->bind_param("sssssss",$firstname,$lastname,$username,$email,$password,$gov,$date);

   

    
    if(!$bind_result){

     die("Binding failed: ". $db->errno." ".$db->error."---".$query);
    }

$execution_result =  $stmt->execute();

   if($execution_result){
 
    return true;
   }else{

    die("Execution failed: " .$db->errno." --- ".$db->error);
   }

  
  }

 public function insert_id(){
        
        return $db->insert_id;
        
}


public  function db_disconnect(){
    $db = self::db_connect();
  if(isset($db)){
    $db->close();

  }
}
}
 
$db = DatabaseObject::db_connect();

?>