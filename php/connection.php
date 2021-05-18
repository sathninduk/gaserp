<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// time
date_default_timezone_set('Asia/Colombo');
$time = date("H:i:s");
// date
$date = date("Y-m-d");
$today = $date;

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
