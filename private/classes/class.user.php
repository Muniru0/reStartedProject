<?php require_once(PRIVATE_DIR."initialize.php");

/**
 *Every thing about the user should be in the user class(sign ups , logins,updatin info,etc)
 *
 *
 */



class user extends DatabaseObject{
    
    
    public    static $table_name            = "users";
    private   static $class_name     = "user";

    protected static $fields = ["id","firstname","lastname","email","password","gov","date","interest","business_logo","business_name","profile_image","profession","phone","profile_image_time","industry","logo_time","location","description"]; 
    
   


    public static $id                = "" ;
    public static $firstname         = "" ; 
    public static $lastname          = "" ;
    public static $email             = "" ;
    public static $gov               = "" ;
    public static $password          = "" ;
    public static $date              = "" ;
    public static $interest          = "" ;
    public static $business_logo     = "" ;
    public static $business_name     = "" ;
    public static $profile_image     = "" ;
    public static $profile_image_time= "" ;
    public static $profession        = "" ;
    public static $phone             = "" ;
    public static $industry          = "" ;
    public static $logo_time         = "" ;
    public static $location          = "" ;
    public static $description       = "" ;
    public static $follow_query_type = "query_type";

   
  

  
   // general insert function that enables you to
   
   
   public function escape_values($db = NULL,$string = ""){

     return mysqli_real_escape_string($db,$string);

   }



public static function get_date_time(){

 return date("Y-m-d h:s:i",time());


}





public  static function update_profile($firstname = "", $lastname = "",$email = "",$phone = "",$location = "",$interest = "" ,$business_name = "",$industry = "",$description = ""){


  global $db;

// TOOOOOOOOOOOOOOOOO UGLY
// get a way of making this better

   !empty(trim($firstname)) ? $_SESSION["firstname"] = $firstname  : ""  ;         
   !empty(trim($lastname))  ? $_SESSION["lastname"]       = $lastname   : ""   ;
   !empty(trim($email))     ? $_SESSION["email"]          = $email   : ""      ;
   !empty(trim($phone))     ? $_SESSION["phone"]          = $phone   : ""      ;
   !empty(trim($location))         ? $_SESSION["location"]       = $location   : ""  ;
   !empty(trim($interest))   ?        $_SESSION["interest"]       = $interest  : ""    ;
   !empty(trim($business_name)) ?    $_SESSION["business_name"]  = $business_name : "";
   !empty(trim($industry))      ?    $_SESSION["industry"]       = $industry     : "" ;
   !empty(trim($description))   ?    $_SESSION["description"]    = $description  : "" ;



  $query = "UPDATE ".user::$S_table_name." SET firstname = ?,lastname = ?,email = ?,phone = ?,location = ?,interest = ?,business_name = ?,industry = ?,description = ? WHERE id = ?";

$query = mysqli_real_escape_string($db,$query);
$stmt = $db->prepare($query);
 if(!$stmt){

  die($db->error." this is a database error");

 }

$id = $_SESSION["id"];

$bind = $stmt->bind_param("sssssssssi",$_SESSION["firstname"],$_SESSION["lastname"],$_SESSION["email"],$_SESSION["phone"],$_SESSION["location"],strtolower($_SESSION["interest"]),$_SESSION["business_name"],$_SESSION["industry"] ,$_SESSION["description"],$id);


if(!$bind){


die($stmt->error." ( ".$db->error." )");
}


if( !$stmt->execute()){

 die($stmt->error." (".$db->error." )");
}


//free result
$stmt->free_result();


//close the statement
$stmt->close();


//close the db connection
$db->close();

return true;
}




 protected function attribute (){
  

   $attribute = [];
   
   // foreach of the properties if there is any,
   // match it up with the properties of the class; 
   
   $r_class = new ReflectionClass($this);
   foreach(self::$fields as $field){

      if(property_exists($this,$field)){
   

       $attribute[$field] = $r_class->getStaticPropertyValue($field);     
      } 
   }

    return $attribute;
   
   
  }// attribute();


