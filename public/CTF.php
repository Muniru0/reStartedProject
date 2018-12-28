<?php 
require_once("../private/initialize.php");
?>
<!DOCTYPE html>
  <html>
      
    <head>
        <title>CTF</title>
        <script src = "ajax_practice/jquery.js" ></script>
         <script src = "ajax_practice/script.js" async></script>
    <style>
        @font-face{
            font-family:"myfont";
            src: url("../includes/assets/fonts/KozMinPro-Extralight.otf");
        }
/*.thumb {*/
/*    height: 75px;*/
/*    border: 1px solid #000;*/
/*    margin: 10px 5px 0 0;*/
/*  }*/
/**/
/*body{*/
/*    font-family: "myfont","Helvetica","Times New Roman","sans-serif";*/
/*        }*/
/*        */
/*img{*/
/*  height:0px;*/
/*    width:0px;*/
/*  margin:0px 40px;    */
/*  transform: translate3d(100px ,5%,1px) skew(-1deg);*/
/**/
/*}*/
/**/
/*   .no-class{*/
/*       display:none;*/
/*   }*/
/**/
/*   ui-dialog-title{*/
/*       color:#9298a0;*/
/*       text-align:center;*/
/*   }*/
/**/
/*   ui-dialog-titlebar{*/
/*       background-color:#9dc7ca !important;*/
/*   }*/
/**/
/*</style>
<script>


</script>

    </head>
 <body>
<!---->
<!--    //<img src="../includes/assets/images/loader.gif" />
 <form action="#" METHOD="POST" enctype="multipart/form-data">
 <input type="file" id="file" name="file" />
<input type="submit" name="submit" />
 </form>
-->
<?


?>
    <?php
	$var = 0;
	 echo $var === 0 ?  "they are equal" : "not equal";
	// echo   strtolower(strftime("%B, %e   &nbsp; &nbsp; %G  %i:%M:%S %P",1545903135));
	// $query = "SELECT * FROM comments WHERE ";
	// $post_ids = [1,2,3,4,5,6,78,];
	// foreach($post_ids as $post_id)
	// {
		// $query .= " post_id = {$post_id} OR";
		
	// }
	// echo $query."<br />";
	// echo substr_replace($query,'',-2, 2)."<br />";
   // echo $query."<br />";
	 // if(isset($_FILES))
	 // {
		 // echo "<pre>";
		 // print_r($_FILES);
		 
		// $info = pathinfo($_FILES["file"]["name"]);
		// if(in_array(strtolower($info["extension"]),FileUpload::$allowed_extensions_images))
		// {
			// echo "yes";
		// }
		 // echo "</pre>";
	 // }
	
	
//function myfunction(){
//$var = "mynameis<?";
//$position = strpos($var,'<?');
//$sposition  = strrpos($var, "z");
// if($position !== false && $sposition !== false){
//  return true;
// }else{
//  return false;
// }
//
//}
//
//if(myfunction()){
//  echo "it has being found";
//}else{
//  echo "not found";
//}

  // if(isset($_POST["submit"])){
  // if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])){

  //   echo "not empty "."<br />";
  //   print_r($_FILES);
  //   header("Location: /index.php");
  //   exit();
  // }else{
  //   echo "it is empty";   
  //   print_r($_FILES);
  // }
  // }else{
  //   print_r($_FILES);
  // }
     
    // echo phpinfo();
	
	// echo "
	  // <form action = '' method = '' enctype = 'multipart/form-data'>
	// <input type='file' name='file' />
	// </form>";
 // echo "the directory separator is ".DIRECTORY_SEPARATOR."<br />";
// echo password_hash("yussifpassword",PASSWORD_ARGON2I,['memory_cost' =>30,'time_cost' => 50, 'threads' => 3])."<br />";
// echo time();
 // $array = [4 => "testing value",5 => "dd","fsjfksa" => "fkdjsa", "kdjal"=> "kdsjlas"];
     // $post_id = 8;
    // $string = "VALUES ";
     // foreach($array as $element){
          // $string .= "(8,{$element}),";
     // }
      
   // echo substr_replace($string,'',-1, 1);
     

//     $test = true;
//        if(json_decode(true) === true){
//            echo  "yes can decode";
//        }else{
//            echo "cant decode";
//        }

     // echo 1/14;


 



    // $filename = "../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/r8NFcV3V75k4WISV0V8rrp4FmwUTr6Km9tQ1b9sSquA/5bb36ff9ce13f4.26156297.png";


    // // Content type
    // header('Content-type: image/png');

    // // Load
    // $im = imagecreatefrompng($filename);

    // // Flip it vertically
    // imageflip($im, IMG_FLIP_VERTICAL);


    // // Output
    // imagejpeg($im);
    // imagedestroy($im);
    ?>
   
    <!-- <img src='../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/thumbs/5bb36ff9ce13f4.26156297.png' alt="images-1" title="image-1" /> -->
<!--<form class="dropzone" action="../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/post_issue.php" Method="POST"></form>-->
<!--        <script  src="../includes/assets/dropzone/dropzone.js">  </script>-->
<!-- <img src="C:/wamp64/www/sample_app/public/assets/images/203-rain-computer-background-photos-downloads-backgrounds-wallpapers_2.jpg" alt="image test" />-->

<?php
//      $db = DatabaseObject::db_connect();
//     $result_array;
//     $result = $db->query("SELECT * FROM users");
//     
//     if($row = $result->fetch_array(MYSQLI_ASSOC))
//     {
//         $result_array = $row;
//     }
//    echo $result_array["firstName"];
    die();
echo "<form class=\"dropzone\" action=\"../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/post_issue.php\" Method=\"POST\">
<button type='submit' name='submit' value='submit'></button>
</form>";
die();
/**
 * @param $upload_time
 * @return Exception|string
 */
