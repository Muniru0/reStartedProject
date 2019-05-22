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


  static openNotification(requestID = 0){

  }


  static getSpecificLabelNotifications(label = ""){

       if($.trim(label) == "" || label == undefined 
       || $("#" + label + "_notifications_label") == undefined 
       || $("#" + label + "_notifications_label") == ""){
        
        return;

       }

       var notificationBox =  $("#" + label + "_notifications_label");
       var notificationLoadingif = notificationBox.find("img");
       // hide all the notifications boxes
      $(".notifications_box").hide();

      // show that particular notification box
      notificationBox.show();

     // show the loading gif for taht specific label
     notificationLoadingif.show();
      

     $.ajax({
       url: "../private/neutral_ajax.php",
       type: "POST",
       data:{request_type: "specificnotifications", label_param: label},
       dateType: "html"
     }).done(function(response){

      console.log(response);
      try{
        response = JSON.parse(response);

        if(notificationBox != undefined){
           
        $(notificationLoadingif).before();
        }
      }catch(error){
        console.log(error);
        utility.showErrorDialogBox("Please try again if the operation was not successufl");
      }finally{
    // show that particular notification box
    $("#" + label + "_notifications_label").hide();

    //
    $("#" + label + "_notifications_label").find("img").hide();
      }
     });

  }


  static openNotificationsBox(){
    
    if($("#notifications_box") != "" || $("#notifications_box") != undefined){

        $("#notifications_box").toggle();
    }
  }



























}