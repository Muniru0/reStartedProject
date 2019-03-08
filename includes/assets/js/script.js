
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//$(function () {
//  $('[data-toggle="tooltip"]').tooltip();
//});
//
//$(function () {
//  $('[data-toggle="popover"]').popover()
//})
//
//var ajax_url = "../s2CxARWoyfS608LFDZxNvOC8OoZR9Qg/neutral_ajax.php";
//
//function ajax_input_field(val = ""){
// return "<input type='hidden' name='ajax' value="+val+" />";
//}
//// $.document(load,function(){
//// get_views();
//// });
//
//// add to trybe
////add_to_trybe();
////get the views for the post
//get_views();
//
// $("#name").keyup(function (){
//     name_suggestion();
// });
//
//function name_suggestion() {
// // var name = document.getElementById("name").value;
//
// var name  = $("#name").val();
//
//  if($.trim(name) != "" ){
//
//  
//     $.ajax({
//        url:ajax_url,
//        type:"POST",
//        data:{name:name},
//        datatype:"html"
//     }).done(function(info,status){
//
//          if(status == "success"){
//            if($("#suggestion") != null){
//          info = JSON.parse(info);
//           $.each(info,function(index,value){
//        $("#suggestion").append("<li>"+value+"</li>");
//           });
//         //console.log(info);
//          }
//            }
//        });
//
//}else{
//$("#suggestion").html("");
//}
//   
//}
//
//var files;
//$("#files").on("change",function(e){
//  
//  files = e.target.files
//
//});
//
//$("#post").on("click",function(e){
//
////var data = new FormData();
//
//console.log($("#files"));
//// $.each($("#files").files,function(i,files){
//
////    data.append("files-"+i,files);
//// });
//// console.log(data);
//
//$("form").submit(function(e){
//
//console.log($("#post_image_form")[0]);
//$.ajax({
//    url:ajax_url,
//    type: "POST",
//    data:{files:files},
//    contentType:"multipart/form-data",
//    datatype:"html"
//}).done(function(info,status){
//   if(status == "success"){
//  console.log("the request was successful "+info);
//   }
//  //console.log(info);
//});
//});
//e.preventDefault();
//});
//function post_file(){
//
//   $.ajax({
//    url:ajax_url,
//    type:"POST",
//    data:{}
//   });
//}
//
//function trybe_or_follow(element,first_check,second_check,search_found_index){
//
//// $(class_name).on("click",function(e) {
////      e.preventDefault();
////     var element = e.target;
//   
//    if($.trim($(element).html()) == $.trim(first_check)){
//       $(element).html($.trim(second_check));
//     }else{
//       if($(element).html() == $.trim(second_check)){
//        $(element).html($.trim(first_check));
//       }else{
//        return null;
//       }
//     }
//   var element_id = $(element).prop("id");
//    
//    if(element_id.search(/[_]/g) == search_found_index){
//    element = element_id.split("_");
//   // check if it is a number
//    if($.isNumeric($(element)[1])){
//
//  console.log($(element)[1]+"_"+$(element)[2]);
//
//return $(element)[1]+"_"+$(element)[2];
//
//}
//
//
//}
//
//
////});
//}
//
//
//$(".trybe_member").on("click",function(e){
//
//     e.preventDefault();
//     var element_id = trybe_or_follow(e.target,"trybe","Untrybe",5);
//     add_to_trybe(element_id);
//});
//
//
//$(".follow_post").on("click",function(e){
//    
//    e.preventDefault();
//    var element_id = trybe_or_follow(e.target,"follow","Unfollow",6);
//    //console.log(element_id);
//    follow_post(element_id);
//
//});
//
//function follow_post(element_id) {
// 
// //console.log(element_id);
//     $.ajax({
//      url:ajax_url,
//      type:"POST",
//      data:{follow_post:element_id},
//      datatype:"html",
//}).done(function(info,status){
//
//  if(status == "success"){
//
//    console.log($.trim(info));
//
//  }
//}); 
//}
//
//function add_to_trybe(element_id){
// //console.log(element_id);
//     $.ajax({
//      url:ajax_url,
//      type:"POST",
//      data:{trybe_member:element_id},
//      datatype:"html",
//}).done(function(info,status){
//
//  if(status == "success"){
//
//   console.log(info);
//
//  }
//});
//    }
//   
//
//
//
//
//// });
//// }
//
//
//// GET THE VIEWS
//
//function get_views(){
//
//var value = $("#post_ids").prop("value");
//     $("#post_ids").remove();
////console.log(value);
//
//   $.ajax({
//    url:ajax_url,
//    type:"POST",
//    data:{get_views: value},
//   //contentType:"application/x-www-form-urlencoded",
//   datatype:"html",
//}).done(function(info,status){
//
// //console.log(info);
//    if(status == "success"){
//      
//    value = JSON.parse(info);
//     
//     //console.log(info);
////loop through the entire array 
//// and 
//    $.each(value,function(index,views){
//      // get the element by the id
//       var element =  $("#views_"+$.trim(index));
//
//        if(element != null){
//         // console.log("the id was found....!");
//       // append the view to the element
//         $.each(views,function(realindex,realview){
//          element.append(realview["view"]);
//         });
//  }
//    });
//}
//
// });
//}
//// prevent the default the behaviour of the 
//// button to show the post textarea
//$("button").on("click",function(event){
//
//    event.preventDefault();
//
//  //  var button = "button"
//});
//
//// prevent the default behaviour of the links 
//// to delete or edit the view
//// $("div a").on("click",function(event){
//
////     event.preventDefault();
////   console.log("it prevented the default describekdf;a");
// 
//// });
//
//
//$("div").on("click",function(e){
//  // prevent the default behaviour
//  // of the link here
//   
//   if($(e.target).attr("role") == "button"){
//        // e.preventDefault();
//         edit_view(e.target);
//      
//   }else{
//// get the button that has being pressed
//  var button  = e.target;
//  // get the parent div element of the button 
//  // that has being pressed
//  var element = $(button).parent();
//  // get the the textarea of the div
//  element     = $(element).find(".view");
//  
//
//  if(button.id == "support_button"){
//     oppose_textarea = element[1];
//      
//     if($(oppose_textarea).css('display') != 'none'){
//         $(oppose_textarea).focusout();
//        $(oppose_textarea).toggle();
//     }
//
//
//
// $(element[0]).toggle();
//
//
//
//}else
//  
//  if(button.id == "oppose_button"){
//      
//support_textarea = element[0];
//  
//  
// if($(support_textarea).css('display') != 'none'){
//   // console.log(support_textarea);
//   $(support_textarea).focusout();
//    $(support_textarea).toggle();
// }
//
// 
// $(element[1]).toggle();
//     
//}
//}
//});// show or hide the respective view textarea.
//
//
//// helper methods to get the focused element
//function getFocusedElement(event,selector = null,position = null){
//
//  var theElement = event.target;
//  var parentElement = $(theElement).parent();
//  var mainElement    = $(parentElement).find(selector);
//
//  if(position != null){
//     return mainElement[position];
//}else{
//
//  return mainElement;
//}
//}// returns the focused element
////drop the view in the database;
//
//
//
//
//// define and implementation of the edit 
//// view method
//
//function edit_view(element = ""){
//
//
//     var id = $(element).attr("id");
//
//     var element_two = $(element).parent();
//     var element_two_value = $(element_two).find("p").html();
//   //console.log($(element_two).find("p").html());
//      id = id.split("/");
//      var view_id = id[1];
//      // this enables us to get the textarea to populate
//      var post_id = id[2];
//      // this to enable we get the textarea to populate
//      var type_of_view = id[3];
//       element_two = $(element_two).parent();
//      element_two = $(element_two).parent();
//var element_value = $(element).val();
//var textarea = $(element_two).find("textarea");
//      if(id[0] == "1"){
//       // console.log("it supported the view");
//        textarea = textarea[0];
//           if($(textarea).prop("placeholder") == "support"){
//          //$(textarea).css("display","inline-block");
//          console.log(textarea);
//       $(textarea).html(element_two_value);
//     }
//      }else if(id[0] == "0"){
//    
//     textarea = textarea[0];;
//     $(textarea).toggle();
//      $(textarea).html(element_two_value);
//      }
//
//     
//     // console.log(element_two[0]);
//}
//
//
//// add a view of the post
//$(".view").focus(function(e){
//   
//  // get the focused element
//  //console.log(e.target);
//
//   
//  
//   var display_paragraph = $(e.target).attr("id");
//
//  
//     display_paragraph = display_paragraph.split("/");
//
//  // check for the pressing of a key
// // console.log(element);
//
//   var element;
//  if(display_paragraph[1] == "1"){
//        element = getFocusedElement(e,".view",0);  
//}else
//if(display_paragraph[1] == "0"){
//        element = getFocusedElement(e,".view",1);
//}
//      $(element).keypress(function(e){
//      var element_value = $(element).val();
//      // var array_element_value = ["holds","/hello"]; 
//      // console.log(array_element_value.length);
//      // if it is the enter key,
//      // trim and make sure that
//      // the value is not empty  
//      if(e.which == 13 && $.trim(element_value) != ""){
//      // prevent the default behaviour of the enter 
//      // key
//      // perform the ajax request
//      var info = [display_paragraph[2],element_value,display_paragraph[3]];
//     addView(info,"html",element,element_value,display_paragraph[1],display_paragraph[2],display_paragraph[3]);
//      //empty the textarea
//      $(element).val("")
//      // prevent the default action of the enter key
//      e.preventDefault();
//
//     
//
//}});
//          
//
//  }); 
//
//
//// cancelling the default behaviour of the trybe members link tag
//
//$(".trybe_member .follow_post").on("click",function(e){
//
//    e.preventDefault();
//  
//});
//
//
//
//
//// display the total number of reactions per post
//function displayTotalReactions(info,support_base_id,oppose_base_id){
//
//      info = $.parseJSON(info);
//      var totalSupports = info[0];
//      var totalOpposes  = info[1];
//      var db_post_id    = info[2];
//
//      var support =  $("#"+support_base_id+db_post_id);
//       //console.log("#support");
//      support.html(totalSupports);
//   
//      support = $("#"+oppose_base_id+db_post_id);
//      support.html(totalOpposes);
//}
//
//
//
//// this is to record or update the 
//// reaction on a post
//$("input").click(function(e){
//     
//
//  var reaction = e.target;
//  reaction = $(reaction).attr("value");
//
//// split the value of the input tag,use the 
//// first element of the arrayOfStrings and...
//
// var splittedId = reaction.split("/");
// var post_id = splittedId[splittedId.length - 2];
//  splittedId[0] = "checked";
//  var supportButton = $("#sup"+post_id);
//  var opposeButton   = $("#opp"+post_id);
//   
//   splittedId[splittedId.length - 1] = 1;
//  $(supportButton).attr("value",splittedId.join("/"));
//  
//  
//  splittedId[splittedId.length - 1] = 0;
//  $(opposeButton).attr("value",splittedId.join("/"));
//  
//
//   $.ajax({
//    url:ajax_url,
//    type:"POST",
//    data:{reaction: reaction},
//   contentType:"application/x-www-form-urlencoded",
//   datatype:"html",
//}).done(function(info,status){
//
//
//    if(status == "success"){
//      
//      displayTotalReactions(info,"support","oppose");
//
//    // console.log($info);
//
//  // get the element which id you are about to 
//          // update.
//          
//         
//
//          // get the element which id you are about to 
//          // update.
//        //  $("#"+realIdOppose).attr("id",oppose);
//          
//
//   }
//
// });
//
//    // function display_data() {
//
//        
//    //     if (request.readyState == 4) {
//    //         if (request.status == 200) {
//
//    //     if (reactionValue != '') {
//    //  request.onload = function(){
//    //     console.log(request);
//     // declare the response variables for easy manipulation   
//                    // var response = request.response;
//                    // console.log(response);
//                   
//
//                    // console.log("total number of supports: " + totalSupports + " opposes " + totalOpposes
//                    //   + " id: " + db_post_id);
//                  
////                     //find the paragraph that holds the support value
////                     reaction = document.getElementById("support"+db_post_id);
////                     if(reaction != null){
////                           console.log(reaction.innerHTML);
////                         // update the total number of supports with the 
////                         // info from the database
////                       reaction.innerHTML = totalSupports;
////                       // set the first element of the exploded input.value string
////                       // to support for the paragraph that holds the supports
////                     arrayOfStrings[arrayOfStrings.length - 1] = "1";
////                     // join the array of strings back together to form a 
////                     // complete input.value string
////                     var joinedStrings  = arrayOfStrings.join("/");
//                    
////                     //  now get the input tag for support 
////                       var inputSupportElement = document.getElementById("sup"+db_post_id);
//                    
////                        if(inputSupportElement != null){
////                          // set the value to joinedStrings
////                          inputSupportElement.value = joinedStrings;
////                        }else{
////                         console.log("input"+reaction);
////                        }
//      
////                     }else{
////                         console.log("couldn't be found :support"+db_post_id);
////                     }
//
//
////                     //find the paragraph with the oppose and update it
////                     reactionOppose = document.getElementById("oppose"+db_post_id);
////                     if(reaction != null){
////                   console.log(reaction.innerHTML);
////                   reactionOppose.innerHTML = totalOpposes;
//                   
////                     arrayOfStrings[arrayOfStrings.length - 1] = "0";
////                     var joinedStrings  = arrayOfStrings.join("/");
////                       var inputOpposeElement = document.getElementById("opp"+db_post_id);
////                        if(inputOpposeElement != null){
////                          console.log(joinedStrings);
////                          inputOpposeElement.value = joinedStrings;
////                        }else{
////                         console.log("input"+reaction);
////                        }
//      
////                     }else{
////                         console.log("Couldn't be found : oppose"+db_post_id);
////                     }
//
////                        }
////                        }
////                        }
//                            
////  } 
//
////      else { 
////          // console.log(request);
////                 //maybe some animation here to describe the process of search.
////                 suggestion.innerHTML = 'Searching...';
//
////             }
//        
////     }
//// // var button = ;
//   
//   
//});
//
//
// 
//
//$('#button').click(function (){
//
// $('#form').toggle();
//});
//
//
//
//
//
//function addView(serverData = "",type = null,element = "",value = "",type_of_view = null,post_id = null,view_id = null){
//  
// 
// if(type == null){
//   
//   type = "json";
// }
//
//if($.trim(serverData) != ""){
//
//$.ajax({
//  url: ajax_url,
//  type: "POST",
//  data: {reaction_view: serverData},
//  //contentType: "text/plain",
//  datatype: type,
//}).done(function(info,status){
//
//   info = info.trim();
//  if(status == "success"){
//
//    if(type_of_view == "1"){
//        // append the text to the paragraph of the display supports
//   //  console.log($(element).parent().find(".display_reaction")[0]+" thecisd: "+info);
//    // var display_reaction =   $(element).parent().find(".display_reaction")[0];
//   
//      // $("<p>Test</p>").insertAfter($(element).parent().find(".display_reaction")[0]);
//         $($(element).parent().find(".display_reaction")[0]).append("<div class=\"view_support\"><p>"+value+"</p><br /><a href='../s2CxARWoyfS608LFDZxNvOC8OoZR9Qg/update_view.php?id="+info+"&post_id="+post_id+"&link_type=edit' role='button' class='edit_view' id = '1/"+info+"/"+post_id+"/"+view_id+"'>edit</a>  <a href='#' role='button' class='delete_view' id = '0/"+info+"/"+post_id+"/"+view_id+"'>delete</a></div>");
//         // $("<p>Test</p>").insertAfter($(element).parent().find(".display_reaction")[0]);
//        //console.log($(element).parent()[0]); 
//      }else
//      if(type_of_view == "0"){
//      // append the text to the paragraph of the display oppose
//      // console.log($(element).parent().find(".display_reaction")[0])
//      $($(element).parent().find(".display_reaction")[0]).append("<div class=\"view_oppose\"><p>"+value+"</p><br /><a href='#' role='button' class='edit_view' id = '1/"+info+"/"+post_id+"/"+view_id+"'>edit</a>  <a href='#' role='button' class='delete_view' id = '0/"+info+"/"+post_id+"/"+view_id+"'>delete</a></div>");
//      }
//
// $(element).val("");
//  }
//});
//} 
//}
    
  //  });