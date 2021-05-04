<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
</head>

<?php
session_start(); //start session to grab username

include "database_login_info.php";
//$mysqli->close();
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

$rollno = $_GET['rn'];
$username = $_SESSION["username"];

echo "Hello, " . $username . "<br>";
echo $rollno . " is added to your cart.";

//check if the user already added the game to their cart
$check = "SELECT * FROM Cart where username ='" . $username . "' AND gameID ='" . $rollno . "';";
  $query_check = $mysqli->query($check);
  if(mysqli_num_rows($query_check)==1){
	 header("Location: ../interface.php?additemtocart=fail"); 
}else{
	$sql = "INSERT INTO Cart VALUES ('$username', '$rollno');";
	$result = $mysqli->query($sql);
}

session_write_close();
?>