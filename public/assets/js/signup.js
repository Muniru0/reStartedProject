



function verifyPasswordsMatch(){
  
 let confirm_password = $.trim($("#confirm_password").val());
 let password         =  $.trim($("#password").val());
  if(confirm_password !== password){
    if($.trim($(".password_mismatch_text").css("display")) !== "block"){
      $(".password_mismatch_text").show();
    }
      if($("#confirm_password").css("background") !== "#eecdc6"){
        $("#confirm_password").css("background","#eecdc6");
       
      
      }
      return false;
  }else if(confirm_password === password){
    if($.trim($(".password_mismatch_text").css("display")) !== "none"){
      $(".password_mismatch_text").hide()
    }
      if($("#confirm_password").css("background") === "#eecdc6"){
        $("#confirm_password").css("background","#fff");
       
      
      }
  }
  return true;
}

  function showReporterIdField(target  = ""){

    
    if($(target) == undefined || $.trim(target) == ""){
 return;
    }
    let reporterIdDiv =  $("#reporter_id").parent();
    if($.trim(target) === "reset"){
      if($.trim($(reporterIdDiv).css("display")) !== "none"){
        $(reporterIdDiv).css("display","none");
        let signupButton = document.querySelector("#button_login");
        signupButton.disabled = false;
       let loadinGif = $(signupButton).find("img")[0];
        if($(loadinGif).css("display") !== "none"){
          $(loadinGif).css("display","block"); 
        }
        return;
      }
    }
  
    if($(target).val() === "reporter"){
    $(reporterIdDiv).show();
    }else if($(target).val() === "government"){
      if($.trim($(reporterIdDiv).css("display")) !== "none"){
        $(reporterIdDiv).css("display","none");
      }
    }
          }



// validating if the password and confirm password are the same
$("#confim_password").on("keyup focus",function(){
verifyPasswordsMatch();
});

// validating input before send to server
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




$("#button_login").on("click",function(e){
    if(!verifyPasswordsMatch()){
  return false;
    }
   var element = e.target;
   
   var bucket = $(element).find("img")[0];
     $(bucket).css("display","inline");
  
   $("#form").unbind("submit");  
    $("#form").submit(function(e){

        $.ajax({
            url:"logout.php",
            type:"POST",
            data:$("#form").serialize(),
            dataType:"html"
  }).
  done(function(response,status){
    console.log(response);
    try{
    response = JSON.parse(response);
    
if(status  === "success"){
    
    $.each(response,function(index,value){
        
         if(value == true)
         {
          location.href="me.php";
          return;
         }else
    if(index == "false"){
    var errors = "";
     $.each(response,function(index,value){
   errors += "<li>"+value+"</li>";
   });  
    $("#login_err").show();
    if($(".errors") != "null"  ){
      $(".errors").remove();
    }
     $("#login_err").append("<ul class=\"errors\">" + errors + "</ul>");  
     $(element).removeAttr("disabled");
     $(bucket).css("display","none");     
      
}
           
});
}
    }catch(e){
      
        utility.showErrorDialogBox("Sorry Invalid request please refresh the page and try again.");
    }

       
});



e.preventDefault();
//
$(element).attr("disabled","disabled");        
    });

 
});


