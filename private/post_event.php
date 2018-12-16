<?php

require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");


    // FetchPost::get_post_full_header_and_body();
    // return;


function is_ajax(){

    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
}


try {// check to see if the request is an ajax one
    if (is_ajax()) {
       if(is_request_post() && csrf_token_is_valid()) {

   
          if(csrf_token_is_recent()){
                if($_FILES["file"]["name"][0]){
                 // check the length of the caption string        
                if(isset($_POST["caption"]) && !empty(trim($_POST["caption"])) && strlen($_POST["caption"]) > 4000){
                   print  j(["false" => "Please the maximum number of characters for the caption is <b>(4000)</b>"]);
           return;
        }
                    // check the length of the title string
                         if(isset($_POST["title"]) && !empty(trim($_POST["title"])) && strlen($_POST["title"]) > 50){
                    print  j(["false" => "Please the maximum number of characters for the title is <b>(50)</b>"]);
           return;
        }
                   
               // if all the required fields have being populated
           
                if(PostImage::validate_post($_POST, $_FILES)) {
                  echo "(".$_POST["caption"].") this is before the post method is called";
     
                           if (PostImage::post(
                              $_FILES["file"],$_POST["title"],
                              $_POST["caption"], $_POST["label"], 
                              $_POST["location"])) {
                               //Mail:notify_Admin("DB_ERROR","Failure in writing to database: ".print_r($_FILES));
                            print j(["true" => "Please Your post is currently under going verification.It will appear in the stream very soon.<br /><b>(this may take up to 5 minutes)."]);
                           
                       } else{
                        // error with posting the files
                       }
                 }
       }else{
            print j(["ERROR" => "Please include files in your post"]);
           }
     }else{
print j(["ERROR" => "csrf token failure!!!(Please reload the page and try again.)"]);
       }
     }else{
print j(["ERROR"=> "Please try again(csrf token failure)"]);
       }
  }else {
print j(["ERROR" => "Please try again(AJAX REQUEST FAILED)"]);
    }
} catch (Exception $e) {

// send me a mail
print j($e);
}

?>
