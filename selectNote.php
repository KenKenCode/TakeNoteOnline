<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL | E_STRICT);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if (isset($_POST["note_id"])) {
    $output = '';

    $connect = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");  
    $query = "SELECT * FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";  
    $result = mysqli_query($connect, $query);  
    

       //If we are using NotebooksPage2.php for editing and deleting, NotebooksPage2.php should also be able to retrieve the current note ID selection.
       //WHY selectNote.php might not be the best for directly updating a note: IT IS BECAUSE IT DOES NOT HAVE A DIRECT ACCESS TO #editSelectedNoteModal in NotebooksPage2.php which has the 'Update' button
       //SO IT WOULD BE IDEAL TO IMPLEMENT THE UPDATE FUNCTIONALITY TO NotebooksPage2.php instead
       //For NOTE EDITING (VIEW)!!!
       $queryForViewEditing = "SELECT notes FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";
       $result2 = mysqli_query($connect, $queryForViewEditing);
       $row1 = mysqli_fetch_assoc($result2);

       //For NOTE EDITING (UPDATE)!!!
       $queryForUpdateEditing = "UPDATE studentNotes SET notes = '' WHERE noteid = '".$_POST["note_id"]."'";

       //FOR NOTE DELETING
       $queryForDeleting = "DELETE FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";
      
       //MAY 19, 2023: I HAVE NOW RESOLVED THE PROBLEM. COMMENT TO MY STACKOVERFLOW QUESTION POST: https://stackoverflow.com/questions/76286674/return-a-specific-record-from-mysql-database-and-display-it-to-tinymce-text-area
       //TYPE THIS PAGE'S WHOLE CODE IN EXTERNAL LINK CODEPEN
?>
    
    <!DOCTYPE html>
    <html>
    <head>
    
    <!--<link rel="stylesheet" href="selectNoteStyle.css"/>-->
    <!--There seems to be a problem with my external CSS, for now we will just use inline CSS-->

    <style>
    #deleteAndEditContainerID{
      text-align: left;
      
    }
  
  
  #noteTitleSelected {
      text-align: center;
      
  }
  
  #accessibilityOptionsID {
      float: right;
      
  }
  
  #noteContentID {
      width: 90%; 
      display: inline-block;
  }

  
  table, th, td, tr {
    /*We can also use ID and class to better specify which element to style, but since we only have one table
    in this component, we can also just call the entire table*/

    border: none;
  }
    </style>

    <script>
      
$(document).ready(
  function mode(){
  $("#darkMode").click(function(){
       document.getElementById("noteContentID").style.backgroundColor = "#ffcc66";
       document.getElementById("noteContentRow").style.backgroundColor = "#ffcc66";
       document.getElementById("noteContentID").style.color = "white";
      });
  
      $("#lightMode").click(function(){
       document.getElementById("noteContentID").style.backgroundColor = "white";
       document.getElementById("noteContentRow").style.backgroundColor = "white";
       document.getElementById("noteContentID").style.color = "black";
      });


      $(".deleteButton").click(function(){
       //Basically, .attr() gets the attribute value from $(this).attr("id"). so this could be $(".className").attr("id"), the id of the .className is selected.
       event.preventDefault(); // prevent page reload
       
       var title_note = $("#noteTitleSelected").text();
       var title_id_note = $("#noteIDSelected").text();

       $("#titleDeletingNoteID").text(title_note);
       $("#titleID").text(title_id_note);

       $("#myModal").modal("hide");
 
       
     }); //End of line for $(".deleteButton").click(function()){};

     
     $('.editButton').click(function(){
       //Basically, .attr() gets the attribute value from $(this).attr("id"). so this could be $(".className").attr("id"), the id of the .className is selected.
       event.preventDefault(); // prevent page reload
       id_noteTwo = $(this).attr('id');

      $.ajax({url: "NotebooksPage2.php",
      method:'POST',
      data: {
        note_idTwo:id_noteTwo
      },
      success: function(result) {
          console.log('IT WORKS! note ID: ' + id_note + '. This is from selectNote.php');
      }, 
      error: function(jqXHR, textStatus, errorThrown) {
        // Code to handle errors
        console.log("AJAX Error: " + textStatus + " - " + errorThrown);
      }
      });
        


       $("#myModal").modal("hide");

       var content = '<?php echo $row1['notes']?>';
       //Try to use an external JavaScript file, using quotes in this js code is causing problem. https://stackoverflow.com/questions/3352576/how-do-i-embed-php-code-in-javascript
       console.log(content);
       
       tinymce.get("editNoteArea").setContent(content);
       
     }); //End of line for $(".editButton").click(function()){};
   
    
 });
    </script>
    </head>
    <body>
    <div>  
         <table >
          <?php
    while($row = mysqli_fetch_array($result))  
    {  
      ?>
         
			  
                 <h2 id="noteTitleSelected"><?php echo $row["noteTitle"] ?></h2>
                 <h4 id="noteIDSelected"><?php echo $row["noteid"] ?></h4> <!--Make Delete and Edit functional-->
                 <div id="menuAbove">
                 <label><i>Timestamp: <?php echo $row["note_timestamp"] ?></i></label>
                 
                 <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="accessibilityOptionsID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 Accessibility options
                 <span class="caret"></span>
               </button>
               <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="accessibilityOptionsID">
                 <li><a id="darkMode" href="#">Dim Mode</a></li>
                 <li><a id="lightMode" href="#">Light Mode</a></li>
                 <li><a href="#">Something else here</a></li>
                 <li role="separator" class="divider"></li>
                 <li><a href="#">Separated link</a></li>
               </ul>
                 </div>
                
                 </div>
			  
			  <tr>
                   <form id="currentNoteEdit">
                   <!--Use <textarea> tag for multiline support-->
                   <td width="70%" id="noteContentRow"><p id="noteContentID" placeholder="" ><?php echo $row["notes"] ?></p><br></br></td>
                   </form>
			  </tr>

        <td id="deleteAndEditContainerID">
        <div style="margin-top: 80%;">
        <button type="button" class="btn deleteButton '.$row['noteTitle'].'" id="'.row['noteid'].'" data-dismiss="modal" data-toggle="modal" data-target="#deleteSelectedNoteModal">Delete</button>
        <button type="button" class="btn editButton '.$row['noteTitle'].'" id="'.row['noteid'].'" data-dismiss="modal" data-toggle="modal" data-target="#editSelectedNoteModal">Edit</button>
        </div>
        </td>

             <?php 
    }  
    ?>

    
    
    
    </div>

    <!--REMEMBER TO USE A JAVASCRIPT TEXT EDITOR FOR THESE LINES OF CODES BECAUSE IT IS DIFFICULT TO SPOT ERRORS WITHOUT PROPER SYNTAX CHECKING!!!!!-->
    <script>
    
    </script>

    
    </body>
    </html>
    <?php
  }
  
  ?>




