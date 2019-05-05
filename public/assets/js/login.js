


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
	
	try{
    response = JSON.parse(response);
	

	
	$.each(response,function(index,value){
		
		 if($.trim(index) == "response" && $.trim(value) == "success")
		 {
		  location.href="me.php";
		  return;
		 }else
    if($.trim(index) == "false" && $.trim(value) != "blocked_request"){
     
      showLoginErrors(value);
  }else
    if($.trim(index) == "false" && $.trim(value) == "blocked_request"){
     
      location.href="blocked_request_page.php";
  }
           
});

	}catch(e){
		
	  showLoginErrors("Sorry Invalid request please refresh the page and try again.");
	}finally{
		 $(element).removeAttr("disabled");
     $(bucket).css("display","none");   
	}

       
}).fail(function(){
  showLoginErrors("Sorry Invalid request please refresh the page and try again.");
});



e.preventDefault();
//
$(element).attr("disabled","disabled");        
    });

 
});


function showLoginErrors(value = "") {
     
  if($.trim(value) == ""){
return ;
  }
	var errors = "";
   
  errors += "<li>"+value+"</li>";
  
   $("#login_err").show();
   if($(".errors") != "null"  ){
     $(".errors").remove();
   }
    $("#login_err").append("<ul class=\"errors\">" + errors + "</ul>");  
}

