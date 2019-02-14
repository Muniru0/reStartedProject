

 class comment{
	  
	 // define the constructor of the class
	  constructor (){
		  this.commentUrl = "../private/neutral_ajax.php";
		  this.returnedArray;
		 
	  }
	
	
	  
	  
	// just for debugging
    static nodes_and_indeces(element){


	  	 for(var index = 0; index < element.length ; index++){
		    	console.log(i);

		    	console.log(element[index]);
		    }  
	  }

   
  // helper static method for showing the replyBox
  static showReplyBox(commentID = 0){
	
      commentID = commentID.valueOf();
		 if(typeof commentID !== "number"  || commentID < 0 || commentID == null || commentID == undefined || $.trim(commentID) == "" ){
			
			 return;
		 }
		 
		
		 // show the reply_area
		 $("#reply_area_wrapper_" + commentID).toggle();
		 
		
	}// showReplyBox();

	
    // prepare the comment or reply text for the ajax request
    static prepare_text(element_id,post_button,option,toggleElement){

          let grandParent;
          let parent;
          let loadinGif;
          let comment_area;
          let textArea = "";
	      let returnedArray = [];
	      
			switch($.trim(option)){
           	   case "comment" :
           	   if(document.querySelector("#comment_area_" + element_id)){
           	   	textArea = document.querySelector("#comment_area_" + element_id);
           	   }
           	   break;
           	  case "reply" :
           	   if(document.querySelector("#reply_area_" + element_id)){
				  
           	   	textArea = document.querySelector("#reply_area_" + element_id);
           	   }
           	   break;
           	   default : "";
           } 

            
        
          
     if($.trim(textArea) == ""){
               	return "";
               }
       textArea.disabled = true;
	    // add the textArea element to the returned Array
		returnedArray.push(textArea);
		// get the comment from the text area
   
		let comment_value = textArea.value;
		 returnedArray.push(comment_value); 
   // return fast if the comment is an empty string	
	if($.trim(comment_value) === ""){	
	
     return ;
	}
		// reset the comment_area
		textArea.value = "";  
		// reset the height of the textarea
		textArea.style.height = "35px";
		
		// initialize the grandParent
        if($(post_button).parents()[1]){
			 
			grandParent = $(post_button).parents()[1];
			returnedArray.push(grandParent); 
		// show the grandParent of the post actions
		//	$(grandParent).hide();
		}	
		
		// initialize temporary variable for the parent 
	     
		if(grandParent.hasChildNodes() && $(grandParent).find(".ps-comment-actions")){
		let parent = $(grandParent).find(".ps-comment-actions")[0];
		 returnedArray.push(parent);
		// hide the post actions
		    $(parent).hide();
		}
		
		// show the loadinGif
		loadinGif = $(grandParent).find(".ps-comment-loading")[0];
		 returnedArray.push(loadinGif);
		 $(loadinGif).show();
		
		
	return returnedArray;
      
}// prepare_text();

	
	
// on a comment area change  
	static on_text_field_change(element){


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
	  
	  
	

	// post a comment
    static post_comment(postID,post_button){
		
		let     returnedArray =  comment.prepare_text(postID,post_button,"comment",true);
	    let 	comment_value = returnedArray[1];
		 
        //  post a new comment
	  	$.ajax({
	  		 url: "../private/neutral_ajax.php",
			data: {comment:comment_value,post_id : postID,add_comment : true},
			type: "POST",
	  		datatype:"html",
			}).done(function(response){ 
			   console.log(response);
			  try{
			   response = JSON.parse(response);
				
				    let comment_template = document.querySelector("#comment_template");
					     console.log(comment_template);
		                comment_template = comment_template.cloneNode(true);
                        comment_template.id = response["comment_div_id"];
                         $(comment_template).hide();
		                let user = $(comment_template).find(".ps-comment-user")[0];
		                $(user).html(response["fullname"]);
		               let time  =  $(comment_template).find(".ps-js-autotime")[0];
		               $(time).attr("title",response["comment_date"]);
		                
		                $(time).html(response["comment_info"][4]);

		               // set the text of the comment from the db
				    let db_comment = $(comment_template).find("p");
				        db_comment.html(response["comment_info"][3]);

						
/////////////////// SETUP THE VARIOUS LINKS OF THE                           			COMMENT(e.gedit,delete,reply)////////////////////		     				

	// set the delete variable
          let actionsLink = "";
   
   // edit the delete comment link
      if($(comment_template).find(".actaction-delete")[0]){
  	actionsLink = $(comment_template).find(".actaction-delete")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","comment.delete_comment("+ response["comment_info"][1] +","+ response["comment_info"][0] +"); return false;");
  }             

  // edit the reply to the comment link
      if($(comment_template).find(".actaction-reply")[0]){
  	actionsLink = $(comment_template).find(".actaction-reply")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","comment.showReplyBox("+ response["comment_info"][0] +"); return false;");
  }    
  
    // edit the delete comment link
      if($(comment_template).find(".actaction-edit")[0]){
  	actionsLink = $(comment_template).find(".actaction-edit")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","comment.prepare_edit_comment("+ response["comment_info"][1] +","+ response["comment_info"][0] +",this,'comment'); return false;");
      }     

        //set the reply template
	   let reply_template ;
	   let textAreaDiv;
	   let reply_container;
	   let textArea;
	   // set up the entire reply wall template
			if(document.querySelector("#reply_wall_template")){
				reply_template = document.querySelector("#reply_wall_template");
				console.log(reply_template);
				// clone the reply template
              reply_template = reply_template.cloneNode(true);	
			// set the id of the reply wall template div			  
           $(reply_template).attr("id","reply_wall_" + response["comment_info"][0]);  
		   
		    // find the replys container
	         if($(reply_template).find(".ps-comment-container")[0]){
			 // find the id of the replys container
	      reply_container =	$(reply_template).find(".ps-comment-container")[0];
		// set the id of the replys container
		   reply_container   =  $(reply_container).attr("id","reply_container_" + response["comment_info"][0]);
		   }
		   
		   //
		   if($(reply_template).find(".ps-comment-reply")[0]){
			   //find the entire div with the textarea, the reply post button and cancel button
            textAreaDiv  = $(reply_template).find(".ps-comment-reply")[0];
			 $(textAreaDiv).attr("id","comment_area_" + response["comment_info"][0]);
		   }
		   
		   // find the text area associated with the reply template
		      if($(reply_template).find("textarea")){
				textArea    = $(reply_template).find("textarea");
				// set the id of reply textarea
			$(textArea).attr("id","reply_area_" + response["comment_info"][0]);
			
			  }
			 
			}
	   
		  
     // edit the post reply  link
      if( $(reply_template).find(".ps-button-action")[0]){
  	actionsLink =  $(reply_template).find(".ps-button-action")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","comment.reply_comment("+ postID +","+ response["comment_info"][0] +",this); return false;");
      }     
  
  		  // edit the cancel reply  link
      if( $(reply_template).find(".ps-button-cancel")[0]){
  	actionsLink =  $(reply_template).find(".ps-button-cancel")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","comment.reply_cancel("+ postID + "," +response["comment_info"][0] + ",this); return false;");
      }     
        // give the reply text area an id
        $(textAreaDiv).attr("id","reply_area_wrapper_" + response["comment_info"][0]);
                 // find the comments list
 				let comments_container = document.querySelector("#comment_area_wrapper_" + postID); 
//  			    comments_container = $(comments_container).parent()[0];
//  				  console.log(comments_container);
		
            // append the comment to the comments_container 
			$(comments_container).before(comment_template);
            $(comments_container).before(reply_template);
			
			 $(comment_template).fadeIn(680);
            // hide the grandParent
			}catch(e){
				console.log(e);
				alert("Sorry it is our fault, but please try again.");
			}finally{
            //finally block
			 $(returnedArray[2]).hide();
			// hide the parent
			$(returnedArray[3]).hide();
			// hide the loadinGif
			$(returnedArray[4]).hide();
			returnedArray[0].disabled = false;
			}
			   
			 }).fail(function (error){
				 alert(error);
			 });

	}	
	
	
	
	// clear/cancel a comment
	static cancel_comment(postID,cancelButton){
		if(postID != null || postID != undefined){
		  // set the textarea
	     let comment_area = document.querySelector("#comment_area_" + postID);
		 
		 // hide the loading gif if it is present
		  let post_actions_gr_parent = $(cancelButton).parents()[1];
		let loadinGif = post_actions_gr_parent.childNodes[1];
		    loadinGif.style.display = "none";
		if(comment_area != null && comment_area != undefined){
			   // reset the text of the textarea 
			   comment_area.value = "";
			   // reset the height of the textarea
			 comment_area.style.height = "35px";
		    // define the temporary variable for the grandParent
			let grandParent;

        if($(cancelButton).parents()[1]){
			
			grandParent = $(cancelButton).parents()[1];
			$(grandParent).hide();
		}		   
		// define the temporary variable for the parent 
	     let parent;
		if($(grandParent).find(".ps-comment-actions")){
			let parent = $(grandParent).find(".ps-comment-actions")[0];
			$(parent).hide();
		}
		
		 // find the reset the onclick attribute of the post button
		 if($(cancelButton).siblings()[0]){
			 $(cancelButton).siblings().attr("onclick","return comment.post_comment(" + postID + ",this);");
		 }

			 

		} 
		 }
	}//cancel_comment();
	
	
	
    // delete a comment
	static delete_comment(postCommentID = 0,commentReplyID = 0,option = "comment"){
         
			  
		 
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
								if(commentReplyID == null || 
								commentReplyID == 0 ||
								commentReplyID == undefined ||
								commentReplyID == NaN ||
								commentReplyID == false){
								return false;	
								}


            				// define the various variables
								let hiddenReply;
								let hiddenComment;
								let requestType;
								let commentReplyAreaWrapper;
                        
    						// initialize the various variables in the case of a comment
								if($.trim(option) === "comment"){
								
								// hide the comment until the response from the server is positive
                                
								// find the comment to be deleted and hide it
if(document.querySelector("#new_comment_" + commentReplyID)  != null  && document.querySelector("#new_comment_" + commentReplyID)){
								hiddenComment = document.querySelector("#new_comment_" + commentReplyID);
								$(hiddenComment).fadeOut(600);
								
								}
								
								// find the reply to be deleted and hide it
								if(document.querySelector("#reply_wall_" + commentReplyID)  != null  && document.querySelector("#reply_wall_" + commentReplyID)){
								hiddenReply = document.querySelector("#reply_wall_" + commentReplyID);
								$(hiddenReply).fadeOut(600);
								requestType = "comment";

    				
					// find and initialize the comment  text area wrapper and empty the text area if there are any text in it 
					if($(commentReplyAreaWrapper) && $("#comment_area_wrapper_" + postCommentID)[0] != undefined){
					commentReplyAreaWrapper = $("#comment_area_wrapper_" + postCommentID);
					let commentReplyArea = $(commentReplyAreaWrapper).find("textarea")[0];
					  $(commentReplyArea).val("");
					 
                    
				  // find, initialize and hide  the post actions grandParent 
					 if($(commentReplyAreaWrapper) && $(commentReplyAreaWrapper).find(".ps-comment-send")[0]){
					 	commentReplyAreaWrapper = $(commentReplyAreaWrapper).find(".ps-comment-send")[0];
					 	$(commentReplyAreaWrapper).hide();
					 	 
					 }
					 
					  // find, initialize and hide  the post actions wrapper 
					 if($(commentReplyAreaWrapper) && $(commentReplyAreaWrapper).find(".ps-comment-actions")[0]){
					 	commentReplyAreaWrapper = $(commentReplyAreaWrapper).find(".ps-comment-actions")[0];
					 	$(commentReplyAreaWrapper).show();
					 }
					

                    }
								}
								
							// initialize the various variables in the case of a reply
								}else if($.trim(option) === "reply"){
                                // find the comment to be deleted and hide it
								if(document.querySelector("#new_reply_" + commentReplyID)  != null  && document.querySelector("#new_reply_" + commentReplyID)){
								hiddenReply = document.querySelector("#new_reply_" + commentReplyID);
								hiddenReply.style.display = "none";
								requestType = "reply";
 						
 						}
 						

 							// find and initialize the comment  text area wrapper and empty the text area if there are any text in it 
					if($(commentReplyAreaWrapper) && $("#reply_area_wrapper_" + postCommentID)[0] != undefined){
					commentReplyAreaWrapper = $("#reply_area_wrapper_" + postCommentID);
					 commentReplyAreaWrapper = $(commentReplyAreaWrapper).find("textarea")[0];
					  $(commentReplyAreaWrapper).val("");
					
  
				  // find, initialize and hide  the post actions grandParent 
					 if($(commentReplyAreaWrapper) && $(commentReplyAreaWrapper).find(".ps-comment-send")[0]){
					 	commentReplyAreaWrapper = $(commentReplyAreaWrapper).find(".ps-comment-send")[0];
					 	$(commentReplyAreaWrapper).hide();
					 }
					 
					  // find, initialize and hide  the post actions wrapper 
					 if($(commentReplyAreaWrapper) && $(commentReplyAreaWrapper).find(".ps-comment-actions")[0]){
					 	commentReplyAreaWrapper = $(commentReplyAreaWrapper).find(".ps-comment-actions")[0];
					 	$(commentReplyAreaWrapper).show();
					 }
					
								}
								}
								
								
								$.ajax({
									url      : "../private/neutral_ajax.php",
									type     : "POST",
									data     : {post_id : postCommentID,comment_id :commentReplyID,delete_comment : requestType},
									datatype : "html"
								}).done(function(response){
									
								// parse the json response	
								try{
							   response = JSON.parse(response);
							  
            					   if(response[0] === true){
									if($.trim(option) === "comment"){
                          			//now you can remove the comment from the DOM
							    	hiddenComment.remove();
									$(hiddenComment).next().remove();
								// now remove the reply from the DOM	
									 }else if($.trim(option) === "reply"){
                                   	 $(hiddenReply).remove();
                                   	  
                                   }
							    	
							    }else if(response["false"] != undefined && response["false"] != ""){
  							$(hiddenComment).fadeIn(680);
							$(hiddenReply).fadeIn(680);
							setTimeout(function (){
								 alert(response["false"]);
							},1000);
                             console.log("error from server");
							
							    }

							   }catch(e){
							 $(hiddenComment).fadeIn(680);
							$(hiddenReply).fadeIn(680);
							setTimeout(function (){
                       alert("Something unexpectedly happend, Please refresh the page and try again");
         					},800);
         				}
							    	
								}).fail(function(error){
									 setTimeout(function(){
									 alert(error);
									  },800);
								});// end of ajax request
								
                                }// click : function();

                            }// button delete
                        ]// buttons of ui-dialog
                    });// dialog instantiation

                    $('.ui-dialog-titlebar').addClass("error-titlebar");
                    $(".ui-dialog-title").addClass("error-title");
                  $("#error-dialog").show();
		

	}
	
     static edit_comment(postCommentID = 0,commentReplyID = 0,element = "",option = "comment"){
	
		
     		//validate the comment id
		if(commentReplyID == null || 
		commentReplyID == 0 ||
		commentReplyID == undefined ||
		commentReplyID == NaN ||
		commentReplyID == false||
		postCommentID == null || 
		postCommentID == 0 ||
		postCommentID == undefined ||
		postCommentID == NaN ||
		postCommentID == false ||
        element == null || 
		element == 0 ||
		element == undefined ||
		element == NaN ||
		element == false ||
		$.trim(element) == "" ||
		option == null || 
		option == 0 ||
		option == undefined ||
		option == NaN ||
		option == false ||
		$.trim(option) == ""
		){
			
		return false;	
		}

         // define a temporal variable for the comment area
        let textArea;
       
        // define a temporal variable for the old comment
        let newComment;
       
        // define a temporal variable for the edit button
        let editButton;
       
        // define a temporal variable for the grand parent of
        // the post button
        let grandParent;
       
        //  define a temporal variable for the loading gif
        let loadinGif;
      
       // define a temporal variable for the comment outer wrapper
        let commentOuterWrapper;
      
       //  define a temporal variable for the comment paragraph
       let commentParagraph; 
       
        //  define a temporal variable for the post actions buttons
       let parent; 
        
        //  define a temporal variable for the buttons wrapper
       let buttonsWrapper; 

        //  define a temporal variable for the post buttons
       let postButton;

        //  define a temporal variable for the comment outer div
       let oldCommentOuterDiv; 
       
	   // define a temporal variable for the to be sent to the server for determining
	   // if the line request is to edit a comment or reply
	   let requestType;
	   
	   // define a temporal variable for the post Button Onclick Attribute
	   let postButtonOnclickAttr;
       
          // check and initialize the text area variable for both the reply and comments 
      // find the text area associated with the comments  or replys
		   switch(option){

		    // find the text area for the comment
		     case "comment" :
		     if($("#comment_area_" + postCommentID)[0]){
		     	 
		     	 textArea = $("#comment_area_" + postCommentID)[0];
		     	
				 // set the request type to be an edit comment
				 requestType = "true";
				 // set the post button onclick attribute
				postButtonOnclickAttr = "return comment.post_comment(" + postCommentID + ",this);";
        
				// find an hide the old comment outer div to be able to fade it in
					if($(commentOuterWrapper) && $("#new_comment_" + commentReplyID)[0] != undefined){
					// find and initialize the comment outer wrapper ;
                     commentOuterWrapper = $("#new_comment_" + commentReplyID);
                   
						}
					
				 
		     }
		      break;

             // find the text area for the reply
		     case "reply" :
		     if($("#reply_area_" + postCommentID)[0]){
		     	 
		     	textArea = $("#reply_area_" + postCommentID)[0];
				 // set the request type to be an edit reply
				 requestType = "false";
				 
				// find an hide the old comment outer div to be able to fade it in
					if($(commentOuterWrapper) && $("#new_reply_" + commentReplyID) != undefined){
					// find and initialize the comment outer wrapper ;
                     commentOuterWrapper = $("#new_reply_" + commentReplyID);

					}else{
						
						return;
					}
					
		     	
		     }
		      break;

		      default : "" ;
		   }



        // set the value of the old comment  
    if($.trim(textArea) != undefined 
    && $(textArea) != null 
    && $(textArea) != "" 
    && $(textArea).val() != ""){
    	newComment = $(textArea).val();
    }
  
     // check and initialize the grandParent of the post button
    if($(textArea) && $(textArea).parents()[2]){
    	grandParent =  $(textArea).parents()[2];
    }
       // check and initialize the loading gif 
    if($.trim(grandParent) != undefined &&
     $.trim(grandParent) != null && 
     $.trim(grandParent) != "" && 
     $(grandParent).find(".ps-comment-loading")[0]){
    	loadinGif = $(grandParent).find(".ps-comment-loading")[0] ;
    	// show the loading gif while the request is sent to the server
    	$(loadinGif).show();
    }

    
// find an hide the old comment outer div to be able to fade it in
    if($(commentOuterWrapper) && $.trim(commentOuterWrapper) != ""){
    // find and initialize the comment outer wrapper ;
	
    	$(commentOuterWrapper).fadeOut(200);
    	
    	

    }
  

   $.ajax({
		url      : "../private/neutral_ajax.php",
		type     : "POST",
		data     : {post_id : postCommentID,comment_id :commentReplyID,comment : newComment,edit_comment : requestType},
		datatype : "html"
		}).done(function(response){
			console.log(response);
	  try {
		response = JSON.parse(response);
		if(response["true"] && $.trim(response["true"] != "")){
		
		 $(textArea).val("");
		// find and initialize the comment paragraph
	   commentParagraph =	$(commentOuterWrapper).find("p")[0];
	   $(commentParagraph).html(response["true"]);
	  
	   // fade the new comment outer div in
	   $(commentOuterWrapper).fadeIn(1200);
		}else if(response["false"] && response["false"] != ""){
			setTimeout(function(){

	alert(response["false"]);
		
	   },500);
		
		}
		}catch(e){
			 alert("Something happened Unexpectedly... Please refresh the page an dtry again");
		}
		finally{
	    // check and initialize the grandParent of the post button
    if($(grandParent) && $(grandParent).find(".ps-comment-send")[0]){
    	parent = $(grandParent).find(".ps-comment-send")[0];
    	$(parent).hide();
    }
    
      
     // check and initialize the wrapper of the post button
    if($(grandParent) &&  $(grandParent).find(".ps-comment-actions")[0]){
    	buttonsWrapper =   $(grandParent).find(".ps-comment-actions")[0];
    	$(buttonsWrapper).hide();
    }
	
	  // hide the loading gif
	  $(loadinGif).hide();
	  
	  //  find and hide the button
	  if($(grandParent).find(".ps-button-action")[0]){
    	postButton = $(grandParent).find(".ps-button-action")[0];

	    if($.trim(option) == 'reply'){
 		let postID = $(grandParent).find(".ps-button-cancel")[0];
	   postID = $(postID).attr("onclick");
	   postID = postID.split("(");
	    postID = postID[1].split(",");
	    postID = postID[0];
	    // set the post button onclick attribute for a reply
	    $(postButton).attr("onclick","return comment.reply_comment("+ postID +","+postCommentID+",this);");
	    }else{
	    	// set the onclick attribute of the post comment button
	    	$(postButton).attr("onclick",postButtonOnclickAttr);
	    }     
	  
    	
    	
    }
	    if(textArea){
	    	// reset the height of the height of the text area
	    	$(textArea).height(35);

	    	textArea.style.height = "35px";
	    }


		 // hide the loading gif
	  $(loadinGif).hide();
	   }
	 
		  }).fail(function(error){
		 alert(error);
		 });
		
     }

   // edit a comment
	static prepare_edit_comment(postCommentID = 0,commentReplyID = 0,element = "",option = "comment"){
		
		           
		//validate the comment id
		if(commentReplyID == null || 
		commentReplyID == 0 ||
		commentReplyID == undefined ||
		commentReplyID == NaN ||
		commentReplyID == false ||
		postCommentID == null || 
		postCommentID == 0 ||
		postCommentID == undefined ||
		postCommentID == NaN ||
		postCommentID == false){
			
		return false;	
		}
		
		
		let commentDiv = "";
		let commentPargh;
		let oldComment;
		let commentArea;
		let textAreaParent;
		let buttonsGrParent; 
		let buttonsWrapper;
		let postButton;
	    let reply_area_wrapper; 

	   switch(option){
	   	   case "comment" :
	   	   if( document.querySelector("#new_comment_" + commentReplyID)){
	   	   	
	   	   commentDiv = document.querySelector("#new_comment_" + commentReplyID);

	   	   }
	   	   break;

 	   	   case "reply"  :
 			 if( document.querySelector("#new_reply_" + commentReplyID)){
	   	   	
	   	   commentDiv = document.querySelector("#new_reply_" + commentReplyID);
	   	     

	   	   }
	   	   // show or hide the reply area wrapper when the edit reply
	   	   // link is clicked
	   	     if($("#reply_area_wrapper_" + postCommentID)[0]){
            reply_area_wrapper =  $("#reply_area_wrapper_" + postCommentID)[0];
               $(reply_area_wrapper).show();

	   	     }
	   	     

 			default : "";
	   	  
	   }
	  
		if(commentDiv){
		// find the entire div of the comment to edit
	if($(commentDiv).find("p")[0]){
		   // find the paragraph associated with the div with the comment text
		 commentPargh = $(commentDiv).find("p")[0];

				if( $(commentPargh).html()){
			   // set the new comment to a temporal variable
		oldComment = $(commentPargh).html();
		
		     // push the old comment into the returnedArray;
            		 

				}
		   }
		}
		
  // find the text area associated with the comments  or replys
		   switch(option){
		    // find the text area for the comment
		     case "comment" :
		     if($("#comment_area_" + postCommentID)[0] && $.trim(oldComment) != ""){
		     	 
		     	 commentArea = $("#comment_area_" + postCommentID)[0];
		     }
		      break;

             // find the text area for the reply
		     case "reply" :
		     if($("#reply_area_" + postCommentID)[0] && $.trim(oldComment) != ""){
		     	 
		     	 commentArea = $("#reply_area_" + postCommentID)[0];
		     	
		     }
		      break;

		      default : "" ;
		   }
	  
         
		if($(commentArea) && $.trim(commentArea) != "" && $.trim(oldComment) != ""){
			 // replace the line breaks in the string with empty string
			// oldComment = utility.replaceString("<br>","", oldComment);
		  // populate the text area with the old comment			
		$(commentArea).val(oldComment);	
		 $(commentArea).trigger("paste");
		
		$(commentArea).trigger("keydown");
		  $(commentArea).focus();
	    //find the parent of the text area and post action buttons
		   if($(commentArea).parents()[2]){
			// find and set the parent of the comment text area   
			    textAreaParent = $(commentArea).parents()[2];
			  // find and set the grand parent of the post action buttons		
			 if($(textAreaParent).find(".ps-comment-send")[0]){
				
             buttonsGrParent =  $(textAreaParent).find(".ps-comment-send")[0];
			 // show the grand parent
			 $(buttonsGrParent).show();
				 }
			
			 // find the children of the grand parent 
			 if(buttonsGrParent.hasChildNodes()){
				if($(buttonsGrParent).find(".ps-comment-actions")[0]){
			// set the child of the grand parent		
			buttonsWrapper  = $(buttonsGrParent).find(".ps-comment-actions")[0];
			// show the child of the grand parent
			$(buttonsWrapper).show(); 
			
              // find the post button
      if($(buttonsWrapper).find(".ps-button-action")[0]){
  	postButton = $(buttonsWrapper).find(".ps-button-action")[0];
	// per if the post button belongs is for a reply text area or comment
   //	adjust its onclick attribute accordingly
	if( $.trim(option) === "comment"){
		
	
  	$(postButton).attr("onclick","comment.edit_comment("+ postCommentID +","+ commentReplyID +",this,'comment'); return false;");
	}else if($.trim(option) === "reply"){
		
	$(postButton).attr("onclick","comment.edit_comment("+ postCommentID +","+ commentReplyID +",this,'reply'); return false;");
		
	}else{
	
	}
	}    
  
 

				   }
				   
				
			
			 }
				
		   }
       	
		
	}
	
	}
	
	
	
	// if the reply field has a change

	static reply_field_change(commentID = 0,textArea = ""){

		
		// max length check 
		   if(textArea.value.length > 4000){
		  	 	alert("Please MAX characters for a comment is 4000.");
		  	 return ;
		   }


		  // checks and validations 
		if(commentID == null || commentID == undefined ||
		commentID < 0  
		|| $.trim(textArea) == ""){
			
			return;
		}
		

		  // set the textarea
	    
         let grandParent;
		 let parent;
		
		
			
		
		// define and initialize the grandParent of the textArea
		if($(textArea) && $(textArea).parents()[2] ){
           
 			 grandParent = $(textArea).parents()[2];
			 grandParent = $(grandParent).find(".ps-comment-send")[0];
			 
			 $(grandParent).show();

		}
	
	    // define and initialize the parent of the textArea	
		 if($(".ps-comment-send")[0] &&  $(grandParent).find(".ps-comment-actions")[0]){
            parent  = $(grandParent).find(".ps-comment-actions")[0];
             
            $(parent).show();
		 }

		
	}// reply_field_change();



	// reply to a comment
	static reply_comment(postID,commentID,post_button){

		
		// return an array of all the relevant information
		let returnedArray =  comment.prepare_text(commentID,post_button,"reply",true);
		  if(returnedArray == [] || returnedArray == undefined || returnedArray == null){
          
		  	return;
		  }
		
		
			 //  post a new comment
	  	$.ajax({
	  		 url: "../private/neutral_ajax.php",
			data: {reply:returnedArray[1],comment_id : commentID,post_id : postID, reply_comment : true},
			type: "POST",
	  		datatype:"html",
			}).done(function(response){ 
                   console.log(response);
			  try{
			response = JSON.parse(response);
			
			 let comment_template = document.querySelector("#reply-items-template");
		                comment_template = comment_template.cloneNode(true);
		                
                        comment_template.id = response["new_reply_id"];

						$(comment_template).hide();

		                let user = $(comment_template).find(".ps-comment-user")[0];
		                $(user).html(response["fullname"]);
		               let time  =  $(comment_template).find(".ps-js-autotime")[0];
		               $(time).attr("title",response["reply_date"]);
		                
		                $(time).html(response["reply_time"]);
		               
		               // set the text of the comment from the db
				    let db_comment = $(comment_template).find("p");
				        db_comment.html(response["reply"]);

				   // set the action variable
          let actionLink = "";
   
   // find  adjust the onclick atrribute of the delete link in the reply
      if($(comment_template).find(".actaction-delete")[0]){
  	actionLink = $(comment_template).find(".actaction-delete")[0];
	// change the onclick attribute of the link 
  	$(actionLink).attr("onclick","comment.delete_comment("+ commentID +","+  response["reply_id"] +",'reply'); return false;");

  }     
   // find  adjust the onclick atrribute of the edit link in the reply
   if($(comment_template).find(".actaction-edit")[0]){
  	actionLink = $(comment_template).find(".actaction-edit")[0];
	// change the onclick attribute of the link 
  	$(actionLink).attr("onclick","comment.prepare_edit_comment("+ commentID +"," +  response["reply_id"] +",this,'reply'); return false;");

  }       


         
               // prepend the comment to the comments_container 
				 $("#reply_container_" + commentID).append(comment_template); 
                	  $(comment_template).fadeIn(680);			 
  } catch(e){
  	   setTimeout(function(){
		   
	  
     alert("Something Unexpectedly happened");
	  },680);
	}finally {
			  	
			  
               // hide the grandParent
			  $(returnedArray[2]).hide();
			  // hide the parent
			  $(returnedArray[3]).hide();
			  // hide the loadinGif
			  $(returnedArray[4]).hide();
			  returnedArray[0].disabled = false;
			  }  
		
			 }).fail(function (error){
				 alert(error);
			 });

			 
			
		
	}
	
	// cancel reply 

	static reply_cancel(postID,commentID,element){

		// check the validity of the postID		
		if(commentID != null && commentID != undefined && 
		commentID > 0  && $.trim(element) != "" && postID != null && postID != undefined && 
		postID > 0 ){
		  // set the textarea
	     let textArea;
         let grandParent;
          let parentWrapper;
		 let parent;
		 let loadinGif;
			textArea  =  document.querySelector("#reply_area_" + commentID);
		

		  if($(textArea)){
		  	$(textArea).css("height","35px");
			$(textArea).val("");
		  }

		
		// define and initialize the grandParent of the textArea
		if($(textArea) && $(textArea).parents()[2] ){
			 grandParent = $(textArea).parents()[2];
			 

		}
	
	 // define and initialize the parentWrapper of the textArea	
		 if($(grandParent).find(".ps-comment-send")[0]){
		 	parentWrapper = $(grandParent).find(".ps-comment-send")[0];
		 	   $(parentWrapper).hide();
            
		 }
		 
	    // define and initialize the parent of the textArea	
		 if( $(grandParent).find(".ps-comment-actions")[0]){
		 	
            parent  = $(grandParent).find(".ps-comment-actions")[0];
            
            $(parent).hide();
		 }
		 


		  // hide the loading gif if displayed
		if($(".ps-comment-loading")[0] && $(grandParent).find(".ps-comment-loading")[0] ){
		loadinGif = $(grandParent).find(".ps-comment-loading")[0];
		$(loadinGif).hide();
		}

		 // find the reset the onclick attribute of the post button
		 if($(element).siblings()[0]){
			 $(element).siblings().attr("onclick","return comment.reply_comment(" + postID + "," + commentID + ",this);");
		 }
		
	}
	}// cancel_reply();

	}
  



