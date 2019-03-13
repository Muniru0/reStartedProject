<?php
require_once("../private/initialize.php"); 

echo "<a href=\"CTF.php?id=2&username='Yussif'&wrong_param='some_code'\">Link to test.php</a>";

if(is_get_request() && request_is_same_domain()){
	if(allowed_get_params()){
		
		echo "good request INSHA ALLAH";
		return;
	}
}


?>