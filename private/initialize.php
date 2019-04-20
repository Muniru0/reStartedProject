<?php

// define  hashed constants for the various directories

//defined("PUBLIC")         ? null    : define("PUBLIC","s2CxARWoyfS608LFDZxNvOC8OoZR9Qg");
//defined("PRIVATE_DIR")        ? null    : define("PRIVATE_DIR","lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk");
//
//defined("PRIVATE_MEDIA") ? null    : define("PRIVATE_MEDIA","FnjP4kkPmLiF3lAq1nHx7AnbiBTogWwfhvTI");
//
//
//
//

//
//defined("POST_IMAGES")    ? null    : define("POST_IMAGES","r8NFcV3V75k4WISV0V8rrp4FmwUTr6Km9tQ1b9sSquA");
//
//defined("LOGS")           ? null    : define("LOGS","ZPeQ86qNLPr4Zs19kJw7NXPmrBiAoEs99eqlXDxHWovU");
//
//defined("POST_VIDEOS")           ? null    : define("POST_VIDEOS","IeMCtTN4sZJtobIIQlU2TMJE3MGudqvG3L31bf");
//
//defined("BUSINESS_LOGO")           ? null    : define("BUSINESS_LOGO","OTVQUklYTkM4cXBvSEJ2ZgybE2HQn6Bkvt4X31lcj");
//
//defined("POST_COMBINED_FILES") ? null : define("POST_COMBINED_FILES","M3Bc6ayHOHp5eVBYRklyaEls6ayUg2lnc6ayaL75eV");
//defined("POST_AUDIOS")           ? null    : define("POST_AUDIOS","M3Bc6ayHOHp5eVBYRklyaEls6ayUg2lnc6ayaL75eV");





// Perform all initialization here, in private

// Set constants to easily reference public 
// and private directories


// Define the core paths
// Define them as absolute paths to make sure that require_once works
// as expected.

//// DIRECTORY_SEPARATOR is a  PHP pre-defined constant
//// (\ for windows,/ for Unix)
//defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR,false);
//
//defined('PUBLIC_DIR') ? null:
//define ('PUBLIC_ROOT','C:'.DS.'wamp64'.DS.'www'.DS.'sample_app'.DS.'s2CxARWoyfS608LFDZxNvOC8OoZR9Qg');
//
//defined('PRIVATE_ROOT') ? null:
//define ('PRIVATE_DIR','C:'.DS.'wamp64'.DS.'www'.DS.'sample_app'.DS.'lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk');

// pages constants
defined("PROFILE_PAGE") ? null    : define("PROFILE_PAGE","profile.php");

//logic CONSTANTS
!defined("RECENT")  ? define("RECENT","recent")              : null;
!defined("STREAM")  ? define("STREAM","stream")              : null;
!defined("POST")    ? define("POST","post")                  : null;
!defined("SUPPORT") ? define("SUPPORT","support")            : null;
!defined("OPPOSE")  ? define("OPPOSE","oppose")              : null;
!defined("COMMENT")          ? define("COMMENT","comment")         : null;

!defined("APP_ROOT")         ? define("APP_ROOT", dirname(dirname(__FILE__)))   : null;

!defined("PRIVATE_DIR")      ? define("PRIVATE_DIR", APP_ROOT . "/private/")    : null;
!defined("PUBLIC_DIR")       ? define("PUBLIC_DIR", APP_ROOT . "/public/")      : null;
!defined("PRIVATE")          ? define("PRIVATE", "private/")    : null;
!defined("PUBLIC")           ? define("PUBLIC", "public/")      : null;


