class reaction {

	constructor (){
		this.reactionSupport = "support";
		this.reactionOppose  = "oppoose";
	}
 
 
 
 
 // add a reaction
 static addReaction(postID = 0,reactionValue = null,targetElement){
	 
	let opposeLabel = "";
	let supportLabel = "";
	let supportCount = "";
	let opposeCount = "";
	let parent   = $(targetElement).parent();
 
	let reactionType = $(targetElement).attr("id");
	reactionType = reactionType.split("_")[0];
		reactionValue = reactionValue.valueOf();
		 // toggle the colors of the label and reactions text
		 if(reactionValue === 2){
				$(targetElement).attr("checked","");
				// find the support span tag 
				let supportSpan =  $(parent).find("span")[0];
		 if($(supportSpan) && $.trim(supportSpan) != ""){
	//change it's html 
				 $(supportSpan).html("Supported");
					// add the support span selected class
					$(supportSpan).removeClass("deselected_support_span").addClass("selected_support_span");
					
		}
	 
				// find and highlight the support count
				if( ($(supportCount) || $(opposeCount)) && $.trim($("#reactions_count_" + postID).find("a")) != ""){
					// find the support count and add a selected reactions count class to it
						if($(supportCount) && $.trim($("#reactions_count_" + postID).find("a")[0]) != "" ){
								supportCount = $("#reactions_count_" + postID).find("a")[0];
								$(supportCount).removeClass("deselected_reactions_count").addClass("selected_reactions_count");
						}
						// find the oppose count and add a deselected reactions count class to it
							 if($(opposeCount) && $.trim($("#reactions_count_" + postID).find("a")[1]) != ""){
								opposeCount = $("#reactions_count_" + postID).find("a")[1];
								$(opposeCount).removeClass("selected_reactions_count").addClass("deselected_reactions_count");
						}

					
				}

				 // find the oppose span 
				let opposeSpan =  $(parent).find("span")[1];
		if($(opposeSpan) && $.trim(opposeSpan) != ""){
		// change the text inside the oppose span
				$(opposeSpan).html("oppose");
				// change it's color
				$(opposeSpan).removeClass("selected_oppose_span").addClass("deselected_oppose_span");
		
		}
				// find the support label and set its background
				 supportLabel = $(parent).find("label")[0];
		 if($(supportLabel) && $.trim(supportLabel) != ""){
			 
				 // set the background o the support label
				 // to show a selected option
			 $(supportLabel).css("background","#3bcdac");
		 } 

			 // find the oppose label set its background 
					opposeLabel = $(parent).find("label")[1];
		 if($(opposeLabel) && $.trim(opposeLabel) != ""){
				 // set its background to reflect a de-selected optio
					$(opposeLabel).css("background","#999");
		}
	
		 //if the the reaction is an oppose
		 }else if(reactionValue === 1){
			 $(targetElement).attr("checked","");
			 // find the support span
			let supportSpan =  $(parent).find("span")[0];
	 if($(supportSpan) && $.trim(supportSpan) != ""){
		 
			// change it's html
			$(supportSpan).html("Support");
				// change the color of the support span 
				// to show a de-selected option
				$(supportSpan).removeClass("selected_support_span").addClass("deselected_support_span");
			 // find the support label
			 supportLabel = $(parent).find("label")[0];
			// change the background color of support lable
			 $(supportLabel).css("background","#999");
	 }



	 
	 if($(supportSpan) && $.trim(supportSpan) != ""){
		 
			 // find the oppose span
				let opposeSpan =  $(parent).find("span")[1];
				// change its html
				$(opposeSpan).html("Opposed");
				// change the color of the oppose span
				$(opposeSpan).removeClass("deselected_oppose_span").addClass("selected_oppose_span");
			
				// find the label of the oppose 
			 opposeLabel = $(parent).find("label")[1];
			 // set the background of the label
			 $(opposeLabel).css("background","#dc756f");
	 }
			 
		 // find and highlight the support count
				if( ($(supportCount) || $(opposeCount)) && $.trim($("#reactions_count_" + postID).find("a")) != ""){
					// find the support count and add a selected reactions count class to it
						if($(supportCount) && $.trim($("#reactions_count_" + postID).find("a")[0]) != "" ){
								supportCount = $("#reactions_count_" + postID).find("a")[0];
								$(supportCount).removeClass("selected_reactions_count").addClass("deselected_reactions_count");
						}
						// find the oppose count and add a deselected reactions count class to it
							 if($(opposeCount) && $.trim($("#reactions_count_" + postID).find("a")[1]) != ""){
								opposeCount = $("#reactions_count_" + postID).find("a")[1];
								$(opposeCount).removeClass("deselected_reactions_count").addClass("selected_reactions_count");
						}

					
				}

			 
		 }




		 $.ajax({
			 url: "../private/neutral_ajax.php",
			 type: "POST",
			 data: {reaction_param:reactionValue,post_id: postID,request_type: "add_reaction"},
			 dataType:"html"
		 }).done(function(response){
								
			
				
					try{
						response = JSON.parse(response);
				// if the session is invalid
						if(response["false"] == "login"){
						utility.toLoginPage();
						return;
					}else if($.trim(response["false"]) != ""){
						utility.showErrorDialogBox(response["false"]);
						return;
					}
						 if(response["support"] && response["oppose"] && response["post_id"] > 0){
							 if($("#reactions_count_" + response["post_id"])){
					 $("#reactions_count_" + response["post_id"]).show();
				 }
							 // update the number of supports 
									if( $("#reactions_count_" + response["post_id"]) && $("#reactions_count_" + response["post_id"]).find("a")[0]){
											let supportChange = $("#reactions_count_" + response["post_id"]).find("a")[0];
											 if($(supportChange) && $(supportChange) != ""){
											 
											 let reactionString = response["support"] > 1 ? response["support"] + " supports" : response["support"] + " support";
											$(supportChange).html(reactionString);
											 }
									}
				
				
						 
						 // update the number of opposes
									if( $("#reactions_count_" + response["post_id"]) && $("#reactions_count_" + response["post_id"]).find("a")[1]){
											let opposeChange = $("#reactions_count_" + response["post_id"]).find("a")[1];
											if($(opposeChange) && $(opposeChange) != ""){
										 let reactionString = response["oppose"] > 1 ? response["oppose"] + " opposes" : response["oppose"] + " oppose";
											$(opposeChange).html(reactionString);  	
											}
										

									}
						 
									
						}

					}catch(e){
					 alert("Please something went wrong,please try again.");
					}
	 
		 }).fail(function(error){

		 });

 }

 


