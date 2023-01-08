<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$connect = mysqli_connect("localhost", "root", "root", "tnstudentregistrationdb");

if (isset($_POST["login"])) {
    if (empty($_POST["userNameName"]) || empty($_POST["passwordName"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        $username = mysqli_real_escape_string($connect, $_POST["userNameName"]);
        $password = mysqli_real_escape_string($connect, $_POST["passwordName"]);

        $queryString = "SELECT * FROM registrationforlogin WHERE studentUsername = '$username'";
        $query = mysqli_query($connect, "SELECT * FROM registrationforlogin WHERE studentUsername = '$username'"); //The username input value is being stored to the database with a pre space. For example: ' kenneth', this is why we have to modify this query to add a space before $username.
        //other columns' spacing doesn't seem to have a problem. Only studentUsername. I have also tried to re-build this table on other databases but the same issue still persists.
        //Dec. 17, 2022 3:09pm: The problem seems to be from my html form inputs, I tried directly inserting a record into registrationforlogin table in mysql shell, and the spacing-issue did not come up. The spacing issue seems to only come up when I insert from RegistrationPage.php
        //As a suggestion, we can use other column for logging in such as studentName (unique), and studentEmail (unique) since they have no spacing-issue.
        //Dec. 17, 2022 3:14pm, problem with RegistrationPage.php is now resolved. The SQL 'INSERT INTO' query has a pre-space on ' $studentUsername'

        $studentID = mysqli_query($connect, "SELECT * FROM registrationforlogin WHERE studentUsername = '$username'");
        
        $result = mysqli_query($connect, $queryString);
        
        if (mysqli_num_rows($result) > 0) {
            $row2 = mysqli_fetch_assoc($studentID);
                    $_SESSION["username"] = $row2['studentUsername'];
                    $_SESSION["userID"] = $row2['studentID'];
                    header("location:NotebooksPage2.php");
            /*
            while ($row = mysqli_fetch_array($result)) {
               
                if (password_verify($password, $row["studentPassword"])) {
                    //return true;  
                    $row2 = mysqli_fetch_assoc($studentID);
                    $_SESSION["username"] = $username;
                    $_SESSION["userID"] = $row2['studentID'];
                    header("location:NotebooksPage2.php");
                } else {
                    //return false;  
                    echo '<script>alert("Wrong User Details")</script>';
                }
            }
            */
        } else {
            echo '<script>alert("Wrong User Details 2")</script>';
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