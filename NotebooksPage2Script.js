const navLinks = document.querySelector(".nav-links");

const showMenu = () => {
    navLinks.classList.toggle("show"); //will show the nav links that has been hidden because of .nav_links {display: none;}
}



$(document).ready(
  function showNote(){
    $('.noteIDClass').click(function(){
  id_note = $(this).attr('id') //href is also compatible replacement for id.
  
        $.ajax({url: "selectNote.php",
        method:'post',
        data:{
          note_id:id_note
        },
        success: function(result){

    $(".modal-body").html(result);

  },    error: function(jqXHR, textStatus, errorThrown) {
        // Code to handle errors
        console.log("AJAX Error: " + textStatus + " - " + errorThrown);
    }
	
  });

        $('#myModal').modal("show");
    });


    
    

}



  

);


function giveWarning() {
  alert("Warning message.");
  document.write ("Warning message.");
} 