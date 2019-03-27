<?php


// require_once("../../private/initialize.php");

echo strlen("<textarea cols='50' rows='50' name='textarea' id='textarea'></textarea>");
die();

if(file_exists("../../private/".UPLOADS_DIR.IMG_THUMBS_DIR."hanifa.jpg")){

echo "file exists";
}else{

echo "file does not exists";

}




?>