function time_converter($upload_time){

    $upload_time = (integer)$upload_time;
    if (isset($upload_time) && !empty($upload_time) && is_integer($upload_time)) {

        if ((time() - $upload_time) > -1 ) {
            try {

                //echo $upload_time
                $min = 60;
                $hr = $min * 60;
                $day = $hr * 24;
                $mid_night = $hr * 18;
                $wk = $day * 7;
                $mon = ($wk * 4) + 2;
                $yr = $mon * 12;

             $upload_time = (time()  + $mon + ($wk * 3)) - $upload_time;
//             echo "mon: ".$mon ." upload_time ". $upload_time;
//             $abs = abs(($mon - $upload_time));
//             echo "difference between them: ".$abs;
//             echo "the number of days of days are: ". ceil($abs/ $day)."<br />";

                 if ($upload_time < $min) {
                    if($upload_time == 1){
                        return "a second ago";
                    }else if(ceil($upload_time/$min) == 1){
                        return "a minute ago";
                    }else{
                        // if it is just some seconds ago
                        return $upload_time . " seconds ago";
                    }

                    //if it is more than or equal to a minute but less than or equal to an hour
                } elseif ($upload_time >= $min && $upload_time <= $hr) {
                    // if it is exactly a minute
                    if(ceil($upload_time/$min) == 1){
                        return "a minute ago";
                        //if it is exactly an hour
                    }elseif(ceil($upload_time / $hr) == 1){
                        return "an hour ago";
                    }else{
                        // if it is between an hour and a minute
                        return ceil($upload_time/$min)."minutes ago";
                    }
                    //  greater than an hour and less than a day
                } elseif($upload_time > $hr && $upload_time <= $day) {
                    // about 18 hours ago
                    if(ceil($upload_time /$hr) >= $mid_night){
                        return "yesterday";

                        // if the it is greater than an hour and less than $mid_night hours
                    }elseif(ceil($upload_time / $hr) > 1 && ceil($upload_time / $hr) < $mid_night){

                        return  ceil($upload_time / $hr) . " hrs ago";

                    }elseif(ceil($upload_time / $hr) == 1) {
                        return "an hour ago";
                    }elseif(ceil($upload_time / $hr) > $mid_night && ceil($upload_time / $hr) < $day){
                        // if it is just a day ago
                    } elseif(ceil($upload_time / $day) == 1){
                        return "since yesterday";

                    }else{
                        return "some time ago";
                    }
                    // greater than or equal to a day and less than or equal to a week
                }elseif($upload_time  >= $day && $upload_time <= $wk) {
                            // if it is just a day ago
                            if(ceil($upload_time / $day) == 1){
                                return "since yesterday";
                            }elseif($upload_time == $wk){
                                return "a week ago";
                            }else{
                                // within the week
                                return ceil( $upload_time / $day) . " days ago";
                            }
                  // greater than or equal to a week or less than or equal to a month
                } elseif($upload_time >= $wk && $upload_time <= $mon) {
                                if($upload_time == $wk){
                                    return "a week ago";

                            }elseif ($upload_time > $wk && $upload_time < $mon) {
                                 // return only the weeks
                                return  ceil($upload_time / $wk). " weeks ago";
                            }elseif($upload_time > $wk && $upload_time == $mon){

                                return "a month ago";
                            }else{
                                    return "some time ago";
                                }
            }elseif($upload_time >= $mon && $upload_time <= $yr ){
                    // if it is a month and some weeks

                     if(($upload_time > $wk && $upload_time >= $mon) &&
                         ((int)floor($upload_time / $mon)  === 1) &&
                         $upload_time < (($mon * 2)-($day * 6))){
//
                         return "a month ".sub_time_converter($upload_time,$mon,$wk,"weeks")." ago";

                     }elseif(($upload_time > $wk && $upload_time >= $mon) &&
                         ((int)floor($upload_time / $mon)  === 1) &&
                         $upload_time < ($mon * 2)){

                         return "about ".round($upload_time / $mon)." months ".sub_time_converter($upload_time,$mon,$wk,"weeks")." ago";;

                     }elseif($upload_time > $mon && $upload_time > $wk && $upload_time == $yr){
                         return "about a year ago";
                     }else{
                         return "some time ago";
                     }

                 }elseif($upload_time >= $yr && $upload_time <= ($yr * 10)){
                      if($upload_time == $yr){
                          return "about a year ago";
                      }elseif($upload_time > $yr && $upload_time < ($yr * 10)){

                          return "10 years ago";
                      }elseif($upload_time == ($yr * 10)){
                           return "about 10 years ago";
                      }elseif($upload_time > ($yr * 10)){
                          return "more than 10 years ago";
                      }else{
                          return "some time ago";
                      }
                 }else{
                     return "some time ago";
                 }
            }catch (Exception $e) {
                return $e;
            }
        }
    }
}

function sub_time_converter($dividend = 0,$divisor = 0,$fallback = 0,$fallback_name = ""){

    if(isset($divisor) && !empty($divisor)
        && isset($divisor) && !empty($dividend)
        && isset($fallback_name) && !empty(trim($fallback_name))
        && fmod($dividend,$divisor) > 0 ){

        $time =fmod($dividend,$divisor) ;
        if(floor($time/$fallback) > 1 && round($time/$fallback) < 4){
            return "and ".round($time/$fallback)." $fallback_name ";
        }

    }

}

