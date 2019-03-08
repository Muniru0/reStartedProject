<?php require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");before_every_protected_page(); ?>

<?php

$label   = "";
$message = "";


$user = new user();



//echo user::$firstname;
if(isset($_POST["name"])){
 $user->search_for_user($_POST["name"]);

}else{

  if(isset($_POST["post"])){
      $label = $_POST["label"] ?? "" ;
      $caption = $_POST["caption"];

        

      // check to see if the label has being selected 
      // and the caption(title) is not empty  
         if(!empty(trim($_FILES["files"]["name"][0]))){

            if(validate_presence_on(["label","caption"])) {
 
           if(PostImage::post($_POST["caption"],"files",$_POST["label"])){
            
           $message = $_SESSION["message"] = "Insertion successful";
           redirect_to("sanitation.php");
            
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
   $text_label     = $_POST["text_label"] ?? "";
   $text_area = $_POST["textarea"];

   echo $text_label;
if(validate_presence_on(["textarea","label"])){


 

 if(PostImage::post(false,$_POST["textarea"],$_POST["text_label"])){

   $message = $_SESSION["message"] = "Insertion successful";

  redirect_to("sanitation.php");
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

.view {
   display: none;
}

.support_div,.oppose_div {
 display:inline;
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

echo $_SESSION["firstname"]." ".$_SESSION["lastname"];
 
$profile_image = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/"; 

// if the profile image has being set the use it
// else load the default profile_image;
 $profile_image .= h($_SESSION["profile_image"]) ?? h("IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/muniru.png");
  



  echo "<a href=\"profile_image.php\"><img src=\"$profile_image\" alt=\"profile_image\" width=\"50px\" height=\"50px\" /></a>
  


  <a href=\"update_profile.php\" >update profile</a>


  <a href=\"sanitation.php\" >sanitation</a>

  <a href=\"sol.php\" >S.O.L</a>

  <a href=\"health.php\" >health</a>

  <a href=\"security.php\" >Security</a>

  <a href=\"sanitation.php\" >Sanitation</a>

  <a href=\"work.php\" >Work</a>

  <a href=\"other.php\" >Other</a>
  
  <a href=\"community.php\">Community</a>
 <br />
 <br />

<br />
 <form action = \"sanitation.php\" method = \"POST\">

 <input type = \"submit\" name=\"logout\" id = \"submit\" value = \"Log Out\"/>
 </form>

<br />
<br />

  <form action=\"sanitation.php\" method=\"POST\" enctype=\"multipart/form-data\" class=\"well-sanitation span6 form-horizontal\" name=\"ajax-demo\" id =\"ajax-demo\">
  
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
<form action=\"sanitation.php\" method = \"POST\" enctype=\"multipart/form-data\">


  <input type = \"file\" name = \"files[]\" id= \"files\"multiple/>
  <input type=\"text\" id=\"title\" name=\"caption\" placeholder=\"caption\" value = \"".(isset($caption) && !empty(trim($caption)) ? $caption : "")."\" />
  
  sanitation :<input type=\"radio\" id=\"radio\" name = \"label\"  value = \"sanitation\"  ".((isset($label) && $label == "sanitation")  ? "checked = 'checked'" : "")." />

  S.O.L     :<input type=\"radio\" id=\"radio\" name = \"label\"  value = \"S.O.L\"  ".((isset($label) && $label == "S.O.L")  ? "checked = 'checked'" : "")." />

  Health    :<input type=\"radio\" id=\"radio\" name = \"label\"  value = \"health\"  ".((isset($label) && $label == "health")  ? "checked = 'checked'" : "")." />

  Trade/business/work :<input type=\"radio\" id=\"radio\" name = \"label\"  value = \"work\" ".((isset($label) && $label == "work")  ? "checked = 'checked'" : "")."/>

   Sanitation :<input type=\"radio\" id=\"radio\" name = \"label\"  value = \"sanitation\"  ".((isset($label) && $label == "sanitation")  ? "checked = 'checked'" : "")." />

   Security  :<input type=\"radio\" id=\"radio\" name = \"label\"  value = \"security\"  ".((isset($label) && $label == "security")  ? "checked = 'checked'" : "")." />

   other     :<input type=\"radio\" id=\"radio\"  name = \"label\"  value = \"other\"  ".((isset($label) && $label == "other")  ? "checked = 'checked'" : "")." />

  
  <input type=\"submit\" id=\"post\" name=\"post\"  value=\"Post\"/>

 
</from>

$label

<br /> <br />



<!-- the post text area -->
<form action=\"sanitation.php\" method = \"POST\" enctype=\"text/plain\" >
sanitation :<input type=\"radio\" id=\"radio\" name = \"text_label\"  value = \"sanitation\"  ".((isset($text_label) && $text_label == "sanitation")  ? "checked = 'checked'" : "")." />

  S.O.L     :<input type=\"radio\" id=\"radio\" name = \"text_label\"  value = \"S.O.L\"  ".((isset($text_label) && $text_label == "S.O.L")  ? "checked = 'checked'" : "")." />

  Health    :<input type=\"radio\" id=\"radio\" name = \"text_label\"  value = \"health\"  ".((isset($text_label) && $text_label == "health")  ? "checked = 'checked'" : "")." />

  Trade/business/work :<input type=\"radio\" id=\"radio\" name = \"text_label\"  value = \"work\" ".((isset($text_label) && $text_label == "work")  ? "checked = 'checked'" : "")."/>

   Sanitation :<input type=\"radio\" id=\"radio\" name = \"text_label\"  value = \"sanitation\"  ".((isset($text_label) && $text_label == "sanitation")  ? "checked = 'checked'" : "")." />

   Security  :<input type=\"radio\" id=\"radio\" name = \"text_label\"  value = \"security\"  ".((isset($text_label) && $text_label == "security")  ? "checked = 'checked'" : "")." />

   other     :<input type=\"radio\" id=\"radio\"  name = \"text_label\"  value = \"other\"  ".((isset($text_label) && $text_label == "other")  ? "checked = 'checked'" : "")." />

 <p><textarea cols=\"100px\" width = \"100px\" placeholder=\"text\" name = \"textarea\" >".(isset($text_area) && !empty(trim($text_area)) ? $text_area : "")."</textarea></p>

 <input type=\"submit\" name=\"post_text\" value = \"post\" />
</from>

</div>


";
$interest = "sanitation";

FetchPost::top_trends("WHERE post_table.label = '".$interest."'  ");
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