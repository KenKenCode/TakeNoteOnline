<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

$retrieveNotes = "SELECT * FROM studentNotes WHERE studentUsername = '" . $_SESSION['username'] . "'";

if (isset($_POST['submitNoteName'])) {
  if(empty(trim($_POST['titleName'])) && empty(trim($_POST['contentName']))) {
    echo '<script type="text/javascript"> alert("Input fields must have values"); </script>';
} else {
    $studentIDNote = mysqli_real_escape_string($conn, $_SESSION['userID']);;
    $studentUsernameNote = mysqli_real_escape_string($conn, $_SESSION['username']);;
    $studentContentNote = mysqli_real_escape_string($conn, $_POST['contentName']);;
    $studentTitleContentNote = mysqli_real_escape_string($conn, $_POST['titleName']);

    $conn->query("INSERT INTO studentNotes (studentID, studentUsername, notes, noteTitle) VALUES ('$studentIDNote', '$studentUsernameNote', '$studentContentNote', '$studentTitleContentNote')");

    if($conn->affected_rows != 1) {
      echo '<script type="text/javascript"> alert("something went wrong"); </script>';
    } else {
      echo '<script type="text/javascript"> alert("note insertion successful"); </script>';
    }

}

}

$noteSearchResult = '';

if(isset($_POST['searchNoteInput'])) {

if(!empty($_POST['searchNoteInput'])) {
$search = $_POST['searchNoteInput'];
$searchQuery = $conn->prepare("SELECT notes FROM studentnotes WHERE notes LIKE '%$search' OR notetitle LIKE '%$search'");

} else {
  $searchNoteRetrievalError = 'Error retrieving the note';
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebooks</title>
    

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

    <nav>
      <div class = "nav-inner">

      <script>
        //alertdialog
alert('<?php echo $_SESSION['username'];
echo '  user ID is:  ';
echo $_SESSION['userID']; ?>');
</script>
        <h1 class = "nav-brand">TakeNote</h1>
        
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
          <button id="advancedNoteEditor" style="margin-left: 15px;"> Advanced Editor </button>
          <input type="submit" id="submitNote" name="submitNoteName"  value="+" style="margin-left: 60px; font-size: 30px;">
          </div>
          
        </form>
        </div>
        
      </div>
    </div>

    
    <div id="displayNotes">

    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="tab-pane fade in active">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade in active">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade in active">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
      <?php
 if ($result = mysqli_query($conn, $retrieveNotes)) {
	if (mysqli_num_rows($result) > 0) {
 ?>
<div id="tableForNotes">
<table>
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
<td><a href="https://www.google.com"><?php echo $row['noteTitle']; ?> </a></td>
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
echo "</table>";

?>

      <br>
      
    </div>
</div>
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
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left">Delete</button>
        <button type="button" class="btn btn-secondary pull-left">Edit</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
        <button type="button" class="btn btn-secondary pull-left">Delete</button>
        <button type="button" class="btn btn-secondary pull-left">Edit</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


</div>

<?php

?>

    <script src = "NotebooksPage2Script.js"></script>

    
    </body>
    </html>