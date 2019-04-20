
(function($){
  "use strict";
})();
$("#button_login").on("click",function(e){
 
   var element = e.target;
    
   var bucket = $(element).find("img")[0];
     $(bucket).css("display","inline");
   
  
   $("#form").unbind("submit");  
    $("#form").submit(function(e){

        $.ajax({
            url:"login.php",
            type:"POST",
            data:$("#form").serialize(),
            dataType:"html"
  }).
  done(function(response){
	console.log(response);
	try{
    response = JSON.parse(response);
	

	
	$.each(response,function(index,value){
		
		 if(value == "success")
		 {
		  location.href="me.php";
		  return;
		 }else
    if(index == "false"){
	var errors = "";
     $.each(response,function(index,value){
   errors += "<li>"+value+"</li>";
   });  
    $("#login_err").show();
    if($(".errors") != "null"  ){
      $(".errors").remove();
    }
     $("#login_err").append("<ul class=\"errors\">" + errors + "</ul>");  
      
      
}
           
});

	}catch(e){
		utility.showErrorDialogBox("Sorry Invalid request please refresh the page and try again.");
	}finally{
		 $(element).removeAttr("disabled");
     $(bucket).css("display","none");   
	}

       
}).fail(function(){
  utility.showErrorDialogBox("Sorry Invalid request please refresh the page and try again.");
});



e.preventDefault();
//
$(element).attr("disabled","disabled");        
    });

 
});


