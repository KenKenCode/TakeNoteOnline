<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

if (isset($_GET['userid'])) {
  $userId = $_GET['userid'];
  
  // Perform further processing or use the $userId variable as needed
  
  echo "User ID: " . $userId;
  
  
  switch($userId) {
	  case "delete":
            // Code to handle AJAX action 1
            echo "<script type='text/javascript'>alert('Performing delete');</script>";
            break;
			
	  case "edit":
			echo "<script type='text/javascript'>alert('Performing edit');</script>";
            break;
	  
  }
} else {
  echo "User ID not provided.";
}

?>



<!DOCTYPE html>
<html>
<head>

</head>
<body>
<p>The page where five.php leads</p>

</body>

</html>