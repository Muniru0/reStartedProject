

<?php

 require_once("../private/initialize.php");

// initialize variables to default values

$message = "";
$email = "";
$password = "";

// if this is a redirect then set the message 
// to the found_user message from the redirect

//if(isset($_POST["submit"])){
//    die("it is dry");
//}
 

 $_SESSION["found_user"] ?? $_SESSION["found_user"] = "";
 // unset the found_user to prevent the 
 // persistence of the displayed message 
$_SESSION["found_user"] = null;
  $cover_image = "assets/images/203-rain-computer-background-photos-downloads-backgrounds-wallpapers_2.jpg";
     
  // if the request is a post and at the same time
  // from us
if(is_request_post() && request_is_same_domain()) {
	
  // is the csrf token valid and recent
  if(!csrf_token_is_valid() || !csrf_token_is_recent()) {

   
  	print j(["false" => "Sorry, request was not valid."]);
      return;

  } else {
    // CSRF tests passed--form was created by us recently.
   // retrieve the values submitted via the form
$email    =  user::$email    = $_POST['email'];
$password =  user::$password = $_POST['password'];
// validate the presence of the required fields  
if(validate_presence_on(["password","email"]) && is_email($email)){
// check that they are not being throttled before 
  //  
  if(throttle::throttle_user()){
     $user = new user();
  if(user::found_user()) {
    after_successful_login();
          // if they are authenticated successfully
	   	 // then clear all the failed logins
        throttle::clear_failed_logins();
         print j([true]);
      return;
} else {
throttle::record_failed_logins($email);
		      // if the person is throttled or not give
			  // the same information out
      
       $_POST = null;
        return ;
		    }
		}else{
// don't tell the person that he is being throttled
          print j(["Throttled! Try again after 10mins"]);
          return;
		}
			}
    else{
//    // put a return here to stop processing the rest 
//    // of the page
//    echo "nooo either the email or presence is broken!!!";
 return;
}
  }
			
		}
?>


<!DOCTYPE html>


<html lang="en-US" class="no-js fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <style type="text/css">svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;-webkit-box-sizing:border-box;box-sizing:border-box;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.33333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1em}.svg-inline--fa.fa-stack-2x{height:2em;width:2em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}</style><link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="#">
    <!--[if lt IE 9]>
    <script src="https://demo.peepso.com/wp-content/themes/new/js/html5.js"></script>
    <![endif]-->
    <title>Community</title>
    
<!--    <link rel="dns-prefetch" href="//fonts.googleapis.com">-->
<link rel="dns-prefetch" href="//s.w.org">
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.4\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.4\/svg\/","svgExt":".svg","source":{"concatemoji":"assets1\/js\/wp-emoji-release.min.js"}};
			!function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55357,56692,8205,9792,65039],[55357,56692,8203,9792,65039]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
      </script><script src="assets1/js/wp-emoji-release.min.js" type="text/javascript" defer=""></script>
<!--    <script src="https://demo.peepso.com/wp-includes/js/wp-emoji-release.min.js?ver=4.9.6" type="text/javascript" defer=""></script>-->
		<!-- managing ads with Advanced Ads --><script>
					advanced_ads_ready=function(){var fns=[],listener,doc=typeof document==="object"&&document,hack=doc&&doc.documentElement.doScroll,domContentLoaded="DOMContentLoaded",loaded=doc&&(hack?/^loaded|^c/:/^loaded|^i|^c/).test(doc.readyState);if(!loaded&&doc){listener=function(){doc.removeEventListener(domContentLoaded,listener);window.removeEventListener("load",listener);loaded=1;while(listener=fns.shift())listener()};doc.addEventListener(domContentLoaded,listener);window.addEventListener("load",listener)}return function(fn){loaded?setTimeout(fn,0):fns.push(fn)}}();
			</script><style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<!--
