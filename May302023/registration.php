<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);


$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully <br>";



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
    <link rel="stylesheet" href="registrationstyle.css">
    <title>Register to TakeNote</title>

</head>
<body>

<main>
    <div class="registerBox">
            <h1>Register to TakeNote</h1>
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

