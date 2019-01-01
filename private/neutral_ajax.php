<?php 

require_once("../private/initialize.php");



function is_ajax(){

	return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
}
if(is_ajax()){

if(isset($_POST["comment"]) && !empty(trim($_POST["comment"]))  && $_POST["add_comment"] == true){
	  
          $_SESSION["post_ids"] = [10];
		  $post_id = (int)$_POST["post_id"];
		 if(!in_array($post_id,$_SESSION["post_ids"],true))
		 {
		    print j(["false" => "Please try again"]); 
		 }
		 
		 $view_id =  Views::add_views($post_id,$_POST["comment"]);	
  		 
if($view_id == true)
{
	  print j(["true" => "new_comment_$view_id"]);
}   
  
}elseif(isset($_POST["reaction"]) && !empty($_POST["reaction"])){

//record reaction for a post
print json_encode(Reaction::record_reaction($_POST["reaction"]));
 
//Reaction::record_reaction($_POST["reaction"]);
}elseif(isset($_POST["reaction_view"]) && !empty($_POST["reaction_view"])){


// a view of a post
print_r(Views::add_view($_POST["reaction_view"]));

}elseif(isset($_POST["view_reaction"]) && !empty($_POST["view_reaction"])){

//add a reaction to a view of a post
  print json_encode(Views::add_view_reaction($_POST["view_reaction"]));
}elseif(isset($_POST[""]) && !empty($_POST["get_views"])){

   //die($_POST["get_views"]);
  echo FetchPost::get_views($_POST["get_views"]);
 // print ShowPost::get_views();
}elseif(isset($_POST["trybe_member"]) && !empty($_POST["trybe_member"])){

    //die($_POST["trybe_member"]);
    // add a member to your trybe list
    // check to see if underscore is contained within "_"
    // the string
   
    if(strpos($_POST["trybe_member"],"_")){
     
    // expolde the string into an array containing 
    // the puloader_id and post_id.
    $_POST["trybe_member"] = explode("_",$_POST["trybe_member"]);
     
    // call the add_to_trybe method to add it to the trybe
    echo user::add_trybe_member_or_follow_post($_POST["trybe_member"][0],$_POST["trybe_member"][1]);


}else{
	echo "Please try again %s";
}

// follow a particular issue
}elseif(isset($_POST["follow_post"]) && !empty($_POST["follow_post"])) {
    // a general method that either adds a member to 
    // a trybe or allows you to follow a post
	echo user::add_trybe_member_or_follow_post($_POST["follow_post"],user::$follow_query_type);

}elseif(isset($_POST["name"]) && !empty(trim($_POST["name"]))){
  
  print_r(user::search_for_user($_POST["name"]));

}elseif(isset($_POST["label"]) && !empty($_POST["label"])
    && isset($_POST["location"]) && !empty($_POST["location"])
    && isset($_POST["media"]) && !empty($_POST["media"])
    && isset($_FILES["file"])){

$label     = $_POST["label"]     ?? "";
$caption   = $_POST["caption"]   ?? "";
$location  = $_POST["location"]  ?? "";
$reporters = $_POST["media"]     ?? "";
$mood      = $_POST["mood"]      ?? "";


//
//// check that they are files selected
//  if(!empty(trim($_FILES["files"]["name"][0]))){
//          // check to see if the label has being selected
//      // and the caption(title) is not empty
//            if(validate_presence_on(["label","caption","location","mood","media"])) {
//       // post the file
//           if(PostImage::post($_POST["caption"],"files",$_POST["label"])){
//          // if echo a success message(this is where you show the post back to the user)
//           $message = $_SESSION["message"] = "Insertion successful";
//           // redirect to the home page to wash the post
//           // super global off that data.
//           redirect_to("home.php");
//
//           }else{
//           // if the post was not successfull...
//            // this should really be removed.
//            echo "insertion failed";
//           }
//
//        }else{
//
//// use can javascript to highlight the different options
//// echo "Please select a label and give a title to the post";
//        }
//      }
//    else{
//
//      echo "Please choose an image";
//    }
//
//}elseif(isset($_POST["post_text"]) && !empty(trim($_POST["post_text"]))) {
//
//   $text_label     = $_POST["text_label"] ?? "";
//   $text_area = $_POST["textarea"];
//
//   //echo $text_label;
//if(validate_presence_on(["textarea","label"])){
//if(PostImage::post(false,$_POST["textarea"],$_POST["text_label"])){
//$message = $_SESSION["message"] = "Insertion successful";
//redirect_to("home.php");
//}
//}
//}elseif(!empty(trim($_FILES)) || isset($_FILES)){
////
////// upload the files before you store
////// the file names in the database.
//// print_r(PostImage::upload_files($_FILES));
////
////  if(isset($_POST["name"])){
////
////  echo "( ".$_POST["name"]." ) this is the name that you typed";
////  }else{
////    echo "the name is input field is not sent";
////  }
////  echo "yes it got here";
//
//     $upload_dir = "images/";
//   move_uploaded_file($_FILES["tmp"],$upload_dir.$_FILES["name"]);
}
else{

	echo "not accessible";
}

}
?>