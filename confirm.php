<?php
session_start();
?>

<form method=POST>
  <button type="submit" name="back">
    Confirm and Sign Out
  </button>
</form>

<?php
include "database_login_info.php";
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
$name = $_SESSION['username'];


$sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."' AND copy='Digital';";
$result = $mysqli->query($sql);
echo "Your Order has been placed. Thank you for your purchase!" . "<br>";
if ($result->num_rows > 0) {
  echo "<table border='1'>
  <tr>
  <th>name</th>
  <th>store</th>
  <th>CODE</th>
  </tr>";
  echo "Here are your digital codes:" . "<br>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $code ="";
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['Store'] . "</td>";
    for($i=0;$i<16;$i++){
      $pick = rand(0,1);
      if($i%4==0 && $i !=0)
        $code = $code . "-";
      else{
        if($pick==0)
          $code = $code . rand(0,9);
        else
          $code = $code . chr(rand(65,90));
      }
    }
    echo "<td>" . $code . "</td>";
    echo "</tr>";
  }
  echo "</table>";
}

if(isset($_POST['back'])){
  $clear = "DELETE FROM Cart where username='" . $name . "';";
  $result_c = $mysqli->query($clear);
  header("Location: ../user_login.php");
}
?>
