<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'secret/credentials.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // collect value of input field
    $v1 = $_POST['sensorvalue1'];
    $v2 = $_POST['sensorvalue2'];
    $v3 = $_POST['sensorvalue3'];
    // Create connection
    $conn = new mysqli(servername, username, password, dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO waterlevel (`sensor_value_1`, `sensor_value_2`, `sensor_value_3`) VALUES (?,?,?)");
    $stmt->bind_param("iii", $v1, $v2, $v3);
    $stmt->execute();
    echo "Values added successfully";
    $stmt->close();
    $conn->close();

} else {
    header("HTTP/1.1 400 Bad Request");
  } 
?>