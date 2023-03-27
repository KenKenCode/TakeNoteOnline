<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if(isset($_POST['register'])) {

    if(empty(trim($_POST['studentNameName'])) && empty(trim($_POST['userNameName'])) && empty(trim($_POST['emailName'])) && empty(trim($_POST['phoneNumberName'])) && empty(trim($_POST['studentLevelName'])) && empty(trim($_POST['passwordName']))) {
        echo '<script type="text/javascript"> alert("Input fields must have values (email, password)"); </script>';
    } else {
    //set variables for sql query
    $studentNameRegister = mysqli_real_escape_string($conn, $_POST['studentNameName']);
    //$studentNameRegister = mysqli_real_escape_string($conn, $_POST[$_SESSION['userid']]);
    $userNameRegister = mysqli_real_escape_string($conn, $_POST['userNameName']);
    $emailNameRegister = mysqli_real_escape_string($conn, $_POST['emailName']);
    $phoneNumberNameRegister = mysqli_real_escape_string($conn, $_POST['phoneNumberName']);
    $studentLevelNameRegister = mysqli_real_escape_string($conn, $_POST['studentLevelName']);
    $passwordRegister = mysqli_real_escape_string($conn, $_POST['passwordName']);

    //hash the password
    $encrypt_password = password_hash($passwordRegister, PASSWORD_DEFAULT);
    
    $conn->query("INSERT INTO registrationforlogin (studentName, studentUsername, studentEmail, studentPhone, studentLevel, studentPassword) VALUES ('$studentNameRegister', '$userNameRegister', '$emailNameRegister', '$phoneNumberNameRegister', '$studentLevelNameRegister', '$encrypt_password')");

    if($conn->affected_rows != 1) {
		echo '<script type="text/javascript"> alert("something went wrong"); </script>';
	} else {
		echo '<script type="text/javascript"> alert("sign up successful"); </script>';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!--JQuery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="RegistrationPageStyle.css">
    <title>Register</title>

    
</head>
<body>
<main>
    <div class="registerBox">
            <h1>Registration</h1>
            <hr>
            <br />
            <form action="" method="POST">

                <label for="studentNameID" class="form-label fs-5">Full name: </label><br /> <!--label for will bind to input element's id-->
                <input type="text" id="studentNameID" name="studentNameName" placeholder="Type your full name" class = "registerTextBox form-control" required> <br />
                
                <label for="userNameID">User name: </label><br /> <!--label for will bind to input element's id-->
                <input type="text" id="userNameID" name="userNameName" placeholder="Type your username" class = "registerTextBox form-control" required> <br />

                <label for="emailID">Email: </label><br /> <!--label for will bind to input element's id-->
                <input type="text" id="emailID" name="emailName" placeholder="Type your email" class = "registerTextBox form-control" required> <br />

                <label for="phoneNumberID">Phone number: </label><br /> <!--label for will bind to input element's id-->
                <input type="number" id="phoneNumberID" name="phoneNumberName" placeholder="Type your phone number" class = "registerTextBox form-control" required> <br />

                <label for="studentLevelID">Student level: </label>
                <select name="studentLevelName" id="studentLevelID" class="form-control">
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>

                </select>
                </br>

                <label for="passwordID">Password: </label><br /> <!--label for will bind to input element's id-->
                <input type="password" id="passwordID" name="passwordName" placeholder="Type your password" class = "registerTextBox form-control"> <br />

                <input type="submit" value="Registration" name="register" class="logInButton btn btn-success">                      
            </form>
            
            <hr>

            <footer>
                <p>Already have an account? <a href="LogInPage.php">Log-in.</a></p>
                <p>Terms and Conditions</p>
            </footer>
</div>
        </main>
        
</body>
</html>