!defined("UPLOADS_DIR")      ?  define("UPLOADS_DIR","uploads_dir/")            : null;
!defined("IMGS_DIR")       ?  define("IMGS_DIR","images/")                  : null;
!defined("IMGS_THUMBS_DIR")   ?  define("IMGS_THUMBS_DIR","img_thumbs/")          : null;
!defined("VIDEOS_DIR")       ?  define("VIDEOS_DIR","videos/")                  : null;
!defined("VID_THUMBS_DIR")   ?  define("VID_THUMBS_DIR","vid_thumbs/")          : null;
!defined("SHARED_DIR")       ?  define("SHARED_DIR","shared/")                  : null;
!defined("DS")               ?  define("DS",DIRECTORY_SEPARATOR)                : null;
!defined("STREAM_PROFILE")               ?  define("STREAM_PROFILE","profile")                : null;
!defined("STREAM_COMMUNITY")               ?  define("STREAM_COMMUNITY","community")                : null;
!defined("STREAM_SELF")               ?  define("STREAM_SELF","self")                : null;
!defined("STREAM_HOME")               ?  define("STREAM_HOME","mainstream")                : null;



//signup types
!defined("GOVERNMENT_SIGNUP_TYPE")               ?  define("GOVERNMENT_SIGNUP_TYPE","government")                : null;
!defined("REPORTER_SIGNUP_TYPE")               ?  define("REPORTER_SIGNUP_TYPE","reporter")                : null;


!defined("RETRY")               ?  define("RETRY","re_try")                : null;
!defined("INVALID_STREAM_OPTION")               ?  define("INVALID_STREAM_OPTION","invalid")                : null;
!defined("INVALID_SESSION")               ?  define("INVALID_SESSION","invalid_session")                : null;
!defined("UNEXPECTED_RETRY")               ?  define("UNEXPECTED_RETRY","unexpected_retry")                : null;
!defined("RE_SEND_MESSAGE")               ?  define("RE_SEND_MESSAGE","re_send_message")                : null;
!defined("INVALID_REQUEST")               ?  define("INVALID_REQUEST","invalid_request")                : null;


!defined("RESET_POST")               ?  define("RESET_POST","reset_post")                : null;
!defined("COMMUNITIES")               ?  define("COMMUNITIES",["transport","health","work","sol","security","sanitation","education","oppression","other"])        : null;
!defined("ALLOWED_STREAM_PARAMETERS")               ?  define("ALLOWED_STREAM_PARAMETERS",[STREAM_HOME,STREAM_PROFILE,STREAM_COMMUNITY,STREAM_SELF])        : null;

!defined("RE_INITIATE_OPERATION")               ?  define("RE_INITIATE_OPERATION","re-initiate-operation")   : null;

// post interaction operations
!defined("NEW_COMMENT")               ?  define("NEW_COMMENT","new_comment")   : null;

!defined("INCIDENT_POST")               ?  define("INCIDENT_POST","incident_post")   : null;

!defined("NEW_POST")                    ?  define("NEW_POST","new_post")   : null;
!defined("EDIT_POST")               ?  define("EDIT_POST","edit_post")   : null;
!defined("DELETE_POST")               ?  define("DELETE_POST","delete_post")   : null;
!defined("CONFIRM_POST")               ?  define("CONFIRM_POST","confirm_post")   : null;
!defined("REVERSE_CONFIRMED_POST")               ?  define("REVERSE_CONFIRMED_POST","reverse_confirmed_post")   : null;

!defined("FOLLOW_POST")               ?  define("FOLLOW_POST","follow_post")   : null;
!defined("UNFOLLOW_POST")               ?  define("UNFOLLOW_POST","unfollow_post")   : null;

!defined("CONNECTION_REQUEST_SENT")               ?  define("CONNECTION_REQUEST_SENT","connection_request_sent")   : null;

!defined("CONNECTION_REQUEST_REVOKED")               ?  define("CONNECTION_REQUEST_REVOKED","connection_request_revoked")   : null;




!defined("NEW_SUPPORT")               ?  define("NEW_SUPPORT","new_support")   : null;


!defined("NEW_OPPOSE")               ?  define("NEW_OPPOSE","new_oppose")   : null;

!defined("ALT_SUPPORT")               ?  define("ALT_SUPPORT","change_to_support")   : null;


!defined("ALT_OPPOSE")               ?  define("ALT_OPPOSE","change_to_oppose")   : null;

