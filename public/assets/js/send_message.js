


function enable_post_button(){
	
    if($("#message_area") != "" && $("#message_area") != undefined && $("#send_message_button") != undefined && trim($("#send_message_button")) != ""){
     document.querySelector("#send_message_button").disabled = false;
    }
}



(function($){
    "use strict";
  })();
  $("#submit").on("click",function(e){
  
     var element = e.target;
     
     var bucket = $(element).find("img")[0];
       $(bucket).css("display","inline");
       if($("textarea") == undefined || trim($("textarea")) == ""){
       
       }
    let txt = $("textarea").html();
      $("textarea").html("");   
     $("#form").unbind("submit");  
      $("#form").submit(function(e){
  
          $.ajax({
              url:"message.php",
              type:"POST",
              data:$("#form").serialize(),
              dataType:"html"
    }).
    done(function(response,status){
      
      try{
      response = JSON.parse(response);
      
  if(status  === "success"){
      
      $.each(response,function(index,value){
          
           if(value == true)
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
       $(element).removeAttr("disabled");
       $(bucket).css("display","none");     
        
  }
             
  });
  }
      }catch(e){
          utility.showErrorDialogBox("Sorry Invalid request please refresh the page and try again.");
      }
  
         
  });
  
  
  
  e.preventDefault();
  //
  $(element).attr("disabled","disabled");        
      });
  
   
  });
  
  
  