  class view{
	  
	 // define the constructor of the class
	  constructor (){
		  this.commentUrl = "../private/neutral_ajax.php";
	  }
	  
	// on a view area change  
	static view_area_change(element) {
		 // set the viewBoxParent  
		let commentBoxParent = $(element).parents()[2];
		  // check to see if it has child nodes
		  if (commentBoxParent.hasChildNodes()) {
		// set the children to a variable	  
        let  children = commentBoxParent.childNodes;
         // out of the children set the post actions grand parent. children includes loading gif, clear and post button
        let post_actions_gr_parent = children[3]
		 // show the post actions grand parent
        $(post_actions_gr_parent).show();
		
		// set the post actions parent
		let post_actions_parent = post_actions_gr_parent.childNodes[3];
	
		 // show the parent
        $(post_actions_parent).show();
		// show the post actions themselves
		$(post_actions_parent.childNodes).show();
		// enable the post button
		post_actions_parent.childNodes[3].disabled = false;
		
  }
	  }// view_area_change();
	  
	// auto grow a text field
	static  autoGrow(oField){
		// if the scroll height is > than the clientHeight  
	if(oField.scrollHeight > oField.clientHeight)
	{
		// update the height of the input text field in px;
		oField.style.height = oField.scrollHeight + "px";
	}
	  }// autGrow();
	  
	  
	  
	  // clear/cancel a view
	static cancel_view(id,cancel_button){
		
		if(id != null || id != undefined){
		  // set the textarea
		let view_area = document.querySelector("#view_area_" +id);
		  
		if(view_area != null && view_area != undefined){
			   // reset the text of the textarea 
			   view_area.value = "";
			   // reset the height of the textarea
			 view_area.style.height = "35px";
			 // set the parent of the cancel and post buttons
		let parent = cancel_button.parentNode;
			 // hide the parent of both the cancel and post button
			   parent.parentNode.style.display = "none";
			   // hide the cancel button
			  $(cancel_button).hide();
			  // set the post button
		let post_button = cancel_button.nextSibling.nextSibling;
			// hide the post button
			$(post_button).hide();
			

			 

		   }
		 }
	}
	
	// post a view
    static post_view(post_id,post_button){
		
		// set the text area
		let view_area = document.querySelector("#view_area_" +post_id);
		// get the view from the text area
		let real_view = view_area.value;
		   
        if($.trim($(real_view)) != ""){
	  	$.ajax({
	  		 url: "../private/neutral_ajax.php",
			data: {comment:real_view,post_id : post_id,add_comment : true},
			type: "POST",
	  		datatype:"html",
			}).done(function(response){
			//commentboxParent.id = response;
			console.log(response);
			 }).fail(function (error){
				 alert(error);
			 });

	}
		
	}	
	
	
}
  


