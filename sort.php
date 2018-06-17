<?php include('server.php') ?>
<!DOCTYPE html>

<html>

<head>

<title>View Sorted Records of List</title>
</head>

<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reg2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$username=$_SESSION['username'];

$sql = "SELECT id,list,checked,implev FROM list WHERE username='$username' ORDER BY implev DESC ";
$result = $conn->query($sql);
?>
<p><strong>SORTED MY TO-DO-LIST BASED ON IMPORTANCE LEVEL</strong></p>
<br>

<?php

echo "<table border='1' cellpadding='10'>";

echo "<tr>  <th>To-Do-List</th> <th>Completion Status</th> <th>Importance Level</th></tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo out the contents of each row into a table

echo "<tr>";


echo '<td>' . $row['list'] . '</td>';

echo '<td>' . $row['checked'] . '</td>';

echo '<td>' . $row['implev'] . '</td>';



echo "</tr>";
    }}
     else {
    echo "0 results";
}

$conn->close();

// close table>

echo "</table>";

?>
<br>

<p><a href="viewl.php">Back to Edit or View List</a></p> 
<p><a href="index.php">Back to HomePage</a></p> 




</body>

</html>