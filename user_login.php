<h1> <center> Games-Hub <center> </h1>
<form method=POST>
  <input type ="varchar(16)" name="name" placeholder="UserName">
  <br>
  <input type ="varchar(64)" name="pass" placeholder="Password">
  <button type="submit" name="submit">
    Sign up
  </button>
</form>

<form method=POST>
  <input type ="varchar(16)" name="login_name" placeholder="UserName">
  <br>
  <input type="varchar(64)" name="login_pass" placeholder="Password">
  <button type="submit" name="login_submit">
    Login
  </button>
</form>

<?php

include "database_login_info.php";

?>

<!--
<form>
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname">
</form>

-->


<?php
//connect to database
$word ='';
$passw ='';
$login_word='';
$login_passw='';

$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

//echo $mysqli->host_info . "<br>";
//search through table
//Sets the UserNames/Passwords
if(isset($_POST['login_submit'])){
  $login_word = $_POST["login_name"];
  $login_passw = $_POST["login_pass"];
}
else if(isset($_POST['submit'])){
  $word = $_POST["name"];
  $passw = $_POST["pass"];
}

/*if($_POST){
  $word = $_POST["name"];
  $passw = $_POST["pass"];
  $login_word = $_POST["login_name"];
  $login_passw = $_POST["login_pass"];
}*/

//checks if the User is login or Signing up
if($word !='' && $passw !='' && $login_word=='' && $login_passw==''){
  $check = "SELECT * FROM Users where name='" . $word . "';";
  $query_check = $mysqli->query($check);
  if(mysqli_num_rows($query_check)==1){
    //echo "UserName Or Password already exist. Please Try Again"; //might not include
    header("Location: ../user_login.php?signup=fail");
  }
  else{
    $sql = "INSERT INTO Users VALUES ('$word', '$passw');";
    $result = $mysqli->query($sql);
    header("Location: ../user_login.php?signup=success");
  }
}
else if($word=='' && $passw=='' && $login_word !='' && $login_passw !=''){
  $sql = "SELECT * FROM Users where name ='" . $login_word . "' AND pass='" . $login_passw . "';";
  $result = $mysqli->query($sql);
  if(mysqli_num_rows($result)!=1)
    echo "The User does not Exist" . "<br>";
  else
    echo "Hello," . $login_word . "<br>";
}
/*$sql = "SELECT * FROM Users;";
$result = $mysqli->query($sql);
$resultcheck = mysqli_num_rows($result);

if($resultcheck >0){
  foreach($result as $item){
    echo $item['name']  . " " . $item['pass'] . "<br>";
    //echo $item['pass'] . "<br>";
  }
}*/

?>
