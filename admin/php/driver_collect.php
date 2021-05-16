<?php

include "../../php/connection.php";

$today = date("Y-m-d");

$driver_id = htmlentities($_GET["driver_id"]);
$debit_balance = htmlentities($_GET["debit_balance"]);

$sql = "UPDATE driver_payments SET debit_balance=0, last_date='$today' WHERE driver_id='$driver_id'";
$sql_2 = "INSERT INTO driver_payments_history (driver_id, payment, type, date) VALUES ('$driver_id', '$debit_balance', 'Credit', '$today')";

if ($conn->query($sql) === TRUE && $conn->query($sql_2) === TRUE) {
    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../drivers.php';";
    echo "</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>