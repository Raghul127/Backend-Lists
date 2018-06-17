<?php include('server.php') ?>
<?php

/*

NEW.PHP

Allows user to create a new entry in the database

*/

// creates the new record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($list, $checked, $implev,$error)

{

?>

<!DOCTYPE html>

<html>

<head>

<title>New Record</title>

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

<div>

<strong>List to be added: *</strong> <input type="text" name="list" value="<?php echo $list; ?>" /><br/>

<strong>Completed(YES/NO): *</strong> <input type="text" name="checked" value="<?php echo $checked; ?>" /><br/>

<strong>Importance Level(0 to 5): *</strong> <input type="text" name="implev" value="<?php echo $implev; ?>" /><br/>

<p>* required</p>

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



// check if the form has been submitted. If it has, start to process the form and save it to the database

if (isset($_POST['submit']))

{

// get form data, making sure it is valid

$list = mysqli_real_escape_string($conn,$_POST['list']);

$checked = mysqli_real_escape_string($conn,$_POST['checked']);

$implev = mysqli_real_escape_string($conn,$_POST['implev']);



// check to make sure both fields are entered

if ($list== '' || $checked == '' || $implev=='')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



// if either field is blank, display the form again

renderForm($list, $checked,$implev, $error);

}

else

{

// save the data to the database
$query = "INSERT INTO list (username, list, checked,implev) 
          VALUES('$username','$list','$checked',$implev)";
    mysqli_query($db, $query);




// once saved, redirect back to the view page

header("Location: viewl.php");

}

}

else

// if the form hasn't been submitted, display the form

{

renderForm('','','');

}

?>