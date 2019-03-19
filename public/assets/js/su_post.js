function post_options_dropdown(element){
$(element).find(".ps-dropdown__menu").toggle("fade",100);

}

function post_option_edit(user_id = 0,post_id = 0,element = ""){

    if(typeof user_id != "number" || typeof post_id != "number" || $.trim(element) == ""){
        return;
    }

   let grParent =  $(element).parentsUntil("#ps-activitystream");
   let title    =  $.trim($(grParent).find(".ps-stream-action-title").html());
   
       title    =  title.split("<a")[0];

   let caption  = $(grParent).find("peepso-markdown").find("p");
       caption   = $.trim($(caption).html());

   let editBox  =  $(grParent).find(".ps-js-activity-edit");   
     // show the editBox
     $(editBox).show();

     

}

  function editPost(post_id = 0,targetElement = ""){

      if(typeof post_id != "number" || $.trim(targetElement) == ""){
          return;
      }

      let grParent = $(targetElement).parentsUntil("#ps-activitystream");
      let mainParent = $(grParent).find(".ps-postbox");
      let title    = $(mainParent).find("textarea")[0];
      let titleParent = $(title).parent();
          title     = $(title).html();
      let caption   = $(mainParent).find("textarea")[1];
          caption   = $(caption).html();
           if($.trim(title) == ""){
             $(titleParent).effect("shake");
             $(titleParent).css("border","#d24942");
             $(titleParent).css("background","#d24942");
             return;
           }
          console.log(grParent);  
          console.log(title);  
          console.log(caption);   


          $.ajax({
            url: "../private/neutral_ajax.php",
            type: "POST",
            data: {request_type: "edit_post",caption: captionValue, title: titleValue,location: locationValue},
            dataType : "html"
          }).done(function(response){
             console.log(response);

             try{
               response = JSON.parse(response);
               


             }catch(e){

             }      

          }); 
  }



  function cancelEditPost(targetElement = ""){
      
      if($.trim(targetElement) == ""){
return;
      }


    let editBox = $(targetElement).parentsUntil(".ps-stream-body");
         //hide the entire editbox
         $(editBox);

   

  }



function post_option_delete(userID,postID,element){
  
  if(Number(userID)  == 0 || Number(userID)  == undefined  || Number(userID) == null ||
     Number(postID)  == 0 || Number(postID)  == undefined  || Number(postID) == null ||
     $.trim(element)  == "" || $.trim(element) == undefined || $.trim(element) == null){

 return;
  }
    
     let postContainer = $(element).parentsUntil("#ps-activitystream").fadeOut(600);

    $.ajax({
        url: "../private/neutral_ajax.php",
        type: "POST",
        data: {post_id: postID,user_id: userID,request_type:"delete_post"},
        dataType: "html"
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
       if(response["true"]){
         $(postContainer).remove();
       }
       }catch(e){
        $(postContainer).fadeIn(600);
  utility.showErrorDialogBox("It is our fault, but please try again.<br /> if problem persist refresh the page ");
       }
       
    }).fail(function(error){
        utility.showErrorDialogBox("It is our fault, but please try again.<br /> if problem persist refresh the page ");
        $(postContainer).fadeIn(600);
    });

}

function post_option_follow(post_id,element){
    
}

function post_option_link_user(info = "" ,postID = 0,element = ""){
  
  if($.trim(info) == "" || Number(postID) < 1 || $.trim(element) == "" ){
    return;
  }

  
  info = JSON.stringify(info);
  info = JSON.parse(info);
   let requestTypeValue = "link_user";

    $.ajax({
    url: "../private/neutral_ajax.php",
    type: "POST",
    data:{firstname: info["firstname"],lastname: info["lastname"],id: info["id"],post_id: postID,request_type: requestTypeValue},
    dataType: "html"
  }).done(function(response){
      console.log(response);
  }); 
  
  
  
    
}

