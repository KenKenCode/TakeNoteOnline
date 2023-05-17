<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if(isset($_POST["note_content"])) {
	$output = '';
	$connect = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");
	$query = "SELECT * FROM studentNotes WHERE noteid = 61";
	$result = mysqli_query($connect, $query);
	
	
$output .= '
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!--JQuery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	
		<title>TinyMCE - Set Data 2</title>
		
		<script src="./TinyMCE/tinymce/js/tinymce/tinymce.min.js"></script>
</head>

<body>';

while($row = mysqli_fetch_array($result)) {
	
	$output .='
<textarea class="tinymce" id="texteditor"></textarea>
			<button class="set-data-btn-class" id="set-data-btn-id" >Set Data</button>

</body>

</html>';
}

echo $output;
}

?>