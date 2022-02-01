<?php
// Validate and convert date inputs
$from = date("Y-m-d H:i:s", strtotime($_GET['from']));
$to = date("Y-m-d H:i:s", strtotime($_GET['to']));
if ($_GET['anytime'] == 'on') $anytime = true; 
else $anytime = false;
require 'secret/credentials.php';

  // Create connection
  $conn = new mysqli(servername, username, password, dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $select_query = "SELECT `sensor_value_1`, `sensor_value_2`, `sensor_value_3`, `datetime` FROM `waterlevel` WHERE `datetime` BETWEEN '$from' AND '$to' ORDER BY `id` DESC";
  if ($anytime) $select_query = "SELECT `sensor_value_1`, `sensor_value_2`, `sensor_value_3`, `datetime` FROM `waterlevel` WHERE `datetime` ORDER BY `id` DESC";

  $result = $conn->query($select_query);

  $conn->close();

if ($result->num_rows > 0) {
  // Start creating CSV file
  header("Content-Type: text/csv");
  header("Content-Disposition: attachment; filename=file.csv");
  // Define separator to comma
  echo "sep=,\n";
  // First line with title of columns
  echo "Sensor 1, Sensor 2, Sensor 3, Datetime\n";
  while($row = $result->fetch_assoc()) { // Print the database rows, with columns separated by comma
      $row['sensor_value_1'] = (int)$row['sensor_value_1'];
      $row['sensor_value_2'] = (int)$row['sensor_value_2'];
      $row['sensor_value_3'] = (int)$row['sensor_value_3'];
      if (strlen($row['datetime']) == 0) $row['datetime'] = "No data.";
      echo implode($row,",");
      echo "\n"; // New line for next column
}
    
} else {
    echo "No data found for this interval.";
}

?>