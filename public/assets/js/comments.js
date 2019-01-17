
 function replaceString(oldS, newS, fullS) {
  return fullS.split(oldS).join(newS);
}



  function showReplyBox(commentID = 0){
	
      commentID = commentID.valueOf();
		 if(typeof commentID !== "number"  || commentID < 0 || commentID == null || commentID == undefined || $.trim(commentID) == "" ){
			
			 return;
		 }
		 
		
		 // show the reply_area
		 $("#reply_area_div_" + commentID).toggle();
		 
		
	}// showReplyBox();


 class comment{
	  
	 // define the constructor of the class
	  constructor (){
		  this.commentUrl = "../private/neutral_ajax.php";
		  this.returnedArray;
		 
	  }
	

	// auto grow a text field
	static  autoGrow(oField){
		// if the scroll height is > than the clientHeight  
	if(oField.scrollHeight > oField.clientHeight)
	{
		
		// update the height of the input text field in px;
		oField.style.height = oField.scrollHeight + "px";
	}else if(oField.clientHeight < oField.scrollHeight){
	    	// update the height of the input text field in px;
			
		oField.style.height = oField.clientHeight + "px";
	}
	  }// autGrow();
	  

	  
	  
	// just for debugging
    static nodes_and_indeces(element){


	  	 for(var index = 0; index < element.length ; index++){
		    	console.log(i);

		    	console.log(element[index]);
		    }  
	  }


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
			   response = JSON.parse(response);
				
				    let comment_template = document.querySelector("#comment_template");
					 
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
  	$(actionsLink).attr("onclick","comment.delete_comment("+ response["comment_info"][0] +","+ response["comment_info"][1] +"); return false;");
  }             

  // edit the reply to the comment link
      if($(comment_template).find(".actaction-reply")[0]){
  	actionsLink = $(comment_template).find(".actaction-reply")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","showReplyBox("+ response["comment_info"][0] +"); return false;");
  }    
  
    // edit the delete comment link
      if($(comment_template).find(".actaction-edit")[0]){
  	actionsLink = $(comment_template).find(".actaction-edit")[0];
	// change the onclick attribute of the link 
  	$(actionsLink).attr("onclick","comment.prepare_edit_comment("+ response["comment_info"][1] +","+ response["comment_info"][0] +",this); return false;");
      }     

        //set the reply template
	   let reply_template ;
	   let textAreaDiv;
	   let reply_container;
	   let textArea;
	   // set up the entire reply wall template
			if(document.querySelector("#reply_wall_template")){
				reply_template = document.querySelector("#reply_wall_template");
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
			 $(textAreaDiv).attr("id","reply_area_div_" + response["comment_info"][0]);
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
  	$(actionsLink).attr("onclick","comment.reply_cancel("+ response["comment_info"][0] + ",this); return false;");
      }     
        // give the reply text area an id
        $(textAreaDiv).attr("id","reply_area_div_" + response["comment_info"][0]);
                 // find the comments list
 				let comments_list_children = document.querySelector("#cmt-list-10").childNodes;  
				let comments_container = comments_list_children[1];
		
            // append the comment to the comments_container 
			$(comments_container).append(comment_template);
            $(comments_container).append(reply_template);
			
			 $(comment_template).fadeIn(680);
            // hide the grandParent
			 $(returnedArray[2]).hide();
			// hide the parent
			$(returnedArray[3]).hide();
			// hide the loadinGif
			$(returnedArray[4]).hide();
			returnedArray[0].disabled = false;
			   
			   
			 }).fail(function (error){
				 alert(error);
			 });

	}	
	
	
	
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
	
	
	
    // delete a comment
	static delete_comment(commentID,postID){
         
			  
		 
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
								if(commentID == null || 
								commentID == 0 ||
								commentID == undefined ||
								commentID == NaN ||
								commentID == false){
								return false;	
								}
								// hide the comment until the response from the server is positive

								let hiddenComment;
								// find the comment to be deleted and hide it
								if(document.querySelector("#new_comment_" + commentID)  != null  && document.querySelector("#new_comment_" + commentID)){
								hiddenComment = document.querySelector("#new_comment_" + commentID);
								hiddenComment.style.display = "none";
								}
								let hiddenReply;
								// find the comment to be deleted and hide it
								if(document.querySelector("#reply_wall_" + commentID)  != null  && document.querySelector("#reply_wall_" + commentID)){
								hiddenReply = document.querySelector("#reply_wall_" + commentID);
								hiddenReply.style.display = "none";
								}
								

								
								$.ajax({
									url      : "../private/neutral_ajax.php",
									type     : "POST",
									data     : {post_id : postID,comment_id :commentID,delete_comment : true},
									datatype : "html"
								}).done(function(response){
							   response = JSON.parse(response);
								if(response[0] === true){

							    	//now you can remove the comment from the dom
							    	hiddenComment.remove();
									$(hiddenComment).next().remove();
							    	
							    }else{
							    	hiddenComment.style.display = "block";
									hiddenReply.style.display = "block";
									setTimeout(function(){
										alert(response["false"]);
									},1000);
							    	
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
	
     static edit_comment(postID = 0,commentID = 0,element = ""){
		let commentInfo;
		
     		//validate the comment id
		if(commentID == null || 
		commentID == 0 ||
		commentID == undefined ||
		commentID == NaN ||
		commentID == false||
		postID == null || 
		postID == 0 ||
		postID == undefined ||
		postID == NaN ||
		postID == false){
			
		return false;	
		}
		
// 	  commentInfo      = comment.prepare_edit_comment(postID,commentID,element);
// 	    commentInfo['commentPargh'] = $(commentInfo['commentPargh']).html();
		$.ajax({
		url      : "../private/neutral_ajax.php",
		type     : "POST",
		data     : {post_id : postID,comment_id :commentID,comment: commentInfo['commentPargh'],edit_comment : true},
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

   // edit a comment
	static prepare_edit_comment(postID = 0,commentID = 0,element = ""){
		
		           
		//validate the comment id
		if(commentID == null || 
		commentID == 0 ||
		commentID == undefined ||
		commentID == NaN ||
		commentID == false){
			
		return false;	
		}
		
		let commentDiv;
		let commentPargh;
		let oldComment;
		let commentArea;
		let textAreaParent;
		let buttonsGrParent; 
		let buttonsWrapper;
		let postButton;
		let returnedArray = [];
		
		
		if( document.querySelector("#new_comment_" + commentID)){
			// find the entire div of the comment to edit
		 commentDiv = document.querySelector("#new_comment_" + commentID);
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

			// find the text area associated with the comments  
		if($("#comment_area_" + postID)){
			commentArea = $("#comment_area_" + postID)[0];
			 // replace the line breaks in the string with empty string
			oldComment = replaceString("<br>","", oldComment);
		   $(commentArea).trigger("paste");
		  // populate the text area with the old comment			
		$(commentArea).val(oldComment);	
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
	// change the onclick attribute of the post button to edit comment
  	$(postButton).attr("onclick","comment.edit_comment("+ postID +","+ commentID +",this); return false;");
  }    
  
 

				   }
				   
				
			
			 }
				
		   }
       	
		}

		return returnedArray = {'comment': oldComment,'textArea': commentArea, 'textAreaParent':textAreaParent ,'commentPara' : commentPargh,'buttonsGrParent': buttonsGrParent,'buttonsWrapper' : buttonsWrapper};
		
	
		
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
                
			 
			response = JSON.parse(response);

			 let comment_template = document.querySelector("#reply-items-template");
		                comment_template = comment_template.cloneNode(true);
		                
                        comment_template.id = response["reply_div_id"];

						$(comment_template).hide();

		                let user = $(comment_template).find(".ps-comment-user")[0];
		                $(user).html(response["fullname"]);
		               let time  =  $(comment_template).find(".ps-js-autotime")[0];
		               $(time).attr("title",response["reply_date"]);
		                
		                $(time).html(response["reply_time"]);
		               
		               // set the text of the comment from the db
				    let db_comment = $(comment_template).find("p");
				        db_comment.html(response["reply"]);

				   // set the delete variable
          let deleteLink = "";
   
      if($(comment_template).find(".actaction-delete")[0]){
  	deleteLink = $(comment_template).find(".actaction-delete")[0];
	let comment_id = 
	// change the onclick attribute of the link 
  	$(deleteLink).attr("onclick","comment.delete_reply("+ response["reply_id"] +","+ commentID +"); return false;");

  }            


         
               // prepend the comment to the comments_container 
				 $("#reply_container_" + commentID).append(comment_template); 
                	  $(comment_template).fadeIn(680);			 

               // hide the grandParent
			  $(returnedArray[2]).hide();
			  // hide the parent
			  $(returnedArray[3]).hide();
			  // hide the loadinGif
			  $(returnedArray[4]).hide();
			  returnedArray[0].disabled = false;
			   
		
			 }).fail(function (error){
				 alert(error);
			 });

			 
			
		
	}
	
	// cancel reply 

	static reply_cancel(commentID,element){

		// check the validity of the postID		
		if(commentID != null && commentID != undefined && 
		commentID > 0  && $.trim(element) != ""){
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
		
	}
	}// cancel_reply();

	
	// delete the comment reply
	static delete_reply(){}
	
	// edit the comment reply
	static edit_reply(){}
	
	
	}
  


