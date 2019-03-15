
  class stream {


  static adjustPageScroll(){
  	if($("#ps-no-posts-match").css("display") == "block" || $("#ps-no-posts").css("display") == "block" 
	|| $("#ps-no-more-posts").css("display")== "block"){
  $("body").css("overflow","hidden");
	}else if($("#ps-no-posts-match").css("display") == "none" &&  $("#ps-no-posts").css("display") == "none" 
	|| $("#ps-no-more-posts").css("display") == "none"){
		$("body").css("overflow-y","scroll"); 
	}
  }

  static getMainStream(streamType = "", targetElement = null){
 
  if($.trim(streamType) == "" || $.trim(streamType) != "mainstream"){
  return;
  }

 
 if($("#ps-activitystream-loading").css("display") == "none"){
 	 $("#ps-activitystream-loading").show();
 }

    
   if($("#stream_type").val() != "mainstream"){
   	$("#stream_type").val("mainstream")
   }
  
   $.ajax({
			 url:"../private/neutral_ajax.php",
			 type: "POST",
			 data: {request_type: "scroll",stream_type:streamType},
			 datatype: "html"
		 }).done(function(response){
			console.log(response);


			try{
			response = JSON.parse(response);

			// if there are no post for now
			if($.trim(response["pending"]) == "waiting" && $("#ps-activitystream-loading").css("display") == "none" ){
			$("#ps-activitystream-loading").show();
			    	
			}
			// incase of a redirect		
else if(response["false"] != undefined && response["false"] == "login"){
 location.href="login.php";
		}
		// incase of an error
		else if($.trim(response["false"]) != ""){
					 	 utility.showErrorDialogBox("Please it is our fault but please try again.");
					 	  $("#ps-activitystream-loading").hide();
						 return;
					 
	}else  if($.trim(response["true"])){
		   if($.trim(response["true"]) == "no_posts"){
		   	$("#ps-no-posts").show();
			 
		   }else if($.trim(response["true"]) == "no_more_posts"){
		   	$("#ps-no-more-posts").show();
		   }
			
			 stream.adjustPageScroll();		     	
	}else if($.trim(response) != ""){
		$.each(response,function(index,value){
			$("#ps-activitystream").append(value);
		});
	}
		}catch(e){
			}finally{
				 $("#ps-activitystream-loading").hide();
					
			}	 	
	}).fail(function(error){
			 alert(error);
		 }); 


  
}



  // get your own stream( posts that you posted) 
  static getSelfStream(streamType = "",targetElement = null,reset = null){

    
  // validate the stream type presence
  if($.trim(streamType) == ""){
  return;
  }
  
  // toggle the display of the reset post button
  if($("#reset_posts_personal").css("display") == "none"){
	$("#reset_posts_personal").show();  
  }


  // show the post loading gif
  if($("#ps-activitystream-loading").css("display") == "none"){
	  $("#ps-activitystream-loading").show();
  }
 
 // get the stream type value
  let streamTypeValue = $.trim($("#stream_type").val());
  
  // adjust the ui to reflect the self post query process
   if($.trim(targetElement) != null){
		$(targetElement).attr("disabled",true);
		$(targetElement).find("img").show();
		if( streamTypeValue != "self"){
		$("#ps-activitystream").html("");	
		}
	
     // if the stream type value is 
	 //not self set it to self	
		 if(streamTypeValue != "self"){
	   $("#stream_type").val("self");
   }
					  	
   }


  let resetValue = "false";
   if($.trim(reset) != "" || reset == null){
   	resetValue = "reset_post";
   }

  	 $.ajax({
			 url:"../private/neutral_ajax.php",
			 type: "POST",
			 data: {request_type: "scroll",stream_type:streamType,reset:resetValue},
			 datatype: "html"
		 }).done(function(response){
			console.log(response);


			try{
			response = JSON.parse(response);

			// if there are no post for now
			if($.trim(response["pending"]) == "waiting" && $("#ps-activitystream-loading").css("display") == "none" ){
			    $("#ps-activitystream-loading").show();
			    	
			}
				 
	// incase of a redirect		
		else if(response["false"] != undefined && response["false"] == "login"){
location.href="login.php";
   }
		// incase of an error
		else if($.trim(response["false"]) != ""){
	utility.showErrorDialogBox("Please it is our fault but please try again.");
	$("#ps-activitystream-loading").hide();
	return;
	}
	// incase the user hasn't posted anything yet
 else if(response["true"] == "upclose_empty"){
					  	
 if($("#ps-no-posts-match").css("display") == "none"){
		   $("#ps-no-posts-match").show();
           	   
		 }
		}
    // if the request was successful 
	// and the results is not empty
else if($.trim($("#ps-activitystream")) != "" && $("#ps-activitystream") != null && $.trim(response) != ""){
	$.each(response,function(index,value){
			$("#ps-activitystream").append(value);
		});
		$("#ps-activitystream-loading").hide();
		}
					
		}catch(e){
            utility.showErrorDialogBox("Sorry request failed,please refresh the page and try again.");
           
			}finally{
			$(targetElement).attr("disabled",false);
			$(targetElement).find("img").hide();
			if($("#ps-activitystream-loading") && $("#ps-activitystream-loading").css("display") == "block" ){
			 $("#ps-activitystream-loading").hide();
			}
			
				}	 	
	}).fail(function(error){
			 alert(error);
		 }); 

  }

  static getProfile(){


  }





 /*  static get_stream(streamType = "",targetElement = null){


  if($.trim(streamType) == ""){
  return;
  }


 $("#ps-activitystream-loading").show();
   let page_scroll_value = $("#request_type").val();
   if($.trim(targetElement) != null){

    	$(targetElement).attr("disabled","");
		$(targetElement).find("img").show();
		$("#request_type").val("")
		$("#ps-activitystream").html("");
					  	
   }

  	 $.ajax({
			 url:"../private/neutral_ajax.php",
			 type: "POST",
			 data: {request_type: "scroll",stream_type:streamType},
			 datatype: "html"
		 }).done(function(response){
			console.log(response);


			try{
			response = JSON.parse(response);

			// if there are no post for now
			if($.trim(response["pending"]) == "waiting" && $("#ps-activitystream-loading").css("display") == "none" ){
			    	if( $("#ps-activitystream-loading").css("display") == "none" ){
			    		$("#ps-activitystream-loading").show();
			    	}
			}
				 
		else{
	// incase of a redirect		
if(response["false"] != undefined && response["false"] == "login"){
 location.href="login.php";
		}
		// incase of an error
		else if($.trim(response["false"]) != ""){
					 	 utility.showErrorDialogBox("Please it is our fault but please try again.");
					 	  $("#ps-activitystream-loading").hide();
						 return;
					 
					 }

		if($.trim($("#ps-activitystream")) != "" && $("#ps-activitystream") != null && $.trim(targetElement) != null && streamType != "mainstream"){
					  	 if(response["true"] == "upclose_empty"){
					     	$("#ps-no-posts-match").show();
					     	$("#deactivate_scroll").toggle().val("active");
					     }
					  	$(targetElement).attr("disabled","");
					  	$(targetElement).find("img").hide();
					  	$("#request_type").val(page_scroll_value)
					  	$("#ps-activitystream").html("");
					     // if there are no post for now
			if($("#ps-activitystream-loading") && $("#ps-activitystream-loading").css("display") == "block" ){
			    	
			    		$("#ps-activitystream-loading").hide();
			    
			}
						return;
					    
				 }

					  
					 
					 if($.trim($("#ps-activitystream")) != "" && $("#ps-activitystream") != null ){
					$.each(response,function(index,value){
					$("#ps-activitystream").append(value);
				 });
				
				  
				  }
					
					  $("#ps-activitystream-loading").hide();
				 
			 }
				 
			}catch(e){
            utility.showErrorDialogBox("Sorry request failed,please refresh the page and try again.");
            console.log(e);
			}finally{
					$(targetElement).attr("disabled","");
					$(targetElement).find("img").hide();
					$("#request_type").val(page_scroll_value);
					
			}	 	
	}).fail(function(error){
			 alert(error);
		 }); 


  }
 */


  static getCallMethod(streamType = ""){
  	  if($.trim(streamType) == ""){
  	  	return;
  	  }


  	  streamType = $.trim(streamType);

  	  switch(streamType){
  	  	case "mainstream":

  	  	stream.getMainStream(streamType);
  	  	break;
  	  	case "self":
  	  	stream.getSelfStream(streamType);
  	  	break;
  	  	case "profile":
  	  	stream.getProfileStream(streamType);
  	  	break;
  	  	case "community":
  	  	stream.getCommunityStream(streamType);
  	  	break;
  	  	default: ;
  	  }
  }

  }

// if the reset personal post button has being clicked

$("#reset_posts_personal").click(function(e){
	
	// find the loading gif and toggle the display
let gif = $("#reset_posts_personal").find("img");	 
	 if($(gif).css("display") == "none"){
		$(gif).show(); 
	 }

$.ajax({
	url:"../private/neutral_ajax.php",
	type: "POST",
	data:{request_type: "reset",param: "personal"},
	dataType: "html"
}).done(function(response){
	
	try{
		response = JSON.parse(response);
	
 if(response["result"]  != undefined && reponse["result"] == "fail"){
	
	utility.showErrorDialogBox(response["result"]);
}else{
	utility.showErrorDialogBox("Operation failed please try again later");
}	
		
	}catch(e){
		console.log(e);
		utility.showErrorDialogBox("Operation failed please try again later");
	}finally{
		
	
	if($(gif).css("display") != "none"){
		$(gif).hide(); 
	 
	
}
	}
});	
	
	
	
});
$(window).scroll(function() {
	  
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
    
        
         	 stream.getCallMethod($("#stream_type").val());
        
        
       
    }
});