function post_options(userID = 0,postID = 0 , element = "",option = null){
 
    if(!utility.validate_presence(postID) || !utility.validate_presence(element)){
        return;
    }
  
   let mainParent = $(element).parentsUntil(".ps-stream");
   let requestTypeValue        = "confirm_post";
   let title                   = "";
   let confirmationText        = "";
   let addElementClass         = "";
   let removeElementClass      = "";
   let addIconClass            = "";
   let removeIconClass         = "";
  
 
 

   requestTypeValue = (option == null || $.trim(option) == "") ? "comfirm_post" : option;
    
 
    $.ajax({
        url: "../private/neutral_ajax.php",
        type: "POST",
        data: {user_id: userID,request_type: requestTypeValue,post_id: postID},
        dataType: "html"
    }).done(function(response){
       console.log(response);
    
try{
      response = JSON.parse(response);
      let confirmationTextSpan = $(element).find("span")[0]; 
      let confirmationIcon = $(element).find("i")[0];
     
      if(response["true"] == "success" || response["unlink"] == "success" || response["unfollow"]){
           if(option == "confirm_post" || option == null){
                
                 title              = ($(element).hasClass("confirm_post")) ? "Confirm that this incident really took place" : "Reverse the confirmation of this incident";
                 confirmationText   = ($(element).hasClass("confirm_post")) ? "Confirm this post" : "Reverse Confirmation";
                 addElementClass    = ($(element).hasClass("confirm_post")) ? "confirm_post" : "reverse_post_action";
                 removeElementClass = ($(element).hasClass("confirm_post")) ? "reverse_post_action" : "confirm_post";
                 addIconClass       = ($(element).hasClass("confirm_post")) ?  "fal fa-check-circle" : "fal fa-undo-alt";
                 removeIconClass    = ($(element).hasClass("confirm_post")) ?  "fal fa-undo-alt" : "fal fa-check-circle";
                     
            }else if(option == "link_user" ){
     
                  title                  =  ($(element).hasClass("reverse_post_action")) ?  "linking with a user will get you notified of all future incidents posted by that user." : "You will be notified of incidents posted by this person.";
                  let user               =   $(mainParent).find(".ps-stream-user");
                  $(user).parent().toggleClass("breathing_space");
                   $(user).toggleClass("link_user",1000,"easeOutBounce");
                   $(user).find("small").toggle();
                  let userFullname       =  $(user).html();
                  userFullname           = userFullname.split("<small")[0];
                  console.log(userFullname);
                  confirmationText       =  ($(element).hasClass("reverse_post_action"))  ?  "link with " + userFullname : "unlink with " + userFullname;
                  addElementClass        =  ($(element).hasClass("reverse_post_action"))    ?  "" : "reverse_post_action";
                  removeElementClass     =  ($(element).hasClass("reverse_post_action")) ? "reverse_post_action" : "";
                  addIconClass           =  ($(element).hasClass("reverse_post_action"))  ? "fal fa-link" :  "fal fa-unlink";
                  removeIconClass        =  ($(element).hasClass("reverse_post_action"))  ? "fal fa-unlink" :  "fal fa-link";
                       
                }else if(option == "follow_post"){
                 title                  =  ($(element).hasClass("reverse_post_action"))   ?  "if you follow this incident you will be notified about every development of it." : "Get notified about every development of this incident.";
                 confirmationText       =  $(mainParent).find(".ps-stream-user").html();
                 $(mainParent).find(".following_span").toggle("slide");
                 confirmationText       =  ($(element).hasClass("reverse_post_action"))    ?  "follow this incident" : "unfollow this incident";
                 addElementClass        =  ($(element).hasClass("reverse_post_action"))    ?  "follow_post" : "reverse_post_action";
                 removeElementClass     =  ($(element).hasClass("reverse_post_action"))    ?  "reverse_post_action" : "follow_post";
                 addIconClass            =  ($(element).hasClass("reverse_post_action"))    ?  "far fa-eye" : "far fa-eye-slash";
                 removeIconClass         =  ($(element).hasClass("reverse_post_action"))    ?  "far fa-eye-slash" : "far fa-eye";
                 let uiFollowing         = $(mainParent).find("ps-stream-meta").find("ps-stream-time").toggle("fade",400);
           }

           console.log(title);
           console.log(confirmationText);
           console.log(addElementClass);
           console.log(removeElementClass);
           console.log(removeIconClass);
           console.log(addIconClass);

                 $(element).attr("title",title);
                 $(element).removeClass(removeElementClass).addClass(addElementClass);
                 $(confirmationIcon).removeClass(removeIconClass);
                 $(confirmationIcon).addClass(addIconClass);
                 $(confirmationTextSpan).html(confirmationText);
                 
               
                 
        }

          else if($.trim(response["false"]) != ""){
         utility.showErrorDialogBox(response["false"]);
      }
 }
      
    catch(e){
         console.log(e);
    utility.showErrorDialogBox(response["false"]);
                        
    }
    });






}


   
(function ($) {


 "use strict";


  $(".checkboxradio").checkboxradio();

    var clickables = ["#ps-upload-containter", ".post-status"];
    var fileuploadUrl = "../private/post_event.php";
    var commentUrl = "../public/neutral_ajax.php";
   // fileuploadUrl     = "../s2CxARWoyfS608LFDZxNvOC8OoZR9Qg/testupload.php";

    // required fields
    var requiredLabel;
    var requiredLocation;
    var title;
    var returnedPost;


 

    // Global variables
    var firstPostMirror = $(".ps-postbox-mirror:eq(0)");
    var postStatusMood = $(".ps-postbox-addons:eq(1)");
    var postButton = $(".postbox-submit") ? $(".postbox-submit") : "";
    var cancelDiv = $("#post_action_div") ? $("#post_action_div") : "";
    var cancelButton = $("#cancel_button") ? $("#cancel_button") : "";
    var postbox = $("#post_caption") ? $("#post_caption") : "";
    var postbox_mood = $("#postbox-mood") ? $("#postbox-mood") : "";
    var poststatus = $("#poststatus") ? $("#poststatus") : "";
    var sizeSent = $(".ps-postbox-loading:eq(2)");

    // post parameters variables
    // var label         = label ? label : "transport";
    var post_mood          = [];
    // var post_location      = post_location ? post_location : "Accra";
    //var post_location      = $("#location-tab") ? $("#location-tab") :  "";
    var post_log     =  10234456583;
    var post_lat     = 38493083838;
  //  var post_links       = post_links ? post_links : ["Yussif","Muniru","Kareem","Ganiu"];
    var post_caption       = $("#post_caption") ? $("#post_caption"): false;
    var post_selectedLabel = post_selectedLabel ? post_selectedLabel : "";
    var post_title         = $(".ps-videos-url") ? $(".ps-videos-url") : "this is just a placeholder title" ;
    var showPostErrorAlert;

    // End of  Global Variables
    function refreshLabel() {
        //$(selectedLabel).controlgroup();
        $("fieldset .checkboxradio").prop("checked", false);
        $("fieldset .checkboxradio").checkboxradio("refresh");  
    
        
        
    }

  
    // helper function to convert the file
    // size to a more human readable format
    function convertFileSize(size) {
        var selectedSize = 0;
        var selectedUnit = "b";
        var conversionBase = 1024;
        var FileSizeUnits = {
            tb: "TB",
            gb: "GB",
            mb: "MB",
            kb: "KB",
            b: "b"
        };

        if (size > 0) {
            var units = ['tb', 'gb', 'mb', 'kb', 'b'];

            for (var i = 0; i < units.length; i++) {
                var unit = units[i];
                var cutoff = Math.pow(conversionBase, 4 - i) / 10;

                if (size >= cutoff) {
                    selectedSize = size / Math.pow(conversionBase, 4 - i);
                    selectedUnit = unit;
                    break;
                }
            }

            selectedSize = Math.round(10 * selectedSize) / 10; // Cutting of digits
        }

        return "<strong>" + selectedSize + "</strong> " + FileSizeUnits[selectedUnit];
    }


    ////   Dropzone  ///
    Dropzone.options.postcontent = false;
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#postcontent", {
        url: fileuploadUrl,
        paramName: "file",
        autoProcessQueue: false,
        parallelUploads: 10,
        uploadMultiple: true,
        addRemoveLinks: true,
        maxFilesize: 70,
        maxFiles: 10,
        //    filesizeBase: 1000000,
        acceptedFiles: 'image/gif,image/png,image/jpeg,image/jpg,video/x-ms-wmv,video/mp4,video/3gpp,audio/mpeg,audio/mp4,audio/mp3',
        renameFile: true,
        clickable: ["#ps-upload-container", ".dropzone"],
        //    forceFallback: true,
        dictDefaultMessage: "",
        dictMaxFilesExceeded :"Please you can upload a Maximun of 10 files",
        dictRemoveFileConfirmationn: true,
        init: function () {
            var dz = this;
            $(postButton).click(function () {
               // if the label is not selected
                if ($.trim(post_selectedLabel) == "" && (post_title) != null) {
                   if(!labelError()){
                      return;
                    }
                  }
               // if the title is not selected
                if($.trim($(post_title).val()) == "" && $(post_title) != null){
                     if(!titleError()){
                      return;
                     }
                 }

                 if($("#location-tab") != null && $.trim(post_log) == "" && $.trim(post_lat) == ""){
                   locationError();
                  return;
                }
                // console.log("all passed now lets proceed");
               // console.log(post_mood["span"]);
              /*   console.log($(post_caption).val());
                console.log($(post_title).first().val());
                //console.log(post_links);
                console.log(post_selectedLabel);
                console.log(post_lat);
                console.log(post_log); */
               // refresh the label selection
                try{
                    dz.processQueue();
                    
                }catch(e){
                 console.log(e);
                }


            });
            $(cancelButton).click(function () {
                dz.removeAllFiles(true);

            });
        }
    });


    // when a file is added
    myDropzone.on("addedfile", function () {
          // console.log(post_selectedLabel);
        // if the post textarea is not empty or null
        // fill the poststatus with the contents of the // post textarea
        if ($(firstPostMirror).length && $(poststatus).length && ($(firstPostMirror).html() != null || $(firstPostMirror).html().trim() != "")) {
            // populate the poststatus if a file is added
            $(poststatus).val($(firstPostMirror).html());

            let firstMood = $(".ps-postbox-status:eq(0) div:nth-child(1) span:nth-child(2)")[0];

            if ($(postStatusMood.length) && $(firstMood).length && post_mood["span"] != null && post_mood["icon"] != null) {
                // set the selected mood on the status of the post
                $(postStatusMood).replaceWith(selectedMoodTemplate(post_mood["icon"], post_mood["span"]));
                // remove the placeholder from the status of the post textarea when the file is added
                $("textarea:eq(1)").attr("placeholder", "");
            }
        } else {
            // console.log("Not found!!!");
        }
        // show the post status textarea
        $(".ps-postbox-status:eq(1)").show();
        // show the post button
        $(postButton).css("display","inline");
        $(cancelButton).show();

    });


    // just when a file is about to be sent to the server
    myDropzone.on("sendingmultiple", function (file, xhr, formData) {
        // show the cancel button
        //toggleCancelButton("show");
        // show the upload progress bar with the percentage and byte rate sent.
        if (sizeSent != null &&
            uploadprogress != null && (
                $(sizeSent).hasClass("hidden") ||
                $(uploadprogress).hasClass("hidden"))) {
            $(sizeSent).removeClass("hidden");
            $(uploadprogress).removeClass("hidden");
        }
        formData.append("label", post_selectedLabel);
       // formData.append("mood", post_mood["span"]);
        formData.append("caption",$(post_caption).val());
        formData.append("log",post_log);
        formData.append("lat",post_lat);
        //formData.append("media", post_links);
        formData.append("title",post_title.val());
        formData.append("csrf_token", $.trim($("#csrf").prop("value")));
        // console.log("label: " + selectedLabel + " mood: " + mood["span"] + " caption " + caption + " location: " + location + " media: " + links + " csrf: " + $("#csrf").prop("value"));

    });

    // when the entire queue has being uploaded successfully
    myDropzone.on("queuecomplete",function(file){
                

 $("#ps-activitystream").prepend(returnedPost);
         $("#ps-activitystream").show();
        
          reset_postbox();
    });

    // if the file sending completed without errors
    myDropzone.on("success", function (file, response) {
          
          console.log(response);
         
        try {
                  
         response = JSON.parse(response);
         
             if(response[0] == null){
                showPostErrorAlert = true;
             }
             
        // if the session is invalid
        if(response["false"] == "login"){
              utility.toLoginPage();
                            return;
                        }else if($.trim(response["false"]) != ""){
                            utility.showErrorDialogBox(response["false"]);
                            return;
                        }
         $.each(response,function(index,value){
             
             returnedPost =  utility.replaceString("\\n","",value);
             console.log(returnedPost); 
         });
         
        }catch(e){
            console.log(e);
            alert("It's our fault but please try again");
        }
       
      
        return;
         //hide the upload progress bar
        if(!$(uploadprogress).hasClass("hidden")){
            $(uploadprogress).addClass("hidden");
        }

//    JSON.parse(response,function(key,value){
// console.log(key);
//    });
   let result;
    if(result = JSON.parse(response)){
     if(result.true){
       showDialog("#success-dialog",true,result.true);       
        
  }else if(result.false){
    //post box error handling
    let label = "label",location = "location",title = "title";
    switch ($.trim(result.false)) {
    case $.trim(label):
    labelError(4);
    break;
    case $.trim(location):
    locationError(4);
    break;
     case $.trim(title):
     titleError(4);
     break;
     default:
     if(result.ERROR){
  showDialog("#postbox-main",false,result.ERROR);
     }
   
     break;
}
                     // $("#error-dialog").html(response.trim());
}
}

});// dropzone.success();


    // if the file sending completed without errors
    myDropzone.on("error", function (file, error) {
       alert(error);
    });

    // tracks the progress of the file
    myDropzone.on("uploadprogress", function (file, percentage, bytes) {
        var progressBar = $("#uploadprogress").find("span")[0];
        var size = convertFileSize(bytes);
        if ($(progressBar)) {
            $(progressBar).css("width", Math.ceil(percentage) + "%");

        }
         
        if ($(sizeSent)) {
            $(sizeSent).html(Math.floor(percentage) + "% ( " + size + " ) ");
        }
        
        if(percentage == 100 && showPostErrorAlert === true ){
              setTimeout(function(){
                  
              });
        }
        //  console.log($(progressBar).prev());
        //        console.log("ceil: " + Math.ceil(percentage) +" round: " + Math.round(percentage));
    });

    //when the file upload completes
    myDropzone.on("complete", function () {
        //    // show the upload progress bar with the percentage and byte rate sent.
        var progressBar = $("#uploadprogress").find("span");
        $("#uploadprogress").find("span").css("width", "0%");
        if (sizeSent != null &&
            uploadprogress != null && (
                !$(sizeSent).hasClass("hidden") ||
                !$(uploadprogress).hasClass("hidden"))) {
            $(sizeSent).addClass("hidden");
            $(uploadprogress).addClass("hidden");
        }
        this.removeAllFiles();

        if($(postButton) && $(postButton).show()){
            $(postButton).hide();
        }
  if($(cancelButton) && $(cancelButton).show()){
            $(cancelButton).hide();
        }



    });



  function showDialog(selector,key,text = null){

    if(key === true){

(test != "" || text != false || text != null) ? ($("#success-dialog").html(text)) : $("#success-dialog").html("SUCCESS");
           
             // success dialog box
            $("#success-dialog").dialog({

                        dialogClass: "no-close",
                        show: {effect: "scale", duration: 400},
                        hide: {effect: "fadeOut", duration: 50},
                        draggable: false,
                        height: "auto",
                        maxHeight: 400,
                        minHeight: 200,
                        modal: true,
                        minWidth: 200,
                        resizable: false,
                        closeOnEscape: true,
                        buttons: [
                            {
                                text: "Ok",
                                icon: "ui-icon-heart",
                                click: function () {
                                    $(this).dialog("close");
                                }

                            }
                        ]
                    });
            $("#success-dialog").show();

    }else if(key === false){
       (text === null) ?  ($("#error-dialog").html(text)) : ""; 
                  
                    // success dialog box
                    $("#error-dialog").dialog({
                        dialogClass: "no-close",
                        show: {effect: "scale", duration: 400},
                        hide: {effect: "fadeOut", duration: 50},
                        draggable: false,
                        height: 50,
                        maxHeight: 100,
                        minHeight: 50,
                        modal: true,
                        minWidth: 200,
                        resizable: false,
                        closeOnEscape: true,
                        buttons: [
                            {
                                text: "Close",
                                icon: "ui-icon-heart",
                                click: function () {
                                    $(this).dialog("close");
                                }

                            }
                        ]
                    });

                    $('.ui-dialog-titlebar').addClass("error-titlebar");
                    $(".ui-dialog-title").addClass("error-title");
                  $("#error-dialog").show();

    }

  }


    // display the error for the label
    function labelError(count = null) {
   
     if(!count){

     
       $("fieldset").effect("shake");
      let labelError = $(".label-error")[1]
        if($(labelError) != null && $(labelError).hide()){
        $(labelError).show();
           $( "fieldset" ).tooltip({
             classes: {
        "ui-tooltip": "tooltip-error",
         "ui-tooltip-content":"tooltip-content-error"
 }
});
        }
        

    }else if(count){
  for (var i = 0; i <= count ; i++) {
      
  
       $("fieldset").effect("shake");
        if($(".label-error") != null && $(".label-error").hide()){
        $(".label-error").show();
           $( "fieldset" ).tooltip({
             classes: {
        "ui-tooltip": "tooltip-error",
         "ui-tooltip-content":"tooltip-content-error"
 }
});
        }
  
}
    }

return false;
    }

    // display the error for the title
    function titleError(count = null){
         if(!count){

         
        if($("#post_title") != null) {
            $("#post_title").effect("shake");
        }
      
      if($("sup") != null){
             $("sup").show();
         }
        $(".ps-videos-url").effect("highlight","#c61140");
        $( "#post_title_div" ).tooltip({
          classes: {
     "ui-tooltip": "tooltip-error",
      "ui-tooltip-content":"tooltip-content-error"
}
});

}else if(count){

     for (var i = 0; i <= count; i++) {
            
        if($("#post_title") != null) {
            $("#post_title").effect("shake");
        }
      
      if($("sup") != null){
             $("sup").show();
         }
        $(".ps-videos-url").effect("highlight","#c61140");
        $( "#post_title_div" ).tooltip({
          classes: {
     "ui-tooltip": "tooltip-error",
      "ui-tooltip-content":"tooltip-content-error"
}
});

     }
}

return false;
    }

    // display the error for the location
    function locationError(count = null){
    
       if(!count){

       
        if($("#location-tab") != null && $("#location-tab")){
         //$("#location_wrapper").effect("shake");
            $("#post_menu").effect("shake");
            $("#location_wrapper").css("background","red");
            $("#post_menu").css("background","red");
            $( "#location_wrapper" ).tooltip({
              classes: {
         "ui-tooltip": "tooltip-error",
          "ui-tooltip-content":"tooltip-content-error"
  }

});

 if($(".label-error").last() != null){
     $(".label-error").last().show();
 }
  }

}else if(count){
   

    for (var i = 0; i <= count ; i++) {
         
        if($("#location-tab") != null && $("#location-tab")){
         //$("#location_wrapper").effect("shake");
            $("#post_menu").effect("shake");
            $("#location_wrapper").css("background","red");
            $("#post_menu").css("background","red");
            $( "#location_wrapper" ).tooltip({
              classes: {
         "ui-tooltip": "tooltip-error",
          "ui-tooltip-content":"tooltip-content-error"
  }

});

 if($(".label-error").last() != null){
     $(".label-error").last().show();
 }
  }
 
    }

}
  return false;
    }
    // hide the mood picker
    function toggleMoodPicker(param) {
        // show the mood picker
        if (param.trim() === "show") {

            if ($(postbox_mood) != null) {
                $(postbox_mood).css("display", "flex");
                if (!$(postbox_mood).hasClass("placeholder")) {
                    $(postbox_mood).addClass("placeholder");
                }
            }

        } else
        if (param.trim() === "hide") {

            if ($(postbox_mood) != null) {
                $(postbox_mood).css("display", "none");
                if ($(postbox_mood).hasClass("placeholder")) {
                    $(postbox_mood).removeClass("placeholder");
                }
            }
        }

    } // hideMoodPicker();


    // hide the location picker
    function toggleLocationPicker(param) {

        // show the location picker if the param is show
        if (param.trim() === "show") {

            if ($("#location_wrapper") != null && $("#pslocation") != null) {
                $("#pslocation").removeClass("hidden");

            } // hide the location picker if the param is hide
            else
            if (param.trim() === "hide") {

                if ($("#location_wrapper") != null && $("#pslocation") != null) {
                    $("#pslocation").addClass("hidden");
                }

            }
        }
    } //toggleLocationPicker()


    // toggle the peoples picker
    function togglePeoplesPicker(param) {
        // show the peoples picker
        if (param.trim() === "show") {

            if ($("#people_wrapper") != null && $("#people_wrapper_div") != null) {
                $("#people_wrapper_div").css("display", "block");
            }
        } else

        if (param.trim() === "hide") {

            if ($("#people_wrapper") != null && $("#people_wrapper_div") != null) {
                $("#people_wrapper_div").css("display", "none");
            }
        }

    }


    // toggle the rest of the pickers apart from
    // the picker with id as the param
    function toggleTheRest(elementId) {

        if (elementId.length) {
            switch (elementId.trim()) {

                // TURNING ON THE PEOPLE WRAPPER
                case "people_wrapper_div":
                    // hide the mood picker
                    toggleMoodPicker("hide");
                    // hide the location picker
                    toggleLocationPicker("hide");
                    break;

                    //TURNING ON THE LOCATION
                case "location_wrapper":
                    // turn off the mood selector
                    toggleMoodPicker("hide");
                    // turn off the peoples wrapper
                    togglePeoplesPicker("hide");
                    break;

                    //TURNING ON THE MOOD SELECTOR
                case "mood_wrapper":
                    // hide the peoples picker
                    togglePeoplesPicker("hide");

                    // hide the location picker
                    toggleLocationPicker("hide");
                    break;

                    // TURNING ALL OFF WITH THE CANCEL UPLOAD BUTTON
                case "all":
                    // hide the peoples picker
                    togglePeoplesPicker("hide");

                    // hide the location picker
                    toggleLocationPicker("hide");

                    // hide the mood picker
                    toggleMoodPicker("hide");
                    break;
                default:
                   /*  console.log(""); */
            }

        }
    } //toggleTheRest


    // return the specific mood chosen by using
    // the iconClass and the mood(as plain text)
    function selectedMoodTemplate(iconClass, mood) {

        return "<span class='ps-postbox-addons' style='display: inline;'>? <i class='ps-emoticon " + iconClass + "'></i> <b> feeling " + post_mood + "</b></span>";

    } // selectedMoodTemplate()


    // helper method to toggle the cancel button
    function toggleCancelButton(toggle) {
        if (toggle != null && $(cancelButton) != null) {
            switch (toggle) {
                case "show":
                    $(cancelButton).show();
                    // console.log("cancel button shown here");
                    break;
                case "hide":
                    $(cancelButton).hide();
                    break;
                default:
                    // console.log("technical fault with toggling the cancel button");
            }
        } else {
            // console.log("Missing Cancel button");
        }
    }


    // reset the entire postbox
    function reset_postbox(key) {
       
       myDropzone.on("reset",function(){});
      refreshLabel();
      toggleCancelButton("hide");
      post_selectedLabel = "";

      if($(".label-error") && $(".label-error").css("display") == "block"){
           $(".label-error").hide();
      }
      
       let titleError = $("sup")[0];
      
      if($(titleError) && ($(titleError).css("display") == "inline" || $(titleError).css("display") == "block")){
        $(titleError).hide();
      }
     
     if($(post_caption)){
         $(post_caption).val();
     }

      $(post_title).val("");
      var span = $("span.ps-postbox-addons");

      if (span.length) {
          span.css("display", "none");
      }

      // if there is a caption
       if(  $(post_caption) &&   $.trim($(post_caption).val()) != ""){
           $(post_caption).val("");
       }

       // if the post title has has text
       if(  $(post_title) &&   $.trim($(post_title).val("")) != ""){
           $(post_title).val("");
       }

       if($("#location_wrapper") != null){

           $("#location_wrapper").css("background","");
       }
     //$(".ps-postbox-loading:eq(2)").show();

        // hide the cancel button
        // toggleCancelButton("hide");
        $(postButton).hide();
       
        // show the post box
        $(".ps-postbox-status:eq(0)").show();
        if($("#post").attr("placeholder") == ""){
            $("#post").attr("placeholder","Provide a short description of your post(optional)...");
        }
        // hide the post box ("comment")
        $(".ps-postbox-status:eq(1)").css("display") != "none" ? $(".ps-postbox-status:eq(1)").show() : "";
        $("#postcontent").show();
        $("#images").css("display", "none");
        $(postbox).val("");
        // reset the height of the textarea
        $(postbox).css("height", "36px");
        // reset the mirrored post
        $(firstPostMirror).html("");
        // reset the mood if any if chosen
        $(".ps-postbox-addons").html("");
        // reset the mood variable
        post_mood = [];
        toggleTheRest("all");
    } //reset_postbox()


    
    

    $(document).ready(function () {

         $(".ps-videos-url").keyup(function(){
          if($(".label-error").first() && $(".label-error").first().show()){
             $(".label-error").first().hide();
           }

         });

        //  get the label
        $(".labelset").prop("checked", true).change(function (e) {
             // label = $(e.target).attr("value");
            // selectedLabel = e.target;
            post_selectedLabel = $(e.target).attr("value");
            if($(post_selectedLabel) != "" && $(".label-error").eq(1).show()){
            $(".label-error").eq(1).hide();
            }
    // $(".label-error").eq(1).hide();
            //console.log(post_title);
 // console.log(selectedLabel);
        });


        // get the mood
        $(".mood-list").on("click", function () {
            if($(".ps-postbox-addons").hide()){
                $(".ps-postbox-addons").show();
            }
            var $trigger = $(this);
            var $icon = $trigger.find("i"); // will return a jQuery list of items (list.length === 0 means not found)

            post_mood["span"] = $trigger.find("span"); // will return a jQuery list of items (list.length === 0 means not found)
            //console.log($trigger.get(0));
            if ($icon.length) {
                let iconClass = $icon.attr("class");
                var icon = $icon.attr("class");
                //    console.log(iconClass);
                post_mood["icon"] = icon;
            } else {
                //console.log("icon not found");
            }
            post_mood["span"] = post_mood["span"].html();
            if (post_mood["span"].length) {
             // console.log(post_mood["span"]);
            } else {
                //  console.log("span not found");
            }

            // store the selected post_mood
            var $selec = selectedMoodTemplate(icon, post_mood["span"]);

            // get the element to replace with
            var mood_span = $(".ps-postbox-status:eq(0) div:nth-child(1) span:nth-child(2)")[0];

            // replace the former element with the new
            // selected mood
            $(mood_span).replaceWith($selec);

            // get the textarea and set remove the placeholder
            $(postbox).attr("placeholder", "");
            toggleCancelButton("show");
        });


        // when the image /video div is clicked
        // display the clickable elements
        $(".media-upload").click(function () {
            // hide the status textarea that reads(say something...)
            $(".ps-postbox-status:eq(0)").show();
            // $("#images").css("display","block");
            // show the cancel button
            $(cancelButton).show();
            //say something about the post
            $("#postcontent").show();

        });


        // if the location icon is clicked?
        // then toggle the class hidden
        if ($("#location_wrapper") != null) {
            $("#location_wrapper").click(function () {
                $("#pslocation").toggleClass("hidden");
                // turns off the display of the other popovers
                toggleTheRest("location_wrapper");
            });
        }


        // show the drop down if the people wrapper is clicked
        if ($("#people_wrapper") != null && $("#people_wrapper_div") != null) {
            $("#people_wrapper").click(function () {
                $("#people_wrapper_div").toggle();
                // turns off the display of the other popovers
                toggleTheRest("people_wrapper_div");
            });

        }

        // when the mood icon is clicked
        if ($("#mood_wrapper") != null && $(postbox_mood) != null) {
            $("#mood_wrapper").click(function () {
                if (!$(postbox_mood).hasClass("placeholder")) {
                    // show the mood picker
                    toggleMoodPicker("show");
                    // turns off the display of the other popovers
                    toggleTheRest("mood_wrapper");
                } else if ($(postbox_mood).hasClass("placeholder")) {
                    toggleMoodPicker("hide");
                }

            });
        }


        // show the cancel button when the postbox has focus and hide the ajax loaging gif
        $(postbox).focus(function () {
            toggleCancelButton("show");
        });

        // when they start typing in the title bar
        $(".ps-videos-url").keyup(function(e){
            if($(".ps-videos-url") && $.trim($(".ps-videos-url").val()) != "" && $("sup").show()){
                 $("sup").hide();
            }
        });

        // when the location tab has being clicked hide the error;
        $("#location-tab").click(function(){
           
          if($(".label-error").last() != null){
          if( $(".label-error").css("display") != "none"){
                  $(".label-error").last().hide();
                  if($(".label-error").last().css("background") == "red"){
                     $(".label-error").last().css("background","")

                  }
             }
          }

        });

        // when the user starts to type display the post button
        // || .ps-textarea
        $(post_caption).keyup(function (e) {
            // if($.trim($(postbox).val()) == ""){
            //   $(".ps-postbox-addons").css("margin-left","0.5em");
            //   return;
            // }

            if($(post_caption) && $.trim($(post_caption).val()) != ""){
                 toggleCancelButton("show");
               //  $(postButton).css("display","inline");
            }
             // let stringLength = $.trim($(postbox).val()).length;
           
             

            // if the post textarea is not empty or null
            // fill the poststatus with the contents of the // post textarea
            if ($(post_caption).val() != null || $.trim($(post_caption).val())!= "") {
                $(firstPostMirror).html($(post_caption).val());
        } else {
                // console.log($(post));
            }

        });


        // when the user post's the content empty the textarea and display
    });     // // the ajax loading 
 
})(jQuery);
 function post_options_dropdown(element){
$(element).find(".ps-dropdown__menu").toggle("fade",100);

}        

