<?php
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

    $stmt = $conn->prepare("INSERT INTO waterlevel ('sensor-value-1', 'sensor-value-2', 'sensor-value-3') VALUES ???");
    $stmt->bind_param("iii", $v1, $v2, $v3);
    $stmt->execute();
    $stmt->close();
    $conn->close();
?>