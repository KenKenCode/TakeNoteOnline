<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if(isset($_POST['submit'])) {
    //set variables for sql query
    $usernameSignIn = mysqli_real_escape_string($conn, $_POST['userNameID']);
    $passwordSignIn = mysqli_real_escape_string($conn, $_POST['passwordID']);

    //scan for the set values in the variables for log-in
    $sqlLogIn = mysqli_query($conn, "SELECT * FROM ")

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
                
                <label for="emailID">Email: </label><br /> <!--label for will bind to input element's id-->
                <input type="text" id="userNameID" name="emailName" placeholder="Type your username" class = "logInTextbox"> <br />

                <label for="passwordID">Password: </label><br /> <!--label for will bind to input element's id-->
                <input type="password" id="passwordID" name="emailName" placeholder="Type your password" class = "logInTextbox"> <br />

                <input type="submit" value="Log-In" class="logInButton">                      
            </form>
            
            <hr>

            <footer>
                <p>New account? <a href="www.registertakenoteuser.com" target="_blank">Register.</a></p>
                <p>Terms and Conditions</p>
            </footer>
        </main>
    </div>
</body>
</html>