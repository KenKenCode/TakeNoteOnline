const navLinks = document.querySelector(".nav-links");

const showMenu = () => {
    navLinks.classList.toggle("show"); //will show the nav links that has been hidden because of .nav_links {display: none;}
}

function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true; 
        break;
      }


    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); //inserts the greater value before the lesser value
      switching = true; // continues to 'switching' while loop
    }
  }
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

    $("#tableSorter").click(function() {
      var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("noteTable");
  
  switching = true;
  
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true; 
        break;
      }


    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); //inserts the greater value before the lesser value
      switching = true; // continues to 'switching' while loop
    }

    console.log('This is a sign that this sorting functionality works');
  }
    });
    
}



);




