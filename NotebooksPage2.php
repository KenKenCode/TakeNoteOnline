<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "root", "tnstudentregistrationdb");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebooks</title>
    <link rel = "stylesheet" href = "NotebooksPage2Style.css"/>
    
    <!--For icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    
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
          echo $_SESSION['userID'];
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
          <input type="submit" id="submitNote" name="submitNoteName"  value="+" style="margin-left: 150px; font-size: 30px;">
          </div>
          
        </form>
        </div>
        
      </div>
    </div>

    <div id="displayNotes">
      <?php
 if ($result = mysqli_query($conn, $retrieveNotes)) {
	if (mysqli_num_rows($result) > 0) {
 ?>
<table>
<tr>
<th style="background-color: green;">Notes</th>
</tr>

<?php
while($row = mysqli_fetch_array($result)){
?>
<tr>

<td><?php echo $row['notes']; ?> </td>
<!--Repetition of html elements under this while column is possible, and inidividual buttons for each record will display in this code-->
<!--<button><?php echo $row['notes']; ?> </button>-->

</tr>
<?php
}


	}
 }
echo "</table>";
?>
      <br>
      
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
</div>
    <script src = "NotebooksPage2Script.js"></script>

    </body>
    </html>