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
				<img src = "images/logo.png" class = "logo" id = "logo_img"> 
			</div>

      <nav>
			<ul class = "navigation"> 
				<li><form method=POST><p><button type="submit" name="back">Back</button></p></form></li>
        <li><form method=POST><p><button type="submit" name="out">Checkout</button></p></form></li>
			</ul>
			</nav>
    </div>
</div>
</html>

<?php
include "database_login_info.php";
$rollno = $_GET['rn']; // get what the user wants to remove from their cart
$username = $_SESSION["username"]; //get current user's username

echo "<p><center><h2> Hello, " . $username . "<br>" . "</h2></center></p>";
echo "<p><center><h2> #" . $rollno . " has been removed from your cart. </h2></center></p>";
//removes game from their cart
$sql = "DELETE FROM Cart where username ='" . $username . "' AND gameID ='" . $rollno . "';";
$result = $mysqli->query($sql);

if(isset($_POST['back']))
  header("Location: ../cart.php");
if(isset($_POST['out']))
  header("Location: ../checkout.php");  
session_write_close();
?>