//echo time_converter(1537815052);
// $message = "SpeakUP";
//
//        $test = function() use ($message){
//            echo $message;
//        };
//   // $message = "SpeakUp!";
//    $test();
//        $messgage = "SpeakUP!!";
//        $test = function() use (&$message){
//            echo $message;
//        };
//        $test();

//  print_r($_SERVER);
// echo $_SERVER['HTTP_X_FORWARDED_PROTO'];  echo $_SERVER['REMOTE_USER'] ;
//
//
//if(strcasecmp($_SERVER["HTTPS"],"on") === 0){
//    echo "pesent";
//}elseif(strcasecmp($_SERVER["HTTPS"],"on") < 0 ){
//    echo "less than it";
//}elseif(strcasecmp($_SERVER["HTTPS"],"on") < 0){
//    echo "greater than it";
//}
//   print_r($_SERVER["HTTPS"]);
//if(exif_imagetype("images/image-1.jpg") != IMAGETYPE_JPEG){
//    echo "it is not a gif";
//}else{
//    echo "it is a gif";
//}
//        die();
//
//        if(isset($_POST["submit"])){
//
//            echo $_POST["name"];
//
//        }
require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");
require_once("PHPMailer_5.2.4/class.phpmailer.php");

//echo "<output id=\"list\"></output>";
//echo "<form action='CTF.php' method='POST' id='form'  enctype='multipart/form-data'>
//
//
//<input type='file' id='files' name='files' multiple/>
//<input type='text' name='name' />
//<input type='submit' name='submit' value='submit'/>
//</form>
//
//";
//   if(isset($_FILES["files"])){
//       print_r($_FILES);
//
//   }
//
//   $test = "test";
//
//   function greet($greeting){
//        return $greeting;
//   }
//  // echo "this is just a test";
//   if(true)
//       echo "first done";
//
//   elseif(true)
//           echo "second done";
//
//   elseif(true)
//       echo "third done";
//   else
//       echo "forth one";


//       echo  password_hash("Backdoors6",PASSWORD_ARGON2I,
//    ['memory_cost' => 30,'time_cost' => 50, 'threads' => 3]);
//$var = true;
//(function(){
//
//$('#login').click(function(e){
//  e.preventDefault();
//alert('people spwak');
//  $('#form').submit(function(e){
//  alert('simple way');
//  });
//});
//
//
//})()
//echo $var = !$var ? "it is true" : "it is false";

//echo ;
//echo strftime("%j",time()) - strftime("%j",1537815052);
//echo strftime("%j",time()) - strftime("%j",1537815052);

  //$time = strftime("%U",time()) - strftime("%U",1537815052);
  $now_time = "1538052300";
$time = time() ;

    $time =  time() - 1538057964;





die();
$first  = j(true);

$second = json_decode($first);
 if($second === true){

     echo "they are the same in value";
 }elseif($second === 1){
      echo "they are the in datatype and value";
 }

 if(json_decode(j("hello"))){
     echo "decoded";
 }else{
     echo "not decoded";
 }
echo "

<div class='selector'></div>
<link rel=\"stylesheet\" href=\"../includes/assets/css/jquery-ui.css\">
<style>
no-close {
display:none;
}
</style>
<script src=\"../includes/assets/dropzone/jquery.min.js\"></script>
 <script  src=\"../includes/assets/dropzone/dropzone.js\">  </script>
  <script  src=\"../includes/assets/js/jquery-ui.js\">  </script>

<button id=\"opener\">open the dialog</button>
<div id=\"dialog\" title=\"Dialog Title\" style=\"font-family: 'myfont' !important; line-height: 1.2em;\">Please You will see your posted issue after it has being verified(this may take up to 5 minutes)</div>


<script>


       $( \"#dialog\" ).dialog({
                dialogClass: \"no-close\",
                draggable:false,
                height:\"auto\",
                maxHeight: 600,
                minHeight:200,
                modal:true,
                minWidth:200,
                resizable:false,
                closeOnEscape: true,
                buttons: [
                    {
                        text: \"Ok\",
                        icon: \"ui-icon-heart\",
                        click: function() {
                            $( this ).dialog( \"close\" );
                        }

                    }
                ]
            });
        $(\"#opener\").click(function(){
          $(\"#dialog\").dialog(\"open\");
        });
</script>



";

//<script>
//$( ".selector" ).dialog({
//  buttons: [
//    {
//      text: "Ok",
//      icon: "ui-icon-heart",
//      click: function() {
//        $( this ).dialog( "close" );
//      },
//
//      // Uncommenting the following line would hide the text,
//      // resulting in the label being used as a tooltip
//      showText: false
//    }
//  ]
//});
//</script>

//$db =$sql->open_connection();
//
//if($result = $db->query("SELECT * FROM post_table WHERE id =(SELECT MAX(id) FROM post_table)")){
//
//    echo "<pre>". print_r($result)."</pre>";
//
//    if($row = $result->fetch_assoc()){
//        if(!is_array($row["post"]) && json_decode(($row["id"]))){
//            print $row["post"];
//        }else{
//            echo "it is not json nor an array";
//        }
//    }
//    $result->close();
//}
//
//$db->close();
//
die();
 date("l ",mktime(07,19,13,03,13,2018)) ." @ ";
 date("h:s",mktime(07,19,13,03,13,2018));
date('l',time());

//echo strftime("%Y-%m-%d %H:%S:%I",filemtime("../private/functions/verification_functions.php"));
$db = $sql->open_connection();


