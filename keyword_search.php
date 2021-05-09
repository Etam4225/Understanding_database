<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
  <link rel = "stylesheet" type="text/css" href = "css/search.css">
</head>
<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> <!-- clicking on this does nothing currently. -->
			</div>
      <nav>
        <ul class = "navigation">
          <li><a href="../interface.php"> Back </a></li>
      </nav>
  </div>
</div>
</html>

<?php

include "database_login_info.php";

$keyword_from_user = $_GET["keyword"];

//echo $keyword_from_user; echo's the keyword user inputs

//search the database for keywords
echo "<h2> Displaying search results of the keyword, ".$keyword_from_user.", below: </h2>";
if(!isset($_GET["Sorting"])){
  //$sql = "SELECT testing_ID, Question, Statement FROM testing_table WHERE Question LIKE '%" .$keyword_from_user."%'";
  $sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) WHERE name LIKE '%" .$keyword_from_user."%'";
  $result = $mysqli->query($sql);
}
else{
  $sort = $_GET["Sorting"];
  if($sort=="rating")
     $sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) WHERE name LIKE '%" .$keyword_from_user."%' ORDER BY sample." .$sort. " DESC;";
  else
    $sql = "SELECT DISTINCT * FROM sample join game using (name,Store,copy) WHERE name LIKE '%" .$keyword_from_user."%' ORDER BY sample." .$sort. ";";
  $result = $mysqli->query($sql);
}

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
<th>ADD to Cart</th>
</tr>";




if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['gameID'] . "</td>";
    $link_address = "../add.php?rn=$row[gameID]";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['Store'] . "</td>";
    echo "<td>" . $row['copy'] . "</td>";
    echo "<td>" . $row['Console'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['avail_copies'] . "</td>";
    echo "<td>" . $row['lowest'] . "</td>";
    echo "<td>" . '<a href="'.$link_address.'">ADD</a>' . "</td>"; 
    echo "</tr>";
  }
  echo "</table>";
}
else {
  echo "0 results, please try a different game keyword.";
}

?>
