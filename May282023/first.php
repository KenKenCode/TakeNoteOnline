

<!DOCTYPE html>
<html>
<body>

<form method="POST" action="">
<button type="submit" name="firstSubmitName">Submit</button>
</form>
<form method="POST" action="">
<p id="firstParagraph" name="firstP">First Paragraph</p>
<button type="submit" name="submitName">Submit</button>
</form>



</body>
</html>
<!--PHP is after the HTML because the js script cannot read #firstParagraph when declared before HTML.-->

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL | E_STRICT);

if (isset($_POST["firstSubmitName"])) {
	
}
elseif(isset($_POST["submitName"])) {
	
    echo "<script type='text/javascript'>
	var element = document.getElementById('firstParagraph');
    console.log(element.textContent);
	alert('WORKING!');
	</script>";
}
?>