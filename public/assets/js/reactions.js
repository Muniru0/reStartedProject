
class reaction {

    constructor (){
    	this.reactionSupport = "support";
    	this.reactionOppose  = "oppoose";
    }
   // add a reaction
   static addReaction(postID = 0,reactionValue = null,targetElement){
     
      let opposeLabel = "";
      let supportLabel = "";
	
	  let parent   = $(targetElement).parent();
	 
	  let reactionType = $(targetElement).attr("id");
    reactionType = reactionType.split("_")[0];
	    reactionValue = reactionValue.valueOf();
       // toggle the colors of the label and reactions text
       if(reactionValue === 2){
       	 // find the support span tag 
       	 let supportSpan =  $(parent).find("span")[0];
		   if($(supportSpan) && $.trim(supportSpan) != ""){
		//change it's html 
       	   $(supportSpan).html("Supported");
       	   // change it's color
       	 $(supportSpan).css("color","#333");
       	 $(supportSpan).css("font-weight","500");
		  }
		  
           // find the oppose span 
          let opposeSpan =  $(parent).find("span")[1];
		  if($(opposeSpan) && $.trim(opposeSpan) != ""){
		  // change the text inside the oppose span
          $(opposeSpan).html("oppose");
          // change it's color
          $(opposeSpan).css("color","#999");
		  // adjust the font weight
          $(opposeSpan).css("font-weight","normal");
		  }
          // find the support label and set its background
           supportLabel = $(parent).find("label")[0];
		   if($(supportLabel) && $.trim(supportLabel) != ""){
			   
           // set the background o the support lable
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
       	// find the support span
        let supportSpan =  $(parent).find("span")[0];
		 if($(supportSpan) && $.trim(supportSpan) != ""){
			 
        // change it's html
        $(supportSpan).html("Support");
          // change the color of the support span 
          // to show a de-selected option
       	 $(supportSpan).css("color","#999");
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
          $(opposeSpan).css("color","#333");
          // find the label of the oppose 
         opposeLabel = $(parent).find("label")[1];
         // set the background of the label
         $(opposeLabel).css("background","#dc756f");
		 }
         
       	
       }

 


       $.ajax({
       	url: "../private/neutral_ajax.php",
       	type: "POST",
       	data: {reaction_param:reactionValue,post_id: postID},
       	dataType:"html"
       }).done(function(response){
                  
				  console.log(response);
				 
				  
            try{
            	response = JSON.parse(response);
            	if(response["false"]){
            		 alert(response["false"]);
            	}else if(response["support"] && response["oppose"] && response["post_id"] > 0){
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

   
   
}


