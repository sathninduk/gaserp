<?php
include "./php/connection.php";

$pid_1 = 1;
$sql_1 = 1;

// db - order_has_products insert section
if (isset($pid_1) && isset($sql_1)) {
    $sql_1 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('1', '1', '2021', '1', '2300', 1)";
}


if ($conn->query($sql_1) === TRUE || $conn->query($sql_2) === TRUE || $conn->query($sql_3) === TRUE || $conn->query($sql_4) === TRUE || $conn->query($sql_5) === TRUE || $conn->query($sql_6) === TRUE || $conn->query($sql_7) === TRUE || $conn->query($sql_8) === TRUE || $conn->query($sql_9) === TRUE) {
    $order_has_tbl = TRUE;
  } else {
    $order_has_tbl = FALSE;
  }
  