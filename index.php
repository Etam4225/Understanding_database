<html>
<head>
</head>

<body>
<h1> <center> Testing PHP  <center> </h1>




<?php 

//connect to database
$host = "localhost";
$username = "root";
$user_pass = "usbw";
$database_in_use = "test";

$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

echo $mysqli->host_info . "<br>";


//search through table
$sql = "SELECT testing_ID, Question, Statement FROM testing_table";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "ID: " . $row["testing_ID"]. " - Question: " . $row["Question"]. " " . $row["Statement"]. "<br>";
  }
} else {
  echo "0 results";
}
$mysqli->close();

?>



</body>

</html>