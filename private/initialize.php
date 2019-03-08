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
defined("PROFILE_PAGE") ? null    : define("PROFILE_PAGE","IPmHxcktDbNYWfiGzwFBkLHmlRJNTykkdduxED1bLs");

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





session_start();

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
require_once(PRIVATE_DIR . "classes/class.link_users.php");

block_blacklisted_ips();

?>
