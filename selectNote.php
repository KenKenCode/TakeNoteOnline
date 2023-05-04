<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if (isset($_POST["note_id"])) {
    $output = '';

    $connect = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");  
    $query = "SELECT notes, noteTitle, note_timestamp FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";  
    $result = mysqli_query($connect, $query);  


    $output .= '  
    <!DOCTYPE html>
    <html>
    <head>
    
    
    </head>
    <body>
    <div class="table-responsive">  
         <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  
         $output .= '  
			  
                 <h2 style="text-align: center;">'.$row["noteTitle"].'</h2>
                 <div id="menuAbove" style="inline-block;">
                 <label><i>Timestamp: '.$row["note_timestamp"].'</i></label>
                 
                 <div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" style="float: right;" aria-expanded="true">
                 Accessibility options
                 <span class="caret"></span>
               </button>
               <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                 <li><a id="darkMode" href="#">Dark Mode</a></li>
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
                   <td width="70%" id="noteContentRow"><p id="noteContentID" placeholder="" style="width: 90%; display: inline-block;">'.$row["notes"].'</p><br></br></td>
                   <td width="70%"></td>
                   </form>
			  </tr>
              ';  

              
    }  
    $output .= "</table></div>
    <script>
    $(document).ready(
     function mode(){
     $('#darkMode').click(function(){
          document.getElementById('noteContentID').style.backgroundColor = 'black';
          document.getElementById('noteContentRow').style.backgroundColor = 'black';
          document.getElementById('noteContentID').style.color = 'white';
         });
     
         $('#lightMode').click(function(){
          document.getElementById('noteContentID').style.backgroundColor = 'white';
          document.getElementById('noteContentRow').style.backgroundColor = 'white';
          document.getElementById('noteContentID').style.color = 'black';
         });
       }
    );
    </script>
    </body>
    </html>";  
    echo $output;  
  }
  
  
?>



