<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type="text/css" href = "css\interface.css">
</head>
<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> <!-- clicking on this does nothing  -->
			</div>

			<nav>
			  <ul class = "navigation"> <!--  Header to use on other pages -->
				  <li>
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
                  $_SESSION["username"] = $login_word;
                }
                else if(isset($_POST['submit'])){
                  $word = $_POST["name"];
                  $passw = $_POST["pass"];
                  $state = $_POST["state"];
                  $city = $_POST["city"];
                  $street = $_POST["street"];
                  $payment = $_POST["payment"];
                }
              echo "<br>" ;
              $link_address = "../cart.php?rn=$login_word";
              echo "<td>" . '<a href="'.$link_address.'"> My Cart </a>' . "</td>"; 
            ?>
          </li>
          <li>  
            <form method=POST> <!-- sign out button -->
              <button type="submit" name="back">
                  Sign Out
              </button>
            </form>
          </li>
			  </ul>
			</nav>
		</div>
</div>

<?php

//checks if the User is login or Signing up
if($word !='' && $passw !='' && $state !='' && $city !='' && $street !='' && $payment !='' && $login_word=='' && $login_passw==''){
  $check = "SELECT * FROM Users where name='" . $word . "';";
  $query_check = $mysqli->query($check);
  if(mysqli_num_rows($query_check)==1){
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
  }
  else{
    echo "<br>";
  }
}

if(isset($_POST['back']))
  header("Location: ../user_login.php");


?>

<br>

  <form action = "keyword_search.php" >
    Enter the game you are looking for: <br>
    <input type="text" name="keyword" class="input-field"><br>
    <select name="Sorting" class = "sort">
      <option selected disabled> SELECT </option>
      <option value="name"> name </option>
      <option value="Store"> Store </option>
      <option value="copy"> Copy </option>
      <option value="Console"> Console </option>
      <option value="rating"> Rating </option>
      <option value="price"> Price </option>
    </select>
    <input type="submit" value="Search!" class="toggle-button">
  </form>
