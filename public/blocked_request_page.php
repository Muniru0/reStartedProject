<?php

require_once("../private/initialize.php");



  if(isset($_SESSION) && isset($_SESSION["message"])){
echo $_SESSION["message"];
return;
  }

  echo "Request Blocked!";






?>