<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type="text/css" href = "css\checkout.css">
</head>
<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> <!-- clicking on this does nothing currently. -->
			</div>
      <nav>
        <ul class = "navigation">
          <li><a href="../cart.php"> Back </a></li>
      </nav>
  </div>
</div>
</html>
  
<?php

date_default_timezone_set('America/New_York'); //sets our timezone

include "database_login_info.php";

$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
$name = $_SESSION['username']; //gets the current user's username

$sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."';";
$result = $mysqli->query($sql);
  
?>
<!-- creates our table -->
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
</tr>
 
<?php
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['gameID'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['Store'] . "</td>";
    echo "<td>" . $row['copy'] . "</td>";
    echo "<td>" . $row['Console'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['avail_copies'] . "</td>";
    echo "<td>" . $row['lowest'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
}
$price_total = "SELECT SUM(sample.price) FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."';";
$result_price = $mysqli->query($price_total);
if($result_price->num_rows >0){
  while($row = $result_price->fetch_assoc()){
    echo "Total Cost: $" . $row['SUM(sample.price)'] . "<br>"; // gets total cost of games
    $tax = $row['SUM(sample.price)'] * .075; //calculates tax 
    echo "Tax: $" . round($tax,2) . "<br>"; 
    $total = $row['SUM(sample.price)'] + $tax; //gets total amount + tax
    echo "Total Cost: $" . round($total,2) . "<br>";
    $Date = date("m/d/Y"); //get today's date
    $num = rand(3,10); //randomly generates a number between 3 and 10
    echo "Date of Arrival: " . date('m-d-Y', strtotime($Date. ' +'. $num. ' days')); //date of arrival = today's date + random number of days
  }
}
if(isset($_POST['back']))
  header("Location: ../interface.php");

echo "<br>" . "<br>" . "<br>";
echo "Please Enter your Card Information:";

?>
<form method=POST>
  <input type=varchar(16) name="card" class="input-field" placeholder="Card Number">
  <br>
  <input type=varchar(4) name="CVC" class="input-field" placeholder="CVC Number">
  <br>
  <input type=month name="date" placeholder="Expiration Date">  <!--month datatype to get only month/year -->
  <br>
  <button type="submit" class="btn-btn-primary" name="sub">
    Submit
  </button>
</form>


<?php
//checks if submitted info is correct/valid
if(isset($_POST['sub'])){ 
  $exp_num = $_POST['date'];
  $card_num = $_POST['card'];
  $cvc_num = $_POST['CVC'];
  $sql = "SELECT payment_method FROM Users WHERE name='" .$name."';";
  $result = $mysqli->query($sql);
  if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
      $payment_m = $row['payment_method'];
    }
  }
  if($exp_num < date("Y-m")){ //checks if card is stil Valid today
    header("Location: ../checkout.php?expiredcard");
  }
  else if (strlen($cvc_num)!=3){ //checks length of CVC code 
    header("Location: ../checkout.php?invalidCVC");
  }
  else if(strlen($card_num)!=16){ //checks length of card numbers
    header("Location: ../checkout.php?invalidCard"); 
  }
  else{
    header("Location: ../confirm.php"); //if all information is correct, sends user to confirmation page
  }
}

?>
