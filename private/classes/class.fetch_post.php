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
	
	
	// the mood variables
	/*
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
*/

    // get the mood template
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
 


    // get the fullname template
    public static function get_fullname($id = 0,$firstname,$lastname){
         
		 $connected_user_class = "";
		 $toggle_string     = "display:none;";
		 $connect_title_string = "";
		 $user_parent_breathing_space = "";
		if(isset($_SESSION) && isset($_SESSION[ConnectUsers::$session_string]) && !empty($_SESSION[ConnectUsers::$session_string]) && in_array($id,$_SESSION[ConnectUsers::$session_string])){
			
		 $connected_user_class = "connect_user";
		 $toggle_string     = "display:inline;";
		 $user_parent_breathing_space = "breathing_space";
		 $connect_title_string = "You are connected to this User.You will be notified of all of his posted incidents.";
		 
		}
		  
		   
        return "<div class=\"ps-stream-header\"><div class=\"ps-stream-meta\"><div class=\"reset-gap {$user_parent_breathing_space}\" ><a class=\"ps-stream-user  {$connected_user_class}\" href=\"../public/".PROFILE_PAGE."?id=".$id."\" style='transition: all 0.5s;'>". $firstname." ".$lastname."<small style='{$toggle_string} transition: all 0.5s;'><i class ='fal fa-link' style='transition: all 0.5s;'></i></small></a>";
		
    }//get_fullname();

    // get the post title template
    public static function get_post_title($count,$label){

        $photos_string = (int)$count === 1 ? "a photo" : "{$count} photos";
		
        return "<span class=\"ps-stream-action-title\"> uploaded {$photos_string} about a  <a href=\"https://demo.peepso.com/profile/demo/photos/album/37\" title='This incident is about {$label}. (See more {$label} based incidents)'>".h($label)."  issue</a></span>";
    }
	
	
    // get the location template
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

    // get the time template
    public static function get_time_template($post_id = 0,$time = 0){

	    $toggle_follow_icon = "display:none";
	   if(in_array($post_id,$_SESSION[FollowPost::$session_string])){
		   $toggle_follow_icon = "";
		}
	   
        return "<small class=\"ps-stream-time\" data-timestamp=\"1528749581\">
                <a href=\"https://demo.peepso.com/activity/?status/2-2-1528720781/\">
                    <span class=\"ps-js-autotime\" data-timestamp=\"1528749581\" title=\"June 11, 2018 8:39 pm\">".self::time_converter($time)."</span>             </a>
					<i class='far fa-eye following_span' style='margin-left: 0.2em !important;{$toggle_follow_icon} ' title='you are following this post'></i>  
					</small></div>";
    }

	// get the post options template
	public static function get_post_options($user_id = 0,$post_id = 0,$firstname = "",$lastname = "",$links_array = [],$following_array = [],$confirmation_eligibility = 0 ,$confirmation = 0,$confirmer = 0){
		
		 if($_SESSION["id"] < 1){
			 
			print j(["false" => "Routine Security checks, please refresh the page and try again."]);
			 return;
		 }
		 
		 // initialize the necessary variables
		 // link user variables
		 $connect_user_string = "connect_user";
		 $toggle_connect_icon   = "fal fa-link";
		 $toggle_connect_class  = "";
		 $toggle_connect_string  = "connect with";
		 $toggle_connect_title  = "connecting with a user will get you notified of all future incidents posted by that user.";
		 
		 // follow post variables
		 $follow_post_string = "follow_post";
		 $toggle_follow_post_icon = "far fa-eye";
		 $toggle_follow_post_html_string = "follow this post";
		 $toggle_follow_post_class = "";
		  $toggle_follow_title  = "if you follow this incident you will be notified about every development of it.";
		 
		 
		 // adjust the link user variables if the two 
		 //users are linked
		  if(in_array($user_id,$_SESSION[ConnectUsers::$session_string])){
			 $toggle_connect_icon = "fal fa-unlink";
			 $toggle_connect_class = "reverse_post_action";
			 $toggle_connect_string = "disconnect from ";
			 $toggle_connect_title  = "You are connected to {$firstname} {$lastname}";
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
		$follow_post_string =  $_SESSION[user::$id] == $user_id ? "" : "<a href='javascript:' title='{$toggle_connect_title}' class='{$toggle_follow_post_class}' onclick='post_options(0,{$post_id},this,\"".$follow_post_string."\");' >
		<i class='{$toggle_follow_post_icon}'></i><span>{$toggle_follow_post_html_string}</span>
</a>";
      
		 // link user html link 
	    $connect_user_string =  $_SESSION[user::$id] == $user_id ? "" :"<a href='javascript:' title='{$toggle_connect_title}' class='{$toggle_connect_class}' onclick='post_options({$user_id},{$post_id},this,\"".$connect_user_string."\");return false' ><i class='{$toggle_connect_icon}'></i><span>{$toggle_connect_string}  {$firstname} {$lastname}</span>
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
<div class='ps-dropdown__menu ps-js-dropdown-menu' style='display: none;z-index: 100;'>
{$edit_post_string}
{$delete_post_string} 
{$follow_post_string} 
{$connect_user_string}
{$confirmation_option_string}

</div>
</div>
		</div></div>
";
		
		
	}
	
	
	
	// get the caption template
	public static function get_caption_template($caption = ""){
		
		if(!isset($caption)){
			return "";
		}
		
		$caption = str_replace("\n","",$caption);
		return "<div class='ps-stream-attachment cstream-attachment ps-js-activity-content ' style='margin-bottom: 2%;'><div class='peepso-markdown' ><p>{$caption}</p></div></div>";
	}// get_caption_template();
	
    
     // get edit post template 
     public static function get_edit_post_template($uploader_id= 0,$caption = "",$title = "", $location = "",$post_id = 0){
		      if($uploader_id < 1){
                  return "";
              }
		$caption_count = 4000 - strlen($caption);	  
			  
			return "<div class='ps-js-activity-edit ps-js-activity-edit--482' style='display:none;'><div class='ps-postbox ps-postbox--edit ps-sclearfix'>
	<div class='ps-postbox-content'>
		<div class='ps-postbox-status'>
			<div style='position:relative'>
				<div class='ps-postbox-input ps-inputbox' style=''>
     <div class='ps-tagging-wrapper' style='
    border-bottom: 1px solid #e1dede;
    margin-bottom: 1%;
'><div class='ps-tagging-beautifier'></div><textarea class='ps-textarea edit_title_textarea ps-postbox-textarea ps-tagging-textarea' placeholder='Please write the title here...(MAX-CHARACTERS: 100 )' MAXLENGTH='100' spellcheck='false' style='height: 32px; z-index: auto; position: relative; line-height: 18.2px; font-size: 13px; transition: none 0s ease 0s; background: transparent !important;'></textarea><input type='hidden' class='ps-tagging-hidden' value=''><div class='ps-tagging-dropdown' style='display: none;'></div></div>
 
<div class='ps-tagging-wrapper'>
   
    <div class='ps-tagging-beautifier'></div><textarea class='ps-textarea edit_caption_textarea ps-postbox-textarea ps-tagging-textarea' placeholder='Say what is on your mind...' spellcheck='false'  MAXLENGTH='100' style='height: 92px; z-index: auto; position: relative; line-height: 18.2px; font-size: 13px; transition: none 0s ease 0s; background: transparent !important;'>{$caption}</textarea><input type='hidden' class='ps-tagging-hidden' value=''><div class='ps-tagging-dropdown' style='display: none;'></div></div>
									</div>
				
			</div>
			<div class='ps-postbox-addons'>— <i class='ps-icon-map-marker'></i><b>{$location}</b></div>
	 <div class='post-charcount charcount ps-postbox-charcount' style='top:24%'>{$caption_count}</div>
		</div>
	</div>
	<div class='ps-postbox-tab ps-postbox-tab-root ps-sclearfix' style='display:none'>
		<div class='ps-postbox__menu ps-postbox__menu--tabs'>
					</div>
	</div>
	<nav class='ps-postbox__tabs ps-postbox-tab selected'>
		<div class='ps-postbox__menu ps-postbox__menu--interactions' style='background:beige; border-radius: 10%;'>
			<div id='location_tab_{$post_id}' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper'><a class='pstd-secondary ps-tooltip ps-tooltip--postbox' data-tooltip='Location' onclick='return;'>
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
	 <button type='button' onclick='cancelEditPost(this);' class='ps-btn ps-btn--postbox ps-button-cancel' style='position: relative;
    right: 5%;'>Cancel</button>
			<button type='button' onclick ='editPost({$post_id},{$uploader_id},this)' class='ps-btn ps-btn--postbox ps-button-action postbox-submit' style='display: inline-block;'>Post</button>
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
	
		   return [];
	   }
	  
	   
     $query = "SELECT ".user::$table_name.".".user::$firstname.",".user::$table_name.".".user::$lastname.",".user::$user_category.",".PostImage::$table_name.".*,".self::$table_name.".*,".PostImage::$table_name.".id AS post_table_id,".self::$table_name.".id AS file_id, ".PostImage::$files_count." AS ".PostImage::$alias_of_files_count." FROM ".PostImage::$table_name."
				JOIN ".user::$table_name." ON 
				".PostImage::$table_name.".uploader_id = ".user::$table_name.".id JOIN ".self::$table_name." ON ".self::$table_name.".post_id = ".PostImage::$table_name.".id WHERE 
				".PostImage::$table_name.".id = $post_id  LIMIT 10";

 // query the database	
  $result = $db->query($query);
	
	// check to see if there are any errors 
 if(!$result || $db->error != ""){
	    Errors::trigger_error(RE_INITIATE_OPERATION);

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
	  Errors::trigger_error(RE_INITIATE_OPERATION);
	  return [];
	 }  
  
	}// get_uploaded_post();
    
	
	//get the layout template for two images 
    public static function images_layout_template($uploader_id = 0,$post_id = 0,$images =[],$count = 0,$number_of_supports = 0,$number_of_opposes = 0,$reactions_user_ids = [],$location = "",$title = "",$caption = null){
 
	
	
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
		
		$multi_images_title = ($count > 1) ? "<div class='post_title' style='width: inherit;
'>{$title}</div>" : "";
 
      $edit_post_template = ((int)$uploader_id === (int)$_SESSION[user::$id]) ? self::get_edit_post_template($uploader_id,$caption,$title,$location,$post_id) : "";
		
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
		".self::get_caption_template($caption)."{$edit_post_template}
		<div class='ps-stream-attachments cstream-attachments'>
		<div class='cstream-attachment photo-attachment'>
		<div class='ps-media-photos ps-media-grid  ps-clearfix' data-ps-grid='photos' style='position: relative; width: 100%; max-width: 600px; min-width: 200px; max-height: 1200px; overflow: hidden;'>
		{$multi_images_title}
		";		
		
		 
	if(isset($images)  && $count == 1){  
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
		<div class='ps-media-grid-fitwidth' style='border-radius: 3%;'>
		<div class='post_title' style='width: inherit;'>{$title}</div>
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
   
   <div id='reactions_count_{$post_id}' class='ps-reaction-likes  ps-stream-status cstream-reactions' {$toggle_reactions_count} style='padding-left:0px;padding-right: 0px;'>
							
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
		
		<a href=' ://demo.peepso.com/activity/?status/2-2-1528720781/' class='ps-media-photo ps-media-grid-item' onclick='return ps_comments.open(200, 'photo');' style='float: left;width: ".$width."%;padding-top: ".$height."%;'>
	<div class='ps-media-grid-padding'>
		<div class='ps-media-grid-fitwidth' style='border-radius: 3%;'>
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
<div class='ps-media-grid-fitwidth' style='border-radius: 3%;'>
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
		<div class='ps-media-grid-fitwidth' style='border-radius: 3%;'>
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


    // get the post confirmation option string
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
    } // get_post_confirmation();

    // get time converter string
    public static function time_converter($upload_time){

		$upload_time = (int)$upload_time;
		
        if (isset($upload_time) && !empty($upload_time) && is_integer($upload_time)) {
			// if the current unix timestamp is > or equal to the "to
			// be converted time";
            if ((time() - $upload_time) > -1 ) {
				
                try {

                    //echo $upload_time
                    $min = 60;
                    $hr = $min * 60;
                    $day = $hr * 24;
                    $mid_night = $hr * 12;
                    $wk = $day * 7;
                    $mon = $wk * 4;
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
                    } elseif($upload_time >= $wk && $upload_time < $mon) {
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
    }// time_converter();

    // get sub_time converter string 
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

    } // sub_time_converter();

    

    // gather all the post parts and print t out as 
    // a single json output 
    public static function get_full_post($returned_array = [],$views = null,$reactions_user_ids = [],$views_likes_user_ids = [],$reply_views_likes_user_ids = [],$linked_users_ids = [],$flag = ""){
		
 
	try{
		
	if(empty($returned_array) || !is_array($returned_array) && !isset($views)){
	  Errors::trigger_error(UNEXPECTED_RETRY);
      
    return;   
   }
   
   
      $headers = [];
	 /*  $post_ids = []; */
     
	 // check if the results array($returned_array) is empty
	 if(empty($returned_array)){
		 Errors::trigger_error(UNEXPECTED_RETRY);
		 
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
				
				  continue;
			  }
			  
			  if(!isset($post_info[PostImage::$alias_of_id]) || $post_info[PostImage::$alias_of_id] < 1){
				
				  continue;
			  }

			  if(!in_array((int)$post_info[PostImage::$uploader_id],$_SESSION[PostImage::$uploader_id])){
				  $_SESSION[PostImage::$uploader_id][] = (int)$post_info[PostImage::$uploader_id];
			  }

			
			
			 if(!in_array((int)$post_info[PostImage::$alias_of_id],$_SESSION[PostImage::$session_post_ids])){
				 $_SESSION[PostImage::$session_post_ids][] = (int)$post_info[PostImage::$alias_of_id];
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
				
			// get the images and their arrangements
			$full_body     = self::images_layout_template($post_info[PostImage::$uploader_id],$post_info[PostImage::$alias_of_id],$images,$post_info[PostImage::$alias_of_files_count],$post_info[PostImage::$support],$post_info[PostImage::$oppose],$reaction_user_ids,$post_info[PostImage::$location],$post_info[PostImage::$title],$post_info[PostImage::$caption]);
			
			
			 // get the reaction and comment box
			  $comments = $views["postID_".$post_info[PostImage::$alias_of_id]] ?? [];

			$comments_with_replys = Views::get_views_with_replys($post_info[PostImage::$alias_of_id],$comments,$views_likes_user_ids,$reply_views_likes_user_ids); 
			if($comments_with_replys){
				$full_body     .= $comments_with_replys;
			}else{
				Errors::trigger_error(INVALID_SESSION);
				return false;
			}
			
		 // if the post body is false then uset the post table id since we no longer 
		 // need it to reference any post
		    if($full_body === false){
				
				Errors::trigger_error(RE_INITIATE_OPERATION);
				 unset($headers[$post_info[PostImage::$alias_of_id]]);
				continue;				
			}
		
			$headers[$post_info[PostImage::$alias_of_id]] = $full_header.$full_body;
        }
		
		
  if(!empty($headers)){
			 print j($headers);
			  
        return true; 
		 }else{
		print j(["true"=>"no_more_posts"]);
		
		$_SESSION["scroll_ready_state"] = true;
        return true; 
		 }
    return false;		 
       
	}catch(Exception $e)
	{
		
   Errors::trigger_error(RETRY);
	   return false;
	}
    
	}// get_full_post();

  
    // get the reaction template
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