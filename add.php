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


$sql = "INSERT INTO cart VALUES ('$username', '$rollno');";
$result = $mysqli->query($sql);

// remove all session variables - w3 schools or utilize other?
session_unset();

// destroy the session
session_destroy();

//session_write_close();
?>