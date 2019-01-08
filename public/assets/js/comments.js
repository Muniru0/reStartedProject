  class comment{
	  
	 // define the constructor of the class
	  constructor (){
		  this.commentUrl = "../private/neutral_ajax.php";
		 
	  }
	  
	// just for debugging
    static nodes_and_indeces(element){


	  	 for(var index = 0; index < element.length ; index++){
		    	console.log(i);

		    	console.log(element[index]);
		    }  
	  }



	static on_text_field_change(element){

     let root = $("#comment_template")[0];

let second  =  $(root).find(".actaction-delete")[0];
console.log(second);







		return;
		// set the root parent of the element
		let rootParent ;
		if($(element).parents()[2]){
			rootParent = $(element).parents()[2];
		} 
		
		// set the parent of the event element
       let parent ; 
        if($(rootParent).find(".ps-comment-send")){
                parent  =  $(rootParent).find(".ps-comment-send")[0];
                // show the parent of the psot actions buttons
                $(parent).show();
               
              
             }

      //  set the post actions buttons
        let postActionWrapper ;
        if(parent.hasChildNodes() &&  $(parent).find(".ps-comment-actions")[0]){
        	  postActionWrapper = $(parent).find(".ps-comment-actions")[0];
  
        $(postActionWrapper).show();
        
        	 
        	
       }



	 if(element.value.length  > 3999){

	 	// hide the parent element
	 	$(parent).hide();
	 	// hide the post actions Wrapper
	 	$(postActionWrapper).hide()
           	alert("Please MAX characters for a comment is 4000.");
      
      }
		
 // }

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
		    // define the temporary variable for the grandParent
			let grandParent;

        if($(cancel_button).parents()[1]){
			
			grandParent = $(cancel_button).parents()[1];
			$(grandParent).hide();
		}		   
		// define the temporary variable for the parent 
	     let parent;
		if($(grandParent).find(".ps-comment-actions")){
			let parent = $(grandParent).find(".ps-comment-actions")[0];
			$(parent).hide();
		}

			 

		} 
		 }
	}//cancel_comment();
	
	// post a comment
    static post_comment(post_id,post_button){
		
		// set the text area
		let comment_area = document.querySelector("#comment_area_" +post_id);
		comment_area.disabled = true;
		// get the comment from the text area
		let comment_value = comment_area.value;
   // return fast if the comment is an empty string	
	if($.trim(comment_value) === ""){	
     return ;
	}
		// reset the comment_area
		comment_area.value = "";  
		// reset the height of the textarea
		comment_area.style.height = "35px";
		
		// set the grandParent of the post actions
		let grandParent;

        if($(post_button).parents()[1]){
			
			grandParent = $(post_button).parents()[1];
		// show the grandParent of the post actions
			$(grandParent).hide();
		}	
		
		// define the temporary variable for the parent 
	     let parent;
		if(grandParent.hasChildNodes() && $(grandParent).find(".ps-comment-actions")){
		let parent = $(grandParent).find(".ps-comment-actions")[0];
		// hide the post actions
		    $(parent).hide();
		}
		
		// show the loadinGif
		let loadinGif = $(grandParent).first()
		loadinGif.show();
		
        
			
				 
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
			 	 $(grandParent).hide();
				 // hide the post actions parent
				 $(parent).hide();
				 // hide the post loading gif
				 $(loadinGif).hide();
			 	  // re-enable the textarea
			 	  comment_area.disabled = false; 
				  
			 }).fail(function (error){
				 alert(error);
			 });

			 
			
			 
	
		
	}	
	
    // delete a comment
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
	
    // edit a comment
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
	
	// if the reply field has a change
	static on_reply_field_change(comment_Id,element){
		   if(element.value.length > 4000){
		  	 	alert("Please MAX characters for a comment is 4000.");
		  	 return ;
		  }

		let root_parent = $(element).parents()[2];
		     console.log(root_parent.getElementsByClassName("ps-comment-send"));
		    let children = root_parent.childNodes;
		   // comment.nodes_and_indeces(children);
		   let post_actions_parent = children[5]; 
		     console.log(post_actions_parent)
		   $(post_actions_parent).show();
		   let post_actions = post_actions_parent.childNodes;
		  
// 		       comment.nodes_and_indeces(post_actions);
		    // show the parent the post actions 
		   $(post_actions[3]).show();

         }
		 
	
	
	// reply to a comment
	static reply_comment(){}
	
	// cancel reply 
	static cancel_reply(element){
		$()
	}
	
	// delete the comment reply
	static delete_reply(){}
	
	// edit the comment reply
	static edit_reply(){}
	
	
	}
  


