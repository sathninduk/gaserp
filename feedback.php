<?php

include "./php/connection.php";

$customer_id = htmlentities($_POST["customer_id"]);
$description = htmlentities($_POST["description"]);

$sql = "INSERT INTO feedback (description, status, customer_id) VALUES ('$description', 1, '$customer_id')";
if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "  alert('Feedback successfully sent!');";
    echo "  window.location = './Home2.php';";
    echo "</script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>