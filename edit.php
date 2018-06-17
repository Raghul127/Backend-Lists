<?php include('server.php') ?>
<?php

/*

EDIT.PHP

Allows user to edit specific entry in database

*/

// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($id, $list, $checked,$implev, $error)

{

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>

<p><strong>ID:</strong> <?php echo $id; ?></p>

<strong>New To-Do-List: *</strong> <input type="text" name="list" value="<?php echo $list; ?>"/><br/>

<strong>Completion Status(YES/NO): *</strong> <input type="text" name="checked" value="<?php echo $checked; ?>"/><br/>

<strong>Importance Level(0 to 5): *</strong> <input type="text" name="implev" value="<?php echo $implev; ?>" /><br/>

<p>* Required</p>

<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}


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


// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{



// get form data, making sure it is valid
$id = $_POST['id'];
$list = mysqli_real_escape_string($conn,$_POST['list']);

$checked = mysqli_real_escape_string($conn,$_POST['checked']);

$implev = mysqli_real_escape_string($conn,$_POST['implev']);



if ($list == '' || $checked == '' || $implev=='')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $list, $checked,$implev, $error);

}

else

{

	// save the data to the database


$query="UPDATE list SET id='$id', list='$list', checked='$checked',implev='$implev' WHERE id='$id'";
mysqli_query($db, $query);



// once saved, redirect back to the view page

header("Location: viewl.php");

}
}

else

// if the form hasn't been submitted, get the data from the db and display the form

{

	// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];
$sql = "SELECT * FROM list WHERE username='$username' AND id='$id'";
$result = $conn->query($sql);
// query db


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {



// get data from db

$list = $row['list'];

$checked = $row['checked'];

$implev=$row['implev']



// show form

renderForm($id, $list, $checked,$implev, '');

}}

else

// if no match, display result

{

echo "No results!";

}

}
else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}




?>