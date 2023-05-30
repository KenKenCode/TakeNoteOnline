$(document).ready(function(){

$('#ajaxTry').on('click', function(){
	idOne = 1;
	idTwo = 2;
	
	act = "action1";
	$.ajax({
		url: "one.php",
		method: "GET",
		data: {
			action:act
		},
		success: function(response) {
        // Handle the response from the server
        alert(idTwo);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        // Handle errors
        console.log("AJAX Error: " + textStatus + " - " + errorThrown);
        }
	});
	
});

});


/*
Ask on StackOverflow:
Why does my php file cannot read the data from AJAX data parameter, but the success parameter returns its value? What I expect to happen is that case: "action1" from one.php will return its value since it is the value of parameter 'action' from my AJAX data.
*/