function post_option_edit(user_id = 0,post_id = 0,element = ""){

    if(typeof user_id != "number" || typeof post_id != "number" || $.trim(element) == ""){
        return;
    }

   let grParent =  $(element).parentsUntil("#ps-activitystream");
   let title    =  $(grParent).find(".ps-stream-action-title").html();
   
       title    =  title.split("<a")[0];

   let caption  = $(grParent).find("peepso-markdown").find("p");
       caption   = $.trim($(caption).html());

   let editBox  =  $(grParent).find(".ps-js-activity-edit");   
     // show the editBox
     $(editBox).show();

     

}

  function editPost(post_id = 0,targetElement = ""){

      if(typeof post_id != "number" || $.trim(targetElement) == ""){
          return;
      }

      let grParent = $(targetElement).parentsUntil("#ps-activitystream");
      let mainParent = $(grParent).find(".ps-postbox");
      let title    = $(mainParent).find("textarea")[0];
      let titleParent = $(title).parent();
          title     = $(title).html();
      let caption   = $(mainParent).find("textarea")[1];
          caption   = $(caption).html();
           if($.trim(title) == ""){
             $(titleParent).effect("shake");
             $(titleParent).css("border","#d24942");
             $(titleParent).css("background","#d24942");
             return;
           }
          console.log(grParent);  
          console.log(title);  
          console.log(caption);   


          $.ajax({
            url: "../private/neutral_ajax.php",
            type: "POST",
            data: {request_type: "edit_post",caption: captionValue, title: titleValue,location: locationValue},
            dataType : "html"
          }).done(function(response){
             console.log(response);

             try{
               response = JSON.parse(response);
               


             }catch(e){

             }      

          }); 
  }



  function cancelEditPost(targetElement = ""){
      
      if($.trim(targetElement) == ""){
return;
      }


    let editBox = $(targetElement).parentsUntil(".ps-stream-body");
         //hide the entire editbox
         $(editBox);

   

  }



