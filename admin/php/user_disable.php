<?php

include "../../php/connection.php";

$today = date("Y-m-d");

$customer_id = htmlentities($_GET["customer_id"]);

$sql = "UPDATE customer SET status=0 WHERE customer_id='$customer_id'";
$sql_1 = "UPDATE customer_login SET status=0 WHERE customer_id='$customer_id'";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 if ($conn->query($sql_1) === TRUE) {
        echo "<script>";
        echo "  alert('User Disabled!');";
        echo "  window.location = '../customers.php';";
        echo "</script>";
    }