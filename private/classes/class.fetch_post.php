<?php
require_once("../private/initialize.php");


class FetchPost extends DatabaseObject{

    //  table and column columns names
    public static $table_name = "normal_post_table";

    public static $id         = "id";
	public static $post_id    = "post_id";
	public static $filename  = "filename";
	
	
	// aliases of table columns
    public static $alias_of_id         = "normal_post_table_id";
	public static $alias_of_post_id    = "normal_post_table_post_id";
	public static $alias_of_filename  = "normal_post_table_filename";
	 
	
	public static $images_dir_string = "../private/".UPLOADS_DIR.IMGS_THUMBS_DIR;
	
	
	
	
	public static $posts = "";
    public static $JOYFUL      = "joyful";
    public static $MEH         =  "meh";
    public static $LOVE        =  "love";
    public static $FLATTERED   = "flatterd";
    public static $CRAZY       = "crazy";
    public static $COOL        = "cool";
    public static $TIRED       = "tired";
    public static $CONFUSED    = "confused";
    public static $SPEECCHLESS = "speechless";
    public static $CONFIDENT   =  "confident";
    public static $RELAXED     =  "relaxed";
    public static $STRONG      = "strong";
    public static $HAPPY       = "happy";
    public static $ANGRY       = "angry";
    public static $SAD         = "sad";
    public static $SICK        = "sick";
    public static $BLESSED     = "blessed";


// helper method to get the appropriate mood
//
    public static function get_mood_template($mood){
        $mood = trim($mood);
        if(!isset($mood) || empty($mood)){
            return;
        }

        switch ($mood){

            case trim(self::$JOYFUL):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-1\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$MEH):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-2\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$LOVE):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-3\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$FLATTERED):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-4\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$CRAZY):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-5\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$COOL):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-6\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$TIRED):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-7\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$CONFUSED):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-8\"></i><span>&nbsp;&nbsp;&nbsp;feeling {$mood}&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                break;
            case trim(self::$SPEECCHLESS):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-9\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$CONFIDENT):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-10\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$RELAXED):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-11\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$STRONG):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-12\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$HAPPY):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-13\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$ANGRY):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-15\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$SAD):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-16\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$SICK):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-17\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            case trim(self::$BLESSED):
                return "&nbsp;&nbsp;<i class=\"ps-emoticon ps-emoticon ps-emo-18\"></i><span>&nbsp;feeling {$mood}&nbsp;&nbsp;</span>";
                break;
            default : return false;
        }



    }
 


 
    public static function get_fullname($id = 0,$firstname,$lastname){
         
		 $linked_user_class = "";
		 $toggle_string     = "display:none;";
		 $link_title_string = "";
		 $user_parent_breathing_space = "";
		if(isset($_SESSION) && isset($_SESSION[LinkUsers::$session_string]) && !empty($_SESSION[LinkUsers::$session_string]) && in_array($id,$_SESSION[LinkUsers::$session_string])){
			
		 $linked_user_class = "link_user";
		 $toggle_string     = "display:inline;";
		 $user_parent_breathing_space = "breathing_space";
		 $link_title_string = "You are linked to this User.You will be notified of all of his posted incidents.";
		 
		}
		  
		   
        return "<div class=\"ps-stream-header\"><div class=\"ps-stream-meta\"><div class=\"reset-gap {$user_parent_breathing_space}\" ><a class=\"ps-stream-user  {$linked_user_class}\" href=\"../public/".PROFILE_PAGE."?id=".$id."\">". $firstname." ".$lastname."<small style='{$toggle_string}'><i class ='fal fa-link'></i></small></a>";
		
    }//get_fullname();

    public static function get_post_title($count,$label){

        $photos_string = (int)$count === 1 ? "a photo" : "{$count} photos";
		
        return "<span class=\"ps-stream-action-title\"> uploaded {$photos_string} about a  <a href=\"https://demo.peepso.com/profile/demo/photos/album/37\" title='This incident is about {$label}. (See more {$label} based incidents)'>".h($label)."  issue</a></span>";
    }
	
	

    public static function get_location_template($longitude = 0,$latitude = 0){
          $locations = ["Wa","Tamale","Kumasi","Accra","Koforidua","Cape Coast","Tema","Bolgatanga","Winneba","Saudi Arabia"];
		   $location = $locations[array_rand($locations)];
        return trim("<span class=\"ps-js-activity-extras\">         <span>
                <a href=\"#\" title=\" follow and find the locatioin ".$location."\" onclick=\"pslocation.show_map(13.6915377, 104.10013260000005, 'Siem Reap Province'); return false;\">

                    <span class=\"at-location ps-js-autotime\">
					</span> <i class=\"ps-icon-map-marker\"></i>".$location."</a>

            </span>
            </span></div>");
    }

    public static function get_time_template($post_id = 0,$time = 0){

	    $toggle_follow_icon = "";
	   if(in_array($post_id,$_SESSION[FollowPost::$session_string])){
		   $toggle_follow_icon = "<i class='far fa-eye following_span' style='margin-left: 0.2em !important;' title='you are following this post'></i>  ";
	   }
	   
        return "<small class=\"ps-stream-time\" data-timestamp=\"1528749581\">
                <a href=\"https://demo.peepso.com/activity/?status/2-2-1528720781/\">
                    <span class=\"ps-js-autotime\" data-timestamp=\"1528749581\" title=\"June 11, 2018 8:39 pm\">".self::time_converter($time)."</span>             </a>
					{$toggle_follow_icon}</small></div>";
    }

	// get the post options template
	public static function get_post_options($user_id = 0,$post_id = 0,$firstname = "",$lastname = "",$links_array = [],$following_array = [],$confirmation_eligibility = 0 ,$confirmation = 0,$confirmer = 0){
		
		 if($_SESSION["id"] < 1){
			 
			print j(["false" => "Routine Security checks, please refresh the page and try again."]);
			 return;
		 }
		 
		 // initialize the necessary variables
		 // link user variables
		 $link_user_string = "link_user";
		 $toggle_link_icon   = "fal fa-link";
		 $toggle_link_class  = "";
		 $toggle_link_string  = "link with ";
		 $toggle_link_title  = "linking with a user will get you notified of all future incidents posted by that user.";
		 
		 // follow post variables
		 $follow_post_string = "follow_post";
		 $toggle_follow_post_icon = "far fa-eye";
		 $toggle_follow_post_html_string = "follow this post";
		 $toggle_follow_post_class = "";
		  $toggle_follow_title  = "if you follow this incident you will be notified about every development of it.";
		 
		 
		 // adjust the link user variables if the two 
		 //users are linked
		  if(in_array($user_id,$_SESSION[LinkUsers::$session_string])){
			 $toggle_link_icon = "fal fa-unlink";
			 $toggle_link_class = "reverse_post_action";
			 $toggle_link_string = "unlink with ";
			 $toggle_link_title  = "You are linked to {$firstname} {$lastname}";
		  }
		 
		
		 // adjust the link user variables if the two 
		 //users are linked
		 if(in_array($post_id,$_SESSION[FollowPost::$session_string])){
			 
			 $toggle_follow_post_icon = "far fa-eye-slash";
			 $toggle_follow_post_html_string = "unfollow this post";
			 $toggle_follow_post_class = "reverse_post_action";
			  $toggle_follow_title  = "You are following this incident";
			 
		 }
		 
		 // edit post html link 
		$edit_post_string =  $_SESSION["id"] != $user_id ? "" : "<a href='javascript:' onclick='post_option_edit({$_SESSION["id"]}, {$post_id},this); return false' ><i class='ps-icon-edit'></i><span>Edit Post</span>
</a>";
        // delete post html link 
		$delete_post_string = $_SESSION["id"] != $user_id ? "" : "<a href='javascript:' onclick='post_option_delete({$_SESSION["id"]}, {$post_id},this);' ><i class='ps-icon-trash'></i><span>Delete Post</span>
</a> ";
		
		 // follow post html link 
		$follow_post_string =  $_SESSION[user::$id] == $user_id ? "" : "<a href='javascript:' title='{$toggle_link_title}' class='{$toggle_follow_post_class}' onclick='post_options(0,{$post_id},this,\"".$follow_post_string."\");' >
		<i class='{$toggle_follow_post_icon}'></i><span>{$toggle_follow_post_html_string}</span>
</a>";
      
		 // link user html link 
	    $link_user_string =  $_SESSION[user::$id] == $user_id ? "" :"<a href='javascript:' title='{$toggle_link_title}' class='{$toggle_link_class}' onclick='post_options({$user_id},{$post_id},this,\"".$link_user_string."\");return false' ><i class='{$toggle_link_icon}'></i><span>{$toggle_link_string}  {$firstname} {$lastname}</span>
</a>
";

  // declare and initialize the confirmation option string
  $confirmation_option_string = "";
 if((int)$_SESSION[user::$user_category] === 2 || (int)$_SESSION[user::$user_category] === 3){
	
    // post option with the link to confirm or reverse the confirmation 	
	if($confirmation == 0){
		
		  $confirmation_option_string = "<a href='javascript:' onclick='post_options(0,{$post_id},this)' data-post-id='930' title='You can confirm that this incident really took place' class='confirm_post'><i class='fal fa-check-circle' style='color:inherit;'></i><span  style='color:inherit; margin-left:0.4em'>Confirm  this post</span>
</a>";

	}elseif(isset($confirmer) && $confirmer == $_SESSION["id"] && $confirmation == 1){
	    $confirmation_option_string = "<a href='javascript:' onclick='post_options(0,{$post_id},this,'reverse_confirmation')' data-post-id='930' title='You can reverse the the confirmation of this post' class='reverse_confirmation'><i class='fal fa-undo-alt' style='color:inherit !important'></i><span style='color:inherit; margin-left:0.4em'>Reverse Confirmation</span>
</a>";
   }

}	
		
		return "<div class='ps-stream-options' onclick=' post_options_dropdown(this);'>
			<div class='ps-dropdown ps-dropdown--stream ps-js-dropdown'>
			<a href='javascript:' class='ps-dropdown__toggle ps-js-dropdown-toggle' data-value=''>
<span class='dropdown-caret ps-icon-caret-down'></span>
</a>
<div class='ps-dropdown__menu ps-js-dropdown-menu' style='display: none;'>
{$edit_post_string}
{$delete_post_string} 
{$follow_post_string} 
{$link_user_string}
{$confirmation_option_string}

</div>
</div>
		</div></div>
";
		
		
	}
	
	
	
	
	public static function get_caption_template($caption = ""){
		
		if(!isset($caption) || trim($caption) == "" || empty($caption)){
			return "";
		}
		
		$caption = str_replace("\n","",$caption);
		return "<div class='ps-stream-attachment cstream-attachment ps-js-activity-content ps-js-activity-content--498'><div class='peepso-markdown' ><p>{$caption}</p></div></div>";
	}// get_caption_template();
	
     public static function get_post_edit_template($caption = "",$title = "", $location = "",$post_id = 0){
		    
		$caption_count = 4000 - count($caption);	  
			  
			return "<div class='ps-js-activity-edit ps-js-activity-edit--482' style=''><div class='ps-postbox ps-postbox--edit ps-sclearfix'>
	<div class='ps-postbox-content'>
		<div class='ps-postbox-status'>
			<div style='position:relative'>
				<div class='ps-postbox-input ps-inputbox'>
<div class='ps-tagging-wrapper'><div class='ps-tagging-beautifier'></div><textarea class='ps-textarea ps-postbox-textarea ps-tagging-textarea' placeholder='Say what is on your mind...' spellcheck='false' style='height: 92px; z-index: auto; position: relative; line-height: 18.2px; font-size: 13px; transition: none 0s ease 0s; background: transparent !important;' ></textarea><input type='hidden' class='ps-tagging-hidden' value='' /><div class='ps-tagging-dropdown' style='display: none;'></div></div>
									</div>
				<div class='ps-postbox-addons'>— <i class='ps-icon-map-marker'></i><b>{$location}</b></div>
			</div>
	 <div class='post-charcount charcount ps-postbox-charcount'>{$caption_count}</div>
		</div>
	</div>
	<div class='ps-postbox-tab ps-postbox-tab-root ps-sclearfix' style='display:none'>
		<div class='ps-postbox__menu ps-postbox__menu--tabs'>
					</div>
	</div>
	<nav class='ps-postbox__tabs ps-postbox-tab selected'>
		<div class='ps-postbox__menu ps-postbox__menu--interactions'>
			<div id='location-tab' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper'><a class='pstd-secondary ps-tooltip ps-tooltip--postbox' data-tooltip='Location' onclick='return;'>
<i class='ps-icon-map-marker'></i>
</a>
</div><div id='pslocation' class='hidden ps-postbox-dropdown ps-js-postbox-location'><div class='ps-location-wrapper ps-js-location-wrapper' style='display:block'>
	<div class='ps-location ps-js-location ps-clearfix' style='position:relative;border:0 none'>
		<input type='text' class='ps-input ps-input-full' placeholder='Enter location name...'>
		<div class='ps-location-loading ps-js-location-loading'>
			<img src='https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif' alt=''>
		</div>
		<div class='ps-location-result ps-js-location-result'>
			<div class='ps-location-map ps-js-location-map' style='display:none'></div>
			<div class='ps-location-list ps-js-location-list'></div>
			<a href='#' class='ps-btn ps-btn-small ps-btn-primary ps-js-select' style='top:42px'>Select</a>
			<a href='#' class='ps-btn ps-btn-small ps-btn-danger ps-js-remove' style='top:42px'>Remove</a>
		</div>
	</div>
	<script type='text/template' class='ps-js-location-fragment'>
		<a href='#' class='ps-location-listitem {{= data.place_id ? 'ps-js-location-listitem' : '' }}' data-place-id='{{= data.place_id }}' style='line-height:12px;padding-top:6px;padding-bottom:6px'>
			<strong class='ps-js-location-listitem-name'>{{= data.name }}</strong><br />
			<small>{{= data.description || '&nbsp;' }}</small>
		</a>
	</script>
</div>
</div>
<div style='display: none;'>
	<div id='pslocation-search-loading'>
		<img src='https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif' alt=''>
	</div>
	<div id='pslocation-in-text'></div>
</div>
</div>		</div>
		<div class='ps-postbox__action ps-postbox-action' style='display: flex;'>
			<button type='button' onclick='cancelEditPost();' class='ps-btn ps-btn--postbox ps-button-cancel'>Cancel</button>
			<button type='button' onclick ='submitEditedPost(post_id)' class='ps-btn ps-btn--postbox ps-button-action postbox-submit' style='display: inline-block;'>Post</button>
		</div>
		<div class='ps-postbox-loading' style='display: none;'>
			<img src='https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif'>
			<div></div>
		</div>
	</nav>
</div>
</div>";
		 
		 
	 }// get_post_edit_template();
	 
	 
	 
	 
	 
    // get the recently uploaded post
 public static function get_uploaded_post($post_id = 0){
        global $db;
		
	
	  
if( !isset($post_id) || is_array($post_id) 
	|| !is_int($post_id) || $post_id < 1){
	
		   log_action(__CLASS__,"Query couldn't bring back post after uploading on line: ".__LINE__." in file: ".__FILE__);
		   
		   return [];
	   }
	  
	   
     $query = "SELECT ".user::$table_name.".".user::$firstname.",".user::$table_name.".".user::$lastname.",".user::$user_category.",".PostImage::$table_name.".*,".self::$table_name.".*,".PostImage::$table_name.".id AS post_table_id,".self::$table_name.".id AS file_id FROM ".PostImage::$table_name."
				JOIN ".user::$table_name." ON 
				".PostImage::$table_name.".uploader_id = ".user::$table_name.".id JOIN ".self::$table_name." ON ".self::$table_name.".post_id = ".PostImage::$table_name.".id WHERE 
				".PostImage::$table_name.".id = $post_id  LIMIT 10";

 // query the database	
  $result = $db->query($query);
	
	// check to see if there are any errors 
 if(!$result || $db->error != ""){
	    print j(["false" => "Something Unexpectedly went wrong please try again"]);
	 log_action(__CLASS__,"Query failed: {$db->error} on line: ".__LINE__." in file: ".__FILE__);
	
	 return [];
 }	
  
  $returned_array = [];

  // check for the number of rows returned
  if($result->num_rows > 0){
	 while($row = $result->fetch_assoc()){
		 
		 
		// if the information about the post is present  	  
if(isset($returned_array) && array_key_exists($row["post_id"],$returned_array)){
	 
	if(isset($returned_array[$row["post_id"]]) &&
	array_key_exists("filenames_".$row["post_id"],
	$returned_array[$row["post_id"]])){
	 
				
 $returned_array[$row["post_id"]]["filenames_".$row["post_id"]][$row["file_id"]] = $row["filename"];
	
	}
	
	// else add the to the post array 	
}else{
	
		// with the post_table_id as the key
		$returned_array[$row["post_id"]][] = $row;
		$returned_array[$row["post_id"]]["filenames_".$row["post_id"]][$row["file_id"]] = $row["filename"];
				
	   }
	
	
  }
 
   
 $comments = [];

  if(empty($returned_array)){
		print j(["false" =>"Sorry please try again($post_id)"]);
		return [];
	}else{
	// was the post giving out to the user	
	  return self::get_full_post($returned_array,$comments,[],[],[],[],RECENT);
	
	}
  
	 }else{
	  print j(["false" => "Sorry, Please try again"]);
	  return [];
	 }  
  
	}// get_uploaded_post();
    
	

	
	//get the layout template for two images 
public static function images_layout_template($post_id = 0,$images =[],$count = 0,$number_of_supports = 0,$number_of_opposes = 0,$reactions_user_ids = [],$caption = null){
 
	
	  // veirfy the entire the images array
		if(!is_array($images) || !isset($images) || empty($images)){
			return false;
		}
		
		// verify the number of images
		if($count < 1)
		{
			return  false;
		}
		
		// verify the post id
		if($post_id < 1){
		return false;	
		}
		
      $edit_post_template = $_SESSION[userr::$id]self::get_edit_post_template($caption,$title,$location,$post_id);
		  
		  // check the number of reactions and show or hide the 
		  // the reactions div accordingly
		  $toggle_reactions_count = "";
		  if($number_of_supports < 1 && $number_of_opposes < 1){
			  $toggle_reactions_count = "style='display:none;'";
		  }
		  
		$number_of_supports_string = ""; 
	    $number_of_opposes_string = "";
		$support_selected = "";
        $oppose_selected = "";
		$support_deselected = "";
        $oppose_deselected = "";
		
		$support_span_selected = "";
        $oppose_span_selected = "";
		$support_span_deselected = "";
        $oppose_span_deselected = "";
		
		$support_check     = "";
		$oppose_check      = "";
		
        $oppose_label_selected = "";		
		 
		     
		  if(($number_of_supports > 0 || $number_of_opposes > 0) && !empty($reactions_user_ids)){ 
		 
		   if(isset($_SESSION) && isset($_SESSION[user::$id]) && (int)$_SESSION[user::$id] > 0){
  
			   if(array_key_exists($_SESSION[user::$id],$reactions_user_ids)){
				   if((int)$reactions_user_ids[$_SESSION[user::$id]] === 2){
					   $support_selected  = "selected_reactions_count";
					   $oppose_deselected = "deselected_reactions_count";
					   $support_span_selected = "selected_support_span";
					   $oppose_span_deselected = "deselected_oppose_span";
					   $support_check     = "checked='checked'";
					 
					   
		
					   
				   }elseif((int)$reactions_user_ids[$_SESSION[user::$id]] === 1){
					   $support_deselected  = "deselected_reactions_count";
					   $oppose_selected     = "selected_reactions_count";
					   $support_span_deselected = "deselected_support_span";
					   $oppose_span_selected = "selected_oppose_span";
					   $oppose_check        = "checked='checked'";
					   $oppose_label_selected = "oppose_label_selected";
				   }
				   
				   
			   }
		   }
		  }
		
		
		
		$number_of_supports_string = 
		 "<a class='{$support_selected} {$support_deselected}' title='Number of supports'  href='' onclick='return'  style='margin-left: 3.3em; cursor:initial;'>
		{$number_of_supports} supported</a>";
		
		$number_of_opposes_string ="<a class='{$oppose_selected} {$oppose_deselected}' title='Number of opposes' href=''  onclick='return' style='margin-left: 2em; cursor:initial;'>
		{$number_of_opposes} opposed</a>" ;
		
 $images_string = "<div class='ps-stream-body'>
		".self::get_caption_template($caption).."
		<div class='ps-stream-attachments cstream-attachments'>
		<div class='cstream-attachment photo-attachment'>
		<div class='ps-media-photos ps-media-grid  ps-clearfix' data-ps-grid='photos' style='position: relative; width: 100%; max-width: 600px; min-width: 200px; max-height: 1200px; overflow: hidden;'>
		
		";		
		
		
	if(isset($images)  && $count === 1){  
	$width;
	$height;

	$image = array_shift($images);
	 if(file_exists(self::$images_dir_string.$image)){
		 
		 $width  = getimagesize(self::$images_dir_string.$image)[0];
	 }else{
		 
		 return false;
		 
	 }
	  
      if(file_exists(self::$images_dir_string.$image)){
		 $height = getimagesize(self::$images_dir_string.$image)[1];
	  }else{
		  return false;
	  }  
	
if($width >= 1000){  
	// if the width is greater than the height 
   // give the width more priority	
	if($width >= $height){
		  $width = rand(97,100);
		  
          $height = rand(85,89);	
			
	}elseif($width < $height){
    log_action(__CLASS__,"method2 ".__LINE__);
	
	$width = rand(97,100);
	$height = rand(85,89);
			  }
}elseif($width < 1000 && $height > 300){
	 
	   
		 if($width >= $height){
		  $width = rand(80,90);
		  
          $height = rand(79,85);	
			
	}elseif($width < $height){
    
	
	 $width = rand(80,90);
	 $height = rand(79,85);	
			  }
			  
}elseif($width < 1000 && $height <= 300){
	
	  if(($width / 2) == $height){
		   $width = 98;
		   $height = 41;
		   
	   }elseif(($height / 2) ==  $width){
		    $width = 50;
		   $height = rand(85,100);
		   
	   }elseif($width >= $height){
		  $width = 85;
		  
          $height = 41;	
			
	}elseif($width < $height){
   
	
	 $width  = 65;
	 $height = 83;	
}
}else{
	 
	 $width = rand(33.6,44.4);
	 $height = rand(33.6,44.4);
}
	
		
		return $images_string .= "
		
		<a href=' ://demo.peepso.com/activity/?status/2-2-1528720781/' class='ps-media-photo ps-media-grid-item' data-ps-grid-item='' onclick='return ps_comments.open(200, \'photo\');' style='float: left;width: ".$width."%;padding-top: ".$height."%;'>
	<div class='ps-media-grid-padding'>
		<div class='ps-media-grid-fitwidth'>
			<img src=".self::$images_dir_string."{$image}  class='ps-js-fitted' style='width: auto; height: 100%;'>
								</div>
	</div>
</a>

  </div>
  </div>
  </div>
	</div>	
		<div class='ps-stream-actions stream-actions' data-type='stream-action' style='padding-left: 0px;padding-right: 0px; padding-bottom: 0px;'>
    <nav class='ps-stream-status-action ps-stream-status-action' >
<!--<a data-stream-id='482' onclick='return reactions.action_reactions(this, 482);' href='javascript:' class='ps-reaction-toggle--482 ps-reaction-emoticon-0 ps-js-reaction-toggle ps-icon-reaction'><span>Like</span></a>-->
<!--</nav>-->
      
      

	<div class='reactions'>

    <input type='radio' name='reaction_{$post_id}' id='support_{$post_id}' oninput='reaction.addReaction({$post_id},2,this)' {$support_check}/>
	<label for='support_{$post_id}'  title='Support the above post' ></label>
    <span class='support_span {$support_span_deselected} {$support_span_selected}'>Support</span>
	
	<span class='oppose_span {$oppose_span_deselected} {$oppose_span_selected}'>Oppose</span>
	<input type='radio' name='reaction_{$post_id}' id='oppose_{$post_id}'  oninput='reaction.addReaction({$post_id},1,this)' {$oppose_check}/>
	<label for='oppose_{$post_id}' class='{$oppose_label_selected} ' title='Oppose the above post' style='margin-left: 11em;'></label>
 </div>
   
   <div id='reactions_count_{$post_id}' class='ps-reaction-likes  ps-stream-status cstream-reactions' $toggle_reactions_count style='padding-left:0px;padding-right: 0px;'>
							
".$number_of_supports_string.$number_of_opposes_string." 
</div>
 


</nav></div>";

	}
		
		
	 $dimen = [];

	
    $previous_width  = 0;
    $previous_height = 0;	
	
	
	 
		
	
if(krsort($images)){
	
	$width = 50;
	$height = 50;
	
	if($count % 2 === 0 && $count < 5){
		
	
	
	foreach($images As $image_id => $image){
      if(!file_exists(self::$images_dir_string.$image)){
		 continue; 
	  }
	$images_string .="
		
		<a href=' ://demo.peepso.com/activity/?status/2-2-1528720781/' class='ps-media-photo ps-media-grid-item' data-ps-grid-item='' onclick='return ps_comments.open(200, \'photo\');' style='float: left;width: ".$width."%;padding-top: ".$height."%;'>
	<div class='ps-media-grid-padding'>
		<div class='ps-media-grid-fitwidth'>
			<img src=".self::$images_dir_string."{$image}  class='ps-js-fitted' style='width: auto; height: 100%;'>
								</div>
	</div>
</a>

";
	
}
// if the images are of an odd number
}
elseif($count % 2 === 1 || $count >= 5){
 
	$height  = 50;
	$width  = 50;
	$margin = "0px";
	$display_inline = false;
	
	foreach($images  AS $image_id => $image){
		if(!file_exists(self::$images_dir_string.$image)){
		 continue; 
	  }
		$dimen["width"][] = getimagesize(self::$images_dir_string.$image)[0];
		$dimen["height"][] = getimagesize(self::$images_dir_string.$image)[1];
		
	}
	if(isset($dimen["width"]) && !empty($dimen["width"]) && count($dimen["width"]) > 0){
	if(sort($dimen["width"])){
	$last_key = array_key_last($dimen["width"]);
    $first_key = array_key_first($dimen["width"]);
		 
		if($dimen["width"][$last_key - $first_key] < 200 && $count == 3){
			$height = 50;
			$width  = 33.3;
			$display_inline = true;
		}
	}
} 
	
	// get the index of the last image
	$last_key = array_key_last($images);
	 $images_processed = 1;
	 $overlay = "";
	foreach($images As $image_id => $image){
	  
		
if(!file_exists(self::$images_dir_string.$image)){
		 continue; 
	  }		
	     
	  if(($image_id === $last_key && $count == 3) || ($images_processed === 5)){
	  
	
	  if($count > 5){
		 
		  $overlay = "<div class='ps-media-photo-counter' style='top:0; left:0; right:0; bottom:0;'>
				<span>+". ($count - 5) ."</span>
			</div>";
	  
	  }
		  if(($height - $width) > 200){
			  $height = 100;
			  $width  = 100;
		  }elseif(($height - $width) < 200){
			  $height = 50;
			  $width = 60;
			  $margin = 40 / 2 . "%"; 
		  }
		 
		
		 $images_string .="
		
		<a href=' ://demo.peepso.com/activity/?status/2-2-1528720781/' class='ps-media-photo ps-media-grid-item' data-ps-grid-item='' onclick='return ps_comments.open(200, \'photo\');' style='float: left;width: ".$width."%;padding-top: ".$height."%; margin-left: ".$margin."'>
	<div class='ps-media-grid-padding'>
<div class='ps-media-grid-fitwidth'>
<img src=".self::$images_dir_string."{$image}  class='ps-js-fitted' style='width: auto; height: 100%;'>
				{$overlay}
								</div>
	</div>
</a>

";
 break;
	 }
	 
	
	//}
	
	
	$images_string .="
		
		<a href=' ://demo.peepso.com/activity/?status/2-2-1528720781/' class='ps-media-photo ps-media-grid-item' data-ps-grid-item='' onclick='return ps_comments.open(200, \'photo\');' style='float: left;width: ".$width."%;padding-top: ".$height."%;'>
	<div class='ps-media-grid-padding'>
		<div class='ps-media-grid-fitwidth'>
			<img src=".self::$images_dir_string."{$image}  class='ps-js-fitted' style='width: auto; height: 100%;'>
								</div>
	</div>
</a>

";
	 $images_processed ++;
		}
			}
				}


	
$images_string .= "</div></div></div></div>
<div class='ps-stream-actions stream-actions' data-type='stream-action'>
    <nav class='ps-stream-status-action ps-stream-status-action'>
<!--<a data-stream-id='482' onclick='return reactions.action_reactions(this, 482);' href='javascript:' class='ps-reaction-toggle--482 ps-reaction-emoticon-0 ps-js-reaction-toggle ps-icon-reaction'><span>Like</span></a>-->
<!--</nav>-->
      
       
	<div class='reactions'>

    <input type='radio' name='reaction_{$post_id}' id='support_{$post_id}' oninput='reaction.addReaction({$post_id},2,this)' {$support_check}/>
	<label for='support_{$post_id}'  title='Support the above post' ></label>
    <span class='support_span  {$support_span_deselected} {$support_span_selected}'>Support</span>
	
	<span class='oppose_span  {$oppose_span_deselected} {$oppose_span_selected}'>Oppose</span>
	<input type='radio' name='reaction_{$post_id}' id='oppose_{$post_id}'  oninput='reaction.addReaction({$post_id},1,this)' {$oppose_check}/>
	<label for='oppose_{$post_id}' class='{$oppose_label_selected}'  title='Oppose the above post' style='margin-left: 11em; '></label>
 </div>
   
   <div id='reactions_count_{$post_id}' class='ps-reaction-likes  ps-stream-status cstream-reactions' {$toggle_reactions_count} style='padding-left:0px;padding-right: 0px;'>
							
".$number_of_supports_string.$number_of_opposes_string." 
</div>
 

</nav></div>";
	unset($dimen);
 return $images_string;
		
	}// images_layout_template();




	// get all comments from the database for a specific post 
	public static function get_comments_with_template($post_ids = []){
		if(!isset($post_id) || !is_array($post_id <= 0 ) || in_array(0,$post_ids,true))
		{
			return "";
			
		}
		
		return "<div class=\"ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--482\" data-act-id=\"482\">
			<div id=\"comment-item-931\" class=\"ps-comment-item cstream-comment stream-comment\" data-comment-id=\"931\">
	<div class=\"ps-comment-body cstream-content\">
		<div class=\"ps-comment-message stream-comment-content\">
			<a class=\"ps-comment-user cstream-author\" href=\" ://demo.peepso.com/profile/william/\">William Torres</a>
			<span class=\"ps-comment__content\" data-type=\"stream-comment-content\"><div class=\"peepso-markdown\"><p>Fantastic! What a beautiful day to celebrate what i did yesterday</p></div></span>
		</div>

		<div data-type=\"stream-more\" class=\"cstream-more\" data-commentmore=\"true\"></div>

		

		<div class=\"ps-comment-time ps-shar-meta-date\">
			<small class=\"activity-post-age\" data-timestamp=\"1529076577\"><span class=\"ps-js-autotime\" data-timestamp=\"1529076577\" title=\"June 15, 2018 3:29 pm\">".self::time_converter($comment_time)."</span></small>

						<div id=\"act-like-493\" class=\"ps-comment-links cstream-likes ps-js-act-like--493\" data-count=\"2\">
				<a onclick=\"return activity.show_likes(493);\" href=\"#showLikes\">2 people like this.</a>			</div>

			<div class=\"ps-comment-links stream-actions\" data-type=\"stream-action\">
				<span class=\"ps-stream-status-action ps-stream-status-action\">
					<nav class=\"ps-stream-status-action ps-stream-status-action\">
<a data-stream-id=\"931\" onclick=\"activity.comment_action_like(this, 493); return false;\" href=\"#like\" class=\"actaction-like liked ps-icon-thumbs-up\"><span><span title=\"2 people like this\">Like</span></span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_report(493); return false;\" href=\"#report\" class=\"actaction-report ps-icon-warning-sign\"><span>Report</span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_reply(493, 931, this, { id: 6, name: 'William Torres' }); return false;\" href=\"#reply\" class=\"actaction-reply ps-icon-plus\"><span>Reply</span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_edit(931, this); return false;\" href=\"#edit\" class=\"actaction-edit ps-icon-pencil\"><span>Edit</span></a>
<a data-stream-id=\"931\" onclick=\"activity.comment_action_delete(931); return false;\" href=\"#delete\" class=\"actaction-delete ps-icon-trash\"><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>


		</div>";
		
		
	}//get_comments();
	

	// get reaction and comment box
	public static function get_reaction_and_commentbox($support = 0,$oppose = 0 ,$post_id = 0){
		if((!isset($support) || !isset($oppose)) && (!isset($post_id) && $post_id < 0 ))
		{
			return "";
		}
		
		return "<div class='ps-stream-actions stream-actions' data-type='stream-action'><nav class='ps-stream-status-action ps-stream-status-action'>
<a data-stream-id='498' onclick='return reactions.action_reactions(this, 498);' href='javascript:' class='ps-reaction-toggle--498 ps-reaction-emoticon-0 ps-js-reaction-toggle ps-icon-reaction'><span>Like</span></a>
<a data-stream-id='498' onclick='return activity.action_report(498);' href='#report' class='actaction-report ps-icon-warning-sign'><span>Report</span></a>
</nav>
</div>
  <div class=\"ps-comment cstream-respond wall-cocs\" id=\"wall-cmt-498\" style='background:##e1dcd9; padding-left: 3px;'>
		<div class=\"ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--498\" data-act-id=\"498\" style='background:#f7f7f7'>
					</div>

						<div id=\"act-new-comment-498\" class=\"ps-comment-reply cstream-form stream-form wallform ps-js-comment-new ps-js-newcomment-498\" data-id=\"498\" data-type=\"stream-newcomment\" data-formblock=\"true\">
			<a class=\"ps-avatar cstream-avatar cstream-author\" href=\" ://demo.peepso.com/profile/demo/\">
				<img data-author=\"4\" src=\" ://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg\" alt=\"\">
			</a>
			<div class=\"ps-textarea-wrapper cstream-form-input\">
				<div class=\"ps-tagging-wrapper\"><div class=\"ps-tagging-beautifier\"></div><textarea data-act-id=\"498\" class=\"ps-textarea cstream-form-text ps-tagging-textarea\" name=\"comment\" oninput=\"return activity.on_commentbox_change(this);\" placeholder=\"Write a comment...\" style=\"height: 35px;\"></textarea><input type=\"hidden\" class=\"ps-tagging-hidden\"><div class=\"ps-tagging-dropdown\"></div></div>
				<div class=\"ps-commentbox__addons ps-js-addons\">
<div class=\"ps-commentbox__addon ps-js-addon-giphy\" style=\"display:none\">
	<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>
	<img class=\"ps-js-img\" alt=\"photo\" src=\"\">
	<div class=\"ps-commentbox__addon-remove ps-js-remove\">
		<i class=\"ps-icon-remove\"></i>
	</div>
</div>
<div class=\"ps-commentbox__addon ps-js-addon-photo\" style=\"display:none\">
	<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>

	<img class=\"ps-js-img\" alt=\"photo\" src=\"\" data-id=\"\">

	<div class=\"ps-loading ps-js-loading\">
		<img src=\"assets/images/ajax-loader.gif\" alt=\"loading\">
	</div>

	<div class=\"ps-commentbox__addon-remove ps-js-remove\">
		<input type=\"hidden\" id=\"_wpnonce_remove_temp_comment_photos\" name=\"_wpnonce_remove_temp_comment_photos\" value=\"3ca8a9ab47\"><input type=\"hidden\" name=\"_wp_http_referer\" value=\"/peepsoajax/activity.show_posts_per_page\">		<i class=\"ps-icon-remove\"></i>
	</div>
</div>
</div>

			</div>
			<div class=\"ps-comment-send cstream-form-submit\" style=\"display:none;\">
				<div class=\"ps-comment-loading\" style=\"display:block;\">
					<img src=\"assets/images/ajax-loader.gif\" alt=\"\">
					<div> </div>
				</div>
				<div class=\"ps-comment-actions\" style=\"display:block;\">
					<button onclick=\"return activity.comment_cancel(498);\" class=\"ps-btn ps-button-cancel\">Clear</button>
					<button onclick=\"return activity.comment_save(498, this);\" class=\"ps-btn ps-btn-primary ps-button-action\" disabled=\"\">Post</button>
				</div>
			</div>
		</div>
			</div>

";
	}
	
	
    
	// fetch filenames based on the post_ids
	public static function fetch_images($post_ids = []){
		global $db;
		
		$query = "SELECT * FROM ".self::$table_name." WHERE post_id = ? ";
		
		$stmt = $db->prepare($query);
		
		if(!$stmt)
		{
			log_action(__CLASS__,"Statement preparation failed on line ".__LINE__." in ".__FILE__);
			
		}
		
	   if(!$stmt->bind_param("i",$post_ids[0])){
		   log_action(__CLASS__,"Statement binding failed on line ".__LINE__." in ".__FILE__);
	   }	
	   
	   if(!$stmt->execute()){
		   log_action(__CLASS__,"Statement execution failed on line ".__LINE__." in ".__FILE__);
	   }
	   
	   if(is_array($post_ids)){
		   foreach($post_ids as $post_id)
		   {
			   if(!$stmt->execute())
			   {
				   log_action(__CLASS__,"Statement execution of post_id {$post_id} failed on line ".__LINE__." in ".__FILE__);
			   }
		   }
		   
	   }
	   
	   $result = $stmt->get_result();
	     $results_array = [];
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
      $results_array[] = $row ;
    }
	return $results_array;
	}// fetch_images();
	
	
	

    public static function get_post_confirmation($confirmation = 0){
   
         $switch = "";
		
	   if($confirmation == 1)
	   {
		   $switch = "<span title='this incident has being confirmed' style=\"background-color: rgb(60, 189, 172);\">Confirmed</span>";
	   }elseif($confirmation == 0){
		   
		   $switch =  "<span  title='this incident is pending confirmation' style=\"background-color: rgb(210, 73, 66);\">UnConfirmed \n</span>";
		 
	   }
	   
        return "<div class=\"ps-stream ps-js-activity ps-stream__post--pinned ps-js-activity-pinned ps-js-activity--482\">
     <div class=\"ps-stream__post-pin\" style=\"display:block\">
	      {$switch}
            </div>";
    }

    public static function time_converter($upload_time){

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

                    $upload_time = time()  - $upload_time;
//             echo "mon: ".$mon ." upload_time ". $upload_time;
//             $abs = abs(($mon - $upload_time));
//             echo "difference between them: ".$abs;
//             echo "the number of days of days are: ". ceil($abs/ $day)."<br />";

                    if ($upload_time <= $min) {
                        return "just now";

                        //if it is more than or equal to a minute but less than or equal to an hour
                    } elseif($upload_time > $min && $upload_time < $hr) {
                        // if it is exactly a minute
                        if(round($upload_time/$min) == 1){
                            return "a minute ago";
                            //if it is exactly an hour
                        }else{
                            // if it is between an hour and a minute
                            return round($upload_time/$min)." minutes ago";
                        }
                        //  greater than an hour and less than a day
                    } elseif($upload_time >= $hr && $upload_time < $day) {
                        // about 18 hours ago
                        if((int)round($upload_time / $hr) === 1) {

                            return "about an hour ago";
                            // if the it is greater than an hour and less than $mid_night hours
                        }elseif(round($upload_time / $hr) > 1 && round($upload_time / $hr) < $mid_night){

                            return  ceil($upload_time / $hr) . " hrs ago";

                        }elseif(floor($upload_time /$hr) >= $mid_night) {
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
                            return "a month ".self::sub_time_converter($upload_time,$mon,$wk,"weeks")." ago";

                        }elseif(($upload_time > $wk && $upload_time >= $mon) &&
                            ((int)floor($upload_time / $mon)  === 1) &&
                            $upload_time < ($mon * 2)){

                            return "about ".round($upload_time / $mon)." months ".self::sub_time_converter($upload_time,$mon,$wk,"weeks")." ago";;

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

        return "some time ago" ;
    }



	
    public static  function sub_time_converter($dividend = 0,$divisor = 0,$fallback = 0,$fallback_name = ""){

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

// GET THE FULL HEADER
// brings back the header of the post
    public static function get_full_post($returned_array = [],$views = null,$reactions_user_ids = [],$views_likes_user_ids = [],$reply_views_likes_user_ids = [],$linked_users_ids = [],$flag = ""){
		
 
	try{
		
	if(empty($returned_array) || !is_array($returned_array) && !isset($views)){
	   print j(["false" => "Something happend Unexpectedly, Please refresh the page and try again"]);
      log_action(__CLASS__," {$flag}image(s) or post info is/are empty on LINE ".__LINE__." in FILE ".__FILE__);
    return;   
   }
   
   
      $headers = [];
	 /*  $post_ids = []; */
     
	 // check if the results array($returned_array) is empty
	 if(empty($returned_array)){
		 print j(["false" => "Something happend Unexpectedly, Please refresh the page and try again"]);
		 log_action(__CLASS__," The queried post is empty on Line: ".__LINE__." in file: ".__FILE__);
		return ; 
	 }


     // for every single post,...
foreach ($returned_array as $posts_info => $images_or_info){
	    $skip_post = false;
		$post_info = array_shift($images_or_info);
		/* $post_ids [] = $post_info[PostImage::$alias_of_id]; */
		// pop the images from the trailing end of the array
		$images      = array_pop($images_or_info);
		 foreach($images AS $image){
			 if(!file_exists(self::$images_dir_string.$image)){
				 $skip_post = true;
				 break;
			 }
		 }
		 
		 if($skip_post){
			 continue;
		 }
		
			  if(!isset($images) || empty($images)){
				 log_action(__CLASS__,"No images in the post on line :".__LINE__." in file: ".__FILE__);
				  continue;
			  }
			  
			  if(!isset($post_info[PostImage::$alias_of_id]) || $post_info[PostImage::$alias_of_id] < 1){
				 log_action(__CLASS__,"The post id ( ".$post_info[PostImage::$alias_of_id].") is less than 1 in the post array  on line :".__LINE__." in file: ".__FILE__);
				  continue;
			  }

			  if(!in_array((int)$post_info[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$post_info[PostImage::$uploader_id];
			  }
			  
			 if(!in_array((int)$post_info[PostImage::$alias_of_id],$_SESSION["post_ids"])){
				 $_SESSION[PostImage::$alias_of_id][] = (int)$post_info[PostImage::$alias_of_id];
			 }
			 
			 $reaction_user_ids = (empty($reactions_user_ids[$post_info[PostImage::$alias_of_id]]) || !isset($reactions_user_ids[$post_info[PostImage::$alias_of_id]])) ? [] : $reactions_user_ids[$post_info[PostImage::$alias_of_id]];
			 
			
			// add the post to the array of post in the users session
			$full_header = "";
			
           // get the post confirmation template
            $full_header   = self::get_post_confirmation($post_info[PostImage::$confirmation]);
			
            // gets the full name
            $full_header   .= self::get_fullname($post_info[PostImage::$uploader_id],$post_info[user::$firstname],$post_info[user::$lastname],$linked_users_ids);
            // gets the number of files uploaded and label of the issue
            $full_header   .= self::get_post_title(count($images),$post_info[PostImage::$label]);
            // gets the mood of the post
           // $full_header .= self::get_mood_template($post_info["mood"]);
            // gets the location of the post
            $full_header   .= self::get_location_template($post_info[PostImage::$log],$post_info[PostImage::$lat]);
            // gets the time the post was uploaded
            $full_header   .= self::get_time_template($post_info[PostImage::$alias_of_id],$post_info[PostImage::$upload_time]);
			
			// add the manipulation options to the post header
			$full_header    .= self::get_post_options($post_info[PostImage::$uploader_id],$post_info[PostImage::$alias_of_id],$post_info[user::$firstname],$post_info[user::$lastname],$post_info[user::$user_category],$post_info[PostImage::$confirmation],$post_info[PostImage::$confirmer]);
			
			// gets the caption of post
           // $full_header   .= self::get_caption_template($post_info["caption"]);			
			// get the images and their arrangements
			
			$full_body     = self::images_layout_template($post_info[PostImage::$alias_of_id],$images,$post_info[PostImage::$alias_of_files_count],$post_info[PostImage::$support],$post_info[PostImage::$oppose],$reaction_user_ids,$post_info[PostImage::$caption]);
			 // get the reaction and comment box
			  $comments = $views["postID_".$post_info[PostImage::$alias_of_id]] ?? [];

			$comments_with_replys = Views::get_views_with_replys($post_info[PostImage::$alias_of_id],$comments,$views_likes_user_ids,$reply_views_likes_user_ids); 
			if($comments_with_replys){
				$full_body     .= $comments_with_replys;
			}else{
				Errors::trigger_error(INVALID_SESSION);
			}
			
		 // if the post body is false then uset the post table id since we no longer 
		 // need it to reference any post
		    if($full_body === false){
				print j(["false" => "Sorry, something went wrong,Please try  again after some time"]);
				 unset($headers[$post_info[PostImage::$alias_of_id]]);
				continue;				
			}
		
			$headers[$post_info[PostImage::$alias_of_id]] = $full_header.$full_body;
        }
		
		
  if(!empty($headers)){
			 print j($headers);
			 $_SESSION["scroll_ready_state"] = true;
        return true; 
		 }else{
		print j(["true"=>"no_more_posts"]);
		
		$_SESSION["scroll_ready_state"] = true;
        return true; 
		 }
    return false;		 
       
	}catch(Exception $e)
	{
	log_action(__CLASS__," Exception occured '{$e}' on line: ".__LINE__." in file ".__FILE__);
	    print j(["false" => "An Error occured please try again"]);
	   return false;
	}
    
	}// get_full_post();

    public static function get_post_files_display($files){

        return "<div class=\"ps-stream-attachments cstream-attachments\"><div class=\"cstream-attachment photo-attachment\">
	<div class=\"ps-media-photos ps-media-grid  ps-clearfix\" data-ps-grid=\"photos\" style=\"position: relative; width: 100%; max-width: 600px; min-width: 200px; max-height: 1200px; overflow: hidden;\">
		<a href=\" ://demo.peepso.com/activity/?status/2-2-1528720781/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(200, 'photo');\" style=\"float: left; width: 50%; padding-top: 50%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/5ae0d503466b11.15907101.png\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\" ://demo.peepso.com/activity/?status/2-2-1528720781/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(201, 'photo');\" style=\"float: left; width: 50%; padding-top: 50%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/5ae0d503466b11.15907101.png\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\" ://demo.peepso.com/activity/?status/2-2-1528720781/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(195, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/5ae0d503466b11.15907101.png\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\" ://demo.peepso.com/activity/?status/2-2-1528720781/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(196, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/5ae0d503466b11.15907101.png\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\" ://demo.peepso.com/activity/?status/2-2-1528720781/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(197, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI/IPmHxc3tDbNYWfiGz6FB5LHml2RJNTykk6uxED1bLs/5ae0d503466b11.15907101.png\" class=\"ps-js-fitted\" style=\"width: 100%; height: auto;\">
									<div class=\"ps-media-photo-counter\" style=\"top:0; left:0; right:0; bottom:0;\">
				<span>+6</span>
			</div>
					</div>
	</div>
</a>
		
	</div>
</div>
</div>";
    }


// brings back the template of the the image file with the dackened overlay

// brings back the dody of the post
    public static function get_post_full_body(){


        return "<div id=\"ps-activitystream-recent\" class=\"ps-stream-container\" style=\"\"><div class=\"ps-stream ps-js-activity  ps-js-activity--507\" data-id=\"507\" data-post-id=\"965\" style=\"\">

	
	<div class=\"ps-stream__post-pin\" style=\"\">
		<span style=\"background-color: rgb(210, 73, 66);\">Pinned</span>
        	</div>

	<div class=\"ps-stream-header\">

		<!-- post author avatar -->
		
		<!-- post meta -->
		<div class=\"ps-stream-meta\">
			<div class=\"reset-gap\">
				<a class=\"ps-stream-user\" href=\"https://demo.peepso.com/profile/demo/\"> Patricia Currie</a> <span class=\"ps-stream-action-title\"> uploaded 6 photos</span> 				<span class=\"ps-js-activity-extras\">			<span>
				<i class=\"ps-emoticon ps-emo-1\"></i>
				<span> feeling Joyful</span>
			</span>
			 			<span>
                <a href=\"#\" title=\"Black Park Ltd. (Tesano)\" onclick=\"pslocation.show_map(5.5984168, -0.22774119999996856, 'Black Park Ltd. (Tesano)'); return false;\">
                    <i class=\"ps-icon-map-marker\"></i>Black Park Ltd. (Tesano)                </a>
			</span>
			</span>
			</div>
			<small class=\"ps-stream-time\" data-timestamp=\"1538524754\">
				<a href=\"https://demo.peepso.com/activity/?status/2-2-1538495954/\">
					<span class=\"ps-js-autotime\" data-timestamp=\"1538524754\" title=\"October 2, 2018 11:59 pm\">10 mins ago</span>				</a>
			</small>
						
					</div>
		<!-- post options -->
		<div class=\"ps-stream-options\">
			<div class=\"ps-dropdown ps-dropdown--stream ps-js-dropdown\">
<a href=\"#\" class=\"ps-dropdown__toggle ps-js-dropdown-toggle\" data-value=\"\">
<span class=\"dropdown-caret ps-icon-caret-down\"></span>
</a>
<div class=\"ps-dropdown__menu ps-js-dropdown-menu\" style=\"display: none;\">
<a href=\"#\" onclick=\"activity.option_edit(965, 507); return false\" data-post-id=\"965\"><i class=\"ps-icon-edit\"></i><span>Edit Post</span>
</a>
<a href=\"#\" onclick=\"return activity.action_delete(965);\" data-post-id=\"965\"><i class=\"ps-icon-trash\"></i><span>Delete Post</span>
</a>
<a href=\"#\" onclick=\"return activity.action_pin(965, 1);\" data-post-id=\"965\"><i class=\"ps-icon-move-up\"></i><span>Pin to top</span>
</a>
</div>
</div>
		</div>
	</div>

	<!-- post body -->
	<div class=\"ps-stream-body\">
		<div class=\"ps-stream-attachment cstream-attachment ps-js-activity-content ps-js-activity-content--507\"><div class=\"peepso-markdown\"><p>Test post just now</p></div></div>
		<div class=\"ps-js-activity-edit ps-js-activity-edit--507\" style=\"display:none\"></div>
		<div class=\"ps-stream-attachments cstream-attachments\"><div class=\"cstream-attachment photo-attachment\">
	<div class=\"ps-media-photos ps-media-grid  ps-clearfix\" data-ps-grid=\"photos\" style=\"position: relative; width: 100%; max-width: 600px; min-width: 200px; max-height: 1200px; overflow: hidden;\">
		<a href=\"https://demo.peepso.com/activity/?status/2-2-1538495954/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(202, 'photo');\" style=\"float: left; width: 50%; padding-top: 50%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/31d0a1284e65a77d610f976e2d1cecf7_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\"https://demo.peepso.com/activity/?status/2-2-1538495954/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(203, 'photo');\" style=\"float: left; width: 50%; padding-top: 50%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/c02256ddf00f01ad010f80e7ddb399ce_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\"https://demo.peepso.com/activity/?status/2-2-1538495954/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(204, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/c5e99fcf8efd5547cf6c2efcc3eb82a3_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\"https://demo.peepso.com/activity/?status/2-2-1538495954/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(205, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/2394fed0c093c7451abf41fb64ca1780_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\"https://demo.peepso.com/activity/?status/2-2-1538495954/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(206, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/4198cdc6af05b8b0faef589d03a5346e_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
									<div class=\"ps-media-photo-counter\" style=\"top:0; left:0; right:0; bottom:0;\">
				<span>+2</span>
			</div>
					</div>
	</div>
</a>
		
	</div>
</div>
</div>
	</div>

	<!-- post actions -->
	<div class=\"ps-stream-actions stream-actions\" data-type=\"stream-action\"><nav class=\"ps-stream-status-action ps-stream-status-action\">
<a data-stream-id=\"507\" onclick=\"reactions.action_reactions(this, 507); return false;\" href=\"#\" class=\"ps-reaction-toggle--507 ps-js-reaction-toggle ps-icon-reaction liked ps-reaction-emoticon-8\"><img src=\"https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif\"></a>
</nav>
</div>

				<div id=\"act-reactions-507\" class=\"ps-reactions cstream-reactions-options ps-js-reaction-options ps-js-act-reactions-options--507\" data-count=\"\" style=\"display: none;\">
			<ul class=\"ps-reaction-options\">
									<li>
						<a title=\"Like\" class=\"ps-reaction-emoticon-0 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-0--507\" href=\"#\" data-tooltip=\"Like\" onclick=\"reactions.action_react(this, 507, 965, 0); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Love\" class=\"ps-reaction-emoticon-1 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-1--507\" href=\"#\" data-tooltip=\"Love\" onclick=\"reactions.action_react(this, 507, 965, 1); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Haha\" class=\"ps-reaction-emoticon-2 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-2--507\" href=\"#\" data-tooltip=\"Haha\" onclick=\"reactions.action_react(this, 507, 965, 2); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Wink\" class=\"ps-reaction-emoticon-3 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-3--507\" href=\"#\" data-tooltip=\"Wink\" onclick=\"reactions.action_react(this, 507, 965, 3); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Wow\" class=\"ps-reaction-emoticon-4 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-4--507\" href=\"#\" data-tooltip=\"Wow\" onclick=\"reactions.action_react(this, 507, 965, 4); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Sad\" class=\"ps-reaction-emoticon-5 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-5--507\" href=\"#\" data-tooltip=\"Sad\" onclick=\"reactions.action_react(this, 507, 965, 5); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Angry\" class=\"ps-reaction-emoticon-6 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-6--507\" href=\"#\" data-tooltip=\"Angry\" onclick=\"reactions.action_react(this, 507, 965, 6); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Crazy\" class=\"ps-reaction-emoticon-7 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-7--507\" href=\"#\" data-tooltip=\"Crazy\" onclick=\"reactions.action_react(this, 507, 965, 7); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Speechless\" class=\"ps-reaction-emoticon-8 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-8--507\" href=\"#\" data-tooltip=\"Speechless\" onclick=\"reactions.action_react(this, 507, 965, 8); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Grateful\" class=\"ps-reaction-emoticon-9 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-9--507\" href=\"#\" data-tooltip=\"Grateful\" onclick=\"reactions.action_react(this, 507, 965, 9); return false;\">
						</a>
					</li>
									<li>
						<a title=\"Celebrate\" class=\"ps-reaction-emoticon-10 ps-tooltip ps-tooltip--reaction ps-reaction-option ps-reaction-option--507 ps-reaction-option-10--507\" href=\"#\" data-tooltip=\"Celebrate\" onclick=\"reactions.action_react(this, 507, 965, 10); return false;\">
						</a>
					</li>
				
				
				<li class=\"ps-reaction-option-delete--507\" style=\"display: none;\">
					<a class=\"ps-reaction-option ps-reaction-option-delete ps-reaction-option--507 ps-reaction-option-delete--507\" href=\"#\" data-tooltip=\"Remove\" onclick=\"reactions.action_react_delete(this, 507, 965); return false;\" style=\"display: none;\">
					   <i class=\"ps-icon-remove\"></i>
					</a>
				</li>

				</ul>
			</div>
						<div id=\"act-react-507\" class=\"ps-reaction-likes ps-stream-status cstream-reactions ps-js-act-reactions--507 ps-stream-reactions-hidden  \" data-count=\"\" style=\"opacity: 0.5;\">
							</div>
		
		<div id=\"act-like-507\" class=\"ps-stream-status cstream-likes ps-js-act-like--507\" data-count=\"0\" style=\"display:none\"></div>
			<div class=\"ps-comment cstream-respond wall-cocs\" id=\"wall-cmt-507\">
		<div class=\"ps-comment-container comment-container ps-js-comment-container \" data-act-id=\"507\" style=\"display: none;\">
					</div>

						<div id=\"act-new-comment-507\" class=\"ps-comment-reply cstream-form stream-form wallform ps-js-comment-new ps-js-newcomment-507\" data-id=\"507\" data-type=\"stream-newcomment\" data-formblock=\"true\">
			<a class=\"ps-avatar cstream-avatar cstream-author\" href=\"https://demo.peepso.com/profile/demo/\">
				<img data-author=\"2\" src=\"https://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg\" alt=\"\">
			</a>
			<div class=\"ps-textarea-wrapper cstream-form-input\">
				<div class=\"ps-tagging-wrapper\"><div class=\"ps-tagging-beautifier\"></div><textarea data-act-id=\"507\" class=\"ps-textarea cstream-form-text ps-tagging-textarea\" name=\"comment\" oninput=\"return activity.on_commentbox_change(this);\" placeholder=\"Write a comment...\"></textarea><input type=\"hidden\" class=\"ps-tagging-hidden\"><div class=\"ps-tagging-dropdown\"></div></div>
				<div class=\"ps-commentbox__addons ps-js-addons\">
<div class=\"ps-commentbox__addon ps-js-addon-giphy\" style=\"display:none\">
	<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>
	<img class=\"ps-js-img\" alt=\"photo\" src=\"\">
	<div class=\"ps-commentbox__addon-remove ps-js-remove\">
		<i class=\"ps-icon-remove\"></i>
	</div>
</div>
<div class=\"ps-commentbox__addon ps-js-addon-photo\" style=\"display:none\">
	<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>

	<img class=\"ps-js-img\" alt=\"photo\" src=\"\" data-id=\"\">

	<div class=\"ps-loading ps-js-loading\">
		<img src=\"https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif\" alt=\"loading\">
	</div>

	<div class=\"ps-commentbox__addon-remove ps-js-remove\">
		<input type=\"hidden\" id=\"_wpnonce_remove_temp_comment_photos\" name=\"_wpnonce_remove_temp_comment_photos\" value=\"a42df904ae\"><input type=\"hidden\" name=\"_wp_http_referer\" value=\"/peepsoajax/postbox.post\">		<i class=\"ps-icon-remove\"></i>
	</div>
</div>
</div>
<div class=\"ps-commentbox-actions\">
<a onclick=\"peepso.photos.comment_attach_photo(this); return false;\" title=\"Upload photos\" href=\"#\" class=\"ps-postbox__menu-item ps-icon-camera\"><span></span></a>
<a onclick=\"return false;\" title=\"Send gif\" href=\"#\" class=\"ps-list-item ps-js-comment-giphy ps-icon-giphy\"></a>
</div>
			</div>
			<div class=\"ps-comment-send cstream-form-submit\" style=\"display:none;\">
				<div class=\"ps-comment-loading\" style=\"display:none;\">
					<img src=\"https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif\" alt=\"\">
					<div> </div>
				</div>
				<div class=\"ps-comment-actions\" style=\"display:none;\">
					<button onclick=\"return activity.comment_cancel(507);\" class=\"ps-btn ps-button-cancel\">Clear</button>
					<button onclick=\"return activity.comment_save(507, this);\" class=\"ps-btn ps-btn-primary ps-button-action\" disabled=\"\">Post</button>
				</div>
			</div>
		</div>
			</div>
</div></div>";
    }

    public static function get_full_image_post(){

        return "<a href=\"https://demo.peepso.com/activity/?status/2-2-1538497253/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(203, 'photo');\" style=\"width: 100%; padding-top: 66.6%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/4208a8ecc2060db20502f8f21870c7ea_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>";
    }




    public static function get_single_bottom_extra_small_image_template_last($file = "",$count = 0){

        if(empty(trim($file) && is_int($count) && $count > 0 &&
            !file_exists("../".UPLOAD_DIR."/".$file))){
            return null;
        }
        $count = $count - 4;
        return "<a href=\" ://demo.peepso.com/activity/?status/2-2-1528720781/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(197, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../".UPLOADS_DIR."/{$file} class=\"ps-js-fitted\" style=\"width: 100%; height: auto;\">
									<div class=\"ps-media-photo-counter\" style=\"top:0; left:0; right:0; bottom:0;\">
				<span>{$count}</span>
			</div>
					</div>
	</div>
</a>";
    }
    public static function get_post_body_wrapper($images = "", $caption = "", $count = 0,$id = 0,$support = 0,$oppose = 0){

        if(!isset($images) || $count > 0 ){

        }
        $caption ? "<p>{$caption}</p>" : "" ;
        return "<div class=\"ps-stream-body\" id=\"post_$id\">
		<div class=\"ps-stream-attachment cstream-attachment ps-js-activity-content ps-js-activity-content--516\">
		<div class=\"peepso-markdown\">{$caption}</div></div>
		<div class=\"ps-js-activity-edit ps-js-activity-edit--516\" style=\"display:none\"></div>
		<div class=\"ps-stream-attachments cstream-attachments\"><div class=\"cstream-attachment photo-attachment\">
	<div class=\"ps-media-photos ps-media-grid  ps-clearfix\" data-ps-grid=\"photos\" style=\"position: relative; width: 100%; max-width: 600px; min-width: 200px; max-height: 1200px; overflow: hidden;\">
		
		".self::get_images_arrangement_template($images,$caption,$id = 0,$count)."<!-- Post Actions -->
		".self::get_reaction_template($support,$oppose,$id)."
	</div></div></div>";
    }

    public static function get_single_top_images_template($image = ""){

        return "<a href=\"https://demo.peepso.com/activity/?status/2-2-1538497582/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(207, 'photo');\" style=\"width: 100%; padding-top: 66.6%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../".UPLOAD_DIR."/".$image."\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>";
    }

    public static function get_single_file_template($image = ""){

        if(!isset($image) || empty($image)){

            return "the photo {$image} does not exists ";
        }
        return "<a href=\"https://demo.peepso.com/activity/?status/2-2-1538497582/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(207, 'photo');\" style=\"width: 100%; padding-top: 66.6%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../".UPLOAD_DIR."/".$image."\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>";
    }

    public static function get_single_bottom_extra_small_image_template($file = ""){

        $file ?? "";
        if(empty(trim($file)) && !file_exists($file)){
            return null;
        }

        return "<a href=\"https://demo.peepso.com/activity/?status/2-2-1538497253/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(204, 'photo');\" style=\"float: left; width: 33.3%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../".UPLOAD_DIR."/".$file."\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>";
    }

    public static function get_images_arrangement_template($images = "",$caption = "",$id = 0,$count = 0){


//
//    foreach($images as $image){
//        //check the if they are really populated
//        if(empty(trim($image)) || !is_int($count) || $count < 0 || !file_exists(PRIVATE_MEDIA."/"."/".$image)){
//            return PRIVATE_MEDIA."/"."/".$image;
//        }
//        $image ?? "";
//        $caption ?? "";
//    }



//  return "it processed here";
// if there is only one file then make it fill the entire page
        if((int)$count === 1){

            return self::get_single_file_template($images[0]);

        }

        // declare the variable for the entire images string
        $body_string = "";
        for($x = 0; $x < $count ;$x++){
            if($x < 2){
                // give this to the first two files
                $body_string .= self::get_single_top_images_template($images[$x]);
                continue;
            }

            // this template for the subsequest ones
            $body_string .= self::get_single_bottom_extra_small_image_template($images[$x]);

        }
        // this template for the fourth one then hide the rest to the ui
        if($x == 4){
           
            $body_string .= self::get_single_bottom_extra_small_image_template_last($images[$x],$x);
        }


        return $body_string;
    }

    public static function get_full_image_post_body_display($image = ""){

        if(!isset($image) || empty(trim($image)) || !file_exists("../".UPLOAD_DIR."/".$image)){
            return null;
        }

        return "
<a href=\"https://demo.peepso.com/activity/?status/2-2-1538497582/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(208, 'photo');\" style=\"float: left; width: 50%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"../".UPLOAD_DIR."/".$image."\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
<a href=\"https://demo.peepso.com/activity/?status/2-2-1538497582/\" class=\"ps-media-photo ps-media-grid-item \" data-ps-grid-item=\"\" onclick=\"return ps_comments.open(209, 'photo');\" style=\"float: left; width: 50%; padding-top: 33.3%;\">
	<div class=\"ps-media-grid-padding\">
		<div class=\"ps-media-grid-fitwidth\">
			<img src=\"https://demo.peepso.com/wp-content/peepso/users/2/photos/PRIVATE_MEDIA."/"/2aa084ca66a5bd5f638bf2f6195de775_l.jpg\" class=\"ps-js-fitted\" style=\"width: auto; height: 100%;\">
								</div>
	</div>
</a>
		
	</div>
</div>
</div>
	</div>";
    }


    public static function get_reaction_template($support = 0, $oppose = 0,$post_id){

  return "	<!-- post actions -->
<div class=\"ps-stream-actions stream-actions\" data-type=\"stream-action\" style=\"margin-top:0.5em\">
    <nav class=\"ps-stream-status-action ps-stream-status-action\">
<!--<a data-stream-id=\"482\" onclick=\"return reactions.action_reactions(this, 482);\" href=\"javascript:\" class=\"ps-reaction-toggle--482 ps-reaction-emoticon-0 ps-js-reaction-toggle ps-icon-reaction\"><span>Like</span></a>-->
<!--</nav>-->
        <!--Reaction buttons(support)-->
        <input type=\"radio\" name=\"reaction\" id=\"support_{$post_id}\" value=\"support\" class=\"reactionCheckboxRadio\">
        <label for=\"support_{$post_id}\"> Suppport(".$support.")</label>
        <!--Reaction buttons(oppose) -->
        <input type=\"radio\" name=\"reaction\" id=\"oppose_{$post_id}\" value=\"oppose\" class=\"reactionCheckboxRadio\">
        <label for=\"oppose_{$post_id}\"> Oppose (".$oppose.")</label>

</div>";
}


}








?>