<!DOCTYPE html>

 <html>
 	<head>
 		<title>Profile</title>
 		<meta name=\"description\" content=\"HTML code for user interface for Ajax, PHP and MySQL demo.\"> 
<link href="../includes/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {padding-top: 40px; padding-left: 25%}
li {list-style: none; margin:5px 0 5px 0; color:#FF0000}

.view ,.profile_image,.trybe_member,#post_ids{
   display: none;
}

/*.display_reaction {
	width: 30%;
	height: 30%;
	overflow-y:scroll; 
	margin:auto 0px ;
}*/

.support_div,.oppose_div {
 display:inline;
}

</style>
<script src="../includes/jquery.js" defer></script>
<script src="../includes/script.js" defer></script>
<script>

</script>

 	</head>
 <body>	

<?php
require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");before_every_protected_page(); 



if(request_is_get() && request_is_same_domain() && in_array($_GET["user_id"], $_SESSION["user_ids"])){
 

// $images_path = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/";
// $interest = "";
 
//   echo "<form></form>";
//  $checked = Reaction::$checked;
//  $not_checked = Reaction::$not_checked;

// if($_SESSION["interest"] == NULL || $_SESSION["interest"] == "interest"){
//    $_SESSION["interest"] = "interest";
//   $interest = "";
// }else{
//   $interest = $_SESSION["interest"];
//}

 FetchPost::top_trends("WHERE post_table.uploader_id = ".$_GET["user_id"]." ");

// $post_ids = [];
//    while ($row = $result->fetch_assoc()){
    
//     $post_ids[] = $row["id"];
     
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
//  <a href=\"profile.php?user_id =".(u($row["id"]))."\" ><img src=$images_path".$row["profile_image"]." class=\"figure-img img-fluid round\" width = \"60px\" height = \"60px\" alt=\"profile_image\"></a></div>";


//  foreach ($exploded_filenames as $value) {

//   echo "<a href=\"post.php?id=".u($row["id"])."\"><img src=$images_path".$value." class=\"figure-img img-fluid round\" width = \"60px\" height = \"60px\" alt=\"image\" /></a>";

// }

//  echo "<figcaption class=\"figure-caption text-justify\">".$row["firstname"]." ".$row["lastname"]."     A ".$row["label"]."  issue @ ".$row["location"]."  --".$row['caption']."--".upload_time($row["upload_time"])."--

//   <p  id= \"".Reaction::$support.$row["id"]."\" >".$row["support"]."</p> 

//   <p id= \"".Reaction::$oppose.$row["id"]."\" >".$row["oppose"]."</p></figcaption>

// </figure><br />

//    <form  action= \"home.php\" method = \"POST\" enctype= \"text/plain\">
//   Support <input type=\"radio\" name= \"reaction\" id=\"sup".$row["id"]."\" value =\"".(isset($row["reaction"]) && $row["user_id"] == $_SESSION["id"] ? "{$checked}": "{$not_checked}")."/".$row["id"]."/1\" ".(isset($row["reaction"])  && $row["reaction"] == 1 && $row["user_id"] == $_SESSION["id"] ? "checked = 'checked'" : "")."
// />

//   Oppose  <input type= \"radio\" name =\"reaction\" id=\"opp".$row["id"]."\" value =\"".(isset($row["reaction"]) && $row["user_id"] == $_SESSION["id"] ? "{$checked}": "{$not_checked}")."/".$row["id"]."/0\" 

//   ".(isset($row["reaction"]) && $row["reaction"] == 0 && $row["user_id"] == $_SESSION["id"] ? "checked='checked'": "")."/>

//  <div class='support_div'>
//    <div class=\"display_reaction\" id =\"views_".$row["id"]."\">
//  </div>
// <button id=\"support_button\">Support View</button>
//   <textarea cols=\"50px\" width = \"50px\" id=\"t/1/".$row["id"]."/1\" class= \"view support\" placeholder=\"support\" name = \"reaction_view\" >".(isset($text_area) && !empty(trim($text_area)) ? $text_area : "")."</textarea>


// <button id=\"oppose_button\">Oppose View</button>
// <textarea cols=\"50px\" width = \"50px\" id=\"t/0/".$row["id"]."/0\" class= \"view oppose\"placeholder=\"oppose\" name = \"reaction_view\" >".(isset($text_area) && !empty(trim($text_area)) ? $text_area : "")."</textarea>
// </div>
//   </form>


// ";

// }else{



//   echo "<p>".$row["post"]."--</p>";

//   echo "<p  id= \"".Reaction::$support.$row["id"]."\" >".$row["support"]."</p> 

//   <p id= \"".Reaction::$oppose.$row["id"]."\" >".$row["oppose"]."</p>";
      
// echo " <form  action= \"home.php\" method = \"POST\" enctype= \"text/plain\">
//   Support <input type=\"radio\" name= \"reaction\" id=\"sup".$row["id"]."\" value =\"".(isset($row["reaction"]) && $row["user_id"] == $_SESSION["id"] ? "{$checked}": "{$not_checked}")."/".$row["id"]."/1\" ".(isset($row["reaction"])  && $row["reaction"] == 1 && $row["user_id"] == $_SESSION["id"] ? "checked = 'checked'" : "")."
// />

//   Oppose  <input type= \"radio\" name =\"reaction\" id=\"opp".$row["id"]."\" value =\"".(isset($row["reaction"]) && $row["user_id"] == $_SESSION["id"] ? "{$checked}": "{$not_checked}")."/".$row["id"]."/0\" 

//   ".(isset($row["reaction"]) && $row["reaction"] == 0 && $row["user_id"] == $_SESSION["id"] ? "checked='checked'": "")."/>

//  <div class='support_div'>
//    <div class=\"display_reaction\" id=\"views_\"".$row["id"].">
//  </div>
// <button id=\"support_button\">Support View</button>
//   <textarea cols=\"50px\" width = \"50px\" id=\"t/1/".$row["id"]."/1\" class= \"view support\" placeholder=\"support\" name = \"reaction_view\" >".(isset($text_area) && !empty(trim($text_area)) ? $text_area : "")."</textarea>


// <button id=\"oppose_button\">Oppose View</button>
// <textarea cols=\"50px\" width = \"50px\" id=\"t/0/".$row["id"]."/0\" class= \"view oppose\"placeholder=\"oppose\" name = \"reaction_view\" >".(isset($text_area) && !empty(trim($text_area)) ? $text_area : "")."</textarea>
// </div>
//   </form>

// ";

      

// }

//  }

// $post_ids = json_encode($post_ids);
//  echo "<input type=\"hidden\" value=".$post_ids." name=\"get_views\" id=\"post_ids\"/>";


}









?>
</body>
 </html>
