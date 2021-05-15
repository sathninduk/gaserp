<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
	// Logged out
	$log = false;
	header("location: ./");
	exit;
} else {
	//Logged in
	$log = true;

	$today = date("Y-m-d");
include "../../php/connection.php";
$product_id = htmlentities($_POST["product_id"]);
$new_stock = htmlentities($_POST["availability"]);

$sql = "SELECT availability FROM products WHERE product_id='$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $old_stock = $row["availability"];
  }
}

$new_availability = $old_stock + $new_stock;

$sql = "UPDATE products SET availability='$new_availability' WHERE product_id='$product_id'";

if ($conn->query($sql) === TRUE) {
  echo "<script>";
  echo "  alert('Stock updated successfully!');";
  echo "  window.location = '../stock.php';";
  echo "</script>";
} else {
  echo "Error updating record: " . $conn->error;
}
}
?>