$query = "INSERT INTO txt (txt,json_column) VALUES(?,?)";

$stmt = $db->prepare($query);

if(!$stmt){

  die("the preparation failed ".$db->error);

}

$txt = "hey";
$json = json_encode(["heloo",1,true,"hey",false]);
if(!$stmt->bind_param("ss",$txt,$json)){

die("binding parama failed: ".$stmt->error);
}

if(!$stmt->execute()){

die("Execution failed: ".$stmt->error);
}
$array = [1,23,3,5,5,4,6,9,7];


//echo strlen("jfdlksafjl;kdsafj;salkdfj;ksalfjl;dsajfksald;fj;ldfj;ldjf;slajfdsalkfjsdkfjskladfjsk;ldfjsl;kdajfl;dskjfdsl;kfjlksafjksldjfslkdjfksladjfkdsjfksdfjkfdjklfdjkfldjfl;dsjafd;lsjfds;lfkdj;flkdj;lfdsjfld;ksjf;dljfd;slfkjds;lkfdjsl;kfdjslkfdjslkfdj;lkfdj;fdsj;");


if(isset($_FILES["file"])){

  print_r($_FILES);

}
//  function match(){

// $match2 = "no";

// $match = "yes";

// $location = "yes";

// $in = "/matched";
// switch($location){

//   case $match:
//   return uniqid($in,true);
//   break;

//  case $match2:
//  return "matched2";
//  break;
// }
// }
// echo match();

$a = "a";

// echo "my name is ".((isset($a) && $a == "a") ? " Yussif Muniru " : "M")." hahah";
//  echo "<br /><br /><br />";

// // echo password_hash("public",PASSWORD_ARGON2I)." == public <br />";
// // echo password_hash("private",PASSWORD_ARGON2I)." == private <br />";
// // echo  password_hash("images",PASSWORD_ARGON2I)." == images <br />";
// // echo  password_hash("profile_images",PASSWORD_ARGON2I)." == profile_images <br />";
// // echo  password_hash("post_images",PASSWORD_ARGON2I)."== post_images<br />";
// // echo  password_hash("public",PASSWORD_ARGON2I)."<br />";
// // echo  password_hash("public",PASSWORD_ARGON2I)."<br />";

// echo strlen('IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/5abd8b35eaa2f9.93819391.png');


  //$array = ["b",3,"54",["b","d",74,true,"Yussif",["Muniru","Isam","Muslim"=>90,"fd"]]];

$string = "kdfad";
//echo "<pre> <br /> <br />".$json = json_encode($array)."<br /> <br /> </pre>";


//echo strpos("yussifmunirium@gmail.com","@",0);
// echo "<br />".password_hash("WorK HarD",PASSWORD_ARGON2I,['memory_time' => 1024,'time_cost' =>100000,'$threads' =>3]);
// $stmt->execute();
//echo $date = date("Y-m-d h:s:i",time());

 //  $stmt = $db->prepare("INSERT INTO test (name,value) VALUES(? , ?)");

 //    $name = "Muniru";
 //    $value = "Yussif";

 //    $array = [$name,$value];

 // $result = "";
 //    foreach($array as $field){

 // $result = $stmt->bind_param("ss", $name,"$value")
 //    }



  //echo $hello;
// $password = '$argon2i$v=19$m=1024,t=2,p=2$bk9heUNrLk5OVW1VdVRXbw$b/IeMCtTN4sZJtobIIQlU2TMJE3MGudqvG3L31bf/bc';
 //echo password_hash("muniru",PASSWORD_ARGON2I);
// if(password_verify("muniru",$password)){

//   echo "They are the same";
// }else{
//   echo "They are not the same";
//}
  // $result = $stmt->bind_param("ss", $name,"$value");

   // echo  $password    = password_hash("Muniruisaboy",PASSWORD_ARGON2I,
   //  ['memory_cost' => 30,'time_cost' => 50, 'threads' => 3]);;


//function ground($name=NULL){

//global $db;


//    foreach($subject as $item){

// preg_match('/([^A-Za-z])/', $item,$matches);

//   if(!empty($matches)){

//     echo "Please ".$item." should contain only lower and upper case characters.";
//    return false;

//  }
//    }

//   return true;

// $query = " SELECT post_table.*,post_table.id as post_table_id ,firstname,lastname,profile_image,reactions.user_id,reaction,views.*,views.id as views_id  FROM post_table LEFT JOIN users ON post_table.uploader_id = users.id LEFT JOIN views on views.post_id = post_table.id  LEFT JOIN reactions ON reactions.post_id = post_table.id  ";


$query = "SELECT firstname,lastname,profile_image,view,view_type,view_time,views.support,views.oppose,post_table.id AS post_table_id FROM users RIGHT JOIN views ON users.id = views.user_id LEFT JOIN post_table ON views.post_id = post_table.id";

$query = " SELECT post_table.* ,firstname,lastname,profile_image,user_id,reaction,view_support,view_oppose FROM post_table LEFT JOIN users ON post_table.uploader_id = users.id LEFT JOIN reactions ON reactions.post_id = post_table.id GROUP BY post_table.id ORDER BY (post_table.support + post_table.oppose) DESC  LIMIT 2 ";

$query = " SELECT post_table.* ,firstname,lastname,users.profile_image,reactions.user_id,views.profile_image,view,view_type,view_time,views.user_id FROM post_table LEFT JOIN users ON post_table.uploader_id = users.id LEFT JOIN reactions ON reactions.post_id = post_table.id LEFT JOIN views ON views.post_id = post_table.id GROUP BY post_table.id ORDER BY (post_table.support + post_table.oppose) DESC ";

