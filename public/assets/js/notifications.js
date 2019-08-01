class notifications {








static mark_as_read(element = "", notificationID = 0){

if(notificationID == 0 || notificationID == undefined){
  return;
}

$(element).hide();
$(element).parentsUntil(".ps-notifications").css({
  "background": "white",
    "opacity": "0.9"
});

$.ajax({
  url: "../private/neutral_ajax.php",
  type: "POST",
  data: {request_type : "mark_notification_as_read",notification_id : notificationID}
}).done(function(response){
  console.log(response);
}).fail(function(error){console.log(error)});

}

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




   
  static getSpecificLabelNotifications(label = ""){

       if($.trim(label) == "" || label == undefined 
       || $("#" + label + "_notifications_label") == undefined 
       || $("#" + label + "_notifications_label") == ""){
        
        return;

       }

       var notificationBox =  $("#" + label + "_notifications_box");
       if($(notificationBox).css("display") != "none"){
         $(notificationBox).hide();
         return;
       }
       var notificationLoadingif = $(notificationBox).find(".notifications_loader")[0];
        console.log(notificationBox);
       // hide all the notifications boxes
      $(".community_notifications_box").hide();
      $("#main_notifications_box").hide();

      // show that particular notification box
      $(notificationBox).show();
      console.log(notificationBox[0]);

     // show the loading gif for taht specific label
     $(notificationLoadingif).show();
      

     $.ajax({
       url: "../private/neutral_ajax.php",
       type: "POST",
       data:{request_type: "specificnotifications", label_param: label},
       dateType: "html"
     }).done(function(response){

      console.log(response);
   
      response = JSON.parse(response);
      let fullNotificationsString = "";
    
      $.each(response,function(index,value){

          fullNotificationsString += "<div id=\'\' class=\'ps-notification ps-notification--unread\' ><a class=\'ps-notification__inside\' href=\'\'><div class=\'ps-notification__body\'><div class=\'ps-notification__desc\' style=\'text-align: center;\'><strong style=\'font-size: 20px;\'>" + value["firstname"] + " " + value["lastname"] + " </strong>" + value["filename"]+ "<span style=\'margin-top: 1.2em;\'> " +value["title"] + " </span></div><div class=\'ps-notification__meta\' style=\'float: right;\'><small class=\'activity-post-age\' data-timestamp=\'April,  9    2019  04:46 PM\'><span title=\'April,  9    2019  04:46 PM\'>" + value["upload_time"]+ "</span></small><span class=\'ps-notification__status ps-tooltip ps-tooltip--notification \'  style=\'cursor:pointer;\'><span class=\'ps-notification__status ps-tooltip ps-tooltip--notification\'  style=\'cursor:pointer;\'><i class=\'ps-icon-eye\'></i><span>Mark as read</span></span></div></div></a></div>";
      
      });
   //  console.log(fullNotificationsString);
   

     
      try{
//         response = JSON.parse(response);

        if(notificationBox != undefined){
           
       $(".ps-notifications--empty").html(fullNotificationsString);
        }
      }catch(error){
       
        utility.showErrorDialogBox("Please try again if the operation was not successufl");
      }finally{
    // show that particular notification box
   // $(notificationBox).hide();

    //
    $(notificationLoadingif).hide();
      }
     });

  }


  
  static toggleNotificationsBox(element = ""){

          if(element == undefined ){
return;
          }
          if($.trim($(element).find(".js-counter").css("display")) != "none"){
            $(element).find(".js-counter").hide();
          }
        
      if($("#main_notifications_box") != "" || $("#main_notifications_box") != undefined){

        $("#main_notifications_box").toggle();
        $(".community_notifications_box").hide();
      }
       
        
      
 
  }


  static toggleFollowingsBox(){

  if($("#following_notifications_box") != "" || $("#followings_notifications_box") != undefined){

        $("#followings_notifications_box").toggle();
        $(".community_notifications_box").hide();
    }

         
 
  }


























}