

<?php

require_once("../private/initialize.php");



// initialize variables to default values

$message  = "";
$email    = "";
$password = "";

// if this is a redirect then set the message 
// to the found_user message from the redirect

//if(isset($_POST["submit"])){
//    die("it is dry");
//}

 $cover_image = "assets/images/203-rain-computer-background-photos-downloads-backgrounds-wallpapers_2.jpg";
    
 // if the request is a post and at the same time
 // from us
if(is_request_post() && request_is_same_domain()) {
 
 // is the csrf token valid and recent
 if(!csrf_token_is_valid() || !csrf_token_is_recent()) {

  
   Errors::trigger_error(INVALID_CSRF_TOKEN);
     return;

 } else {
    
  if(isset($_POST["signup_type"]) || isset($_POST["reporter_id"])){
    if(trim($_POST["reporter_id"]) != "" || !isset($_POST["signup_type"]) || !isset($_POST["reporter_id"])){
      Errors::trigger_error(GJA_ID);
  return;
    }
    if(!user::$verify_reporter($_POST["reporter_id"])){
      
      return;
    }

  }else{
    $_POST["signup_type"] = "";
    $_POST["reporter_id"]  = "";
   }
  

if(trim($_POST["confirm_password"]) !== trim($_POST[user::$password])){
  Errors::trigger_error(RETRY);
return;
}

if(!has_length([$_POST[user::$password],"min"=>8])){

 return;
}
// validate the presence of the required fields  
if(!validate_presence_on([user::$password,user::$firstname,user::$lastname,user::$email]) && is_email($email)){

return; 
}
   
 if(user::signup_user($_POST[user::$firstname],$_POST[user::$lastname],$_POST[user::$email],$_POST[user::$password],$_POST["signup_type"],$_POST["reporter_id"])) {
   
   // CSRF tests passed--form was created by us recently.
  // retrieve the values submitted via the form


   Session::after_successful_login();
         // if they are authenticated successfully
       // then clear all the failed logins
     
      
    print j([true]);
     return;
} else {

      $_POST = null;
       return ;
       }
  
   
 }
     
   }

  $message = $_SESSION["message"]?? "";
   
?>


<!DOCTYPE html>


<html lang="en-US" class="no-js fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width">
 
  <!--Personal Styles -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">      
  <link rel="stylesheet" href="assets/css/speakup_minor.css">
  <link rel="stylesheet" href="assets/css/speakup_major.css">
  <link rel="stylesheet" href="assets/css/signup.css">
  
    
  
       
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  
     
   
   </head>
 <body class="home page-template page-template-page-tpl-community page-template-page-tpl-community-php page page-id-5 plg-peepso" id="top">
  <div class="top__button">
     <a class="btn btn--red" href="#top"><svg class="svg-inline--fa fa-angle-up fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="angle-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M177 159.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 255.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 329.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1z"></path></svg><!-- <i class="fas fa-angle-up"></i> --></a>
   </div>
   <div class="page__wrapper">
     <div class="header__wrapper header__wrapper--medium">
       <div class="header">
       <div id="userbar" class="header__account"><div class="widget_text widget header__widget"><div class="textwidget custom-html-widget"><div class="ultimate__box-actions" style="margin-left: 30px;"><a class="btn btn--sm" style="display:block;" href="#"><strong>NatNet</strong></a></div></div></div></div>
        
         <ul class="header__menu">
           <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item " style="color: #333 !important;
    font-weight: bold;
    margin-right: 55%; font-size: 1.7em;"><a href="" style="text-decoration: none;
    cursor: default;
    color: #333;">Sign Up</a></li>

         </ul>

                  
         
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
  margin-left: 15%;
   width: 65%;
">
           <div id="peepso-wrap" class="container-fluid"><div class="peepso ps-page--activity-post">
   <section id="mainbody" class="ps-wrapper ps-clearfix">
       <section id="component" role="article" class="ps-clearfix">
           <noscript>
<div class="alert alert-error pstd-important">
 <span style="color: #ff0000;">Please Note:</span> PeepSo requires the use of Javascript
 for proper operation. Please enable Javascript in order to experience the full capabilities
 of the application. You may also visit our website for
 <a href="#">more information about enabling Javascript.</a>
 Thank you!
</div>
</noscript>

                             <div class="ps-landing">
   <div class="ps-landing-cover">
   <div class="ps-landing-image" style="background:url('assets/images/203-rain-computer-background-photos-downloads-backgrounds-wallpapers_2.jpg');background-size:cover"></div>

     <div class="ps-landing-content">
       <div class="ps-landing-text">
<h2>Get Connected!</h2>
<p>Come and join our community. Let's connect and build</p>
</div>
<div class="ps-landing-signup">
<a class="ps-btn ps-btn-join" href="">Let's Network To Build The Nation</a>
</div>
     </div>
   </div>
