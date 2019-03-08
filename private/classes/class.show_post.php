<?php


require_once(PRIVATE_DIR."initialize.php");




class ShowPost extends DatabaseObject{

public static $normal_post_table  = "normal_post_table";
public static $post_table = "post_table";


// shows the top trending news accross the globe uploaded by people

public static function top_trends(){

	global $db;

$query = "SELECT ".self::$post_table.".* ,firstname,lastname,profile_image FROM ".self::$post_table." JOIN ".user::$S_table_name."  ON ".user::$S_table_name.".id = ".self::$post_table.".uploader_id  GROUP BY post HAVING support >= AVG(oppose) OR oppose >=AVG(support) ORDER  BY (support AND oppose ) DESC";



$stmt = self::S_query($query);

if(!$stmt){

	die("Prepare failed: top_trends() || show_post_class.php ".$db->error);
}


if(!$stmt->execute()){


die("Execution failed: top_trends() || show_post_class.php ".$db->error);
}


// store the result
$result = $stmt->get_result();

//free the resources
self::free_resources($stmt,$db);

// return the result
return $result;

}//top_trends()



public static function show_post(){


$query = "SELECT * FROM ".self::$table_name;
	return FetchPost::find_all($query);

	
}


}

















?>