	// like a comment or reply 
 static like(postID = 0, commentID = 0,replyID = 0,targetElement = "",option = ""){
	 
 
	 if($.trim(postID) == "" || $.trim(postID) == undefined || Number($.trim(postID)) == 0
	 || $.trim(commentID) == "" || $.trim(commentID) == undefined || Number($.trim(commentID)) == 0
	 || $.trim(targetElement) == "" || $.trim(targetElement) == undefined 
	 || $.trim(option) == "" || $.trim(option) == undefined){
		 return;
	 }  

		 let likesCountDiv;
	 let likesCountSpan;
	 let likesCount;
	 let likesCountSpanTitle;
	 let likesCountTitleString;
	 let likesString;
	 let requestValue;
			
			if($.trim(option) == "comment" && Number(replyID) == 0){
	
		 likesCountDiv = document.querySelector("#comment_likes_count_" + commentID);
		 requestValue = "like_comment";
			}else if($.trim(option) == "reply" && Number(replyID) > 0){
					likesCountDiv = document.querySelector("#reply_likes_count_" + replyID);
		 requestValue = "like_reply";
			}else{
				 return;
			}

		 
				
	
			likesCountSpan    = $(likesCountDiv).find("span");
		likesCount        = $(likesCountSpan).html();
			
			 
		 if($.trim(likesCount) == ""){
		likesCountTitleString = "you just liked this";
				$(likesCountSpan).attr("title",likesCountTitleString);
			$(likesCountSpan).html("1");	
			$(likesCountDiv).show();
		
		 }else
				 if(Number(likesCount) >= 0){
							// change the like to liked or liked to like
			likesString = $(targetElement).find("span")[0];
				 $(likesCountDiv).show();
				 
				
	 
				 if(likesCount.split("k").length === 1 && likesCount.split("m").length === 1){
						 likesCount = Number(likesCount);
						if($(targetElement).hasClass("liked")){
							 $(likesString).html("Like");
					likesCount = likesCount - 1;
						}else if(!$(targetElement).hasClass("liked")){
							$(likesString).html("Liked");
							likesCount = likesCount + 1;
						}
						
					if(likesCount == 0){
										$(likesCountDiv).hide();
					}
												 
				$(likesCountSpan).html(likesCount);
				 }
				
					
		//initialize the likesCountSpanTitle variable 			
				 likesCountSpanTitle = $(likesCountSpan).attr("title");
		// get the number of likes from the string of the title attribute	
				 likesCountSpanTitle  = likesCountSpanTitle.split("p")[0];
		// cast the likes count span attribute to a number 
				likesCountSpanTitle = Number(likesCountSpanTitle);
	 
		// check to see if the likes count in the span 
		// title attribute is a number
				if(typeof likesCountSpanTitle == "number"){
					if($(targetElement).hasClass("liked")){
				 likesCountSpanTitle = likesCountSpanTitle - 1; 
					}else if(!$(targetElement).hasClass("liked")){
						likesCountSpanTitle = likesCountSpanTitle + 1 ;
					}
								
								// if the number of likes is less than 1
						if(likesCountSpanTitle < 1){
									 likesCountTitleString = "";
									 // if the number of likes is equal to 1
						}else if(likesCountSpanTitle == 1){
								likesCountTitleString = "1 person likes this";
								// if the number of likes is greater than 1
						}else if(likesCountSpanTitle > 1){
							likesCountTitleString = likesCountSpanTitle +" people like this";
						}
			
	 // update the number of likes on the client side		
			 $(likesCountSpan).attr("title",likesCountTitleString);
				} 	    
			 
				 }
		 
		
		 
	
	 
		 
$(targetElement).toggleClass("liked",1000,"easeOutBounce");
$(likesCountSpan).toggleClass("liked",1000,"easeOutBounce");

	 
	$.ajax({
		url: "../private/neutral_ajax.php",
		type: "POST",
		data: {post_id: postID,comment_id: commentID,reply_id: replyID,request_type: requestValue},
		dataType: "html"
	}).done(function(response){
		console.log(response);
		 return;
			try{
			response = JSON.parse(response);
			 if($.trim(response["false"]) != "" && $.trim(response["false"]) != undefined ){
				 
				 if($.trim(response["false"]) == "login" ){
					 
				 utility.toLoginPage();
							 return;					 
				 }
				 
				 if($.trim(response["false"]) != "login"){
					 utility.showErrorDialogBox(response["false"]);
					 return;
				 }
			 }
			 
			 if($.trim(response["likes"]) != "" && $.trim(response["likes"]) != undefined ){
					response["likes"] = Number(response["likes"]);
					 if(response["likes"] != likesCount){
										 $(targetElement).toggleClass("liked",1000,"easeOutBounce");
										 $(likesCountSpan).toggleClass("liked",1000,"easeOutBounce");
										 $(likesCountSpan).html(response["likes"]);
					 }
				
	 
			 }
			 
			 
		}catch(e){
			utility.showErrorDialogBox("Sorry something Unexpectedly happened");
		}finally{}	
		
	});
	 
	 
	 
 
	 
	 
	 
 }
 
}


