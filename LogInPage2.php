<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb2");   

if (isset($_POST['validate'])) {
	$raw_password = $_POST['passwordName'];
	$raw_username = $_POST['username'];
	echo $raw_password;
	echo $raw_username;
	$res = $conn->query("SELECT student_password FROM registrationforlogin WHERE student_username = '$raw_username'");
	
	$hashed_pass = $res->fetch_assoc()['student_password'];
	
	if(!password_verify($raw_password, $hashed_pass)) {
		$validation_error = "Wrong password";
	} else {
		$validation_success = "valid password";
	    header('Location: https://www.google.com');
	}
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in</title>
</head>
<body>
<h1> Log-in to the system </h1>
	<form action="" method="POST">
		<label>Type a username</label>
		<input type="text" name="username">

		<label>Type a password</label>
		<input type="password" name="passwordName">

		<button type="submit" name="validate">Submit</button>

		<p class="error"><?php echo @$validation_error ?></p>
		<p class="success"><?php echo @$validation_success ?></p>
	</form>
</body>
</html>