<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if (isset($_POST["note_id"])) {
    $output = '';

    $connect = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");  
    $query = "SELECT notes, noteTitle FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";  
    $result = mysqli_query($connect, $query);  


    $output .= '  
    <div class="table-responsive">  
         <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  
         $output .= '  
			  
                 <p style="text-align: center;">'.$row["noteTitle"].'</p>
			  <!--Make note title unique in sql database-->
			  <tr>
                   <form id="currentNoteEdit">
                   <!--Use <textarea> tag for multiline support-->
                   <td width="70%"><textarea placeholder="" style="width: 90%;">'.$row["notes"].'</textarea></td>
                   </form>
			  </tr>
              ';  

              
    }  
    $output .= "</table></div>";  
    echo $output;  
  }
  
  
?>



