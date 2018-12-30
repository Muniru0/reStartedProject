// (function (){

    // var commentUrl = "../private/neutral_ajax.php";
   // $(".cstream-form-text").on("focus",function(e){
      // let commentsbox = e.delegateTarget;
      // let comment = $(commentsbox).val();
	  // let parent      = $().parents()[2];
	   // $(parent).find(".ps-comment-send").show(); 
	    // $(".cstream-form-text").on("keyup",function(e){
	    	// console.log($(commentsbox).val());
	    // });
	  // if($.trim($(comment)) && $(commentsbox)){
	  	// $.ajax({
	  		// url: commentUrl,
			// data: comment,
			// METHOD: "POST",
	  		// datatype:"html",
			
	  		
	  	// }).done(function(status,response){
			// if(status === "success"){
				// console.log(response);
			// }
		// }).always(function(){
			
		// }).fail(function (){
			
		// });

	  // }
// })
// })();

	
	 var commentUrl = "../private/neutral_ajax.php";
    class activity{
	  
	 static on_commentbox_change(element) {
		 let comment = element.value;
		 let post_id = element.id;
		    post_id  =
		 if($.trim($(comment))){
	  	$.ajax({
	  		 url: "../private/neutral_ajax.php",
			data: {comment:comment,post_id :},
			type: "POST",
	  		datatype:"html",
			}).done(function(status){
			 if(status === "success"){
				 console.log(response);
				 console.log("returned from the server");
	 }else{
		 console.log(status);
	 }
	});

	}
		  
	  }
  }


