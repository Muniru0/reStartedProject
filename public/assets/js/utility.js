
$("#logout_link").click(function(e){
	let element = $(e.delegateTarget)[0];
	
if(!utility.validate_presence(element)){
		return;
	}
$(element).addClass("deactivate-logout");
	
$(element).find("img").show();

$("#logout_form").unbind("submit");  
$("#logout_form").submit(function(e){
$.ajax({
				url:"../private/logout.php",
				type:"POST",
				data:$("#logout_form").serialize(),
				dataType:"html"
}).done(function(response){
console.log(response);
try{
	
	 response = JSON.parse(response);

if(response["true"] != undefined && $.trim(response["true"]) != "" && $.trim(response["true"]) == "logout"){
	location.href= "login.php";
}else if(response["false"] != undefined && $.trim(response["false"]) != ""){
	showErrorDialogBox(response["false"]);
}else{
	alert("Please something went wrong please try again later");
}
 }catch(e){
		alert("Please something went wrong please try again later");
 }finally{
	$(element).removeClass("deactivate-logout",1000,"easeInBack");
	
 }

}).fail(function(){
alert("Server error please try again");
});
e.preventDefault();
});
e.preventDefault();
});

class utility {


// just for debugging
static nodes_and_indeces(element){


	 for(var index = 0; index < element.length ; index++){
			console.log(index);

			console.log(element[index]);
		}  
}

	static maintainLineBreaks(input = ""){

if($.trim(input) == ""){
	return;
}

 input  = input.split("\n");
 return input.join("<br />");

}// maintainLineBreaks();  	
// auto resize all text areas
static resizeTextarea(textArea = ""){
 

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




}	