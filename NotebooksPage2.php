<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

$retrieveNotes = "SELECT * FROM studentNotes WHERE studentUsername = '" . $_SESSION['username'] . "'";
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
alert('<?php echo $_SESSION['username'];
echo '  user ID is:  ';
echo $_SESSION['userID']; ?>');
</script>
        <h1 class = "nav-brand">Welcome</h1>
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
          <li><a href = "ExtrasPage.html">Extras</a></li>
          
        </ul>
      </div>
    </nav>

    <div id="addNote">
      <div id="noteTitleAndContentContainer">
        
        <div id="titleAndContent">
        <form action="" method="" id="noteForm">
          <input type="text" id="noteTitle" name="titleName" placeholder="Note Title">
          <textarea id="noteContent" name="contentName" form="noteForm">Enter your note here</textarea>
          
          <div id="advancedEditorAndSubmit">
          <button id="advancedNoteEditor" style="margin-left: 15px;"> Advanced Editor </button>
          <input id="submitNote" type="submit" value="+" style="margin-left: 150px; font-size: 30px;">
          </div>
          
        </form>
        </div>
        
      </div>
    </div>

    <div id="displayNotes">
      HI
      <?php
 if ($result = mysqli_query($conn, $retrieveNotes)) {
	if (mysqli_num_rows($result) > 0) {
 ?>
<table>
<tr>
<th>Notes</th>
</tr>

<?php
while($row = mysqli_fetch_array($result)){
?>
<tr>

<td><?php echo $row['notes']; ?> </td>
</tr>
<?php
}
	}
 }
echo "</table>";
?>
      <br>
      
    </div>

    <script src = "NotebooksPage2Script.js"></script>

    </body>
    </html>