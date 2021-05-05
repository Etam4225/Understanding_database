<?php
session_start()
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
</head>

<form method=POST>
  <button type="submit" name="back">
    Back
  </button>
</form>
<?php
include "database_login_info.php";
$rollno = $_GET['rn'];
$username = $_SESSION["username"];

echo "Hello, " . $username . "<br>";
echo $rollno . " is removed from your cart.";

$sql = "DELETE FROM Cart where username ='" . $username . "' AND gameID ='" . $rollno . "';";
$result = $mysqli->query($sql);

if(isset($_POST['back']))
  header("Location: ../cart.php");
  
session_write_close();
?>