  public static function S_attribute($fields){

 $attribute = [];
   
   // foreach of the properties if there is any,
   // match it up with the properties of the class; 
   
   
   foreach(self::$fields as $field){

      if(property_exists(user::$class_name,$field)){
   

       $attribute[$field] = "";     
      } 
   }

    return $attribute;
   

  }



public static function search_for_user($name = ""){

global $sql;
global $db;

$name = mysqli_real_escape_string($db,$name);


$query = $db->query("SELECT firstname,lastname FROM users WHERE firstname LIKE '%{$name}%' OR lastname LIKE '%{$name}%' LIMIT 4");

if(!$query){

  die($db->error);

}
 
 $results = [];

 while($row = $query->fetch_assoc()){
 
 $results[] = h($row["firstname"]." ".$row["lastname"]);

 }

return j($results);


}


 public function create(){


global $sql;
$db = $sql->open_connection();
//global $db;
$values = [];

  
$attributes = $this->attribute();  
 
array_shift($attributes);

$elements = count($attributes);
   for ($x = 1; $x <= $elements; $x++) {
     $values[$x] = "?";  

  }


   $query = "  INSERT INTO ".$this->table_name."  (".  implode (", ", array_keys($attributes)).") VALUES (".implode(", ", array_values($values)).") ";
    
  
   $stmt = $db->prepare($this->escape_values($db,$query));

    if(!$stmt){
      die($db->error." ".$stmt->error);
     log_action("User Class : create() || ","Preparation failed ".$db->error);
    }
 

 // bind the params
   $bind_param = $stmt->bind_param("ssssss",$firstname,$lastname,$email,$password,$gov,$date);


   $firstname  =  $_SESSION["firstname"] = user::$firstname;
   $lastname   =  $_SESSION["lastname"]  = user::$lastname;
   $email       = $_SESSION["email"]     = user::$email;
   $password    = password_hash(user::$password,PASSWORD_ARGON2I,
    ['memory_cost' => 30,'time_cost' => 50, 'threads' => 3]);
   $gov         = $_SESSION["gov"]       = user::$gov;
   $date        = $_SESSION["date"]      = user::$date;
   

    
    if(!$bind_param){
die($db->error." ".$stmt->error);
     log_action("User Class: create() || ","Binding failed ". $db->error);
    
    }


  
   if($stmt->execute()){
 
    // free the results 
    $stmt->free_result();

    // close statement  
    $stmt->close();

$id = $db->insert_id;
   if($id > 0){
     
      // store the insert id in the session to avoid 
      // going back to the database. 
      $_SESSION["id"] = $id;
   }else{
   
   // if there was a problem with the 
    return false;
   }

    $this->set_default_profile_image($id);
    
    // close the database connection
    $db->close();
    
    return true;
 
   }else{
die($db->error." ".$stmt->error);
   log_action("USER Class: create() || ","Statement Execution failed ".$db->error." ".$stmt->error);
   }

  }





public static function S_has_attribute($attribute){

     $class_properties = user::S_attribute($attribute) ;
    return array_key_exists($attribute,$class_properties);
   
}//has_attribute();


