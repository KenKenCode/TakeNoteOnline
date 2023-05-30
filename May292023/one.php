<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

//OR PERHAPS WE DONT HAVE TO USE ISSET? JUST DIRECTLY SET THE PHP VARIABLE'S VALUE FROM THE AJAX ITSELF


	//if (isset($_GET["action"])) {
	if($_SERVER["REQUEST_METHOD"] === "GET") {
    $ajax_action = $_GET["action"];
	echo $ajax_action;
	
//echo "<script type='text/javascript'>alert('test if this part is working ');</script>"; //Even this line of code inside this if statement is not executing.
    switch ($ajax_action) {
        case "action1":
            // Code to handle AJAX action 1
            echo "<script type='text/javascript'>alert('Performing action 1');</script>";
            break;
            
        case "action2":
            // Code to handle AJAX action 2
            echo "Performing action 2";
            break;
            
        case "action3":
            // Code to handle AJAX action 3
            echo "Performing action 3";
            break;
            
        default:
            // Default case if none of the cases match
            echo "Unknown action";
            break;
    }
	}
	//}
?>

<!DOCTYPE html>
<html>
<head>
<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!--JQuery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<script src="two.js"> </script>
</head>
<body>

<button class="btn btn-default" id="ajaxTry">CLICK TO TRY AJAX WITH SWITCH</button>

</body>
</html>

