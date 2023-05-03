<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "codexworld";


$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

$noteSelect = mysqli_query($db, "SELECT * FROM editor");


?>
<!DOCTYPE html>
<html>
<head>

</head>

<body>

<?php
while($row = mysqli_fetch_assoc($noteSelect)) {
    echo "<p>" . $row['content'] . "</p>";
}
?>
</body>
</html>