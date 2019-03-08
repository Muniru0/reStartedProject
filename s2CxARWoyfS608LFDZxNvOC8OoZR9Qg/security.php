<?php require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");before_every_protected_page(); ?>

<?php

$label   = "";
$message = "";


$user = new user();

 $interest = "security";
echo user::$firstname;
if(isset($_POST["name"])){
 $user->search_for_user($_POST["name"]);

}else{

  if(isset($_POST["post"])){
      
      $caption = $_POST["caption"];

        

      // check to see if the label has being selected 
      // and the caption(title) is not empty  
         if(!empty(trim($_FILES["files"]["name"][0]))){

            if(validate_presence_on(["caption"])) {
 
           if(PostImage::post($_POST["caption"],"files",$interest)){
            
           $message = $_SESSION["message"] = "Insertion successful";
           redirect_to("security.php");
            
           }else{

            echo "insertion failed";
           }
         
        }else{
            
          // use can javascript to highlight the different options
         // echo "Please select a label and give a title to the post";
        }
      } 
    else{

      echo "Please choose an image";  
    }



}else{


   if(isset($_POST["post_text"])){
  
   $text_area = $_POST["textarea"];

   echo $text_label;
if(validate_presence_on(["textarea"])){


 

 if(PostImage::post(false,$_POST["textarea"],$interest)){

   $message = $_SESSION["message"] = "Insertion successful";

  redirect_to("security.php");
}


 }
}else{

  if(isset($_POST["logout"])){


   if(session_status() === PHP_SESSION_ACTIVE){
    after_successful_logout();
    redirect_to("login.php");
  }}
}
}

echo "
<!DOCTYPE html> 
<html lang=\"en\"> 
<head> 
<meta charset=\"utf-8\"> 
<title>User interface for Ajax, PHP, MySQL demo</title> 
<meta name=\"description\" content=\"HTML code for user interface for Ajax, PHP and MySQL demo.\"> 
<link href=\"../includes/css/bootstrap.css\" rel=\"stylesheet\">
<style type=\"text/css\">
body {padding-top: 40px; padding-left: 25%}
li {list-style: none; margin:5px 0 5px 0; color:#FF0000}

#sacrificial_support,#sacrificial_oppose {
   display: none;
}
</style>
<script src=\"../includes/jquery.js\" defer></script>
<script src=\"../includes/script.js\" defer></script>
<script>

</script>

</head>
<body>

";
 
// makes sure that we dont get an undefined index 
// one log's in
echo $_SESSION["message"] ?? "" ;
$_SESSION["message"] = null;

// echo $_SESSION["firstname"]." ".$_SESSION["lastname"];
 
// $profile_image = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/"; 

// // if the profile image has being set the use it
// // else load the default profile_image;
//  $profile_image .= h($_SESSION["profile_image"]) ?? h("IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/muniru.png");
  



//   echo "<a href=\"profile_image.php\"><img src=\"$profile_image\" alt=\"profile_image\" width=\"50px\" height=\"50px\" /></a>
  

echo "
  <a href=\"update_profile.php\" >update profile</a>

  <a href=\"security.php\" >security</a>

  <a href=\"security.php\" >S.O.L</a>

  <a href=\"health.php\" >health</a>

  <a href=\"security.php\" >Security</a>

  <a href=\"sanitation.php\" >Sanitation</a>

  <a href=\"work.php\" >Work</a>

  <a href=\"security.php\" >security</a>
 
 <br />
 <br />

<br />
 <form action = \"security.php\" method = \"POST\">

 <input type = \"submit\" name=\"logout\" id = \"submit\" value = \"Log Out\"/>
 </form>

<br />
<br />

  <form action=\"security.php\" method=\"POST\" enctype=\"multipart/form-data\" class=\"well-security span6 form-horizontal\" name=\"ajax-demo\" id =\"ajax-demo\">
  
    <div class = \"control-group\">
              <label class = \"control-label\" for=\"name\">Username</label>
              <div class = \"controls\">
                <input type=\"search\" id = \"name\" name=\"name\" />
        </div>
 </div>
 <div class = \"control-group\">
             
       <p>Suggestion: <span id = \"suggestion\"></span></p>
 </div>

</form>


<!-- this should be replaced with an images of a camera and a camcoder -->
<input type=\"button\" id = \"button\" value=\"hide/show post\" />

 <br />
 <br />

 <div id = \"form\">

<!-- form for accepting file uploads of images and videos -->
<form action=\"security.php\" method = \"POST\" enctype=\"multipart/form-data\">


  <input type = \"file\" name = \"files[]\" id= \"files\"multiple/>
  <input type=\"text\" id=\"title\" name=\"caption\" placeholder=\"caption\" value = \"".(isset($caption) && !empty(trim($caption)) ? $caption : "")."\" />
  

  
  <input type=\"submit\" id=\"post\" name=\"post\"  value=\"Post\"/>

 
</from>

$label

<br /> <br />



<!-- the post text area -->
<form action=\"security.php\" method = \"POST\" enctype=\"text/plain\" >

 <p><textarea cols=\"100px\" width = \"100px\" placeholder=\"text\" name = \"textarea\" >".(isset($text_area) && !empty(trim($text_area)) ? $text_area : "")."</textarea></p>

 <input type=\"submit\" name=\"post_text\" value = \"post\" />
</from>

</div>


";

// $images_path = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/";

// //$interest = "";
 
//   echo "<form></form>";
//  $checked = Reaction::$checked;
//  $not_checked = Reaction::$not_checked;

// // if($_SESSION["interest"] == NULL || $_SESSION["interest"] == "interest"){
// //    $_SESSION["interest"] = "interest";
// //   $interest = "'' OR 1 = 1";
// // }else{
// //   $interest = $_SESSION["interest"];
// // }


FetchPost::top_trends("WHERE label = '".$interest."'  ");
// while ($row = $result->fetch_array(MYSQLI_ASSOC)){
    
   
//   // check the post type for each row to determine
//   // where to use an image,video or <p> tags accordingly
//   if($row["caption"] != PostImage::$post_text_unique_string){
  
//   //get the individual filenames from the post
//   $exploded_filenames = explode(",",$row["post"]);

//  // remove the last element from the array since 
//  // this will be null 
//  array_pop($exploded_filenames);


// echo  "<figure class=\" figure\">
// <div class=\"text-center\">
//  <img src=$images_path".$row["profile_image"]." class=\"figure-img img-fluid round\" width = \"60px\" height = \"60px\" alt=\"profile_image\"></div>";


//  foreach ($exploded_filenames as $value) {

//   echo "<img src=$images_path".$value." class=\"figure-img img-fluid round\" width = \"60px\" height = \"60px\" alt=\"image\" />";

// }

//  echo "<figcaption class=\"figure-caption text-justify\">".$row["firstname"]." ".$row["lastname"]."     A ".$row["label"]."  issue @ ".$row["location"]."  --".$row['caption']."--".upload_time($row["upload_time"])."--

//   <p  id= \"".Reaction::$support.$row["id"]."\" >".$row["support"]."</p> 

//   <p id= \"".Reaction::$oppose.$row["id"]."\" >".$row["oppose"]."</p></figcaption>

// </figure><br />

//    <form  action= \"security.php\" method = \"POST\" enctype= \"text/plain\">
//   <input type=\"radio\" name= \"reaction\" id=\"sup".$row["id"]."\" value =\"".(isset($row["reaction"]) && $row["user_id"] == $_SESSION["id"] ? "{$checked}": "{$not_checked}")."/".$row["id"]."/1\" ".(isset($row["reaction"])  && $row["reaction"] == 1 && $row["user_id"] == $_SESSION["id"] ? "checked = 'checked'" : "")."
// />

//     <input type= \"radio\" name =\"reaction\" id=\"opp".$row["id"]."\" value =\"".(isset($row["reaction"]) && $row["user_id"] == $_SESSION["id"] ? "{$checked}": "{$not_checked}")."/".$row["id"]."/0\" 

//   ".(isset($row["reaction"]) && $row["reaction"] == 0 && $row["user_id"] == $_SESSION["id"] ? "checked='checked'": "")."/></form>

// ";

// }else{



//   echo "<p>".$row["post"]."--".$row["support"]." ".$row["oppose"]."</p>";

// }



//  }
// echo "<form class='Form'>
//   <input type = 'radio' name = \"radioName\" value = \"one\" />
//   <input type = 'radio' name = \"radioName\" value = \"two\" />
// </form>";

}




?>

<pre>
  <?php //print_r($array);?>
  </pre>
</body>
</html>