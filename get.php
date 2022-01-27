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
  
  $result_array = $result->fetch_assoc();

  $result_array['sensor_value_1'] = (int)$result_array['sensor_value_1'];
  $result_array['sensor_value_2'] = (int)$result_array['sensor_value_2'];
  $result_array['sensor_value_3'] = (int)$result_array['sensor_value_3'];
  if (strlen($result_array['datetime']) == 0) $result_array['datetime'] = "00-00-00 00:00:00";

  $json = json_encode($result_array);
  
  return $json;
}

$starting_content = $current_content = getLatestValuesfromDB();

$polling_delay_seconds = 0.5;

if ($_GET['instant'] != '1') {
  while ($starting_content == $current_content && ($x < 15 / $polling_delay_seconds)) {
    usleep($polling_delay_seconds * 1000000); // Sleep 0.5s
    $current_content = getLatestValuesfromDB();
    $x++;
  }
}

print_r(getLatestValuesfromDB());
?>