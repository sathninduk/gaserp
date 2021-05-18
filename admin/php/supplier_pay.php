<?php

include "../../php/connection.php";

$today = date("Y-m-d");

$supplier_id = htmlentities($_GET["supplier_id"]);
$amount = htmlentities($_GET["amount"]);

$sql = "UPDATE supplier_payments SET amount=0, last_date='$today' WHERE supplier_id='$supplier_id'";
$sql_2 = "INSERT INTO supplier_payments_history (supplier_id, amount, date) VALUES ('$supplier_id', '$amount', '$today')";

if ($conn->query($sql) === TRUE && $conn->query($sql_2) === TRUE) {
    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../suppliers.php';";
    echo "</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>