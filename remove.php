<?php
session_start()
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type="text/css" href = "css\remove.css">
</head>

<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> <!-- clicking on this does nothing currently. -->
			</div>

      <nav>
			<ul class = "navigation"> <!-- Placeholder header to use on other pages -->
				<li><a href="#"> About us </a></li>
				<li><form method=POST><p><button type="submit" name="back">Back</button></p></form></li>
        <li><form method=POST><p><button type="submit" name="out">Checkout</button></p></form></li>
			</ul>
			</nav>
    </div>
</div>
</html>

<?php
include "database_login_info.php";
$rollno = $_GET['rn'];
$username = $_SESSION["username"];

echo "<center><h2> Hello, " . $username . "<br>" . "</h2></center>";
echo "<center><h2>" . $rollno . " is removed from your cart. </h2></center>";

$sql = "DELETE FROM Cart where username ='" . $username . "' AND gameID ='" . $rollno . "';";
$result = $mysqli->query($sql);

if(isset($_POST['back']))
  header("Location: ../cart.php");
  
session_write_close();
?>