!defined("NEW_REPLY_COMMENT")               ?  define("NEW_REPLY_COMMENT","new_reply_comment")   : null;



!defined("DELETE_REPLYVIEW")               ?  define("DELETE_REPLYVIEW","delete_reply_view")   : null;

!defined("LIKE_COMMENT")               ?  define("LIKE_COMMENT","like_comment")   : null;


!defined("LIKE_REPLY")               ?  define("LIKE_REPLY","like_reply")   : null;

!defined("UNLIKE_COMMENT")               ?  define("UNLIKE_COMMENT","unlike_comment")   : null;


!defined("UNLIKE_REPLY")               ?  define("UNLIKE_REPLY","unlike_reply")   : null;

!defined("ALT_SUPPORT")               ?  define("ALT_SUPPORT","alt_support")   : null;


!defined("NEW_COMMENT")               ?  define("NEW_COMMENT","new_comment")   : null;

!defined("NEW_REPLY_COMMENT")               ?  define("NEW_REPLY_COMMENT","new_reply_comment")   : null;


!defined("EDIT_COMMENT")             ?  define("EDIT_COMMENT","edit_comment")   : null;
!defined("EDIT_REPLY")               ?  define("EDIT_REPLY","edit_comment")   : null;


!defined("DELETE_VIEW")               ?  define("DELETE_VIEW","delete_view")   : null;




!defined("DELETE_VIEW")               ?  define("DELETE_VIEW","delete_view")   : null;




!defined("SERVER_PROBLEM")               ?  define("SERVER_PROBLEM","server_problem")   : null;



!defined("OPERATION_FAILED")               ?  define("OPERATION_FAILED","operation_failed")   : null;









session_start();

require_once(PRIVATE_DIR. "classes/class.error_handling.php");
// headers file
require_once("headers.php");
// Database connection files
require_once(PRIVATE_DIR.SHARED_DIR."config.php");
require_once(PRIVATE_DIR. "classes/class.database_object.php");

//require the functions
require_once(PRIVATE_DIR . "functions/general_functions.php");
require_once(PRIVATE_DIR . "functions/blacklist_functions.php");
require_once(PRIVATE_DIR . "functions/csrf_request_type_functions.php");
require_once(PRIVATE_DIR . "functions/csrf_token_functions.php");
require_once(PRIVATE_DIR . "functions/request_forgery_functions.php");
require_once(PRIVATE_DIR . "functions/reset_token_functions.php");
// require_once(PRIVATE_DIR . "functions/session_hijacking_functions.php");

//require the classes
require_once(PRIVATE_DIR . "classes/class.session.php");
require_once(PRIVATE_DIR . "classes/class.user.php");
require_once(PRIVATE_DIR . "classes/class.throttle.php");
require_once(PRIVATE_DIR . "classes/class.file_uploads.php");
require_once(PRIVATE_DIR . "classes/class.post_images.php");
require_once(PRIVATE_DIR . "classes/class.fetch_post.php");
require_once(PRIVATE_DIR . "classes/class.reactions.php");
require_once(PRIVATE_DIR . "classes/class.views.php");
require_once(PRIVATE_DIR . "classes/class.reply_views.php");
require_once(PRIVATE_DIR . "classes/class.pagination.php");
require_once(PRIVATE_DIR . "classes/class.notifications.php");
require_once(PRIVATE_DIR . "classes/class.post_templates.php");
require_once(PRIVATE_DIR . "classes/class.views_likes.php");
require_once(PRIVATE_DIR . "classes/class.reply_views_likes.php");
require_once(PRIVATE_DIR . "classes/class.connect_users.php");
require_once(PRIVATE_DIR . "classes/class.follow_post.php");
require_once(PRIVATE_DIR . "classes/class.pending_connections.php");
require_once(PRIVATE_DIR . "classes/class.messages.php");

// foreach (glob("../private/classes/class.*") AS $filename) {
//     require_once(PRIVATE_DIR.substr($filename,strpos($filename,"c")));
// }

block_blacklisted_ips();

?>
