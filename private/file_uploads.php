<?php
require_once("initialize.php");


 class FileUpload extends DatabaseObject {
private static $max_file_size = 502042880; // 5 MB expressed in bytes

// Where to store uploaded files?
// Choose a directory outside of the public path, unless the file 
// should be publicly visible/accessible.
// Examples:
//   job application => private
//   website profile photo => public
// Of course, when outside the public path, you need PHP code that can
// access those files. The browser can't access them directly.
private static $upload_path = PRIVATE_PATH."/".PRIVATE_MEDIA;
private static $final_width_of_the_image = 500;

// Allowed mime types and extensions for audio files
public static $allowed_mime_types_audios = ['audio/mpeg','audio/mp4',"audio/mp3"];
public static $allowed_extensions_audios = ['mp3','mp4'];

// Allowed mime types and extensions for image files
public static $allowed_mime_types_images =['image/png', 'image/gif', 'image/jpg', 'image/jpeg','image/gif'];
public static $allowed_extensions_images = ["png", 'gif', 'jpg', 'jpeg','jpe'];

// Allowed mime types and extensions for video files     
public static $allowed_mime_types_videos = ['video/x-ms-wmv','video/mp4','video/3gpp'];
public static $allowed_extensions_videos = ['wmv','mp4','3gp'];

// Provides plain-text error messages for file upload errors.
private static function file_upload_error($error_integer) {
	$upload_errors = array(
		// http://php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	return $upload_errors[$error_integer];
}

     
// Sanitizes a file name to ensure it is harmless
private static function sanitize_file_name($location = "") {
	// Remove characters that could alter file path.
	// I disallowed spaces because they cause other headaches.
	// "." is allowed (e.g. "photo.jpg") but ".." is not.
     
    
     //$business_logo       = "business_logo";
     // $post_images         = ;
     // $post_videos         = "post_videos";
     // $post_image_videos   = "post_audios";

    switch($location){
//case $business_logo:
//    return uniqid(BUSINESS_LOGO."/",true);
//   break;

      case "post_images":
   return uniqid(POST_IMAGES."/",true);
   break;

       case "post_videos":
   return uniqid(POST_VIDEOS."/",true);
   break;

       case "post_audios":
   return uniqid(POST_IMAGE_AUDIOS."/",true);
   break;

        case "post_combined_files":
        return uniqid(POST_COMBINED_FILES."/",true);
            break;
    default:
    return false;
    break;
    }
}

// Returns the file permissions in octal format.
private static function file_permissions($file) {
	// fileperms returns a numeric value
	$numeric_perms = fileperms($file);
	// but we are used to seeing the octal value
	$octal_perms = sprintf('%o', $numeric_perms);
	return substr($octal_perms, -4);
}

// Returns the file extension of a file
private static function file_extension($filename = "",$file_type = "") {
	$path_parts = pathinfo($filename);

	if(in_array($path_parts["extension"],self::$allowed_extensions_videos) && in_array($file_type, self::$allowed_mime_types_videos)){
     
      return $path_parts["extension"];
	}elseif(in_array($path_parts["extension"],self::$allowed_extensions_images) && in_array($file_type, self::$allowed_mime_types_images)){
     
      return $path_parts["extension"];
	}elseif(in_array($path_parts["extension"],self::$allowed_extensions_audios) && in_array($file_type, self::$allowed_mime_types_audios)){

	return $path_parts['extension'];
}else{
	    return false;
    }
}

// Searches the contents of a file for a PHP embed tag
// The problem with this check is that file_get_contents() reads 
// the entire file into memory and then searches it (large, slow).
// Using fopen/fread might have better performance on large files.
private static function file_contains_php($file) {
	$contents        = file_get_contents($file);
	$position        = strpos($contents, '<?php');
    $second_position = strpos($contents,'<?');
     // if($second_position === false){
     //  return true ;
     // }

     // if($position === false){
     // return true;
     // }
     //   return false;

    return $position !== false;
     
	
}

// helper method that takes a multiple files
// and returns an easy to use array
public static function  multiple_uploads($files = ""){

if(isset($_FILES[$files])){
  $array = [];
  $files = $_FILES[$files];

  $count = count($files["name"]);
  for($x = 0; $x < $count ; $x++){
  foreach( $files as $key => $value){
    if(!empty(trim($files["name"][$x]))){


$array[$x][$key] = $files[$key][$x];
  }
}
}
return $array;
}
}

public static  function createThumbnail($filename) {



        if(preg_match('/[.](jpg)$/', $filename)) {
            $im = imagecreatefromjpeg( $filename);
        } else if (preg_match('/[.](gif)$/', $filename)) {
            $im = imagecreatefromgif($filename);
        } else if (preg_match('/[.](png)$/', $filename)) {
            $im = imagecreatefrompng( $filename);
        }

    $filename = explode("/",$filename);
    $filename = $filename[count($filename) - 1];

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = self::$final_width_of_the_image;
        $ny = floor($oy * ( self::$final_width_of_the_image / $ox));

        $nm = imagecreatetruecolor($nx, $ny);

        imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

        if(!file_exists(PATH_TO_THUMBS)) {
            if(!mkdir(PATH_TO_THUMBS)) {
                die("There was a problem. Please try again!");
            }
        }


    if(imagejpeg($nm, PRIVATE_MEDIA."/".PATH_TO_THUMBS.$filename)){
      $tn = '<img src="' .PRIVATE_MEDIA."/".PATH_TO_THUMBS.$filename . '" alt="image" />';
        $tn .= '<br />Congratulations. Your file has been successfully uploaded, and a thumbnail has been created.';
        echo $tn;
    }
       
    }

// Runs file being uploaded through a series of validations.
// If file passes, it is moved to a permanent upload directory
// and its execute permissions are removed.
public static function upload_file($location = "",$name = "",$count) {

    if (isset($name) && !empty($name)) {

        $errors = [];
        $sanitized_filenames = [];
    for ($file_index = 0; $file_index < $count  ;$file_index++) {


            // Even more secure to assign a new name of your choosing.
            // Example: 'file_536d88d9021cb.png'
            // $unique_id = uniqid('file_', true);
            // $new_name = "{$unique_id}.{$file_extension}";
            $original_filename = $name["name"][$file_index];
            $file_type = $name['type'][$file_index];
            $tmp_location = $name['tmp_name'][$file_index];
            $error = $name['error'][$file_index];
            $file_size = $name['size'][$file_index];

            // Sanitize the provided file name.
            $sanitized_filename = $name['name'][$file_index];
            $file_extension = self::file_extension($sanitized_filename, $file_type);
//            if(self::sanitize_file_name($location)){
//               return
//            }

        $sanitized_filename = self::sanitize_file_name($location) . ".{$file_extension}";
        //		 // to prevent breaking the page if no file name
            //		 // was returned
            //		 if ($sanitized_filename != "false.".$file_extension) {
            //         if($location == "profile_image" || $location == "business_logo"){
            //
            //         $_SESSION["profile_image"] = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/".$sanitized_filename;
            //
            //   }

   
            // Prepend the base upload path to prevent hacking the path
            // Example: $sanitized_filename = '/etc/passwd' becomes harmless
            $file_destination = self::$upload_path . '/' . $sanitized_filename;

            if ($error > 0) {
                // Display errors caught by PHP
                print j(  "Error: " . self::file_upload_error($error));
                return false;
                // return false;
            } elseif (!is_uploaded_file($tmp_location)) {
              print j("Error: Does not reference a recently uploaded file.");
                return false;
                // return false;
            } elseif ($file_size > self::$max_file_size) {
                // PHP already first checks php.ini upload_max_filesize, and
                // then form MAX_FILE_SIZE if sent.
                // But MAX_FILE_SIZE can be spoofed; check it again yourself.
               
                print j("Error: File size is too big ( \" {$file_size} \" )");
               return false;
            } elseif (!in_array($file_type, self::$allowed_mime_types_images) && (!in_array($file_type, self::$allowed_mime_types_videos)) &&
                (!in_array($file_extension, self::$allowed_mime_types_audios))) {

                print j("Error: The file '" .$original_filename ."'  does not have an allowed mime type {'". $file_type ."'} ");
               return false;
            } elseif ((!in_array($file_extension, self::$allowed_extensions_images)) && (!in_array($file_extension, self::$allowed_extensions_videos))
                && (!in_array($file_extension, self::$allowed_extensions_audios))) {
                // Checking file extension prevents files like 'evil.jpg.php'
               print j("Error: The file '".$original_filename."'  does not have an allowed extension {'".$file_type."'} ");
                 return false;
            } elseif ((getimagesize($tmp_location) === false) && (!in_array($file_extension, self::$allowed_extensions_videos))) {
                // getimagesize() returns image size details, but more importantly,
                // returns false if the file is not actually an image file.
                // You obviously would only run this check if expecting an image.
               print j(["Error:" => " Not a valid image file '{$original_filename}'.<br />"]);
                 return false;
            } elseif(self::file_contains_php($tmp_location)) {
                // A valid image can still contain embedded PHP.
                print j(["Error:" => " File contains PHP code.<br />"]);
                 return false;
            } else {

                // Success! file has passed all the above test
                // Now it is ready to be moved with permissions
                // removed.
                // echo "File was uploaded without errors.<br />";
                // echo "File name is '{$sanitized_filename}'.<br />";
                // echo "File references an uploaded file.<br />";

                // Two ways to get the size. Should always be the same.
                //echo "Uploaded file size was {$file_size} bytes.<br />";
                // filesize() is most useful when not working with uploaded files.
                //$tmp_locationsize = filesize($tmp_location); // always in bytes
                //echo "Temp file size is {$tmp_locationsize} bytes.<br />";

                //echo "Temp file location: {$tmp_location}<br />";

                if (move_uploaded_file($tmp_location, $file_destination)) {

                    if((in_array($file_type, self::$allowed_mime_types_images) || in_array($file_type, self::$allowed_mime_types_videos))
                        && (in_array($file_extension, self::$allowed_extensions_images)
                        || in_array($file_extension, self::$allowed_extensions_videos))
                    ){

                        self::createThumbnail(PRIVATE_MEDIA."/".$sanitized_filename);
                    }

                    //echo "File moved to: {$destination}<br />";
                    if (chmod($file_destination, 0644)) {
                        self::file_permissions($file_destination);
                        //move_uploaded_file has is_uploaded_file() built-in
                    } else {
                        for ($x = 0; $x < 3; $x++) {
                            log_action("Couldn't remove the execute permissions from: " . $file_destination . " @ " . time());
                            Mail::sendMail("Security", "Couldn't remove file permissions " . $file_destination);
                            // delete the associated file
                            unlink($file_destination);
                          print  j(["Error" => "Please try again!!!"]);
                          return;

                        }
                    }
                }

            }
//            //if there are errors then return them
//              if(isset($errors) && !empty($errors)){
//                   return j($errors);
//              }
            $sanitized_filenames[$file_index] = $sanitized_filename;
        }// return the sanitized name to be stored in the database

    }

    return $sanitized_filenames;

}




 }



?>