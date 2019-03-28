class notifications {


  static getLatestNotification(){


    try{
    $.ajax({
       url: "../private/neutral_ajax.php",
       type: "POST",
       data: {request_type: "get_latest_notification"},
       datatype: "html"
    }).done(function(response){

         console.log(response);
        
      response = JSON.parse($.trim(response));
        if($.trim(response) == ""){
        utitlity.showErrorDialogBox("Unexpected Error,Please refresh the page and try again.");
            
return;
        }else if($.trim(reponse["false"]) != undefined && $.trim(response["false"]) == "" && $.trim(response["false"] == "login")){
            utitlity.showErrorDialogBox(response["false"]);
            return;
        }else if($.trim(response["false"]) == "login"){
       utility.toLoginPage();
        }


    }).fail(function(error){
        utitlity.showErrorDialogBox("Please refresh the page and re-initiate the operation if it wasn't successful.");
    });
}catch(e){}finally{}



  }


























}