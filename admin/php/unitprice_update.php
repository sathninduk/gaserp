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
$unit_price = htmlentities($_POST["unit_price"]);

$sql = "UPDATE products SET price='$unit_price' WHERE product_id='$product_id'";

if ($conn->query($sql) === TRUE) {
  echo "<script>";
  echo "  alert('Unit price updated successfully!');";
  echo "  window.location = '../stock.php';";
  echo "</script>";
} else {
  echo "Error updating record: " . $conn->error;
}
}

?>