

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

  
   Errors::trigger_error(RETRY);
     return;

 } else {
    
  

if(trim($_POST["confirm_password"]) !== trim($_POST[user::$password])){
  Errors::trigger_error(RETRY);
return;
}

if(!has_length([$_POST[user::$password],"min"=>8])){

 return;
}
// validate the presence of the required fields  
if(!validate_presence_on([user::$password,user::$firstname,user::$lastname,user::$email,user::$profession,user::$location]) && is_email($email)){

return; 
}
   
 if(user::create_user()) {
   
   // CSRF tests passed--form was created by us recently.
  // retrieve the values submitted via the form
$firstname    =  $_SESSION[user::$firstname]   = $_POST[user::$firstname];
$lastname     =  $_SESSION[user::$lastname]    = $_POST[user::$lastname];
$email        =  $_SESSION[user::$email]       = $_POST[user::$email];
$profession   =  $_SESSION[user::$profession]  = $_POST[user::$profession];
$location     =  $_SESSION[user::$location]    = $_POST[user::$location];
$password     =  $_SESSION[user::$password] = $_POST[user::$password];


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
?>


<!DOCTYPE html>


<html lang="en-US" class="no-js fontawesome-i2svg-active fontawesome-i2svg-complete"><head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width">
 <style type="text/css">
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


@media only screen and (min-width: 992px){
  .ps-landing-action .ps-form-input {
   display: inline-block !important; 
   
}
}


/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "&#10004;";
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "&#10006;";
}
</style>

<!--Personal Styles -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">      
<link rel="stylesheet" href="assets/css/speakup_minor.css">
<link rel="stylesheet" href="assets/css/speakup_major.css">

  

<script type="text/javascript" src="assets/js/fontawesome-all.min.js" defer=""></script>
     
<script type="text/javascript" src="assets/js/jquery.js"></script>

   <style>
  

/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "&#10004;";
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "&#10006;";
}
  
  	
 .reactions {
	position: relative;
  display: inline-block;
  max-height: 0.2em;

  
}

 
.reactions label {
	width: 55px;
	height: 23px;
	position: absolute;
	background-color: #999;
	top: 0;
	left: 0.3em;
	border-radius: 50px;
	}
	
	
	
.reactions input[type="radio"]{
	visibility: hidden;
}

.reactions label:after {
	content: "";
	width: 21px;
	height: 21px;
	border-radius: 50px;
	position: absolute;
	top: 1px;
	left: 1px;
	transition: all 0.5s;
	background-color: white;
}



.reactions input[type="radio"]:checked + label:after {
	left: 33px;
}

.reactions input[type="radio"]:checked  + label{
	background-color:#3cbdac;
	
}


 .oppose_selected {
	 
	background: #d83f3f;
    border-radius: 3px;
    padding: 4px;
    color: #fff;
    vertical-align: middle;
    line-height: normal;
 }
 
 
.oppose_span {
    font-weight: bold;
    position: relative;
    top: 3px;
    color: black;
    left: 5.5em;
}


.support_span {
    
    font-weight: bold;
  
    color:black
    
}

.reactions_count:hover{
	opacity: 0;
}

.deselected_reactions_count {
	color: #999999;
    font-size: 0.9em !important;
}

.selected_reactions_count {
	color: #333;
    font-weight: 600;
}

.selected_support_span {
	color: rgb(59, 205, 172);
    font-weight: 700;
    letter-spacing: 0.05em;
	transition: all 0.5s;
}

.deselected_support_span {
	color: rgb(153, 153, 153);
    font-weight: normal;
    letter-spacing: 0px;
}

.selected_oppose_span {
	color: rgb(220, 117, 111);
    font-weight: 700;
    letter-spacing: 0.05em;
	transition: all 0.5s;
}

.deselected_oppose_span {
	color: rgb(153, 153, 153);
    font-weight: normal;
    letter-spacing: 0px;
}



.reply-sidebar{
	border-radius: 0.6em !important;
    background: #e1dcd9 !important;
    padding-left: 0.1em !important;
	background-image: linear-gradient(109.6deg, #fdc78d 11.3%, #f98ffd 100.2%) !important;
}

.comment-sidebar{
	border-radius: 0.6em;	
	background: #e1dcd9 !important;
    padding-left: 0.3em !important;
	background-image: linear-gradient(109.6deg, #fdc78d 11.3%, #f98ffd 100.2%) !important;
}

  	</style>
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
         <input class="ps-input" type="text" id="firstname" name="firstname" placeholder="Firstname" mouseev="true" autocomplete="off" keyev="true" clickev="true">
       </div>
       <div class="ps-form-input ps-form-input-icon">
         <span class="ps-icon"><i class="ps-icon-user"></i></span>
         <input class="ps-input" type="text" id="lastname" name="lastname" placeholder="Lastname" mouseev="true" autocomplete="off" keyev="true" clickev="true">
       </div>
       <div class="ps-form-input ps-form-input-icon">
         <span class="ps-icon"><i class="ps-icon-user"></i></span>
         <input class="ps-input" type="text" id="email" name="email" placeholder="Email" mouseev="true" autocomplete="off" keyev="true" clickev="true">
       </div>
       <div class="ps-form-input ps-form-input-icon">
         <span class="ps-icon"><i class="ps-icon-lock"></i></span>
         <input class="ps-input password" id="password" type="password" name="password" placeholder="Password" ondblclick="myFunction(this)" mouseev="true" autocomplete="off" keyev="true" clickev="true">
       </div>
       <div class="ps-form-input ps-form-input-icon">
          <span class="ps-icon"><i class="ps-icon-lock"></i></span>
          <input class="ps-input password" id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password" mouseev="true" ondblclick="myFunction(this)" autocomplete="off" keyev="true" clickev="true" />

          <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
    </div>
    <div class='reactions'>

<input type='radio' name='signup_type' id='gov'  value="government" style="margin-bottom: 0.5em"/>
<label for='gov'  title='Check this if you work with the government' ></label>
<span class='support_span'>Government</span>

<span class='oppose_span'>Reporter</span>
<input type='radio' name='signup_type' id='reporter' value="reporter" />
<label for='reporter' class='oppose_deselected' title='Check this if you are a reporter' style='margin-left: 11em;'></label>
</div>
        <div class="ps-form-input ps-form-input-icon" style='display:none !important;'>
          <span class="ps-icon"><i class="ps-icon-lock"></i></span>
          <input class="ps-input" id="reporters_id" type="password" name="reporters_id" placeholder="GJA ID" mouseev="true" autocomplete="off" keyev="true" clickev="true">
        </div>
       <div class="ps-form-input ps-form-input--button" style="margin-right: 7.3em;
float: right;
    margin-bottom: 0px;
    max-height: 0.5em;">
         <button type="submit" id="button_login" name="submit" class="ps-btn ps-btn-login">
           <span>Sign Up</span>
           <img style="display:none" src="assets/images/ajax-loader.gif">
         </button>
       </div>
</div>

     <a class="ps-link ps-link--recover" href="recover.php">Recover Password</a>
       <a class="ps-link ps-link--recover" href="login.php">I already have an account.</a>
         
           <!-- Alert -->
     <div class="errlogin calert clear alert-error" style="display:none"></div>
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


var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) { 
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) { 
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) { 
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

<script type="text/javascript" src="assets/js/utility.js" defer=""></script>
<script type="text/javascript" src="assets/js/signup.js" defer=""></script>
       
</section></section></div></div></div></div></div></div></div>
   
   </body></html>