<link rel="stylesheet" id="peepso-css" href="https://demo.peepso.com/wp-content/plugins/peepso-core/templates/css/speakup_major.css?ver=1.10.3" type="text/css" media="all">
<link rel="stylesheet" id="widgetopts-styles-css" href="https://demo.peepso.com/wp-content/plugins/widget-options/assets1/css/widget-options.css" type="text/css" media="all">
<link rel="stylesheet" id="peepso-theme-css-css" href="https://demo.peepso.com/wp-content/themes/new/style.css?ver=4.9.6" type="text/css" media="all">
<link rel="stylesheet" id="peepso-site-font-css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed%3A300%2C400%2C700&amp;ver=4.9.6" type="text/css" media="all">
<link rel="stylesheet" id="peepso-site-css-04-06-css" href="https://demo.peepso.com/wp-content/themes/new/assets1/css/speakup_minor.css?ver=1.0" type="text/css" media="all">
<link rel="stylesheet" id="peepso-moods-css" href="https://demo.peepso.com/wp-content/plugins/peepso-core/assets1/css/moods.css?ver=1.10.3" type="text/css" media="all">
<link rel="stylesheet" id="peepso-giphy-css" href="https://demo.peepso.com/wp-content/plugins/peepso-extras-giphy-integration/assets1/css/giphy.css?ver=1.10.3" type="text/css" media="all">
<link rel="stylesheet" id="peepsoreactions-dynamic-css" href="https://demo.peepso.com/wp-content/peepso/plugins/reactions/reactions-1530194434.css?ver=1.10.3" type="text/css" media="all">
<link rel="stylesheet" id="peepso-vip-admin-css" href="https://demo.peepso.com/wp-content/plugins/peepso-extras-vip/assets1/css/frontend.css?ver=4.9.6" type="text/css" media="all">
<link rel="stylesheet" id="peepso-markdown-highlight-css" href="https://demo.peepso.com/wp-content/plugins/peepso-integrations-markdown/assets1/css/highlight.min.css?ver=1.10.3" type="text/css" media="all">
<link rel="stylesheet" id="peepso-markdown-css" href="https://demo.peepso.com/wp-content/plugins/peepso-integrations-markdown/assets1/css/markdown.css?ver=1.10.3" type="text/css" media="all">
   
--> 
<!--Personal Styles -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">      
<link rel="stylesheet" href="assets/css/speakup_minor.css">
<link rel="stylesheet" href="assets/css/speakup_major.css">
<link rel="stylesheet" href="assets/fonts/fontawesome/all.css">
          
<link rel="stylesheet" href="assets/tmp_folder_for_login_page/bootstrap.min.css">      
<link rel="stylesheet" href="assets/tmp_folder_for_login_page/speakup_minor.css">
<link rel="stylesheet" href="assets/tmp_folder_for_login_page/speakup_major.css">
<link rel="stylesheet" href="assets/fonts/fontawesome/all.css">

<!--<link rel="stylesheet" href="assets1/css/style.css" />-->
  

<!--<script type="text/javascript" src="assets1/js/jquery-migrate.min.js" defer></script>-->

<!--<script type="text/javascript" src="assets1/js/index.js" defer></script>  -->

<!--<script type="text/javascript" src="assets1/js/bootstrap.bundle.min.js"></script>  -->
        