  /**
   *Use to check whether the user has the right 
   *credentials to log into the account
   */
public static function found_user(){

          global $db;
            
         // Query to get password for the submitted username 
         // from the database 
         // NOTE: we are getting back the password to make it generic
         // for use else where
         
       $query = "SELECT * FROM ".self::$table_name." WHERE BINARY email = ? LIMIT 1 ";

       // prepare the statement
      $stmt = $db->prepare($query);
       if(!$stmt){
           
         log_action("User class : found_user() ","Statement preparation failed ".$db->errors);
         }

       // assign the bind parameter
       $email    =  user::$email;
      
       // bind the parameter
        $bind_result = $stmt->bind_param("s",$email);
        

        if(!$bind_result){
          
         log_action("User class: found_user() || ","Binding failed. ". $db->error. " ".$stmt->error);
       
        }
          
         // then execute the query
          $result = $stmt->execute();

          
          if(!$result){
     
           log_action(__CLASS__,"Query execution failed: ( ".$db->errno." )".$db->error);
          }
              
       $verification = false;
       $result = $stmt->get_result();
  if($row = $result->fetch_array(MYSQLI_ASSOC)){
     
  $verification = password_verify(user::$password,$row["password"]);
 
   
  }     

       // the results
        $stmt->free_result();

        // close the statement
        $stmt->close();

		if(!empty($row) && $verification === true){

// prevents a second database trip
 foreach ($row as $attribute => $value){
      
          $_SESSION[trim($attribute)] = $value;  
     }
  
   
  return $verification;
  
  }else{
	
   print j(["false" => "Username and password mismatch"]);
    return $verification;
  }      
        

    }//found_user();
  
    



 public function set_default_profile_image($id = 0){


    global $sql;
    global $db;
    
    $profile_image_column = "profile_image";
    $image_time_column = "profileImageTime";
    $upload_time = time();
   

    $query = "UPDATE ".$this->table_name."  SET {$profile_image_column} = ? , {$image_time_column} = ? WHERE id = ? ";

  $stmt = $sql->query($query);
    if(!$stmt){

  log_action("Class User|| set_default_profile_image: ","Statement preparation failed");
   
   return false;
  }

  if(!$stmt->bind_param("sii",$new_image,$upload_time,$id)){
 log_action("Class User|| set_default_profile_image: ","Binding failed");
return false;
  }


if(!$stmt->execute()){
  log_action("User|| set_default_profile_image: ","Statement preparation failed");
  return false;
}

 
 return true;

 }



  public  static function update_profile_image ($type = "", $file = ""){
    
    global $sql;
    global $db;
    
    // define columns for updates,time of upload and $id 
    // of the uploader
    $profile_image_column = "profile_image";
    $image_time_column = "profile_image_time";
    $business_logo_column = "business_logo";
    $logo_time_column = "logo_time";

    $upload_time = time();
    $id = $_SESSION["id"];

    
    if($type == "profile_image"){
         //returns all the uploaded files in an indexed array
         //$image = FileUpload::multiple_uploads($file); 
  
         
   // to be executed query
   // just hard coding the table_name into the query since it will be used only once in 
   // method.
    // if the type of upload is profile_image then update the profile_image column
    $query = "UPDATE users SET {$profile_image_column} = ? , {$image_time_column} = ? WHERE id = ? ";
     

}else{
  // else update the business_logo_column and the logo_time_column
  $query = "UPDATE users SET {$business_logo_column} = ? , {$logo_time_column} = ? WHERE id = ? ";


}

  

// preparation of the query
  $stmt = $sql->query($query);
    if(!$stmt){
     die(" file has being executed... ".$db->error);
  log_action("Class User|| update_profile_image: ","Statement preparation failed");
   return ($db->error." ");
  }

  // returns the name and the directory of the file as {$new_image}
  $image = FileUpload::upload_file($type ,$file); 

  if(!$stmt->bind_param("sii",$image,$upload_time,$id)){

    log_action("Class User|| update_profile_image: ","Binding failed");
      die($db->error." ".$stmt->error);
//return false;
  }


if(!$stmt->execute()){
  die($db->error." ".$stmt->error);
  log_action("User|| update_profile_image: ","Statement preparation failed");
 // return false;
}



if($type == "profile_image"){
if(!user::save_former_profile_images($id,$new_image,$upload_time)){
 
 return false;
}

}
return true;




}// update_profile_image();





// Store all the previous profile images
 

