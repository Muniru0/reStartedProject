<?php
require_once(PRIVATE_DIR."initialize.php");




class PostImage extends FileUpload {


    public static $db_fields = ["id","uploader_id","filename","upload_time","caption","support","oppose"];
   
    public static  $post_image_table        = "post_table";
    public static  $normalize_post_table = "normal_post_table";
    public static  $post_text_unique_string = "b2FlS0puNzl1RzZxbHNjbQSPreJATipxwCarcRsZMelYussifMuniru";
    public static   $table_name = "post_table";
 

	
    public static $id           = "id";
    public static $uploader_id  = "uploader_id";
    public static $upload_time  = "upload_time";
    public static $title        = "title";
    public static $label        = "label";
    public static $caption      = "caption";
	public static $log          = "longitude";
    public static $lat          = "latitude"; 
	public static $location     = "location";
	public static $files_count  = "files_count";
    public static $support      = "support";
    public static $oppose       = "oppose";
    public static $confirmation = "confirmation";
    public static $confirmer    = "confirmer";
	public static $likes        = "likes";

	
	//column aliases
	 public static $alias_of_id          = "post_table_id";
    public static $alias_of_uploader_id  = "post_table_uploader_id";
    public static $alias_of_upload_time  = "post_table_upload_time";
    public static $alias_of_title        = "post_table_title";
    public static $alias_of_label        = "post_table_label";
    public static $alias_of_caption      = "post_table_caption";
	public static $alias_of_log          = "post_table_longitude";
    public static $alias_of_lat          = "post_table_latitude"; 
	public static $alias_of_location     = "post_table_location";
	public static $alias_of_files_count  = "post_table_files_count";
    public static $alias_of_support      = "post_table_support";
    public static $alias_of_oppose       = "post_table_oppose";
    public static $alias_of_confirmation = "post_table_confirmation";
    public static $alias_of_confirmer    = "post_table_confirmer";
    public static $alias_of_likes    = "post_table_likes";

    
    // utility properties
    public static $session_post_ids = "post_ids";
    public static $are_there_latest_posts = "latest_post";
    public static $post_max_id             = "post_max_id";
    public static $self_post_max_id        = "self_post_max_id";
    public static $education               = "education";

    public static $health                  = "health";
    public static $work                    = "work";
    public static $sanitation              = "sanitation";
    public static $security                = "security";
    public static $sol                     = "sol";

    public static $transport                = "transport";
    public static $other                    = "other";
   
