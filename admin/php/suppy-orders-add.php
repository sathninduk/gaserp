<?php
include "../../php/connection.php";

$supplier = htmlentities($_POST["supplier"]);
$product_id = htmlentities($_POST["product_id"]);
$unit_price = htmlentities($_POST["unit_price"]);
$quantity = htmlentities($_POST["quantity"]);

$date = date('Y-m-d');

        //get last id
        $sql_get = "SELECT supply_order_id FROM supply_orders ORDER BY supply_order_id DESC LIMIT 1";
        $result = $conn->query($sql_get);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $supply_order_id = $row["supply_order_id"] + 1;
            }
        } else {
            $supply_order_id = 1;
        }

$sql_1 = "INSERT INTO supply_orders (supply_order_id, product_id, unit_price, quantity, date, status, supplier_id) VALUES ('$supply_order_id', '$product_id', '$unit_price', '$quantity', '$date', 1, '$supplier')";
if ($conn->query($sql_1) === TRUE) {

    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../supplier-orders.php';";
    echo "</script>";
  
} else {
  echo "Error updating record: " . $conn->error;
}
