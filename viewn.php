<?php include('server.php') ?>
<!DOCTYPE html>

<html>

<head>

<title>View Records of Notes</title>

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

$sql = "SELECT id,ntitle,ncont FROM notes WHERE username='$username' ";
$result = $conn->query($sql);

?>
<p><strong>MY NOTES</strong></p>
<br>

<?php

echo "<table border='1' cellpadding='10'>";

echo "<tr>  <th>Title</th> <th>Content</th> </tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo out the contents of each row into a table

echo "<tr>";


echo '<td>' . $row['ntitle'] . '</td>';

echo '<td>' . $row['ncont'] . '</td>';


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
<p><a href="index.php">Back to HomePage</a></p> 

</body>

</html>