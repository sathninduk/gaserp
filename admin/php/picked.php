<?php
include "../../php/connection.php";

$order_id = htmlentities($_GET["order_id"]);



$sql_1 = "UPDATE orders SET status=0 WHERE order_id='$order_id'";
$sql_2 = "UPDATE order_has_products SET status=0 WHERE order_id='$order_id'";
if ($conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE) {

    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../pickup.php';";
    echo "</script>";
  
} else {
  echo "Error updating record: " . $conn->error;
}

?>