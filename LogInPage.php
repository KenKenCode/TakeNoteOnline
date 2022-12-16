<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if(isset($_POST['login'])) {

    
    if(empty(trim($_POST['userNameName'])) && empty(trim($_POST['passwordName']))) {
        echo '<script type="text/javascript"> alert("Input fields must have values (email, password)"); </script>';
    } else {
    //set variables for sql query
    $usernameSignIn = mysqli_real_escape_string($conn, $_POST['userNameName']); //name of username input
    $passwordSignIn = mysqli_real_escape_string($conn, $_POST['passwordName']); //name of password input

    $res = $conn->query("SELECT student_password FROM registrationforlogin WHERE student_username = '$usernameSignIn'");
    
    $hashed_pass = $res->fetch_assoc()['passwordName'];

    if(!password_verify($passwordSignIn, $hashed_pass)) {

        echo '<script type="text/javascript"> alert("something went wrong"); </script>';

    } else {
        echo '<script type="text/javascript"> alert("logged in"); </script>';
        header('Location:notebookspage2.php');
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
    <title>Document</title>
<link href = "LogInPageStyle.css" rel = "stylesheet"/>
</head>
<body>
    
    <div class = "logInBox">
        <main>
            <h1>LOG-IN</h1>
            <hr>
            <br />
            <form action="" method="POST">
                
                <label for="userNameID">Username: </label><br /> <!--label for will bind to input element's id-->
                <input type="text" id="userNameID" name="userNameName" placeholder="Type your username" class = "logInTextbox"> <br />

                <label for="passwordID">Password: </label><br /> <!--label for will bind to input element's id-->
                <input type="password" id="passwordID" name="passwordName" placeholder="Type your password" class = "logInTextbox"> <br />
                
                <input type="submit" name="login" class="logInButton">                      
            </form>
            
            <hr>

            <footer>
                <p>New account? <a href="RegistrationPage.php" target="_blank">Register.</a></p>
                <p>Terms and Conditions</p>
            </footer>
        </main>
    </div>
</body>
</html>