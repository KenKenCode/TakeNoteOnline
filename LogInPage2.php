<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");   

if(isset($_SESSION["student_username"])) {
    header("location: NotebooksPage2.php");
}

if (isset($_POST["validate"])) {
	
	$raw_username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = mysqli_real_escape_string($conn, $_POST['passwordName']);
	
    $query = "SELECT * FROM registrationforlogin WHERE student_username = '$raw_username'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            if(password_verify($raw_password, $row["student_password"])) {
                $_SESSION["USER_NAME"] = $raw_username;

                print_r($_SESSION);
                header("Location: NotebooksPage2.php");
            } else {
                echo '<script type="text/javascript"> alert("Something went wrong"); </script>';
            }
        }
    } else {
        echo '<script type="text/javascript"> alert("Something went wrong"); </script>';
    }

    print_r($_SESSION["USER_NAME"]);
    /*
    $query = "SELECT * FROM registrationforlogin WHERE student_username=? LIMIT 1";
    $statement = $conn->prepare($query);
    $statement->bind_param('s', $raw_username);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    if($row && password_verify($raw_password, $row['student_password'])) {
        session_start();
        $_SESSION["student_id"] = $row['student_id'];
        header( 'Location: NotebooksPage2.php' );
        die;
    } else {

        echo '<script type="text/javascript"> alert("something went wrong"); </script>';
        /*
        session_start();
        $_SESSION['LogInFail'] = "Yes";
        */
    //}


	/*
	$hashed_pass = $res->fetch_assoc()['student_password'];
	
	if(!password_verify($raw_password, $hashed_pass)) {
		$validation_error = "Wrong password";
	} else {
		$validation_success = "valid password";
	    header('Location: https://www.google.com');
	}
    */

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
	<form action="" method="GET">
		<label>Type a username</label>
		<input type="text" name="username">

		<label>Type a password</label>
		<input type="password" name="passwordName">

		<button type="submit" name="validate">Submit</button>

		<p class="error"><?php echo @$validation_error ?></p>
		<p class="success"><?php echo @$validation_success ?></p>
        <p><?php print_r($_SESSION); ?></p>
	</form>
</body>
</html>