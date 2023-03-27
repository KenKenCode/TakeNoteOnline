<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost", "root", "", "infinitedata");

?>

<html>
<body>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
   </tr>
<?php

$query = mysqli_query($conn, "SELECT * FROM infinitetable")
   or die (mysqli_error($conn));

while ($row = mysqli_fetch_array($query)) {
  echo
   "
   
   <tr>
    <td>{$row['id_value']}</td>
    <td>{$row['name_value']}</td>
    <td>{$row['age']}</td>
   </tr>\n";

}

?>
</table>

</body>

</html>