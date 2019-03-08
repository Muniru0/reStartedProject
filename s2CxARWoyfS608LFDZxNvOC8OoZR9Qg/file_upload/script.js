$(function()
{
	// Variable to store your files
	var files;

	// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('form').on('submit', uploadFiles);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // START A LOADING SPINNER HERE
         var name = $("#name").val();
        // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
        
     // console.log(data);
     var jqxhr =   $.ajax({
            url: '../../s2CxARWoyfS608LFDZxNvOC8OoZR9Qg/neutral_ajax.php',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'html',
            processData: false, // Don't process the files
            contentType: false // Set content type to false as jQuery will tell the server its a query string request
     //        success: function(data, textStatus, jqXHR)
     //        {
     //            console.log(textStatus + "  " + data);
     //        	if(typeof data.error === 'undefined')
     //        	{
     //                console.log("it has called the submitForm");
     //        		// Success so call function to process the form
     //        		submitForm(event, data);
     //        	}
     //        	else
     //        	{
     //        		// Handle errors here
     //        		console.log('ERRORS: ' + data.error);
     //        	}
     //        },

     //        error: function(jqXHR, textStatus, errorThrown)
     //        { //console.log(jqXHR);
     //           // console.log(errorThrown);
     //        	// Handle errors here
     //        	console.log('ERRORS: ' + textStatus);
     //        	// STOP LOADING SPINNER
     //        }
   })
.done(function(info,status){
           
            if(status == "success"){

             console.log(info);
             // info = JSON.parse(info);
               //console.log(info);
                //submitForm(event,info);

            }else{
                console.log("the request was not successful");
            }

        })
        // Assign handlers immediately after making the request,
// and remember the jqXHR object for this request

  .fail(function(info,status) {
    //alert("Error: Please try again");
  })
  .always(function(info,status) {

    //alert( "complete" + status);
  
  });
 
// Perform other work here ...
 
// Set another completion function for the request above
jqxhr.always(function(info,status) {
 // alert( "second complete" + status);
});

    }

    function submitForm(event, data)
	{
		// Create a jQuery object from the form
		$form = $(event.target);
		//console.log("it has called the submitForm  function");
		// Serialize the form data
		var formData = $form.serialize();
		 
		// You should sterilise the file names
		$.each(data.files, function(key, value)
		{
			formData = formData + '&filenames[]=' + value;
		});
  //console.log("--------" + formData +" : " + data + "------------");
		$.ajax({
			url: '../../s2CxARWoyfS608LFDZxNvOC8OoZR9Qg/neutral_ajax.php',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		//console.log('SUCCESS: ' + data.success);
            	}
            	else
            	{
            		// Handle errors here
            		console.log('ERRORS: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	console.log('ERRORS: ' + textStatus);
            },
            complete: function()
            {
            	// STOP LOADING SPINNER
            }
		});
	}
});