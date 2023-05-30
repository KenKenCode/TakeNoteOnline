$(document).ready(function(){

$.ajax({
  url: "ajax_handler.php",
  method: "POST",
  data: {
    ajax_action: "action2", // Specify the action you want to perform
    // Additional data parameters if needed
  },
  success: function(response) {
    // Handle the response from the server
    console.log(response);
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Handle errors
    console.log("AJAX Error: " + textStatus + " - " + errorThrown);
  }
});


});