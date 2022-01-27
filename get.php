<?php
require 'secret/credentials.php';
header('Content-Type: application/json; charset=utf-8');
function getLatestValuesfromDB()
{
  // Create connection
  $conn = new mysqli(servername, username, password, dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $select_query = "SELECT `sensor_value_1`, `sensor_value_2`, `sensor_value_3`, `datetime` FROM `waterlevel` ORDER BY `id` DESC LIMIT 1";

  $result = $conn->query($select_query);

  $conn->close();
  
  $json = json_encode($result->fetch_assoc());
  if ($json == 'null') $json = '[]';
  
  return $json;
}
print_r(getLatestValuesfromDB());
?>