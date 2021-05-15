<?php

include "../../php/connection.php";
$feedback_id = htmlentities($_GET["feedback_id"]);

$sql = "DELETE FROM feedback WHERE feedback_id='$feedback_id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "  alert('Feedback deleted!');";
    echo "  window.location = '../feedback.php';";
    echo "</script>";
} else {
  echo "Error deleting record: " . $conn->error;
}
?>