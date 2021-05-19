<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
  // Logged out
  $log = false;
  header("location: ../");
  exit;
} else {
  //Logged in
  $log = true;
  

  $today = date("Y-m-d");
  include "../../php/connection.php";
  $driver_id = htmlentities($_GET["driver_id"]);
  $order_id = htmlentities($_GET["order_id"]);
  $payment_type = htmlentities($_GET["payment_type_id"]);


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




  if ($payment_type == 2) {

    // total value of the sale - cash on delivery
    $sql_6 = "SELECT total_price FROM orders WHERE order_id = '$order_id'";
    $result = $conn->query($sql_6);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $total_price = $row["total_price"];
      }
    }

    // old debit balance of the driver
    $sql_5 = "SELECT debit_balance FROM driver_payments WHERE driver_id = '$driver_id'";
    $result = $conn->query($sql_5);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $old_debit_balance = $row["debit_balance"];
      }
    }
    // new debit balance
    $new_debit_balance = $old_debit_balance + $total_price;

    // update debit balance of the driver
    $sql_4 = "UPDATE driver_payments SET debit_balance = '$new_debit_balance' WHERE driver_id='$driver_id'";
    $sql_4_veri = "";
    if ($conn->query($sql_4) === TRUE) {
      $sql_4_veri == TRUE;
    }
  } else {
    $sql_4_veri == TRUE;
  }





  if ($conn->query($sql) === TRUE && $conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE && $conn->query($sql_3) === TRUE) {
    echo "<script>";
    echo "  alert('Record updated!');";
    echo "  window.location = '../delivery.php';";
    echo "</script>";
  } else {
    echo "Error updating record: " . $conn->error;
  }
}
