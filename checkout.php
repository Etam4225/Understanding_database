

<?php
session_start();
include "database_login_info.php";
//$mysqli->close();
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
$name = $_SESSION['username'];
echo $name . " Cart";

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
  <input type=date name="date" placeholder="Expiration Date">
  <button type="submit" name="sub">
    Submit
  </button>
</form>