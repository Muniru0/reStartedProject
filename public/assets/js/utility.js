

class utility {


   // auto resize all text areas
    static resizeTextarea(textArea){
     
	  console.log(textArea.scrollHeight);
 $(textArea).height(0).height(textArea.scrollHeight );

$(textArea).change();
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
			 console.log("this is a console log for the pressing of a key");
		oField.style.height = oField.clientHeight + "px";
	}
	  }// autGrow();
	  

   // helper method for replacing strings
  static replaceString(oldS, newS, fullS) {
  return fullS.split(oldS).join(newS);
}
	
	


}