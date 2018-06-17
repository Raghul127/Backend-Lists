<?php include('server.php') ?>
<?php

/*

DELETE.PHP

Deletes a specific entry from the 'players' table

*/


// connect to the database

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



// check if the 'id' variable is set in URL, and check that it is valid

if (isset($_GET['id']) && is_numeric($_GET['id']))

{

// get id value

$id = $_GET['id'];



// delete the entry
$query="DELETE FROM list WHERE id=$id";
mysqli_query($db, $query);


// redirect back to the view page

header("Location: viewl.php");

}

else

// if id isn't set, or isn't valid, redirect back to view page

{

header("Location: viewl.php");

}



?>