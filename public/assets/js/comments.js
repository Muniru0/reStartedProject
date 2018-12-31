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
    class view{
	  
	 static view_area_change(element) {
		   
		let commentBoxParent = $(element).parents()[2];
		
		  if (commentBoxParent.hasChildNodes()) {
      let  children = commentBoxParent.childNodes;
  
         let post_actions = children[3]
        $(post_actions).show();
        $(post_actions.childNodes[3]).show();
		$(post_actions.childNodes[3].childNodes).show();
		
  }
	  }
	  
	  static  autoGrow(oField){
	if(oField.scrollHeight > oField.clientHeight)
	{
		oField.style.height = oField.scrollHeight + "px";
	}
	  }
	  
	  
	static cancel_view(id,cancel_button){
		if(id != null || id != undefined){
		  let view_area = document.querySelector("#view_area_" +id);
		   if(view_area != null && view_area != undefined){
			   view_area.value = "";
			 view_area.style.height = "35px";
			
			 let parent = cancel_button.parentNode;
			   parent.parentNode.style.display = "none";
			  $(cancel_button).hide();
			$(cancel_button.nextSibling.nextSibling).hide();

			 

		   }
		 }
	}
	
	
}
  