<!--font-family: 'Roboto Condensed', sans-serif !important;-->
                                   
<div id="registration" class="ps-landing-action" style="transition: all .5s">
<div class="alert alert-danger" id="login_err" role="alert" style="display:none;">
<button type="button" class="close" data-dismiss="alert" id="close" aria-label="Close">
   <span aria-hidden="true" style="position: relative;
   bottom: 0.1em;">×</span>
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
         <input class="ps-input" type="text" id="firstname" name="firstname" placeholder="Firstname" mouseev="true" autocomplete="off" keyev="true" clickev="true" required>
       </div>
       <div class="ps-form-input ps-form-input-icon">
         <span class="ps-icon"><i class="ps-icon-user"></i></span>
         <input class="ps-input" type="text" id="lastname" name="lastname" placeholder="Lastname" mouseev="true" autocomplete="off" keyev="true" clickev="true" required>
       </div>
       <div class="ps-form-input ps-form-input-icon">
         <span class="ps-icon"><i class="ps-icon-user"></i></span>
         <input class="ps-input" type="text" id="email" name="email" placeholder="Email" mouseev="true" autocomplete="off" keyev="true" clickev="true" required>
       </div>
       <div class="mismatch_password_div" style="display:none"></div>
       <div class="ps-form-input ps-form-input-icon">
         <span class="ps-icon"><i class="ps-icon-lock"></i></span>
         <input class="ps-input password" id="password" type="password" name="password" placeholder="Password" ondblclick="myFunction(this)" mouseev="true" autocomplete="off" keyev="true" clickev="true" required>
       </div>
       <div class="ps-form-input ps-form-input-icon">
          <span class="ps-icon"><i class="ps-icon-lock"></i></span>
          <input class="ps-input password" id="confirm_password" onkeyup="verifyPasswordsMatch()" type="password" name="confirm_password" placeholder="Confirm Password" mouseev="true" ondblclick="myFunction(this)" autocomplete="off" keyev="true" clickev="true" required />
          <div class="password_mismatch_text" style="display:none;">Passwords mismatch</div>
          <div id="message" style="transition: display .5s ease; transition: display 0.5s ease 0s;
    box-shadow: #f1f1f1 2px 2px 2px 2px;
  
    border-radius: 2em;

    position: relative;
    right: 10em;">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
    </div>
    <div class='reactions'>

<input type='radio'  name='signup_type' id='gov'  value="government" style="margin-bottom: 0.5em" oninput="showReporterIdField(this)"/>
<label for='gov'  title='Check this if you work with the government' ></label>
<span class='support_span'>Government</span>

<span class='oppose_span'>Reporter</span>
<input type='radio'  name='signup_type' id='reporter' value="reporter" oninput="showReporterIdField(this)" />
<label for='reporter' class='oppose_deselected' title='Check this if you are a reporter' style='margin-left: 11em;'></label>
</div>
        <div class="ps-form-input ps-form-input-icon" style='display:none !important;'>
          <span class="ps-icon"><i class="ps-icon-lock"></i></span>
          <input class="ps-input" id="reporter_id" type="password" name="reporters_id" placeholder="GJA ID" mouseev="true" autocomplete="off" keyev="true" clickev="true"  >
        </div>
       
       <div class="ps-form-input ps-form-input--button" style="margin-right: 4.3em;
float: right;
    margin-bottom: 0px;
    max-height: 0.5em;">
         <button type="submit" id="button_login" name="submit" class="ps-btn ps-btn-login">
           <span>Sign Up</span>
           <img style="display:none" src="assets/images/ajax-loader.gif">
         </button>
       </div>
       <div class="ps-form-input ps-form-input--button" style="margin-right: 0.3em;
float: right;
    margin-bottom: 0px;
    max-height: 0.5em;">
         <button type="reset" id="reset" onclick="showReporterIdField('reset');"  class="ps-btn ps-btn-login signup_type">
           <span>Reset</span>
           
         </button>
       </div>
</div>

     <a class="ps-link ps-link--recover" href="recover.php">Recover Password</a>
       <a class="ps-link ps-link--recover" href="login.php">I already have an account.</a>
         
           <!-- Alert -->
     <div class="errlogin calert clear alert-error" style="display:none"></div>
     <div id="session_message" class="errlogin calert clear alert-error" ><?php echo $message; ?></div>
     
         </form>
    </div>
</div>

 </div>
    
 <script>
function myFunction(targetElement = "") {
 
  if($.trim(targetElement)  == "" || $(targetElement) == undefined){
    
    return;
  }
  let x = targetElement;
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


</script>

<script type="text/javascript" src="assets/js/utility.js" defer=""></script>
<script type="text/javascript" src="assets/js/signup.js" defer=""></script>
       
</section></section></div></div></div></div></div></div></div>
   
   </body></html>