<script type="text/javascript" src="assets/js/fontawesome-all.min.js" defer=""></script>
<!--  DO NOT DEFER jquery or else the script will not find it ---->        
<script type="text/javascript" src="assets/js/jquery.js"></script>
<!--        
<script type="text/javascript">
/* <![CDATA[ */
var peepsovipdata = {"template":"<div class=\"ps-vip__dropdown\">\n\t{{ _.each( data, function( item ) { }}\n\t<div class=\"ps-vip-dropdown__item\">\n\t\t<img src=\"{{= item.icon_url }}\" alt=\"{{= item.title }}\" title=\"{{= item.title }}\" class=\"ps-img-vipicons\" \/>\n\t\t<div class=\"ps-vip-dropdown-item__content\">\n\t\t\t<strong>{{= item.title }}<\/strong>\n\t\t\t<span>{{= item.content }}<\/span>\n\t\t<\/div>\n\t<\/div>\n\t{{ }); }}\n<\/div>\n"};
/* ]]> */
</script>
<script type="text/javascript" src="https://demo.peepso.com/wp-content/plugins/peepso-extras-vip/assets1/js/index.js?ver=4.9.6"></script>
<link rel="https://api.w.org/" href="https://demo.peepso.com/wp-json/">
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://demo.peepso.com/xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://demo.peepso.com/wp-includes/wlwmanifest.xml"> 
<meta name="generator" content="WordPress 4.9.6">
<link rel="canonical" href="https://demo.peepso.com/">
<link rel="shortlink" href="https://demo.peepso.com/">
<meta property="og:title" content="PeepSo Demo">
<meta property="og:description" content="Come and join our community. Expand your network and get to know new people!">
<meta property="og:image" content="">
<meta property="og:url" content="https://demo.peepso.com/">
<link rel="icon" href="https://demo.peepso.com/wp-content/uploads/2017/09/PeepSo_128.png" sizes="32x32">
<link rel="icon" href="https://demo.peepso.com/wp-content/uploads/2017/09/PeepSo_128.png" sizes="192x192">
<link rel="apple-touch-icon-precomposed" href="https://demo.peepso.com/wp-content/uploads/2017/09/PeepSo_128.png">
<meta name="msapplication-TileImage" content="https://demo.peepso.com/wp-content/uploads/2017/09/PeepSo_128.png">
-->
		<style type="text/css" id="wp-custom-css">
			.mce-ico {
    font-family: 'tinymce', Arial  !important;
}

i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-backcolor, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-dashicon, i.mce-i-dfw, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-remove, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_code, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page {
    font: 400 20px/1 dashicons !important;
}		</style>
	  </head>
  <body class="home page-template page-template-page-tpl-community page-template-page-tpl-community-php page page-id-5 plg-peepso" id="top">
     
      

      
    <div class="top__button">
      <a class="btn btn--red" href="#top"><svg class="svg-inline--fa fa-angle-up fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="angle-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M177 159.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 255.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 329.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1z"></path></svg><!-- <i class="fas fa-angle-up"></i> --></a>
    </div>
    <div class="page__wrapper">
      <div class="header__wrapper header__wrapper--medium">
        <div class="header">
          <div class="header__logo">
            <a href="https://demo.peepso.com/">
              <img src="https://demo.peepso.com/wp-content/themes/new/assets1/images/logo.svg" alt="PeepSo"><img src="https://demo.peepso.com/wp-content/themes/new/assets1/images/logo-white.svg" alt="PeepSo">
            </a>
          </div>
          <ul class="header__menu">
            <li id="menu-item-149" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-149"><a href="https://demo.peepso.com/">Community</a></li>
<li id="menu-item-148" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-148"><a href="https://demo.peepso.com/profile/">Profile</a></li>
<li id="menu-item-663" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-663"><a href="https://demo.peepso.com/members/">Members</a></li>
<li id="menu-item-664" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-664"><a href="https://demo.peepso.com/classifieds/">Classifieds</a></li>
<li id="menu-item-150" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-150"><a target="_blank" href="/wp-admin/">Login to Admin</a></li>
            <li class="menu-item menu-item--myacccount">
              <a href="https://www.peepso.com/my-account/">My Downloads</a>
            </li>
          </ul>

                    <div id="userbar" class="header__account"><div class="widget_text widget header__widget"><div class="textwidget custom-html-widget"><div class="ultimate__box-actions" style="margin-left: 30px;"><a class="btn btn--sm" style="display:block;" href="http://peep.so/bundle">Buy <strong>Ultimate Bundle</strong></a></div></div></div></div>
          
          <div class="header__actions">
                        <a class="header__toggle header__toggle--account" href="#userbar">
              <svg class="svg-inline--fa fa-user-alt fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg><!-- <i class="fas fa-user-alt"></i> -->
            </a>

            <a href="#userbar" class="header__toggle header__toggle--close" style="display: none">
              <svg class="svg-inline--fa fa-times fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"></path></svg><!-- <i class="fas fa-times"></i> -->
            </a>
            
            <a class="header__toggle header__toggle--menu modal__toggle" href="#menu">
              <svg class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path></svg><!-- <i class="fas fa-bars"></i> -->
            </a>
          </div>
        </div>
      </div>
      
      <!-- CONTENT -->
      <div class="page__content">

