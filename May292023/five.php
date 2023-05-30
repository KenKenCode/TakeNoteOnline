<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";



?>
<!DOCTYPE html>
<html>
<head>


</head>

<body>

<p>Click This</p>
<a href="six.php?userid=delete">Delete</a>
<a href ="six.php?userid=edit"> Edit</a>

</body>
</html>