    public static function get_activities_counts($stream_type = null){
        global $db;

        $query  = "SELECT MAX(".PostImage::$id.") AS ".PostImage::$post_max_id." FROM ".self::$table_name.";";
        $query .= "SELECT COUNT(*) AS count_pending_connections FROM ".PendingConnections::$table_name." WHERE ".PendingConnections::$receiver_id." = ".$_SESSION[user::$id].";";
        $query .= "SELECT COUNT(*)  AS count_notifications     FROM ".Notifications::$table_name." JOIN ".FollowPost::$table_name." ON ".FollowPost::$post_id." = ".Notifications::$post_id.";";
        $query .= "SELECT ".PostImage::$label.",COUNT(*) AS count_labeled_posts FROM ".PostImage::$table_name." GROUP BY ".PostImage::$label."  WHERE ".PostImage::$upload_time." > ".time();
       
       
        
       
        if($db->multi_query($query)){
       do{

                if($result = $db->store_result()){
                    $activities_count_array = [];
                    while($row = $result->fetch_assoc()){
                        
                if(isset($row[PostImage::$post_max_id])){
                        if($row[PostImage::$post_max_id] == NULL || $row[PostImage::$post_max_id] < 1){
                            $_SESSION[$stream_type] = -1;

                        }else{
                            $_SESSION[$stream_type] = $row[PostImage::$post_max_id];
                        }
                    }elseif(isset($row["count_pending_connections"])){
                     $activities_count_array["pending_connections"] = $row["count_pending_connections"];
                    }elseif(isset($row["count_notifications"])){
                        $activities_count_array["count_notifications"] = $row["count_notifications"]; 
                    }elseif($row[PostImage::$label]){
                    $activities_count_array["label"][$row[PostImage::$label]] =
                    $row["count_labeled_posts"];
                    }
                }
                }
            }while($db->more_results() && $db->next_result());
        }

        
    }//get_activities_count();




// overriden database object method just for 
// the ease of work
    public static function prepare ($query = ""){

        global $db ;
        if(isset($db) && $db != null){
            // prepare the statement
            $stmt = $db->prepare($query);
            if(!$stmt){
              Errors::trigger_error(RETRY);
                return null;
            }
        }
        return $stmt;
    }//query();


// validate the destination of the file
// {whether in an image,video or image/video table and directory}
    public static function validate_destination($file = "",$count = ""){
 
//     return false;
          
        $diff_file_types = [];
        // $diff_file_types = "videos";
        // print_r($diff_file_types);
        // die();

        for($x = 0; $x < $count ; $x++) {

            $path_parts = pathinfo($file["name"][$x]);
            $file_type = $file["type"][$x];
            if (in_array(strtolower($path_parts["extension"]), FileUpload::$allowed_extensions_videos) && in_array(strtolower($file_type), FileUpload::$allowed_mime_types_videos)) {

                $diff_file_types[$x] = "videos";
            } elseif (in_array(strtolower($path_parts["extension"]), FileUpload::$allowed_extensions_images) && in_array(strtolower($file_type), FileUpload::$allowed_mime_types_images)) {

                $diff_file_types[$x] = "images";
            } elseif (in_array(strtolower($path_parts["extension"]), FileUpload::$allowed_extensions_audios) && in_array(strtolower($file_type), FileUpload::$allowed_mime_types_audios)) {

                $diff_file_types[$x] = "audios";

            }
        } 
//               print_r($diff_file_types);
            //TODO: check whether the count of images and the combination of the values of
            // the array count values are the same to make sure that all the files were
            // tested checked and the right location was returned

            //   print_r($each_file_number);
            $each_file_number = array_count_values($diff_file_types);
                 // echo "it got here as per the parsing";
            // dealing with only image files
            if ((isset($each_file_number["images"]) && $each_file_number["images"] >= 1) && !isset($each_file_number["videos"]) && !isset($each_file_number["audios"])) {
                //die();
                return "post_images";

            // dealing with only video files
            } elseif ((isset($each_file_number["videos"]) && $each_file_number["videos"] >= 1) && !isset($each_file_number["images"]) && !isset($each_file_number["audios"])) {

                return "post_videos";

                // dealing with only audio files
            } elseif ((isset($each_file_number["audios"]) && $each_file_number["audios"] >= 1) && !isset($each_file_number["images"]) && !isset($each_file_number["videos"])) {

                return "post_audios";

                // dealing with a combination of them
            } elseif ((isset($each_file_number["images"]) && $each_file_number["images"] >= 1) || (isset($each_file_number["videos"]) && $each_file_number["videos"]) >= 1 ||
                (isset($each_file_number["audios"]) && $each_file_number["audios"] >= 1)) {

                return "post_combined_files";

            // just to take care of any error that may occur.
            } else {
                // maybe sumtin went wrong with the server so
                // we are telling them to try again.
                return false;
            }

    }//validate_destination();

  
public static function normalize_post($post_id = 0,$filenames = ""){

        
        global $db;
     
       
        if(!is_array($filenames)){
       Errors::trigger_error(RE_INITIATE_OPERATION);
            return false;
        }
      
	  if($post_id < 1 || !is_int($post_id) ){
          Errors::trigger_error(RETRY);
          
		return false;
	  }
     $string = " VALUES ";
     foreach($filenames as $filename){
          $string .= " ({$post_id},'{$db->real_escape_string($filename)}'),";
     }
	 
	
     
   $string = substr_replace($string,'',-1, 1);
   
$query    = " INSERT INTO ".self::$normalize_post_table." (post_id,filename) {$string}    ";

   $result = $db->query($query);
   if(!$result){
   Errors::trigger_error(RETRY);
       return false;
   }
  
  
     return true;
    }//normal_post_media();

    

/*
//    public static function upload_files($files = ""){
//
//        //returns all the uploaded files in an indexed array
//        //$images_array = FileUpload::multiple_uploads($post);
//        // count the number of images
//        $count = count($files);
//
//        $post = "";
//
//        $location = self::validate_destination($files,$count);
//
//        // die($location);
//        $real_filename = [];
//
//        foreach($files as $file){
//            // this is a single file
//            $filename = FileUpload::upload_file($location,$file);
//            if($filename != false || !is_array($filename)){
//
//                $real_filename[] = $filename;
//            }else{
//                return $filename;
//            }
//        }
//
//        $real_filename = array_values($real_filename);
//
//        print_r($real_filename);
//        foreach ($real_filename as $inner_array) {
//            foreach ($inner_array as $tmp_location => $destination) {
//                FileUpload::move_uploaded_file($tmp_location, $destination);
//            }
//
//        }
//        return $real_filename;
//
//    }
*/
// post a maximum of 3 images
public static function post($files = "",$title = "",$caption = " ",$label = "",$log = 0,$lat = 0,$count = 0){

        global $db;

   
   $media = ["Yussif","Muniru","Kareem","Ganiu"];
// find and return the files destination
 $file_destination = self::validate_destination($files,$count);

     if($file_destination === false){
        print j(["false" => "Please check the file(s) extension and mime types."]);
        return false;
     }

$filenames = FileUpload::upload_file($file_destination, $files,$count);
  
     if($filenames == false){
     return false;
     }

   
// database query parameters
    $uploader_id = $_SESSION["id"];
    $upload_time = time();
    $count       = count($filenames);
	
	// this is for debugging purposes only
	/***********************************/
	$locations = ["Wa","Tamale","Kumasi","Accra","Koforidua","Cape Coast","Tema","Bolgatanga","Winneba","Saudi Arabia"];
		   $location = $locations[array_rand($locations)];
    /***********************************/
		   
$query_parameters = j([$uploader_id,$upload_time,$title,$label,$caption,$log,$lat,$location,$count]);

$uploader_id = $db->real_escape_string($uploader_id);
$upload_time = $db->real_escape_string($upload_time);

$title      = $db->real_escape_string($title);
$label      = $db->real_escape_string($label);
$locaion    = $db->real_escape_string($location);
$log        = $db->real_escape_string($log);
$lat        = $db->real_escape_string($lat);
$count      = $db->real_escape_string($count);

    $query = "CALL post_image(".$uploader_id.",".$upload_time.",'".$title."','".$label."','".$caption."','".$log."','".$lat."','".$location."',".$count.")";
    
    $post_id = 0;

    
    try{
 if(!$db->multi_query($query)) {
    Errors::trigger_error(RETRY);
    return false;
}
 else{
     
   
   do{
	    if($result = $db->store_result()){
        if($row = $result->fetch_assoc()){
            $post_id = $row["insert_id"];
       }
	    // store first result set
    $result->free();
}
   }
   while($db->more_results() && $db->next_result());
       
    
}
  }catch(Exception $e){
   Errors::trigger_error(RE_INITIATE_OPERATION);
    return false;
}


 

$post_id = (int)$post_id;

if(self::normalize_post($post_id,$filenames))
{    
    // the post has being uploaded successful trigger a notification

Notifications::send_notification($post_id,"NULL","NULL",$uploader_id,NEW_POST);
	


      
	  if(is_array($post_id)){
		
  Errors::trigger_error(RETRY);
    return false;
	  }
	  
	  if($post_id > 1 && is_int($post_id)){
		  
	  
    // send back a full post containing all the information of the post(label,caption,etc,)
    // and all the images
 if(!FetchPost::get_uploaded_post($post_id))
 {
    
    Errors::trigger_error(RETRY);
    return false;
 } 
     
	
}else{
    Errors::trigger_error(RETRY);
		return false;
	}
    }else{
        Errors::trigger_error(RETRY);
		return;
	}
    }//post();





