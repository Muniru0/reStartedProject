<?php 
require_once("../private/initialize.php"); 
?>
<!DOCTYPE html>
  <html>
      
    <head>
        <title>CTF</title>
       <!-- <script src = "assets/js/jquery.js" ></script> 
		<script src = "assets/js/jquery-ui.min.js" ></script> 
		<link rel="stylesheet" href= "assets/css/bootstrap.css" />
		-->
		<link rel="stylesheet" href="assets/fonts/fontawesome5/css/all.css" />

</head>
 <body>
 <?php
   Pagination::get_infinite_scroll("mainstream");
 ?>
 <i class="fal fa-check-circle"></i>
 </body>
  </html>
