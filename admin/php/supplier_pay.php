<?php

include "../../php/connection.php";

$today = date("Y-m-d");

$supplier_id = htmlentities($_GET["supplier_id"]);

$sql = "UPDATE supplier_payments SET amount=0, last_date='$today' WHERE supplier_id='$supplier_id'";


if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../suppliers.php';";
    echo "</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>