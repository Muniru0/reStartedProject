  class view{
	  
	 // define the constructor of the class
	  constructor (){
		  this.commentUrl = "../private/neutral_ajax.php";
		 
	  }
	  
	// on a view area change  
	static view_area_change(element){
		
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
	
		 if(element.value.length  > 4000){
           	alert("Please MAX characters for a comment is 4000.");
          // hide the post actions grand parents 	
        $(post_actions_gr_parent).hide();
		  // hide the parent
        $(post_actions_parent).hide();
		// hide the post actions themselves
		$(post_actions_parent.childNodes).hide();
           	
           }
		
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
		 
		 // hide the loading gif if it is present
		  let post_actions_gr_parent = $(cancel_button).parents()[1];
		let loadinGif = post_actions_gr_parent.childNodes[1];
		    loadinGif.style.display = "none";
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
		view_area.disabled = true;
		// get the view from the text area
		let real_view = view_area.value;
		// reset the view_area
		view_area.value = "";  
		// reset the height of the textarea
		view_area.style.height = "35px";
		$(post_button).hide();
		$(post_button.previousSibling.previousSibling).hide();
		 let post_actions_gr_parent = $(post_button).parents()[1];
		let loadinGif = post_actions_gr_parent.childNodes[1];
		    loadinGif.style.display = "block";

        if($.trim(real_view) != ""){
	  	$.ajax({
	  		 url: "../private/neutral_ajax.php",
			data: {comment:real_view,post_id : post_id,add_comment : true},
			type: "POST",
	  		datatype:"html",
			}).done(function(response){  console.log(response);
				   response = JSON.parse(response);
				 
				    let view_template = document.querySelector("#view_template");
		                view_template = view_template.cloneNode(true);
                         view_template.id = response["true"];
		                let user = $(view_template).find(".ps-comment-user")[0];
		                $(user).html(response["fullname"]);
		               let time  =  $(view_template).find(".ps-js-autotime")[0];
		               $(time).attr("title",response["comment_date"]);
		                
		                $(time).html(response["comment_info"][4]);
		               
				    let view = $(view_template).find("p");
				        view.html(response["comment_info"][3]);
				   // find the views list
				    let views_list_children = document.querySelector("#cmt-list-10").childNodes;  
				    let views_container = views_list_children[1];
				    
				    // append the view to the views_container 
				 $(views_container).append(view_template);  
			      // hide the post actions grand parent
			 	  post_actions_gr_parent.style.display = "none";
			 	  // re-enable the textarea
			 	  view_area.disabled = false;  
			 	  // hide the loading gif
		           loadinGif.style.display = "none";
				  
			
		 }).fail(function (error){
				 alert(error);
			 });

			 
			 
	}
		
	}	
	
	
}
  


