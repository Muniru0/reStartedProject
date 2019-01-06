  class comment{
	  
	 // define the constructor of the class
	  constructor (){
		  this.commentUrl = "../private/neutral_ajax.php";
		 
	  }
	  
	  // just for debugging

	  static nodes_and_indeces(element){

	  	 for(int index = 0; index < element.length ; index++){
		    	console.log(i);
		    	console.log(element[index]);
		    } 
	  }

	  

	// on a comment area change  
	static comment_field_change(element){
		// set the commentBoxParent  
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
	
		 if(element.value.length  > 3999){
           	alert("Please MAX characters for a comment is 4000.");
          // hide the post actions grand parents 	
        $(post_actions_gr_parent).hide();
		  // hide the parent
        $(post_actions_parent).hide();
		// hide the post actions themselves
		$(post_actions_parent.childNodes).hide();
           	
           }
		
  }
	  }// comment_area_change();
	  
	// auto grow a text field
	static  autoGrow(oField){
		// if the scroll height is > than the clientHeight  
	if(oField.scrollHeight > oField.clientHeight)
	{
		// update the height of the input text field in px;
		oField.style.height = oField.scrollHeight + "px";
	}
	  }// autGrow();
	  
	  
	  
	  // clear/cancel a comment
	static cancel_comment(id,cancel_button){
		
		if(id != null || id != undefined){
		  // set the textarea
	     let comment_area = document.querySelector("#comment_area_" +id);
		 
		 // hide the loading gif if it is present
		  let post_actions_gr_parent = $(cancel_button).parents()[1];
		let loadinGif = post_actions_gr_parent.childNodes[1];
		    loadinGif.style.display = "none";
		if(comment_area != null && comment_area != undefined){
			   // reset the text of the textarea 
			   comment_area.value = "";
			   // reset the height of the textarea
			 comment_area.style.height = "35px";
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
	
	// post a comment
    static write_comment(post_id,post_button){
		
		// set the text area
		let comment_area = document.querySelector("#comment_area_" +post_id);
		comment_area.disabled = true;
		// get the comment from the text area
		let comment_value = comment_area.value;
		// reset the comment_area
		comment_area.value = "";  
		// reset the height of the textarea
		comment_area.style.height = "35px";
		$(post_button).hide();
		$(post_button.previousSibling.previousSibling).hide();
		 let post_actions_gr_parent = $(post_button).parents()[1];
		let loadinGif = post_actions_gr_parent.childNodes[1];
		    loadinGif.style.display = "block";

        if($.trim(comment_value) != ""){
			
				 
			 //  post a new comment
	  	$.ajax({
	  		 url: "../private/neutral_ajax.php",
			data: {comment:comment_value,post_id : post_id,add_comment : true},
			type: "POST",
	  		datatype:"html",
			}).done(function(response){ 
				   response = JSON.parse(response);
				 
				    let comment_template = document.querySelector("#comment_template");
		                comment_template = comment_template.cloneNode(true);
                         comment_template.id = response["true"];
		                let user = $(comment_template).find(".ps-comment-user")[0];
		                $(user).html(response["fullname"]);
		               let time  =  $(comment_template).find(".ps-js-autotime")[0];
		               $(time).attr("title",response["comment_date"]);
		                
		                $(time).html(response["comment_info"][4]);
		               
				    let comment = $(comment_template).find("p");
				        comment.html(response["comment_info"][3]);
				   // find the comments list
				    let comments_list_children = document.querySelector("#cmt-list-10").childNodes;  
				    let comments_container = comments_list_children[1];
				    
				    // append the comment to the comments_container 
				 $(comments_container).append(comment_template);  
			      // hide the post actions grand parent
			 	  post_actions_gr_parent.style.display = "none";
			 	  // re-enable the textarea
			 	  comment_area.disabled = false;  
			 	  // hide the loading gif
		           loadinGif.style.display = "none";
				  
			
		 }).fail(function (error){
				 alert(error);
			 });

			 
			
			 
	}
		
	}	
	

	static delete_comment(post_Id,comment_Id){

		 $("#delete-dialog").dialog({
                       
					    classes :{
							"ui-dialog" : "center-delete-text",
							
						},
                        show: {effect: "scale", duration: 50},
                        hide: {effect: "fadeOut", duration: 50},
						title: "Delete Comment",
                        draggable: false,
						width: 350,
                        height: 150,
                        maxHeight: 100,
                        minHeight: 100,
                        modal: true,
                        minWidth: 200,
                        resizable: false,
                        closeOnEscape: true,
                        buttons: [
                            {
                                text: "Cancel",
                                click: function () {
                                    $(this).dialog("close");
									console.log("canceled the deletion of the comment");
                                }

                            },
							  {
                                text: "Delete",
                                click: function () {
                                    $(this).dialog("close");
                                    
							//validate the comment id
								if(comment_Id == null || 
								comment_Id == 0 ||
								comment_Id == undefined ||
								comment_Id == NaN ||
								comment_Id == false){
								return false;	
								}
								// hide the comment until the response from the server is positive
								let hidden_comment = document.querySelector("#comment-item-" + comment_Id);
								hidden_comment.style.display = "none";
							
								$.ajax({
									url      : "../private/neutral_ajax.php",
									type     : "POST",
									data     : {post_id : post_Id,comment_id :comment_Id,delete_comment : true},
									datatype : "html"
								}).done(function(response){
									 response = JSON.parse(response);
									
									
							    if(response[0] == "true"){

							    	//now you can remove the comment from the dom
							    	hidden_comment.remove();
							    	
							    }else{
							    	hidden_comment.style.display = "block";
							    	alert(response["false"]);
							    	}
								}).fail(function(error){
									 alert(error);
								});// end of ajax request
								
                                }// click : function();

                            }// button delete
                        ]// buttons of ui-dialog
                    });// dialog instantiation

                    $('.ui-dialog-titlebar').addClass("error-titlebar");
                    $(".ui-dialog-title").addClass("error-title");
                  $("#error-dialog").show();
		
		


	}
	

	static edit_comment(post_Id,comment_Id,element){
		
		         
		//validate the comment id
		if(comment_Id == null || 
		comment_Id == 0 ||
		comment_Id == undefined ||
		comment_Id == NaN ||
		comment_Id == false){
			
		return false;	
		}
		
		let comment_div = document.querySelector("#comment-item-" + comment_Id);
		 let comment_pargh = $(comment_div).find("p")[0];
		
		  let new_comment = $(comment_pargh).html();
		  
		  $("#comment_area_" + post_Id).val(new_comment);
		 let new_event = new Event('input',{'bubbles': true, cancelable: true});
		     document.querySelector("#comment_area_" + post_Id).dispatchEvent(new_event);

		 document.querySelector("#comment_area_" + post_Id).oninput = function(){
				   comment.comment_field_change("#comment_area_" + post_Id);
				   
			   }; 
		     
		       return;
		     
		$.ajax({
		url      : "../private/neutral_ajax.php",
		type     : "POST",
		data     : {post_id : post_Id,comment_id :comment_Id,comment: new_comment,edit_comment : true},
		datatype : "html"
		}).done(function(response){
		response = JSON.parse(response);
		if(response["true"]){
			 $(comment_pargh).html(new_comment);
        // change the html of the comment
		}else{
		
	alert(response["false"]);
		}
		  }).fail(function(error){
		 alert(error);
		 });
								
		
		
	}
	
	
	
	// Comment replys section
	
	// if the reply field has a change
	static on_reply_field_change(element){
		let root_parent =$(element).parents()[2];
		    let children = root_parent.childNodes;
		    comment.nodes_and_indeces(children);
		   
	}
	
	// reply to a comment
	static reply_comment(){}
	
	// cancel reply 
	static cancel_reply(){}
	
	// delete the comment reply
	static delete_reply(){}
	
	// edit the comment reply
	static edit_reply(){}
	
	
	}
  


