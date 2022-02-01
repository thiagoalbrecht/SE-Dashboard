<?php
date_default_timezone_set('Europe/Amsterdam');
require 'secret/credentials.php';

if ($_POST['pw'] != ProcessingPassword){
  header("HTTP/1.1 401 Unauthorized");
  header("xx-status: 401");
  die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // collect value of input field
    $v1 = $_POST['sensorvalue1'];
    $v2 = $_POST['sensorvalue2'];
    $v3 = $_POST['sensorvalue3'];
    $time = date("Y-m-d H:i:s",time());
    // Create connection
    $conn = new mysqli(servername, username, password, dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO waterlevel (`sensor_value_1`, `sensor_value_2`, `sensor_value_3`, `datetime`) VALUES (?,?,?,?)");
    $stmt->bind_param("iiis", $v1, $v2, $v3, $time);
    $stmt->execute();
    echo "Values $v1, $v2, $v3 posted";
    $stmt->close();
    $conn->close();
    header("HTTP/1.1 201 Created");
    header("xx-status: 201");

} else {
    header("HTTP/1.1 400 Bad Request");
    header("xx-status: 400");
  } 
?>