$query = " SELECT post_table.* ,firstname,lastname,users.profile_image AS uploader_image,reactions.user_id,views.*,post_table.id AS post_table_id FROM post_table LEFT JOIN users ON post_table.uploader_id = users.id LEFT JOIN reactions ON reactions.post_id = post_table.id RIGHT JOIN views ON views.post_id = post_table.id GROUP BY views.id ";


// $query = "SELECT post,views.* FROM post_table JOIN  views ON post_id = post_table.id WHERE post_table.id = 4";

   $stmt = $db->prepare($query);

  // if(!$stmt){

  //   die("The prepare failed: ( ".$db->errno." )".$db->error." ".$stmt->error);
  // }


// echo password("post_video",PASSWORD_ARGON2I);

// $bind = $stmt->bind_param("s",$name);

//  if(!$bind){

//   die("Binding failed: ( ".$db->errno." ) ".$db->error);

//  }

// $execution = $stmt->execute();


// if(!$execution){

//   die("there was an execution failure: ( ".$db->errno." ) ".$db->error);

// }



// $result = $stmt->bind_result($id);

// if($result->fetch()){

//    return $id;
// }else{

//   die($stmt->error);
// }

// $result = $stmt->get_result();
// $real_result = [];
// $data = [];
// $count = 0;
// $_2 = uniqid();

// while($row = $result->fetch_array(MYSQLI_ASSOC)){
//   // equate the posts to their individual captions
//   // $real_result[$row["post"]] = [$row["id"],$row["uploader_id"],$row["upload_time"],$row["caption"],$row["label"],$row["location"],$row["support"],$row["oppose"],$row["view_support"],$row["view_oppose"],$row["uploader_image"]];
//   // // advance the array pointer of the real_result
//   // next($real_result);
//   // // store the entire row data in the $data array
//   // $data [] = $row;
//   //   echo "<pre>";
//   //  // echo $row["id"]." ".$row["post_id"]." ".$row["firstname"]." ".$row["view"]." ".$row["view_time"];
//   //   print_r($row);
//   //  echo "</pre>";

//   // $count ++;
// }

// $count = count($real_result);
//  return $real_result;


 // $message = "[".strftime("%Y-%m-%d %H:%S:%i")."] ".$message."\n";
 //     $logged = file_put_contents("C:/wamp64/www/sample_app/private/logs/log.txt",$message,FILE_APPEND | LOCK_EX);

 //   if(!$logged){

 // file_put_contents("C:/wamp64/www/sample_app/private/logs/masterLog.txt",$message,FILE_APPEND | LOCK_EX);

 //   }

  //}

$aa = [1,2,3,33,2,3,1,33];
$aa[] ="kdjfal";

$aa = array_unique($aa);

///$values = ground();

// $count = count($values);

// sort($values);
// echo  "<hr />";


$my_post_with_comments = [];
echo "<hr /> <br /> <br /> <hr /> <br /> <hr />";



 //post_with_views($real_result,$data);

//   $result = $db->query("SELECT * FROM test",MYSQLI_USE_RESULT);

//   $result = $db->query("SELECT * FROM test");
//   if($result = $db->store_result()){
//      while($row = $result->fetch_row()){
// echo $row[0];
//      }
//   }

  $result = $db->query("SELECT * FROM post_table WHERE id = 14005");

  while($row = $result->fetch_assoc()){

  echo $row["post"]."<br />";
}

//   while($row = fetch_assoc($result)){

// echo     $row["name"];
//   }

//print_r($result);



 $allowed_mime_types_images = ["image/png", 'image/gif', 'image/jpg', 'image/jpeg',"image/bmp","image/svg","image/ai","image/eps","image/ps"];
$allowed_extensions_images = ["png", 'gif', 'jpg', 'jpeg','bmp','svg','ai','eps','ps',"wmv"];

 // $var = strrchr("thskdfjd;lakfjld;asfdfdslfkja.kdfsj;lkfafdsa/lkfdslafdlsa;/kdflas.kfjdlaf.png",".");

 //  $var = substr_replace(strrchr("thskdfjd;lakfjld;asfdfdslfkja.kdfsj;lkfafdsa/lkfdslafdlsa;/kdflas.kfjdlaf.png","."),"",0,1);
//    if(in_array(trim(substr_replace(strrchr("thskdfjd;lakfjld;asfdfdslfkja.kdfsj;lkfafdsa/lkfdslafdlsa;/kdflas.kfjdlaf.png","."),"",0,1)),FileUploads::$allowed_extensions_images)){

//    }elseif(in_array(trim(substr_replace(strrchr("thskdfjd;lakfjld;asfdfdslfkja.kdfsj;lkfafdsa/lkfdslafdlsa;/kdflas.kfjdlaf.png","."),"",0,1)),FileUploads::$allowed_extensions_videos)){
//   echo "<video src=\"video.mp4\" autoplay height=\"500px\"  width=\"500px\" controls>
// Sorry, your browser doesn't support embedded videos,
// but don't worry, you can <a href=\"videofile.webm\">download it</a>
// and watch it with your favorite video player!
// </video>";
//    }

// echo "<video src=\"5b1aea19549074.30799213.wmv\" autoplay height=\"500px\"  width=\"500px\" controls>
// Sorry, your browser doesn't support embedded videos,
// but don't worry, you can
// and watch it with your favorite video player!
// </video>";


if(isset($_POST["submit"])){

  print_r($_FILES["myfile"]);
  print_r(pathinfo($_FILES["myfile"]["name"]));
}

