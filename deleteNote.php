<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if (isset($_POST["note_id"])) {
    $output = '';

    $connect = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");  
    $query = "SELECT noteTitle FROM studentNotes WHERE noteid = '".$_POST["note_id"]."'";  
    $result = mysqli_query($connect, $query);  

    
    $output .= '  
    <!DOCTYPE html>
    <html>
    <head>
    <link rel = "stylesheet" href = "deleteNoteStyle.css"/>
    </head>
    <body>
    <div class="table-responsive">  
         <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  
        $output .= ' <h2>WELCOME</h2> ';
    }
    $output .= "</table></div> </body> </html>";
    echo $output;
}

?>