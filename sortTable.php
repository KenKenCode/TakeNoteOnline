<?php

?>

<html>
<head>
<title>Sort a HTML Table Alphabetically</title>
<style>
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
</head>
<body>

<p>Click the button to sort the table alphabetically, by name:</p>
<button onclick="sortTable()">Sort Names Alphabetically</button>
<button onclick="sortTableByID()">Sort by ID</button>
<button onclick="sortTableByDate()">Sort by Date</button>
<table id="myTable">
  <tr>
    <th>Name</th>
    <th>Country</th>
    <th>Date</th>
    <th>ID</th>
  </tr>
  <tr>
    <td>Berglunds snabbkop</td>
    <td>Sweden</td>
    <td>July 20, 2021 20:17:40</td>
    <td>2</td>
  </tr>
  <tr>
    <td>North/South</td>
    <td>UK</td>
    <td>July 20, 2021 20:17:40</td>
    <td>5</td>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Germany</td>
    <td>July 20, 2021 20:17:40</td>
    <td>1</td>
  </tr>
  <tr>
    <td>Koniglich Essen</td>
    <td>Germany</td>
    <td>July 20, 2021 20:17:40</td>
    <td>7</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Italy</td>
    <td>July 20, 2021 20:17:40</td>
    <td>3</td>
  </tr>
  <tr>
    <td>Paris specialites</td>
    <td>France</td>
    <td>July 20, 2021 20:17:40</td>
    <td>4</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>UK</td>
    <td>July 20, 2021 20:17:40</td>
    <td>6</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Canada</td>
    <td>July 20, 2021 20:17:40</td>
    <td>8</td>
  </tr>
</table>

<script>

//Alphabetically by name
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true; 
        break;
      }


    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); //inserts the greater value before the lesser value
      switching = true; // continues to 'switching' while loop
    }
  }
}

//Numerically ascending by ID
function sortTableByID() {
    var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[3];
      y = rows[i + 1].getElementsByTagName("TD")[3];
      //check if the two rows should switch place:
      if (Number(x.innerHTML) > Number(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

function sortTableByDate() {
    var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = [new Date(table.rows)];
    console.log(rows);
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[2];
      y = rows[i + 1].getElementsByTagName("TD")[2];
      //check if the two rows should switch place:
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true; 
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>

</body>
</html>
