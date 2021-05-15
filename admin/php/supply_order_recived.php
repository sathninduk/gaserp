<?php
$supply_order_id = htmlentities($_GET["supply_order_id"]);
$qty = htmlentities($_GET["qty"]);
$product_id = htmlentities($_GET["product_id"]);
$supplier_id = htmlentities($_GET["supplier_id"]);
$add_amount = htmlentities($_GET["total_price"]);

include "../../php/connection.php";
$amount = 0;
$date = date('Y-m-d');

$sql = "SELECT amount FROM supplier_payments WHERE supplier_id='$supplier_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $amount = $row["amount"];
    }
}

$sql = "SELECT availability FROM products WHERE product_id='$product_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $availability = $row["availability"];
    }
}

$new_availability = $availability + $qty;

$new_amount = $amount + $add_amount;

//db - tbl - stock & supplier_payments

$sql_1 = "UPDATE supplier_payments SET amount='$new_amount', last_date='$date' WHERE supplier_id='$supplier_id'";
$sql_2 = "UPDATE supply_orders SET status=0 WHERE supply_order_id='$supply_order_id'";
$sql_3 = "UPDATE products SET availability='$new_availability' WHERE product_id='$product_id'";

if ($conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE && $conn->query($sql_3) === TRUE) {
  echo "<script>";
  echo "  alert('Record updated!');";
  echo "  window.location = '../supplier-orders.php';";
  echo "</script>";
} else {
  echo "Error updating record: " . $conn->error;
}


?>