function post_option_delete(userID,postID,element){
  
  if(Number(userID)  == 0 || Number(userID)  == undefined  || Number(userID) == null ||
     Number(postID)  == 0 || Number(postID)  == undefined  || Number(postID) == null ||
     $.trim(element)  == "" || $.trim(element) == undefined || $.trim(element) == null){

 return;
  }
    
     let postContainer = $(element).parentsUntil("#ps-activitystream").fadeOut(600);

    $.ajax({
        url: "../private/neutral_ajax.php",
        type: "POST",
        data: {post_id: postID,user_id: userID,request_type:"delete_post"},
        dataType: "html"
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
       if(response["true"]){
         $(postContainer).remove();
       }
       }catch(e){
        $(postContainer).fadeIn(600);
  utility.showErrorDialogBox("It is our fault, but please try again.<br /> if problem persist refresh the page ");
       }
       
    }).fail(function(error){
        utility.showErrorDialogBox("It is our fault, but please try again.<br /> if problem persist refresh the page ");
        $(postContainer).fadeIn(600);
    });

}

function post_option_follow(post_id,element){
    
}

function post_option_link_user(info = "" ,postID = 0,element = ""){
  
  if($.trim(info) == "" || Number(postID) < 1 || $.trim(element) == "" ){
    return;
  }

  
  info = JSON.stringify(info);
  info = JSON.parse(info);
   let requestTypeValue = "link_user";

    $.ajax({
    url: "../private/neutral_ajax.php",
    type: "POST",
    data:{firstname: info["firstname"],lastname: info["lastname"],id: info["id"],post_id: postID,request_type: requestTypeValue},
    dataType: "html"
  }).done(function(response){
      console.log(response);
  }); 
  
  
  
    
}

