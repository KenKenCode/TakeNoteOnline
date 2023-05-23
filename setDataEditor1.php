<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

$selectNote = "SELECT notes FROM studentNotes WHERE noteid = 61";

$result = mysqli_query($conn, $selectNote);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!--JQuery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	
		<title>TinyMCE - Set Data</title>
		
		<script src="./TinyMCE/tinymce/js/tinymce/tinymce.min.js"></script>
	</head>
	<body>

			<textarea class="tinymce" id="texteditor"></textarea>
			<textarea class="tinymce2" id="texteditor2"></textarea>
			<button class="set-data-btn-class" id="set-data-btn-id" >Set Data</button>
			
			<button class="update-data-btn-class" id="update-data-btn-id" >Update Data</button>
		<!-- javascript -->
		<script>
		
		$(document).ready(function() {
		$("#set-data-btn-id").on("click", function(e) {
		
		var content = `<?php echo $content = $row["notes"]; ?>`; //remember to only use single quote marks around <?php ?> tag
		console.log(content);
		tinymce.get("texteditor").setContent(content);

	});
		//Maybe just search the delete and edit functionality of notes in youtube
		
		$("#update-data-btn-id").on("click", function(e) {
			
			
		});
		
		});
		
		tinymce.init({
			selector: '#texteditor, #texteditor2',
			width: '100%', 
  
		});
		
		
		</script>
		
	</body>
</html>