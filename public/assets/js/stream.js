
  class stream {







  static get_stream($stream_type = ""){


  if($.trim($stream_type) == ""){
  return;
  }


  	 $.ajax({
			 url:"../private/neutral_ajax.php",
			 type: "POST",
			 data: {request_type: $stream_type},
			 datatype: "html"
		 }).done(function(response){
			console.log(response);
			response = JSON.parse(response);

			  
			   

			if($.trim(response["pending"]) == "waiting"){
				
			$("#ps-activitystream-loading").show();
			
				 }else{
					 if(response["false"] != undefined && response["false"] == "login"){
 						location.href="login.php";
					 	 return;
						}else if($.trim(response["false"]) != ""){
					 	 utility.showErrorDialogBox("Please it is our fault but please try again.");
					 	  $("#ps-activitystream-loading").hide();
						 return;
					 }
					 
					 if($.trim($("#ps-activitystream")) != "" && $("#ps-activitystream") != null ){
					$.each(response,function(index,value){
					$("#ps-activitystream").append(value);
				 });
				
				  
				  }else{
						 console.log("not found");
					 }
					
					  $("#ps-activitystream-loading").hide();
			
			 }
				 
				 	
	}).fail(function(error){
			 alert(error);
		 }); 
  }


  }


$(window).scroll(function() {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
     $("#ps-activitystream-loading").show();
  
        stream.get_stream("mainstream");
    }
});


