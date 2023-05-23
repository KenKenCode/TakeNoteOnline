const navLinks = document.querySelector(".nav-links");

const showMenu = () => {
    navLinks.classList.toggle("show"); //will show the nav links that has been hidden because of .nav_links {display: none;}
}

//TinyMCE:
tinymce.init({
  selector: '#noteContent, #editNoteArea',
  width: '100%', 
  
});

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
    document.getElementById("dropdownMenu1").innerHTML = "Sort 🔽"; //Set the default look of Sort functionality

    
    $('.noteIDClass').click(function(){
        //Basically, .attr() gets the attribute value from $(this).attr('id'). so this could be $('.className').attr('id'), the id of the .className is selected.
        event.preventDefault(); // prevent page reload
        id_note = $(this).attr('id'); //href is also compatible replacement for id.
        id_noteTwo = $(this).attr('id');
        console.log(id_note);
        console.log("id_noteTwo value: " + id_noteTwo);

        
        //Bootstrap from NotebooksPage2.php would also be automatically applied to selectNote.php since we open it using from notebookspage2 using this ajax code
        $.ajax({url: "selectNote.php",
        method:'post',
        data:{
          note_id:id_note //will be used for selectNote.php POST method
        },
        success: function(result){
          //setContent of TinyMCE in editNoteArea
    $(".modalBodyOfSelectedNote").html(result); //class of the body of the modal in note selection
    $('#myModal').modal("show");

  },    error: function(jqXHR, textStatus, errorThrown) {
        // Code to handle errors
        console.log("AJAX Error: " + textStatus + " - " + errorThrown);
    }
	
  });
  

  
      
    });


    $('.deleteNoteSelectedClass').click(function(){
      id_note = $(this).attr('id') //href is also compatible replacement for id.
  
        $.ajax({url: "deleteNote.php",
        method:'post',
        data:{
          note_id:id_note //will be used for selectNote.php POST method
        },
        success: function(result){

    $(".modalBodyOfDeletingNote").html(result); //class of the body of the modal in note selection
    $('#deleteSelectedNoteModal').modal("show");

  },    error: function(jqXHR, textStatus, errorThrown) {
        // Code to handle errors
        console.log("AJAX Error: " + textStatus + " - " + errorThrown);
    }
	
  });
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

    $("#tableSorterAlphabetically").click(function() {
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

    document.getElementById("dropdownMenu1").innerHTML = "Sort alphabetically 🔽";
    console.log('This is a sign that this sorting functionality works');
  }
    });

    $("#tableSorterByID").click(function() {
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
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (Number(x.innerHTML) > Number(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }

    document.getElementById("dropdownMenu1").innerHTML = "Sort by ID 🔽";
    console.log('This is a sign that ID sorting functionality works');
  }
    });


    $("#sort").click(function() {
      document.getElementById("dropdownMenu1").innerHTML = "Sort 🔽";
    });
    

    $("#text-left-align").click(function() {
      event.preventDefault(); // prevent page reload
      document.getElementById("noteContent").style.textAlign = "left";
    });

    $("#text-center-align").click(function() {
      event.preventDefault(); // prevent page reload
      document.getElementById("noteContent").style.textAlign = "center";
    });

    $("#text-right-align").click(function() {
      event.preventDefault(); // prevent page reload
      document.getElementById("noteContent").style.textAlign = "right";
    });

    $("#searchNoteID").click(function() {
      //This is just placeholder for #searchNoteID action when the button is clicked
    });

    $("#yesDeleteNote").click(function() {
        alert('Note DELETED!');
    });

    $("#noDeleteNote").click(function() {

    });

    $("#saveEditNote").click(function() {
      
    });

    
    
    
    
    
//End of line for function showNote()
});

