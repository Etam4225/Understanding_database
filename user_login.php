<form method=POST>
  <input type ="varchar(16)" name="name" placeholder="UserName">
  <br>
  <input type ="varchar(64)" name="pass" placeholder="Password">
  <button type="submit" name="submit">
    Sign up
  </button>
</form>

<?php
//connect to database
$host = "localhost";
$username = "root";
$user_pass = "usbw";
$database_in_use = "test";
$word ='';
$passw ='';

$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

//echo $mysqli->host_info . "<br>";
//search through table
if($_POST){
  $word = $_POST["name"];
  $passw = $_POST["pass"]; 
}
if($word !='' && $passw !=''){
  $sql = "INSERT INTO Users VALUES ('$word', '$passw');";
  $result = $mysqli->query($sql);
  header("Location: ../user_login.php?signup=success");
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