echo "<form action='#' method='POST' enctype='multipart/form-data'><input type='file' name='myfile' /><br />
      <input type = 'submit' name= 'submit'  value = 'submit'/>
      </form>";



 die();

   function post_with_views($post = [],$data = ""){

//print_r($post);
//$array = array_unique($post);

foreach ($post as $caption => $new) {
  echo " <hr /> <hr /><br />".$caption."<br /><br />".$new[10]." <br /><br />";
foreach ($data as $key => $value) {

  if($value["post"] == $caption){

   echo $value["view"]." ".$value["profile_image"]." ".$value["view_fullname"]." "."<br />";
  }
 }

}
 }

$key = hash('sha256', 'this is a secret key', true);
    $input = "Let us meet at 9 o'clock at the secret place.";

    $td = mcrypt_module_open('rijndael-128', '', 'cbc', '');
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM);
    mcrypt_generic_init($td, $key, $iv);
    echo $encrypted_data = mcrypt_generic($td, $input);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

 //print_r($array);

//print_r($data);



print_r($array);
$query  = " SELECT firstname,lastname,profile_image,view,view_type,view_time,views.support,views.oppose,post_table.id AS post_table_id FROM users RIGHT JOIN views ON users.id = views.user_id LEFT JOIN post_table ON views.post_id = post_table.id WHERE views.post_id >= ? AND  views.post_id <= ?";

$stmt = $db->prepare($query);

if(!$stmt){

die("Preparation failed: ".$db->error);
}


if(!$stmt->bind_param("ii",$values[0],$values[$count - 1])){

  die("binding failed: ".$stmt->error);
}

if(!$stmt->execute()){

  die("Exeute the statement: ".$stmt->error." ".$db->error);
}

$result = $stmt->get_result();

while($row = $result->fetch_array(MYSQLI_ASSOC)){

  echo "<pre>";

  print_r($row);

  echo "</pre>";

}

//$result = ground() = null;

//  if($result){


// echo  $result;
//  }


//  $info = pathinfo("../private/logs/log.txt");

//  echo "<br />".$info["extension"]."<br />";

//  print_r($info);


//  echo uniqid("file_",true);

//   echo $query = "INSERfkT INTOdfsl this->table_name (user_id,profile_image,upload_time) VALUES(?,?,?)";

//  $count = 2;

//  if($count <=! 2){

// echo "Yes";
//  }

//    //echo dirname(dirname(__FILE__));
// $result = ground("J");
//    if($row = $result->fetch_array(MYSQLI_ASSOC) == null){

//    echo "no results";
//    }else{

//      echo "there were results for the input F";
//    }


// $d = $_SERVER["REMOTE_ADDR"];
// echo "{$d}";

// if( 1 != false){

// echo "heloo";
// }

  /**
  *
  */
  class ClassName extends DatabaseObject
  {



public  function id (){

  global $sql;
  global $db;

  $stmt =  $this->query("INSERT INTO test (name,value,school) VALUES(?,?,?),(?,?,?)");

$name   = "Muniru";
$value  = "hey";
$school = "ho";

if(!$stmt->bind_param("ssssss",$name,$value,$school,$name,$value,$school)){

  die("Preparation failed: ".$db->error);
}


 $stmt->execute();

$stmt->free_result();



$stmt->close();


 echo mysqli_insert_id($db);;


 $db->close();
}


  }


$i = new ClassName();

echo "hey ".( 1 !== 1 ? "set": "not set" ). " ho";


$message = "Line 1\r\nLine 2\r\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
//mail('caffeinated@example.com', 'My Subject', $message);

//   $file = 'Baqarah.pdf';

// if (file_exists($file)) {
//     header('Content-Description: File Transfer');
//     header('Content-Type: application/octet-stream');
//     header('Content-Disposition: attachment; filename="'.basename($file).'"');
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate');
//     header('Pragma: public');
//     header('Content-Length: ' . filesize($file));
//     readfile($file);
//     exit;
// }

echo password_hash("business_logo",PASSWORD_ARGON2I);
//   // We'll be outputting a PDF
// header('Content-Type: application/pdf');

// // It will be called downloaded.pdf
// header('Content-Disposition: attachment; filename="monkey.pdf"');

// // The PDF source is in original.pdf
// readfile('monkey.pdf');
// while($row = $result->fetch_array(MYSQLI_ASSOC)){

//     echo $row["name"];


      // bind the results
      //$results = $stmt->bind_result($hashedpassword);
      //
      // if(!$results){
      //
      // die("Failure to bind results: ( ".$db->errno." )".$db->error);
      // }

      // fetch the results and verify the fetched password
      // with the one submitted via the form and return the
      // results

$var = NULL;

$var = (boolean)$var;
if($var === false){

echo "it entered there because the variable was false";
}

$query = "INSERT INTO test (name,value,school) VALUES(?,?,?),(?,?,?)";

$stmt = $sql->query($query);

if(!$stmt){


  die("preparation failed");

}

$yh = [];
$name    = "name";
$value   = "";
$school  = "";

$yh = "$name $value $school";

$array = explode(" ",$yh);


// if(!$stmt->bind_param("ssssss",$array[0],$name,$value,$school)){

// die("Binding failed: ".$db->error." ".$stmt->error);
// }




  // }
// $result->free_result();
// $db->close();


//    preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
// print_r($matches);