<div class="page__section page__section--community">
  <div class="community__wrapper" style="
    padding-left: em;
">
    
    <div class="community__main" style="
    margin-left: 15em;
">
            <div id="peepso-wrap" class="container-fluid"><div class="peepso ps-page--activity-post">
    <section id="mainbody" class="ps-wrapper ps-clearfix">
        <section id="component" role="article" class="ps-clearfix">
            <noscript>
<div class="alert alert-error pstd-important">
	<span style="color: #ff0000;">Please Note:</span> PeepSo requires the use of Javascript
	for proper operation. Please enable Javascript in order to experience the full capabilities
	of the application. You may also visit our website for
	<a href="http://peepso.com/enabling-javascript">more information about enabling Javascript.</a>
	Thank you!
</div>
</noscript>

                            	<div class="ps-landing">
		<div class="ps-landing-cover">
		<div class="ps-landing-image" style="background:url('assets/images/203-rain-computer-background-photos-downloads-backgrounds-wallpapers_2.jpg');background-size:cover"></div>

			<div class="ps-landing-content">
				<div class="ps-landing-text">
<h2>Get Connected!</h2>
<p>Come and join our community. Expand your network and get to know new people!</p>
</div>
<div class="ps-landing-signup">
<a class="ps-btn ps-btn-join" href="https://demo.peepso.com/register/">Join us now, it's free!</a>
</div>
			</div>
		</div>
<!--font-family: 'Roboto Condensed', sans-serif !important;-->
                                    
<div id="registration" class="ps-landing-action">
<div class="alert alert-danger" id="login_err" role="alert" style="display:none;">
 <button type="button" class="close" data-dismiss="alert" id="close" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<script>
      $("#close").click(function(){
        $("#login_err").toggle();    
      });
</script>
            
  <div class="login-area">
<form class="ps-form ps-js-form-login" method="post" name="login" id="form">
   <?php echo csrf_token_tag(); ?><div class="ps-landing-form">
        <div class="ps-form-input ps-form-input-icon">
          <span class="ps-icon"><i class="ps-icon-user"></i></span>
          <input class="ps-input" type="text" id="email" name="email" placeholder="Email" mouseev="true" autocomplete="off" keyev="true" clickev="true">
        </div>
        <div class="ps-form-input ps-form-input-icon">
          <span class="ps-icon"><i class="ps-icon-lock"></i></span>
          <input class="ps-input" id="password" type="password" name="password" placeholder="Password" mouseev="true" autocomplete="off" keyev="true" clickev="true">
        </div>
        <div class="ps-form-input ps-form-input--button">
          <button type="submit" id="button_login" name="submit" class="ps-btn ps-btn-login">
            <span>Login</span>
            <img style="display:none" src="assets/images/ajax-loader.gif">
          </button>
        </div>
</div>
<div class="ps-checkbox">
        <input type="checkbox" alt="Remember Me" value="yes" id="remember" name="remember">
        <label for="remember">Remember Me</label>
      </div>
      <a class="ps-link ps-link--recover" href="signup.php">Recover Password</a>
        <a class="ps-link ps-link--recover" href="signup.php">Register</a>
            <a class="ps-link ps-link--activation ps-js-register-activation" href="https://demo.peepso.com/register/?resend" style="display: none;">Resend activation code</a>
            <!-- Alert -->
      <div class="errlogin calert clear alert-error" style="display:none"></div>
          </form>
     </div>
</div>

	</div>
     

<script type="text/javascript" src="assets/js/login.js" defer=""></script>
        
 </section></section></div></div></div></div></div></div></div>
    
    </body></html>