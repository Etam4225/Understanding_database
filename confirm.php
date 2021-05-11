<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type="text/css" href = "css\confirm.css">
</head>

<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> <!-- clicking on this does nothing currently. -->
			</div>
      <nav>
			<ul class = "navigation"> <!-- Placeholder header to use on other pages -->
				<li><form method=POST><p><button type="submit" name="back">Confirm and Sign Out</button></p></form></li>
			</ul>
			</nav>
    </div>
</div>
</html>

<?php
include "database_login_info.php";
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
$name = $_SESSION['username']; //get current user's username


$sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."' AND copy='Digital';";
$result = $mysqli->query($sql);
echo "<p><center><h2> Your Order has been placed. Thank you for your purchase!" . "<br>" . "</h2></center></p>";
if ($result->num_rows > 0) {
  ?>
  <!-- create our table -->
  <table border='1' class = "keywordTable">
  <tr>
  <th>name</th>
  <th>Store</th>
  <th>CODE</th>
  </tr>
    <?php
  echo "<p><center><h2> Here are your digital codes:" . "<br>" . "</h2></center></p>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $code ="";
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['Store'] . "</td>";
    for($i=0;$i<16;$i++){ //loop to randomly generate code
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
  $deduc = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) join Cart on game.gameID=Cart.gameID WHERE username='" .$name."' AND copy='Physical';";
  $result_d = $mysqli->query($deduc);
  //updates available stock of physical games
  if($result_d->num_rows > 0){
    while($row = $result_d->fetch_assoc()){
      $reduce = $row['avail_copies'] - 1 ;
      $repeat = "UPDATE sample SET avail_copies ='" . $reduce. "' WHERE name = '" .$row['name'] . "' AND Store = '" .$row['Store'] . "';";
      $perform = $mysqli->query($repeat);
    }
  }
  //helps removes all games from user's cart after they made their purchase
  $clear = "DELETE FROM Cart where username='" . $name . "';";
  $result_c = $mysqli->query($clear);
  header("Location: ../user_login.php");
}
?>