//print_r($matches);
// filemtime("../private/function/verification.php")
//echo $db->error;
//     function insert( $columns=[],$values = []){
//
//    if(empty($columns) && empty($values)
//			 && isset($values) && isset($values)){
//
//	  $fields = [];
//		 foreach($columns as $column){
//
//			 $fields[$column] = $column;
//		 }
//
//		array_shift($fields);
//		$db->query("INSERT INTO ".$this->tableName."( ".implode(',',$fields).") VALUES('".implode("','", explode(" ",$this->tableName."->".implode( $this->tableName,$fields)))."')");
//
//		}else{
//			$insertId = $db->query("INSERT INTO ".$this->tableName."(".implode(',',$columns)." ) VALUES('".implode("','",$values));
//		if( $insertId < 0){
//
//			return true;
//		}
//
//		}
//
//}

//  $db = $sql->open_connection();
// //

// $password = password_hash('rasmuslerdorf',PASSWORD_ARGON2I,$options = ['memory_cost'=> 100, 'time_cost' => 50, 'threads' =>3] );

// //$query = "INSERT INTO user (name) VALUES('".$password."')";
// echo $db->query($query);

// echo $db->error;

// $result = $db->query("SELECT * FROM user");

//  $password = "";

//   while($row = $result->fetch_assoc()){

//      $password = $row["name"];
//   }



 //echo strlen($password);
//
 //$password = password_hash('rasmuslerdorf',PASSWORD_ARGON2I,$options = ['memory_cost'=> 100, 'time_cost' => 50, 'threads' =>3] );

  // if(password_verify("rasmuslerdorf",$password)){
		// echo "they are the same";
	 // }else{
		// echo "they are not the same";
	 // }


//$table = " user->";
// 'user->firstName','user->lastName', 'user->yussif'
//$array = ['firstName',"lastName","yussif"];



	//while($row = $result->fetch_assoc()){
	//	echo $row["name"]."  ";
	//}

 // echo "   INSERT INTO users (".implode(",", $array).")
 // VALUES ('".implode("','", explode(" ","".trim($table)."".implode( "".$table."",$array)))."');";


//echo $table.implode($table,$array);
//
//echo strtotime("now"), "\n";
//echo strtotime("10 September 2000"), "\n";
//echo strtotime("+1 day"), "\n";
//echo strtotime("+1 week"), "\n";
//echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
//echo strtotime("next Thursday"), "\n";
//echo strtotime("last Monday"), "\n";

//echo strtotime("2days 2hours 2minutes 1seconds");
//  $time1 = date(" Y-m-dTG:i:s", time());
//  $time2 =  date(" Y-m-dTG:i:s", time()-10000000);
// //
//  $datetime1 = date_create($time1);
// $datetime2 = date_create($time2);
// $interval = date_diff($datetime1, $datetime2);

// substr_replace($time1,"  ",strpos($time1,"U"),-8);
// $interval->format('%R%a days minutes');

// strpos("yussifmuniru@gmail.com",".  ",0);



// date_diff($time,$time2);
//print_r(localtime(time(),true));
//print_r(getdate(time()));

//die();
//$field_name = "file1";
//if($_POST["submit"]){
//
//	echo        $file_type = $_FILES[$field_name]['type'];
//	echo 	    $tmp_file = $_FILES[$field_name]['tmp_name'];
//    echo 		$error = $_FILES[$field_name]['error'];
//    echo		$file_size = $_FILES[$field_name]['size'];
//     echo		$file_name = $_FILES[$field_name]['name'];
//
//     foreach (pathinfo($field_name) as $value){
//        echo $value."<br/>";
//     }
//
//     //echo pathinfo("index.php")["extension"]."<br/>";
//     //echo pathinfo("index.php")["filename"];
//
//    $string = sanitize_file_name("wwkdjfjd;fa;add;fkdajfdaf;a");
//
//    echo strlen(uniqid("gov_ substr($string,0,3)",true));
//
//     $array = explode("_",uniqid("gov_",true));
//     echo $array["0"];
//}
//
//

// $result = null;

 //if(is_null($result)){

  //echo "yes it is null";

 //}


//$tz = new DateTimeZone("Africa/Accra");
//print_r($tz->getLocation());
//print_r(timezone_location_get($tz));

//echo "<br />";



// $date = new DateTime('2000-01-01');
// $date->add(new DateInterval('PT10H30S'));
// echo $date->format('Y-m-d H:i:s') . "\n";

// $date = new DateTime('2000-01-01');
// $date->add(new DateInterval('P7mY5M4DT4H3M2S'));
// echo $date->format('Y-m-d H:i:s') . "\n";


//echo count(scandir("../private/profile_images"));
define('RENAME_FILE',true);


//echo date_default_timezone_get();


// if(isset($_POST["submit"])){

//    $array = [];



//   $file_keys = array_keys($_FILES["userfile"]);

//    $files = $_FILES["userfile"]["name"];

//   if(empty($_FILES["userfile"]["name"])){


//   }
// print_r($_FILES["userfile"]["name"]);
//    $array = [];

//   // foreach($files as $key){
//   //     foreach ($key as $value => $value) {
//   //       # code...
//   //     }

//   // }


// $images = multiple_uploads("userfile");


// echo count($images);

// foreach($images as $key => $value){


// echo $value["name"];

// }

// }


//  function multiple_uploads($file = ""){


//   if(isset($_FILES[$file])){

//  $file = $_FILES[$file];

//   $array = [];
// for($x = 0; $x < 3; $x++){
//  foreach($file as $key => $value){
//    if(!empty(trim($file["name"][$x]))){

//  $array[$x][$key] = $file[$key][$x];
//  }
// }

// }

// return $array;
// }
// }


