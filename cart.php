<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
  <link rel = "stylesheet" type="text/css" href = "css/background.css">
  <link rel = "stylesheet" type="text/css" href = "css/table.css">
	<link rel = "stylesheet" type="text/css" href = "css/cart.css">
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
session_start();
include "database_login_info.php";
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
$name = $_SESSION['username']; //gets current user's username

$sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."';";
$result = $mysqli->query($sql);

?>
<!-- create the table -->
<table border='1' class = "keywordTable">
<tr>
<th>gameID</th>
<th>name</th>
<th>Store</th>
<th>copy</th>
<th>Console</th>
<th>rating</th>
<th>price</th>
<th>available_copies</th>
<th>Lowest_Price</th>
<th>REMOVE to Cart</th>
</tr>

<?php

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['gameID'] . "</td>";
    $link_address = "../remove.php?rn=$row[gameID]"; 
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['Store'] . "</td>";
    echo "<td>" . $row['copy'] . "</td>";
    echo "<td>" . $row['Console'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['avail_copies'] . "</td>";
    echo "<td>" . $row['lowest'] . "</td>";
    echo "<td>" . '<a href="'.$link_address.'">REMOVE</a>' . "</td>"; 
    echo "</tr>";
  }
  echo "</table>";
}

if(isset($_POST['back']))
  header("Location: ../interface.php");
if(isset($_POST['out']))
  header("Location: ../checkout.php");

?>
