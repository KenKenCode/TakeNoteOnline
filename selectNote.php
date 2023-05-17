<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if (isset($_POST["note_id"])) {
    $output = '';

    $connect = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");  
    $query = "SELECT * FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";  
    $result = mysqli_query($connect, $query);  


    $output .= '  
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

    </head>
    <body>
    <div>  
         <table >';  
    while($row = mysqli_fetch_array($result))  
    {  
         $output .= '  
			  
                 <h2 id="noteTitleSelected">'.$row["noteTitle"].'</h2>
                 <h4 id="noteIDSelected">'.$row["noteid"].'</h4> <!--Make Delete and Edit functional-->
                 <div id="menuAbove">
                 <label><i>Timestamp: '.$row["note_timestamp"].'</i></label>
                 
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
                   <td width="70%" id="noteContentRow"><p id="noteContentID" placeholder="" >'.$row["notes"].'</p><br></br></td>
                   </form>
			  </tr>

        <td id="deleteAndEditContainerID">
        <button type="button" class="btn deleteButton '.$row["noteTitle"].'" id="" data-dismiss="modal" data-toggle="modal" data-target="#deleteSelectedNoteModal">Delete</button>
        <button type="button" class="btn editButton '.$row["noteTitle"].'" id="" data-dismiss="modal" data-toggle="modal" data-target="#editSelectedNoteModal">Edit</button>
        </td>

              ';  

              
    }  
    $output .= '</table>
    
    </div>

    <!--REMEMBER TO USE A JAVASCRIPT TEXT EDITOR FOR THESE LINES OF CODES BECAUSE IT IS DIFFICULT TO SPOT ERRORS WITHOUT PROPER SYNTAX CHECKING!!!!!-->
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
  
        
        $(".editButton").click(function(){
          //Basically, .attr() gets the attribute value from $(this).attr("id"). so this could be $(".className").attr("id"), the id of the .className is selected.
          event.preventDefault(); // prevent page reload
          

          $("#myModal").modal("hide");
    
          
        }); //End of line for $(".editButton").click(function()){};
      
       
    });
    </script>

    
    </body>
    </html>';  
    echo $output;  
  }
  
  
?>