// makes sure that we are really getting the number of
// required uploads
function multiple_uploads($files = ""){
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



// $array = multiple_uploads("files");

// $count = count($array);
// for($x = 0; $x < $count ; $x++){

// // this is a single file
//     echo  $single_file =  $array[$x]["name"].",";

//   }

// $file = $_FILES["files"];


 $allowed_mime_types_images = ["image/png", 'image/gif', 'image/jpg', 'image/jpeg',"image/bmp","image/svg","image/ai","image/eps","image/ps"];
$allowed_extensions_images = ["png", 'gif', 'jpg', 'jpeg','bmp','svg','ai','eps','ps',"wmv"];

 echo strrchr("thskdfjd;lakfjld;asfdfdslfkja.kdfsj;lkfafdsa/lkfdslafdlsa;/kdflas.kfjdlaf.png",".")." this is what it brought back";

  // if(strrchr("thskdfjd;lakfjld;asfdfdslfkja.kdfsj;lkfafdsa/lkfdslafdlsa;/kdflas.kfjdlaf.png",".")){

  // }
//   echo $file["type"]."<br />";
//|| (!in_array($_FILES["files"]["type"], $array))
// $array = ["image","image","video/x-ms-wmv"];

// if((!in_array($_FILES["files"]["type"], $allowed_mime_types_images)) || !in_array($_FILES["files"]["type"], $array)){

//   echo "not an allowed mime type";
// }else{

//   echo "WHAT an allowed mime type";
// }


// if(1 > 2 || 2 > 1){

// echo "yes";
// }

// $array = array_count_values($array);

// if(isset($array["image"])){
//   echo "it is set";

// }
// echo $array["image"];


if(isset($_POST["submit"])){

if(isset($_FILES["files"]) && $_FILES["files"]["name"] != ""){

  echo "Yes it has names";
}

}
// if(isset($array["image"])){
//   return "post_image";
//  // we are dealing with only videos

// }elseif(isset($array["video"])){
//  return "post_video";
//   // dealing with only images
// }elseif(in_array("image", $array) && in_array("video", $array) ){

//   return "image_video";
//  // then we are dealing with both of them

// }else{
 $row = [];
 if(empty([])){

echo "the empty is set";
 }

//   // maybe sumtin went wrong with the server so
//   // we are telling them to try again.
//   return false;
// }



// Send
// if(mail($to, $subject, $message,$headers)){
//   echo "the email has being being delivered to the appropriate...";

// }else{
//   echo "the email has not being delivered";
// }

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = "true";
$mail->Host = "localhost";
$mail->Port = 26;
$mail->Username = "yussifmunirium@gmail.com";
$mail->Password = "Backdoors7";
$mail->SMTPsecure = "ssl";

$body             = file_get_contents('PHPMailer_5.2.4/examples/contents.html');
//$body             = preg_replace("[\]",'',$body);

$mail->SetFrom ("yussifmunirium@gmail.com");
$mail->AddAddress ("gasify3@gmail.com");

$mail->Subject = "MY new email test";
$mail->Body = "this is just a test";



$mail->MsgHTML($body);

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");
// if($mail->send()){

//   echo "mailer installed correctly";

// }else{

//   echo "<br /> not correctly sent".$mail->ErrorInfo;
// }


?>


 <?php //echo h(PRIVATE_ROOT.'\profile_images\file_5abcac7ad7c2e9.50484134.png');?>


 <!--<img src="fake.php" alt="profile_images" width = "500px" height = "500px"/>-->

<!--  <form action="" method="POST" enctype="multipart/form-data">

	  <!--<input type="radio" name="radio" value="" checked="checked"/>-->
    <!--<input type="file" name="file" accept="video/*" ID="fileSelected" runat="server" size="20" value="upload"/>-->
   <!--  <input type = "file" id="boy" name="files[]" multiple /> <br /> <br />

    <output id="list"></output>
    <input type = "file" name = "userfile[]" />
    <input type = "file" name = "userfile[]" />
    <input type="submit" name="submit" value="Submit"/>

 </form> -->
<?php if (isset($_POST["submit"])){

  if(isset($_POST["radioName"]) && !empty($_POST["radioName"])){

echo "<br />it is not empty and it is set<br />".$_POST["radioName"];

  }else{

    echo "<br />this thing is filled to the brim<br />";
  }
}


$one = 1;
$two = 2;

  $query = "SELECT * FROM test;";
  //$query .= "SELECT * FROM users;";


  $stmt = $db->prepare($query);

  if(!$stmt){

    die($db->error);

  }else{

    echo "Successful prepare";
  }



  if(Reaction::$not_checked == "not_checked"){

echo "";
  }

  if($_SERVER["REQUEST_METHOD"] == "GET"){

    echo "it is a get request";
  }else{
    echo "it is not a get request";
  }
?>
<figure>
  <img src=""/>
</figure>

<a href="#" role="button" id="l1" aria-label ="Delete item 1">link 1</a>
<a href="#" role="button" id="l2" aria-label ="Delete item 1">link 2</a>

<input type ="button" name="radio" value="yes">
<input type ="button" name="radio" value="no">

<form id='myForm' action= "#" method = 'POST'>
  <input type = 'radio' name = "radioName" value = "one" />
  <input type = 'radio' name = "radioName" value = "two" />
  <input type="submit" name="submit">
</form>
<form action="#" method="POST" enctype="multipart/form-data">

<input type="file" id="files" name="files" multiple />
<output id="list"></output>

<input type="submit" name="submit" id ="submit" value="upload"/>

</form>

<p id = "span"></p>

 </body>
  </html>
