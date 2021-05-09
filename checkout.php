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
  
  
<?php

date_default_timezone_set('America/New_York');

include "database_login_info.php";
//$mysqli->close();
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
$name = $_SESSION['username'];

$sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."';";
$result = $mysqli->query($sql);
echo "<table border='1'>
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
</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    //echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['gameID'] . "</td>";
	  //$idVals[] = $row['gameID'];
    //$link_address = "../remove.php?rn=$row[gameID]"; //need to change this
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['Store'] . "</td>";
    echo "<td>" . $row['copy'] . "</td>";
    echo "<td>" . $row['Console'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['avail_copies'] . "</td>";
    echo "<td>" . $row['lowest'] . "</td>";
    //echo "<td>" . '<a href="'.$link_address.'">REMOVE</a>' . "</td>"; 
    echo "</tr>";
  }
  echo "</table>";
}
$price_total = "SELECT SUM(sample.price) FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."';";
$result_price = $mysqli->query($price_total);
if($result_price->num_rows >0){
  while($row = $result_price->fetch_assoc()){
    echo "Total Cost: $" . $row['SUM(sample.price)'] . "<br>";
    $tax = $row['SUM(sample.price)'] * .075;
    echo "Tax: $" . round($tax,2) . "<br>";
    $total = $row['SUM(sample.price)'] + $tax;
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
  <input type=varchar(16) name="card" placeholder="Card Number">
  <input type=varchar(4) name="CVC" placeholder="CVC Number">
  <input type=month name="date" placeholder="Expiration Date">  <!--month datatype to get only month/year -->
  <button type="submit" name="sub">
    Submit
  </button>
</form>


<?php
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
  if($exp_num < date("Y-m")){
    header("Location: ../checkout.php?expiredcard");
  }
  else if (strlen($cvc_num)!=3){
    header("Location: ../checkout.php?invalidCVC");
  }
  else if(strlen($card_num)!=16){
    header("Location: ../checkout.php?invalidCard");
  }
  else{
    header("Location: ../confirm.php"); 
  }
}

?>
