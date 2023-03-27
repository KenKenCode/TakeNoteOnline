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
          note_id:id_note //will be used for selectNote.php POST method
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


    $("#searchForNotesID").click(function(){
      $("#tableForNotes").hide();
      $("#searchForNotes").show();


    });
    
    $("#contentForNotesID").click(function(){
      $("#tableForNotes").show();
      $("#searchForNotes").hide();
    });

    $("#searchForNotes").hide();
}



  

);


