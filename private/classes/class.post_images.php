<?php
require_once(PRIVATE_DIR."initialize.php");




class PostImage extends FileUpload {


    public static $db_fields = ["id","uploader_id","filename","upload_time","caption","support","oppose"];
   
    public static  $post_image_table        = "post_table";
    public static  $normalize_post_table = "normal_post_table";
    public static  $post_text_unique_string = "b2FlS0puNzl1RzZxbHNjbQSPreJATipxwCarcRsZMelYussifMuniru";
    public static   $table_name = "post_table";
    public static $support  = "support";
    public static $oppose   = "oppose";
    public static $acceptable_labels = ['transport','health','sol','security','sanitation','other','work','corruption'];

    public static $id          = "id";
    public static $uploader_id = "uploader_id";
    public static $upload_time = "upload_time";
    public static $caption     = "caption";
    public static $db_support     = "support";
    public static $db_oppose      = "oppose";



// overriden database object method just for 
// the ease of work
    public static function prepare ($query = ""){

        global $db ;
        if(isset($db) && $db != null){
            // prepare the statement
            $stmt = $db->prepare($query);
            if(!$stmt){
                log_action(__CLASS__,"Couldn't prepare the statement in the query function");
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
   print j(["false" => "Sorry is not you but Us <br /> <b>(You can try again with the same files)</b>"]);
            return false;
        }
      
     $string = " VALUES ";
     foreach($filenames as $filename){
          $string .= " ({$post_id},'{$db->real_escape_string($filename)}'),";
     }
	 
	
     
   $string = substr_replace($string,'',-1, 1);
   
$query    = " INSERT INTO ".self::$normalize_post_table." (post_id,filename) {$string}    ";

  
   if(!$db->query($query)){
  print j($db->errno. " ".$db->error); 
       return false;
   }
     return true;
    }//normal_post_media();

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
 if(false){     
$query_parameters = j([$uploader_id,$upload_time,$title,$label,$caption,$log,$lat]);

    $query = "CALL post_image('".$query_parameters."')";

    
    $post_id = 0;

    
    try{
 if(!$db->multi_query($query)) {
    log_action(__CLASS__," CALL failed: (".$db->errno.") ".$db->error);
	print j(["false" => "Please try again...Something Unexpectedly happened"]);
         return false;
}
 else{
     $post_id = 0;
   
   do{
	    if($result = $db->store_result()){
        if($row = $result->fetch_assoc()){
            $post_id = $row["LAST_INSERT_ID()"];
       }
	    // store first result set
    $result->free();
}
   }
   while($db->more_results() && $db->next_result());
       
    
}
  }catch(Exception $e){
    log_action(__CLASS__," Exception with error : ".$e." on line : ".__LINE__." in file: ".__FILE__);
	print j(["false" => "Please try again...Something Unexpectedly happened"]);
	return false;
}

}
$query = "INSERT INTO post_table  VALUES(?,?,?,?,?,?,?,?,?,?,?)ON DUPLICATE KEY UPDATE id = id + ?";


// prepare the statement
$stmt = $db->prepare($query);

if(!$stmt){
	log_action(__CLASS__," Statement preparation failed: ".$stmt->error." with db error: ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
}
$id = null;
$duplicate_update_factor = 1;
$support = 0;
$oppose  = 0;
$confirmation = 0;
if(!$stmt->bind_param("isiisssiiiii",$id,$uploader_id,$upload_time,$title,$label,$caption,$log,$lat,$support,$oppose,$confirmation,$duplicate_update_factor)){
	log_action(__CLASS__," Statement preparation failed: ".$stmt->error." with db error: ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
}


if(!$stmt->execute()){
	log_action(__CLASS__," Statement preparation failed: ".$stmt->error." with db error: ".$db->error." on line: ".__LINE__." in file: ".__FILE__);
}

$post_id = 0;

if($stmt->insert_id){
	$post_id = $stmt->insert_id;
	
}
 
$stmt->close();
if(self::normalize_post($post_id,$filenames))
{    

      
	  if(is_array($post_id)){
		
log_action(__CLASS__, print_r($post_id));
return;
	  }
	  
	   // cast the post id into an integer
    $post_id = (int)$post_id;
	
      if($post_id > 1 && is_int($post_id)){
		  
	  
    // send back a full post containing all the information of the post(label,caption,etc,)
    // and all the images
 if(!FetchPost::get_uploaded_post($post_id))
 {
	 log_action(__CLASS__," get full post execution failed: on line ".__LINE__." in file ".__FILE__);
	 // send a notification to those that this post may be connected to and alert them of the new post 
	 // and its x'tics
	/* if(Notifications::send_notification($post_id[0],$uploader_id,POST,$upload_time))
	{
		
	} */
 } 
     
	
}else{
		log_action("the normal post_table refused to insert");
		return false;
	}
    }else{
		log_action(__CLASS__," Post id less than 1 but passed the first on line: ".__LINE__." in file ".__FILE__);
		print j(["false" => ""]);
	}
    }//post();





    // validate the method to see if it has all the required fields populate

    public static function validate_post($post = "",$files = ""){
             
         if(!isset($post) || empty($post) || !isset($files) || empty($files)){
              return j(["Empty post: Please try again"]);
         }
        //  // check the presence of the label
        if(!isset($post["label"]) || empty(trim($post["label"])) ||
         (!in_array(strtolower(trim($post["label"])),self::$acceptable_labels,true))){
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
//            log_action("Post_images_class : post_image() ", "Preparation failed");
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
//        /* Prepared statement, stage 1: prepare */
//        if (!($stmt = $db->prepare("INSERT INTO test(id) VALUES (?)"))) {
//            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
//        }
//
//        /* Prepared statement, stage 2: bind and execute */
//        $id = 1;
//        if (!$stmt->bind_param("i", $id)) {
//            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
//        }
//
//        if (!$stmt->execute()) {
//            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//        }
//
//        /* Prepared statement: repeated execution, only data transferred from client to server */
//        for ($id = 2; $id < 5; $id++) {
//            if (!$stmt->execute()) {
//                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//            }
//        }
//
//        /* explicit close recommended */
//        $stmt->close();
//
//        /* Non-prepared statement */
//        $res = $mysqli->query("SELECT id FROM test");
//        var_dump($res->fetch_all());
//    }
    public static function post_text($post = "", $label=""){

        global $sql;
        global $db;


        $query = "INSERT INTO post_text (uploader_id,post,upload_time,label) VALUES(?,?,?,?) ";
        $stmt = self::prepare($query);
        if(!$stmt){

            log_action("Post_images_class : post_image() ","Preparation failed");
            die($db->error. "Preparation failed");
        }


        $id = $_SESSION["id"];
        $upload_time = time();
        if(!$stmt->bind_param("isis",$id,$post,$upload_time,$label)){
            //replace with log statement when the code is working
            die($db->error ."( ".$stmt->error." ) binding failed!");
        }



        if(!$stmt->execute()){
            die("Execution failed :". $stmt->error. " (". $db->error.").");
        }


        $id = $db->insert_id;


        return true;

    }







}




?>