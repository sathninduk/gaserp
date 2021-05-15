<?php

include "../../php/connection.php";

$today = date("Y-m-d");

$driver_id = htmlentities($_GET["driver_id"]);

$sql = "UPDATE driver_payments SET amount=0, last_date='$today' WHERE driver_id='$driver_id'";


if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../drivers.php';";
    echo "</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>