  // edit post 
 public static function edit_post($post_id = 0,$caption = "", $title = "",$location = "" ,$lat = "",$log = ""){
     
     global $db;
    
     if($post_id < 1 || !isset($caption)  || !isset($title) || trim($location) == "" ){
        Errors::trigger_error(RETRY);
         return;
     }
     $time = time();  
     $user_id = $_SESSION[user::$id];
    //  $post_id = $db->real_escape_string($post_id);
    //  $caption = $db->real_escape_string($caption);
    //  $title   = $db->real_escape_string($title);
    //  $loctaion = $db->real_escape_string($location);
    //  $log      = $db->real_escape_string($location);
    //  $lat      = $db->real_escape_string($lat);
   
   $query = "CALL edit_post(".$user_id.",{$post_id},'{$caption}','{$title}','{$location}',{$lat},{$log},{$time})";
     
  
 
    if($db->multi_query($query)){
         
        do{
            
            if($results = $db->store_result()){
                 if($row = $results->fetch_assoc()){
                     if(isset($row[PostImage::$caption])){
                         
                     
                      print j(["caption"=>$row[PostImage::$caption],"title"=>$row[PostImage::$title],"location"=>$row[PostImage::$location],"lat"=>$row[PostImage::$lat],"log"=>$row[PostImage::$log]]);
                     
                      
                     
                     }elseif(isset($row["result"]) && $row["invalid request"]){
                         print j(["false" =>"PLEASE INVALID OPERATION"]);
                         return;
                     }
                 }elseif(trim($db->error) != ""){
                     
                     Errors::trigger_error(RETRY);
                     return;
                 }elseif(trim($db->error) != ""){
                        
                      Errors::trigger_error(RETRY);
                        return;
                 }

                 $results->free_result();
            }
            
        }while($db->more_results() && $db->next_result());
        
    }else{
       
        Errors::trigger_error(RETRY);
        return;
    }

     
    Notifications::send_notification($post_id,"NULL","NULL",$user_id,EDIT_POST);
     
 }// edit_post();    