function post_options(userID = 0,postID = 0 , element = "",option = null){
 
    if(!utility.validate_presence(postID) || !utility.validate_presence(element)){
        return;
    }
  
   let mainParent = $(element).parentsUntil(".ps-stream");
   let requestTypeValue        = "confirm_post";
   let title                   = "";
   let confirmationText        = "";
   let addElementClass         = "";
   let removeElementClass      = "";
   let addIconClass            = "";
   let removeIconClass         = "";
  
 
 

   requestTypeValue = (option == null || $.trim(option) == "") ? "comfirm_post" : option;
    
 
    $.ajax({
        url: "../private/neutral_ajax.php",
        type: "POST",
        data: {user_id: userID,request_type: requestTypeValue,post_id: postID},
        dataType: "html"
    }).done(function(response){
       console.log(response);
    
try{
      response = JSON.parse(response);
      let confirmationTextSpan = $(element).find("span")[0]; 
      let confirmationIcon = $(element).find("i")[0];
     
      if(response["true"] == "success" || response["unlink"] == "success" || response["unfollow"]){
           if(option == "confirm_post" || option == null){
                
                 title              = ($(element).hasClass("confirm_post")) ? "Confirm that this incident really took place" : "Reverse the confirmation of this incident";
                 confirmationText   = ($(element).hasClass("confirm_post")) ? "Confirm this post" : "Reverse Confirmation";
                 addElementClass    = ($(element).hasClass("confirm_post")) ? "confirm_post" : "reverse_post_action";
                 removeElementClass = ($(element).hasClass("confirm_post")) ? "reverse_post_action" : "confirm_post";
                 addIconClass       = ($(element).hasClass("confirm_post")) ?  "fal fa-check-circle" : "fal fa-undo-alt";
                 removeIconClass    = ($(element).hasClass("confirm_post")) ?  "fal fa-undo-alt" : "fal fa-check-circle";
                     
            }else if(option == "link_user" ){
     
                  title                  =  ($(element).hasClass("reverse_post_action")) ?  "linking with a user will get you notified of all future incidents posted by that user." : "You will be notified of incidents posted by this person.";
                  let user               =   $(mainParent).find(".ps-stream-user");
                  $(user).parent().toggleClass("breathing_space");
                   $(user).toggleClass("link_user",1000,"easeOutBounce");
                   $(user).find("small").toggle();
                  let userFullname       =  $(user).html();
                  userFullname           = userFullname.split("<small")[0];
                  console.log(userFullname);
                  confirmationText       =  ($(element).hasClass("reverse_post_action"))  ?  "link with " + userFullname : "unlink with " + userFullname;
                  addElementClass        =  ($(element).hasClass("reverse_post_action"))    ?  "" : "reverse_post_action";
                  removeElementClass     =  ($(element).hasClass("reverse_post_action")) ? "reverse_post_action" : "";
                  addIconClass           =  ($(element).hasClass("reverse_post_action"))  ? "fal fa-link" :  "fal fa-unlink";
                  removeIconClass        =  ($(element).hasClass("reverse_post_action"))  ? "fal fa-unlink" :  "fal fa-link";
                       
                }else if(option == "follow_post"){
                 title                  =  ($(element).hasClass("reverse_post_action"))   ?  "if you follow this incident you will be notified about every development of it." : "Get notified about every development of this incident.";
                 confirmationText       =  $(mainParent).find(".ps-stream-user").html();
                 $(mainParent).find(".following_span").toggle("slide");
                 confirmationText       =  ($(element).hasClass("reverse_post_action"))    ?  "follow this incident" : "unfollow this incident";
                 addElementClass        =  ($(element).hasClass("reverse_post_action"))    ?  "follow_post" : "reverse_post_action";
                 removeElementClass     =  ($(element).hasClass("reverse_post_action"))    ?  "reverse_post_action" : "follow_post";
                 addIconClass            =  ($(element).hasClass("reverse_post_action"))    ?  "far fa-eye" : "far fa-eye-slash";
                 removeIconClass         =  ($(element).hasClass("reverse_post_action"))    ?  "far fa-eye-slash" : "far fa-eye";
                 let uiFollowing         = $(mainParent).find("ps-stream-meta").find("ps-stream-time").toggle("fade",400);
           }

           console.log(title);
           console.log(confirmationText);
           console.log(addElementClass);
           console.log(removeElementClass);
           console.log(removeIconClass);
           console.log(addIconClass);

                 $(element).attr("title",title);
                 $(element).removeClass(removeElementClass).addClass(addElementClass);
                 $(confirmationIcon).removeClass(removeIconClass);
                 $(confirmationIcon).addClass(addIconClass);
                 $(confirmationTextSpan).html(confirmationText);
                 
               
                 
        }

          else if($.trim(response["false"]) != ""){
         utility.showErrorDialogBox(response["false"]);
      }
 }
      
    catch(e){
         console.log(e);
    utility.showErrorDialogBox(response["false"]);
                        
    }
    });






}


