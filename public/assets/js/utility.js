

class utility {


   // auto resize all text areas
    static resizeTextarea(textArea = ""){
     
	  console.log(textArea.scrollHeight);
 $(textArea).height(0).height(textArea.scrollHeight );

$(textArea).change();
	}
	
	// auto grow a text field
	static  autoGrow(oField){
		// if the scroll height is > than the clientHeight  
	if(oField.scrollHeight > oField.clientHeight)
	{
		
		// update the height of the input text field in px;
		oField.style.height = oField.scrollHeight + "px";
	}else if(oField.clientHeight < oField.scrollHeight){
	    	// update the height of the input text field in px;
			 console.log("this is a console log for the pressing of a key");
		oField.style.height = oField.clientHeight + "px";
	}
	  }// autGrow();
	  

   // helper method for replacing strings
  static replaceString(oldS, newS, fullS) {
  return fullS.split(oldS).join(newS);
}
	
	// helper method for showing success information to the user
	static showSuccessDialogBox(text){
		 alert(text);
	}

   // helper method for showing error information to the user
	static  showErrorDialogBox(text = ""){
		 alert(text);
	}
  

     // helper method for showing warning information to the user
	static ShowWarningDialogBox(text = ""){
		 alert(text);
	}

	// helper method for validating parameters
	static validate_presence(input = []){

		let length = input.length;
		for(let i = 0; i < length; i++){

			let param = input[i];
			if(typeof Number(param) == "number"){
			  if(param == 0 || param == undefined || param == null){
				 return false;
			}else{
				if($.trim(param) == "" || param == undefined || param == null){
				 return false;
			}

			}
		}

		
	}
return true;

}
    
    // helper method for re-loging in
    static showLoginBox(element = null){
        $("#modal-wrapper").show();
    }
    
    // after successfull login with login box
    static resetLoginBox(){
        // if there are any errors reset the 
         // error alert
          $("#loginBox-alert").html("");
        // hide the error alert
         $("#loginBox-alert").hide();
        // hide the loginBox
        $("#modal-wrapper").hide();
    }


	 // redirect back to the login pageX
	 static toLoginPage(){
		 location.href = "login.php";
	 }
	// login with the login box
	static loginWithLoginBox(loginButton = ""){

		// get the login email
		let login_email    = ($("#login_box_email") && $("#login_box_email").val()) ? $("#login_box_email").val() : ""; 
		// get the login password 
		let login_password    = ($("#login_box_password") && $("#login_box_password").val()) ? $("#login_box_password").val() : ""; 
		if(!utility.validate_presence([loginButton,login_email,login_password])){
			return;
		}
		
		$(loginButton).siblings("img").show();
		$(loginButton).css("background","#9298a0 !important");
		$.ajax({
			url: "../private/neutral_ajax.php",
			type: "POST",
			data: {email: login_email,password: login_password,login: true},
			dataType: "json"
		}).done(function(response){
      
			try{
			
			response = JSON.parse(response);
			if(Boolean(response[0]) == true){
				console.log("entered here");
				utility.resetLoginBox();
			}else if($.trim(response["false"]) != undefined || $.trim(response["false"]) != ""){
			
			}
		}catch(e){
			showErrorDialogBox("Sorry, please try again.");
		}finally{
			
			 $(loginButton).css("background","#29bdff   !important");
			$(loginButton).siblings("img").hide();
		}
			
		}).fail(function(error){
			utility.showErrorDialogBox("Sorry, please try again.");
		});
		
		
		
		
		
		
		
	}
	
	  static logout(){
	$( "#logout_form" ).submit(function( event ) {
  event.preventDefault();
});
	  }
	}