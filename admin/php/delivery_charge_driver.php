<?php

	$today = date("Y-m-d");
include "../../php/connection.php";
$driver_id = htmlentities($_GET["driver_id"]);
$order_id = htmlentities($_GET["order_id"]);

echo $driver_id;

$sql = "SELECT amount FROM driver_payments WHERE driver_id = '$driver_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $old_amount = $row["amount"];
  }
} else {
  echo "Complex error! - 701";
}

$new_amount = $old_amount + 100;

$sql = "UPDATE driver_payments SET amount='$new_amount' WHERE driver_id='$driver_id'";
$sql_1 = "UPDATE orders SET status=0 WHERE order_id='$order_id'";
$sql_2 = "UPDATE delivery SET status=0 WHERE order_id='$order_id'";
$sql_3 = "UPDATE order_has_products SET status=0 WHERE order_id='$order_id'";

if ($conn->query($sql) === TRUE && $conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE && $conn->query($sql_3) === TRUE) {

      echo "<script>";
      echo "  alert('Record updated!');";
      echo "  window.location = '../drivers_dashboard.php';";
      echo "</script>";

} else {
  echo "Error updating record: " . $conn->error;
}
