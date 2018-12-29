(function (){

    var commentUrl = "../private/neutral_ajax.php";
   $(".cstream-form-text").on("focus",function(e){
      let commentsbox = e.delegateTarget;
      let comment = $(commentsbox).val();
	  let parent      = $().parents()[2];
	   $(parent).find(".ps-comment-send").show(); 
	    $(".cstream-form-text").on("keyup",function(e){
	    	console.log($(commentsbox).val());
	    });
	  if($.trim($(comment)) && $(commentsbox)){
	  	$.ajax({
	  		url: commentUrl,
			data: comment,
			METHOD: "POST",
	  		datatype:"html",
			
	  		
	  	}).done(function(status,response){
			if(status === "success"){
				console.log(response);
			}
		}).always(function(){
			
		}).fail(function (){
			
		});

	  }
})
})();