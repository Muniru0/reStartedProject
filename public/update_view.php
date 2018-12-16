<?php

require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");before_every_protected_page(); 
$view_id = "";
$post_id = "";
$link_type = "";
$view = "";
if(request_is_get() && request_is_same_domain()){

  $view_id = $_GET["id"];
  $post_id = $_GET["post_id"];
  $link_type = $_GET["link_type"];
echo $view_id." ".$post_id." ".$link_type." ".$view;

  $result = Views::update_view($view_id,$post_id,$link_type);
   
   $images_path = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/";
   $count = 0;
   while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    if($row["caption"] != PostImage::$post_text_unique_string){
   	  if($count === 0){
        $count ++;
       $post = explode(",", $row["post"]);
       array_pop($post);
foreach ($post as $image) {

  echo "<img src=$images_path".$image." class=\"figure-img img-fluid round\" width = \"60px\" height = \"60px\" alt=\"image\" />";

}
}
echo "<img src=$images_path".$row["profile_image"]." class=\"figure-img img-fluid round\" width = \"60px\" height = \"60px\" alt=\"image\" />";
echo "<p>".$row["view"]."</p>";

   	     }else{
   	 if($count === 0){
 echo "<p>".$row["post"]."</p><hr /><hr />";
   	 }
   	echo "<p>".$row["view"]."</p>"; 
  

   }
  }


if (isset($_POST["edit_view"]) && !empty($_POST["edit_view"]) && isset($_POST["view"]) && !empty($_POST["view"])) {
	
	//echo $view_id." ".$post_id." ".$link_type." ".$view;
	Views::edit_view($view_id,$post_id,$link_type,$_POST["view"]);
  //TODO: look for how to get back to
  // the page that they originally came 
  // from
	echo die("date(format)");
	redirect_to("home.php");

}
}else{

	
	die("<p>Request not found</p>");
}
?>

<form action="update_view.php" method="POST" enctype="text/plain">
<textarea name = "view" cols="50px" width="100px" placeholder="loading..."><?php echo $view ?></textarea> 
<input type="submit" name = "edit_view" value="edit" />
</form>
