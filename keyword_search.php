<?php

include "database_login_info.php";

$keyword_from_user = $_GET["keyword"];

//echo $keyword_from_user; echo's the keyword user inputs

//search the database for keywords
echo "<h2> Displaying search results of the keyword, ".$keyword_from_user.", below: </h2>";
$sql = "SELECT testing_ID, Question, Statement FROM testing_table WHERE Question LIKE '%" .$keyword_from_user."%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "ID: " . $row["testing_ID"]. " - Question: " . $row["Question"]. " " . $row["Statement"]. "<br>";
  }
} else {
  echo "0 results, please try a different game keyword.";
}
?>