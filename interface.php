<h1> <center> Games-Network <center> </h1>
<form method=POST>
  <button type="submit" name="back">
    Sign Out
  </button>
</form>


<?php
include "database_login_info.php";

$mysqli->close();

$word ='';
$passw ='';
$state ='';
$city ='';
$street ='';
$payment ='';
$login_word='';
$login_passw='';

$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

//Sets the UserNames/Passwords
if(isset($_POST['login_submit'])){
  $login_word = $_POST["login_name"];
  $login_passw = $_POST["login_pass"];
}
else if(isset($_POST['submit'])){
  $word = $_POST["name"];
  $passw = $_POST["pass"];
  $state = $_POST["state"];
  $city = $_POST["city"];
  $street = $_POST["street"];
  $payment = $_POST["payment"];
}

//checks if the User is login or Signing up
if($word !='' && $passw !='' && $state !='' && $city !='' && $street !='' && $payment !='' && $login_word=='' && $login_passw==''){
  $check = "SELECT * FROM Users where name='" . $word . "';";
  $query_check = $mysqli->query($check);
  if(mysqli_num_rows($query_check)==1){
    //echo "UserName Or Password already exist. Please Try Again"; //might not include
    header("Location: ../user_login.php?signup=fail");
  }
  else{
    $sql = "INSERT INTO Users VALUES ('$word', '$passw', '$state', '$city', '$street', '$payment' );";
    $result = $mysqli->query($sql);
    header("Location: ../user_login.php?signup=success");
  }
}
else if($word=='' && $passw=='' && $login_word !='' && $login_passw !=''){
  $sql = "SELECT * FROM Users where name ='" . $login_word . "' AND pass='" . $login_passw . "';";
  $result = $mysqli->query($sql);
  if(mysqli_num_rows($result)!=1){
    header("Location: ../user_login.php?login=fail");
    //echo "The User does not Exist" . "<br>";
  }
  else{
    //header("Location: ../interface.php?login=sucess");
    echo "Hello," . $login_word . "<br>";
    echo "<br>";
  }
}

if(isset($_POST['back']))
  header("Location: ../user_login.php");


?>

<br>

<form action = "keyword_search.php">
   Enter the game you are looking for: <br>
  <input type="text" name="keyword"><br>
  <input type="submit" value="Search!">
</form>
