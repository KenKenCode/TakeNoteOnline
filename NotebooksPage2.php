<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

$retrieveNotes = "SELECT * FROM studentNotes WHERE studentUsername = '" . $_SESSION['username'] . "'";
//$deleteSelectedNote = "SELECT noteid FROM studentNotes";



  
//if we have multiple forms in a file, we use elseif. DON'T USE MULTIPLE IF because only elseif allows you to specify additional conditions to check if the previous conditions are not met.
if (isset($_POST['submitNoteName'])) {
  echo "<script type='text/javascript'>console.log('I submitted a note'); </script>";
  if(empty(trim($_POST['titleName'])) && empty(trim($_POST['contentName']))) {
    echo '<script type="text/javascript"> alert("Input fields must have values"); </script>';
} else {
    $studentIDNote = mysqli_real_escape_string($conn, $_SESSION['userID']);;
    $studentUsernameNote = mysqli_real_escape_string($conn, $_SESSION['username']);;
    $studentContentNote = mysqli_real_escape_string($conn, $_POST['contentName']);;
    //$studentContentNote2 = stripslashes(str_replace('<br />\r\n',PHP_EOL,$studentContentNote));
    
    $studentTitleContentNote = mysqli_real_escape_string($conn, $_POST['titleName']);
    $conn->query("INSERT INTO studentNotes (studentID, studentUsername, notes, noteTitle) VALUES ('$studentIDNote', '$studentUsernameNote', '$studentContentNote', '$studentTitleContentNote')");

    if($conn->affected_rows != 1) {
      echo '<script type="text/javascript"> alert("something went wrong"); </script>';
    } else {
      echo '<script type="text/javascript"> alert("note insertion successful"); </script>';
      //header("Refresh:0"); //Refresh the page because somehow the error 'tinymce.min.js:4  Failed to initialize the editor as the document is not in standards mode. TinyMCE requires standards mode.' occurs
      //My html documents have <!DOCTYPE html> declaration meaning that it is in standards mode but the error still occurs, using header("Refresh:0"); fixes the issue
    }

}

} 