  public static function save_former_profile_images($id = 0,$profile_image = "",$time = 0){


    global $sql;
    global $db;
   


    $table_name = "profile_images";

  $query = "INSERT INTO {$table_name} (user_id,profile_image,upload_time) VALUES(?,?,?)";


    $stmt = $sql->query($query);

if(!$stmt){

 log_action("Class User || save_former_profile_images: ","Statement preparation failed".$db->error);
 
return false;
  }


if(!$stmt->bind_param("isi",$id,$profile_image,$time)){

   
 log_action("Class User || save_former_profile_images: ","Binding param failed (".$db->error." ".$stmt->error);
  
return false;
}


if(!$stmt->execute()){
  die($db->error);
 log_action("Class User || save_former_profile_images: ","Execution failed (".$db->error." ".$stmt->error);


return false;

}

return true;
}



public static function add_trybe_member_or_follow_post($id = null,$trybe_post_id= null){
   global $db;

  $id = (int)$id;
  
  //check if the user that is about to be trybed is among those
  // that is on the page of the user
   if(isset($id) && !empty($id) && is_integer($id)){
      
      if(!is_null($trybe_post_id) && in_array($id,$_SESSION["user_ids"]) && is_numeric($trybe_post_id)){
        $trybe_post_id = (int)$trybe_post_id;
   if ( !$db->multi_query("CALL add_to_trybe('".j([$_SESSION["id"],$id,$trybe_post_id,time()])."')")) {
   
   echo "CALL failed: (".$db->errno.") ".$db->error;
}
}elseif(!is_null($trybe_post_id)  && in_array($id,$_SESSION["post_ids"]) && $trybe_post_id === self::$follow_query_type){

   if ( !$db->multi_query("CALL follow_post('".j([$_SESSION["id"],$id,time()])."')")) {
   
   echo "CALL failed: (".$db->errno.") ".$db->error;
}
}
do{

   if($res = $db->store_result()){
    printf("------\n");

    print_r($res->fetch_all());
    $res->free();
}else{
    if($db->errno){

      echo "store failed: (".$db->errno.") ".$db->error;

    }
}
}while($db->more_results() && $db->next_result());
}else{
  return "not an integer";
 }
 
 }

    
    //common database methods to all classes
public function save (){
     
    return isset($this->id) ? $this->update() : $this->create();
      
   }



   protected function sanitized_attributes(){
     global $sql;
     $clean_attributes = [];
     
     foreach ($this->attributes as $key => $value){
         $clean_attibutes [$key] = $slq->escape_values($value);
         
         
     }
     return $clean_attributes;
     
   }
 
   public static function all_in_cmt($id){
    return self::find_by_sql("SELECT id,username,p_path FROM ".self::$table_name." WHERE  id!=$id");
 
   }





   public function update(){
     global $sql;
     $attributes = $this->attribute();
     $attribute_pairs = [];
     
     
     foreach($attributes as $keys=>$values){
         $attribute_pairs [] = "{$keys} = '{$values}' ";
         
         
     }
     $query = " CREATE PROCEDURE _update ()UPDATE ".self::$table_name." SET  ". join(", ",$attribute_pairs) ."  WHERE id = $this->id";
     $sql->query($query);
 
     return ($sql->affected_rows() == 1) ? true : false;
     
   }
 
    
 
  public static function p_update($filename,$id){
     global $sql;
     
     //update the file path by updating the filename in the users table(meaning the profile picture path wil change).
     $query = "UPDATE ".self::$table_name." SET p_path= '$filename' WHERE id = $id";
 
   $sql->query($query);
   return ($sql->affected_rows() == 1)? true : false;
 
    }
 
 
   public function delete(){
     
     global $sql;
     $query = " CREATE PROCEDURE _delete () DELETE FROM ".self::$table_name." WHERE id = $this->id";
     $sql->query($query);
     
     return ($sql->affected_rows() == 1) ? true : false;
     
   }
 
 
 






 }
 


?>
   