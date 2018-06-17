<?php include('server.php') ?>
<?php 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <br>

<form method="post" action="index.php">
          <div class="input-group">
      <label>To do list</label>
      <input type="text" name="list">
    </div>
        <div class="input-group">
      <label>Importance Level(0 to 5)</label>
      <input type="text" name="implev">
    </div>
    <br>
    <div class="input-group">
      <button type="submit" class="btn" name="add_list">Add to List</button>
      <button class="btn" name="view_list"><a href="viewl.php">View List</a></button>
    </div>
  </form>
<br>
<form method="post" action="index.php">
        <div class="input-group">
      <label>Notes Title</label>
      <input type="text" name="ntitle">
    </div>
        <div class="input-group">
      <label>Notes Content</label>
      <input type="text" name="ncont">
    </div>
    <br>
    <div class="input-group">
      <button type="submit" class="btn" name="add_notes">Add to Notes</button>
      <button class="btn" name="view_notes"><a href="viewn.php">View Notes</a></button>
    </div>
</form>


</div>


<br>
    	<p style="margin-left: 350px; bottom: 20px; box-sizing: 10px;"> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>