if(isset($_POST['note_deleteclass'])) {
  echo "<script type='text/javascript'>alert('AJAX for deleteNoteID is working!');</script>";
}
/*
elseif (isset($_POST['yesDeleteNoteName'])) {
  //for some reason, php isset only works with <form><button type="submit"></button></form>. Although isset is not limited to HTML forms. It is a general-purpose PHP function used to check if a variable is set and not null.
  
    $studentIDNote = mysqli_real_escape_string($conn, $_SESSION['userID']);;
    $studentUsernameNote = mysqli_real_escape_string($conn, $_SESSION['username']);;
  
  $noteID = mysqli_real_escape_string($conn, $_POST['']); //html name attribute of note to be deleted.
  
  //WE MIGHT REALLY HAVE TO USE AJAX BECAUSE MAYBE WE REALLY CANT RETRIEVE THE ID IF THE PHP QUERY IS BEFORE THE HTML ELEMENT
  
  $conn->query("DELETE FROM studentNotes WHERE noteid = '$noteID'");

  if($conn->affected_rows != 1) {
    echo '<script type="text/javascript"> alert("something went wrong"); </script>';
    //header("Refresh:0");
  } else {
    echo '<script type="text/javascript"> alert("note DELETION successful"); </script>';
    //header("Refresh:0");
  } 
  
  //echo "<script type='text/javascript'>console.log('deleting works'); </script>";
  //header("Refresh:0"); //Refresh the page because somehow the error 'tinymce.min.js:4  Failed to initialize the editor as the document is not in standards mode. TinyMCE requires standards mode.' occurs
      //My html documents have <!DOCTYPE html> declaration meaning that it is in standards mode but the error still occurs, using header("Refresh:0"); fixes the issue
  } elseif (isset($_POST['noDeleteNoteName'])) {
    echo "<script type='text/javascript'>console.log('not deleting works'); </script>";
    //header("Refresh:0"); //Refresh the page because somehow the error 'tinymce.min.js:4  Failed to initialize the editor as the document is not in standards mode. TinyMCE requires standards mode.' occurs
        //My html documents have <!DOCTYPE html> declaration meaning that it is in standards mode but the error still occurs, using header("Refresh:0"); fixes the issue
  }
*/
/*


}
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebooks</title>
    

    <!--TinyMCE Text Editor-->
    <script src="./TinyMCE/tinymce/js/tinymce/tinymce.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!--JQuery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!--For icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel = "stylesheet" href = "NotebooksPage2Style.css"/>

    <!--Order of stylesheet referencing matters. For example, if we want to overwrite the bootstrap css with our own css file, we should link our own css file AFTER the boostrap stylesheet reference.-->

    

  </head>
<body>

    <nav class="navbar navbar-default">
      <div class = "nav-inner container-fluid">

      <script>
        //alertdialog
//alert('<?php echo $_SESSION['username'];
//echo '  user ID is:  ';
//echo $_SESSION['userID']; ?>');
</script>
        <h1 class = "nav-brand navbar-header">TakeNote</h1>
        
        <h1>Your user ID is: </h1>
        <?php
          echo '<h1>'.$_SESSION['userID'].'</h1>';
        ?>
        <?php  
                echo '<h1>Welcome - '.$_SESSION["username"].'</h1>';  
                echo '<label><a href="LogOut.php">Logout</a></label>';  
                ?>  
        <!-- Add php code here to retrieve user id of username -->
        <div class="nav-hamburger" onclick = "showMenu()">
          <i class = "bx bx-menu bx-md"></i>
        </div>
        <ul class = "nav-links">
          
          <li><a href = "NotebooksPage2.php">Notebooks</a></li>
          <li><a href = "ExtrasPage.php">Extras</a></li>
          
        </ul>
      </div>
    </nav>

    
    

    <div id="noteContainer">
    
    <div id="addNote">
      <div id="noteTitleAndContentContainer">
        
        <div id="titleAndContent">
          
        <form action="" method="POST" id="noteForm">
          <input type="text" id="noteTitle" name="titleName" placeholder="Note Title">
          <textarea id="noteContent" name="contentName" placeholder="Enter your note here" form="noteForm"></textarea>
          
          <div id="advancedEditorAndSubmit">
          <!--
          <button id="text-left-align" style="margin-left: 15px;">Left-Align</button>
          <button id="text-center-align" style="margin-left: 15px;">Center-Align</button>
          <button id="text-right-align" style="margin-left: 15px;">Right-Align</button>
           -->
          <input type="submit" id="submitNote" name="submitNoteName"  value="+" style="margin-left: 60px; font-size: 30px;">
          </div>
          
        </form>

        <form action = "" method = "POST" id = "firstForm">
          <input type="submit" id="firstFormSubmit" name="firstFormSubmitName">
        </form>
        
        </div>
        
      </div>
    </div>


    
    <div id="displayNotes">

    <div class="tab-content" class="tab-pane fade in active">

    <ul class="nav nav-tabs">
    <li class="active"><a id="contentForNotesID" data-toggle="tab" href="#tableForNotes">Notes</a></li>
    <li><a id="searchForNotesID"  data-toggle="tab" href="#searchForNotes">Search</a></li>
    </ul>

<div id="tableForNotes">
<?php
 if ($result = mysqli_query($conn, $retrieveNotes)) {
	if (mysqli_num_rows($result) > 0) {
 ?>
<table id="noteTable" class="table table-striped table-hover col-sm-4">
  
  <div class="dropdown text-center">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Sort
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a id="sort">Sort</a></li>
    <li><a id="tableSorterAlphabetically">Alphabetically (By title)</a></li>
    
    <li><a id="tableSorterByID"> By ID </a></li>

  </ul>
</div>
<tr>
<th style="background-color: pink; display: none;">Note ID</th>
<th style="background-color: green;">Notes</th>

<th style="background-color: blue;">Action</th>
</tr>

<?php
while($row = mysqli_fetch_array($result)){
?>
<tr>
<td style="display:none;"><?php echo $row["noteid"]?></td>
<td><?php echo $row['noteTitle']; ?></td>
<!--Repetition of html elements under this while column is possible, and individual buttons for each record will display in this code-->

<td><button type="button" id='<?php echo $row["noteid"] ?>' class="btn btn-primary btn-lg noteIDClass" data-target="#myModal">
        View</button></td>
        <!--There seems to be problem with modal, it immediately closes upon click, I removed data-toggle="modal" and the problem went away-->
<!--
        <td><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        View</button></td>
-->
</tr>
<?php
}
	}
 }


?>
</table>

      <br>
      
    </div>
</div>

<div id="searchForNotes" class="tab-pane fade">

<div class="container col-sm-12">
    
    <form class="form-horizontal" action="" method="post">
    <div class="row">
        <div class="form-group text-left" >
            <label class="control-label col-sm-4 text-left" for="email"><b>Search a note content:</b></label>
            <div class="col-sm-5" >
              <input type="text" class="form-control" name="searchNoteInputText" placeholder="search here">
            </div>
            <div class="col-sm-2">
              <button type="submit" id="searchNoteID" name="searchNoteInputButton" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </div>
        
         
    </div>
    </form>
    <br/><br/>
    
    <?php
    if (isset($_POST['searchNoteInputText'])) {
      $search = mysqli_real_escape_string($conn, $_POST['searchNoteInputText']);
      $sql = "SELECT * FROM studentnotes WHERE notes LIKE '%$search%' AND studentUsername = '" . $_SESSION['username'] . "'";
      $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr><th style='display: none;'>Note ID</th><th>Notes</th> <th>Action</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td style='display: none;'>" . $row['noteid'] . "</td>";
          echo "<td>" . $row['notes'] . "</td>";
          echo '<td><button id= "'. $row["noteid"] .'" class="btn btn-primary btn-sm noteIDClass"> View </button></td>';
          echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "No results found";
  }
}

    ?>
</div>
    </div>

</div> <!--End of #displayNotes-->
<br>
<br>
<br>

<!--
<div style="background-color: yellow">
    first column
</div>

<div style="background-color: blue">
    second column
</div>

<div style="background-color: red">
    third column
</div>

<div style="background-color: green">
    fourth column
</div>

<div style="background-color: green">
    fifth column 
</div>

-->

<!--Start of modal for note selection-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabelTitle">
          <!--If we want to change the modal title dynamically, maybe we shall just initialize a hidden table where we can fetch the current id of the selected note-->
</h5>
        
      </div>
      <div class="modal-body modalBodyOfSelectedNote">
      
        ...
      </div>
      <div class="modal-footer">
      
      <!--
        <button type="button" id="deleteNoteSelected" class="btn btn-secondary pull-left ">Delete</button>
        
        <button type="button" id="editNoteSelected" class="btn btn-secondary pull-left">Edit</button>
      -->
        
      </div>
    </div>
  </div>
</div>

<!--End of modal for note selection-->



<!--Start of modal for delete selected notes-->
<div class="modal fade" id="deleteSelectedNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabelTitle">
          <!--If we want to change the modal title dynamically, maybe we shall just initialize a hidden table where we can fetch the current id of the selected note-->
</h5>
        
      </div>
      <div class="modal-body modalBodyOfDeletingNote">
      <form id="" method="POST" action="">
        <!--AJAX of this is in selectNote.php, not in NotebooksPage2Script.js-->
        Delete '<b id="titleDeletingNote"> </b>'? <br>Note ID: <b class="titleIDClass" id="titleID" name='titleIDName'> </b>
        <!--Hide the ID on deleting modal for formality purposes. We need to retrieve unique ID to specificity purposes.-->
      </div>
      <div class="modal-footer">
      
        <button type="submit" name="yesDeleteNoteName" id="yesDeleteNote" class="btn btn-secondary pull-left">Yes</button>
        <button type="submit" name="noDeleteNoteName" id="noDeleteNote" class="btn btn-secondary pull-left">No</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
</form>
      </div>
    </div>
  </div>
</div>


<!--End of modal for delete selected notes-->


<!--Start of modal for editing selected note-->

<div class="modal fade" id="editSelectedNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabelTitle">
          <!--If we want to change the modal title dynamically, maybe we shall just initialize a hidden table where we can fetch the current id of the selected note-->
</h5>
        
      </div>
      <div class="modal-body modalBodyOfEditingNote">
        Edit <b id="editNoteTitleID"> </b>
        <p id="editNoteID"></p>
        <textarea id="editNoteArea"> </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelEditNote" class="btn btn-secondary pull-left">Cancel</button>
        <button type="button" id="saveEditNote" class="btn btn-secondary pull-right">Save changes</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<!--End of modal for editing selected note-->

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabelTitle">
          <!--If we want to change the modal title dynamically, maybe we shall just initialize a hidden table where we can fetch the current id of the selected note-->
        </h5>
        
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left">Search</button>
        <button type="button" class="btn btn-secondary pull-left">Search</button>
        <button type="button" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>
</div>


</div>

<?php 

//We cannot use this on the first php tag because the first php tag is the first one to load when the page reloads. So move this condition to somewhere where it can only show up when explicitly called/triggered.

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] === 'NotebooksPage2.php') {
if(isset($_POST["note_idTwo"])) {
  
  
  //$queryEditUpdate = "UPDATE studentNotes SET notes WHERE noteid = '".$_POST["note_idTwo"]."'";  
  echo'<script>console.log("NOTEBOOKS!");</script>';
  echo'<script>console.log("NOTEBOOKS AAGGGGAAAIIINNN!");</script>';
} else {
  echo'<script>console.log("NOTEBOOKS not working!");</script>';
}
}
?>
<script src = "NotebooksPage2Script.js"></script>
    </body>
    </html>