    // validate the method to see if it has all the required fields populate

    public static function validate_post($post = "",$files = ""){
		
             
         if(!isset($post) || empty($post) || !isset($files) || empty($files)){
              return j(["Empty post: Please try again"]);
         }
        //  // check the presence of the label
        if(!isset($post["label"]) || empty(trim($post["label"])) ||
         (!in_array(strtolower(trim($post["label"])),COMMUNITIES,true))){
          print j(["false" => "label"]);
        return false;
        // check the presence of the location
        }elseif((!isset($post["log"]) || empty(trim($post["log"]))) || (!isset($post["lat"]) || empty($post["lat"])) ){
     print j($post["log"]." ".$post["lat"]);
            print j(["false" => "location"]);
            return false;
        // check the presence of the media
        }
        // elseif(!isset($post["media"]) || empty(trim($post["media"]))){
        // return j(["false" =>"media"]);}
       elseif(!isset($post["title"]) || empty(trim($post["title"]))){
         print  j(["false" => "title"]);
           return false;
        }else{
            return true;
        }



}

   
   // confirm a post
   public static function confirm_post($post_id = 0){
	   
	   global $db;
      
	     $post_id = $db->real_escape_string($post_id);
	   if((int)$post_id < 1){
		   
		  Errors::trigger_error(RETRY);
		   return;
	   }
	   

	  

	  if(!isset($_SESSION) || (int)$_SESSION["id"] < 0){

      print j(["false"=>"login"]);
      return;
      }
      $id = $_SESSION["id"];
    

  // if check that the post hasn't already being confirmed   
$query = "CALL confirm_post({$post_id},{$id})";    


// perform the query on the database
if($db->multi_query($query)){
	 do{
		 
		// store the result set
       	if($result = $db->store_result()){
			if($row = $result->fetch_assoc()){
if(isset($row["result"]) && $row["result"] == "confirmed"){
					  
                    print j(["confirmation" => "success"]);
                    Notifications::send_notification($post_id,NULL,NULL,$id,CONFIRMED_POST,time());
					return;
				}  elseif(isset($row["result"]) && $row["result"] == "reverse_confirmation"){
					$_SESSION[user::$invalid_confirmations] = $_SESSION[user::$invalid_confirmations]++;
                    print j(["reverse_confirmation"=>"success"]);
                    Notifications::send_notification($post_id,NULL,NULL,$id,REVERSE_CONFIRMATION,time());
					return;
				}
    elseif(isset($row["result"]) && $row["result"] == "duplicate_confirmation"){
					print j(["false" =>"Please this post has already being confirmed by someone else"]);
                    return;
	}elseif(isset($row["result"]) && $row["result"] == "invalid_confirmation"){
					print j(["false" =>"Please you not eligible to confirm a post"]);

					return;
				}
               
                
                elseif(trim($db->error) != ""){
					
					 print j(["false"=>"Sorry server problem,please try again."]);
					 return;
				}
                
               
			}
		}
	 }while($db->more_results() && $db->next_result());
	

}
   
   }//confirm_post();


  
 // delete the post 
  public static function delete_post($post_id = 0){
	  global $db;

        if(!isset($_SESSION) || isset($_SESSION[user::$id]) || $_SESSION[user::$id] < 1){
            Errors::trigger_error(INVALID_SESSION);
            return;
        }

        $user_id = $_SESSION[user::$id];
     $query = "DELETE FROM ".self::$table_name." WHERE ".self::$id." = {$post_id} && ".self::$uploader_id." = {$user_id} LIMIT 1";

    $results = $db->query($query);

	if($db->error != ""){
        Errors::trigger_error(RETRY);
		return;
	} 
	
	if($db->affected_rows != 1){
        Errors::trigger_error(SERVER_PROBLEM);
		return;
	}elseif($db->affected_rows == 1){
        Notifications::send_notification($post_id,"NULL","NULL",$user_id,DELETE_POST);
		print j(["delete_post" => "success"]);
	}
	
	
   }//delete_post();

   
  
/*
// post a maximum of 3 images
//    public static function post($caption = "", $files = "", $label = "", $mood = NULL)
//    {
//
//
//        global $sql;
//        global $db;
//
//
//        //   if($caption !== false){
//
//        //returns all the uploaded files in an indexed array
//        //   $images_array = FileUpload::multiple_uploads($post);
//
//
//        $count = count($files["name"]);
//
//        $post = "";
//
//        $location = self::validate_destination($files, $count);
//
//       // declare the filename as an array
//        $filename = [];
//
//        for ($x = 0; $x < $count; $x++) {
//
//        // upload a single file and add its name to the  $file_upload_results array
//            $filename[] = FileUpload::upload_file($location, $files[$x]);
//
////            if ($filename != false) {
////
////                $real_filename .= $filename . ",";
////
////             }
//        }
//
////        }else{
////
////
////            $caption = self::$post_text_unique_string;
////            $real_filename = $post;
////
////        }
//
//
//        $query = "INSERT INTO " . PostImage::$post_image_table . " (uploader_id,post,upload_time,caption,label,support,oppose) VALUES(?,?,?,?,?,?,?) ";
//
//        $stmt = self::Personal_query($query);
//        if (!$stmt) {
//

//            die($db->error . "Preparation failed");
//        }
//
//
//        $id = $_SESSION["id"];
//        $upload_time = time();
//
//        $s = rand(1, 200);
//        $v = rand(1, 200);
//
//
//        if (!$stmt->bind_param("isissii", $id, $real_filename, $upload_time, $caption, $label, $s, $v)) {
//            //replace with log statement when the code is working
//            die($db->error . "( " . $stmt->error . " ) binding failed!");
//        }
//
//
//        if (!$stmt->execute()) {
//            die("Execution failed :" . $stmt->error . " (" . $db->error . ").");
//        }
//
//
//        $id = $db->insert_id;
//
//
//        if ($id > 0) {
//
//
//            // if(!self::normal_post($id,$post,time(),$caption)){
//            // //die("couldn't insert".$db->error);
//            //  return false;
//            // }
//
//
//        }
////}
////}
//
//        return true;
//    }//post();

//    public static function prepare_test() {
//        global $db;
//        /* Prepared statement, stage 1: prepare 

//        if (!($stmt = $db->prepare("INSERT INTO test(id) VALUES (?)"))) {
//            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
//        }
//
//         Prepared statement, stage 2: bind and execute 
//        $id = 1;
//        if (!$stmt->bind_param("i", $id)) {
//            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
//        }
//
//        if (!$stmt->execute()) {
//            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//        }
//
//        prepared statement: repeated execution, only data transferred from client to server 
//        for ($id = 2; $id < 5; $id++) {
//            if (!$stmt->execute()) {
//                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//            }
//        }
//
//         explicit close recommended 
//        $stmt->close();
//
//        Non-prepared statement 
//        $res = $mysqli->query("SELECT id FROM test");
//        var_dump($res->fetch_all());
//    
} 
*/
    

}

  



?>