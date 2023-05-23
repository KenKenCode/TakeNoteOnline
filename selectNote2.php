<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL | E_STRICT);

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

if (isset($_POST["note_idTwo"])) {
  echo'<script>console.log("NOTEBOOKS! selectNote2!!");</script>';
}

  ?>