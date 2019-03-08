<?php

print_r($_FILES);
if(isset($_FILES) && !empty($_FILES))
{
   foreach($_FILES as $files => $file){
        echo $file["filename"];
   }
}




