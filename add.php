<?php
session_start(); //used to grab username
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
  <link rel = "stylesheet" type="text/css" href = "css/add.css">
</head>
<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> 
			</div>
      <nav>
        <ul class = "navigation">
          <li><a href="../interface.php"> Back </a></li>
          <li><a href="../user_login.php"> SIGN OUT </a></li>
      </nav>
  </div>
</div>
</html>

<?php

include "database_login_info.php";

$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

$rollno = $_GET['rn']; //gets item we want to add to cart
$username = $_SESSION["username"]; // gets current user's username

echo "<p><center><h2>Hello, " . $username . "<br>" . "</h2></center></p>";
echo "<p><center><h2> #" . $rollno . " has been added to your cart. </h2></center></p>";

//check if the user already added the game to their cart
$check = "SELECT * FROM Cart where username ='" . $username . "' AND gameID ='" . $rollno . "';";
  $query_check = $mysqli->query($check);
  if(mysqli_num_rows($query_check)==1){ //if item is already in cart, we redirect user back to the search page
	 header("Location: ../interface.php?additemtocart=fail"); 
}else{ //adds item to user's cart
	$sql = "INSERT INTO Cart VALUES ('$username', '$rollno');";
	$result = $mysqli->query($sql);
}

session_write_close();
?>
