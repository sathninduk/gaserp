<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    // Logged out
    $log = false;
    header("location: ../");
    exit;
} else {

    include "../../php/connection.php";

    //get last id - delivery
    $sql_get_1 = "SELECT supplier_id FROM supplier ORDER BY supplier_id DESC LIMIT 1";
    $result = $conn->query($sql_get_1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $supplier_id = $row["supplier_id"] + 1;
        }
    } else {
        $supplier_id = 1;
    }

    $fname = $lname = $contact_no = $email = "";

    $fname          = $_POST["fname"];
    $lname          = $_POST["lname"];
    $company_name   = $_POST["company_name"];
    $contact_no     = $_POST["contact_no"];
    $email          = $_POST["email"];


        $sql_1 = "INSERT INTO supplier (supplier_id, fname, lname, company_name, contact_no, email, status) VALUES ('$supplier_id', '$fname', '$lname', '$company_name', '$contact_no', '$email', 1)";

        $sql_2 = "INSERT INTO supplier_payments (supplier_id, amount, status) VALUES ('$supplier_id', 0, 1)";


        if ($conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE) {
            echo "<script>";
            echo "  alert('Supplier added successful! ".$company_name."');";
            echo "  window.location = '../suppliers.php';";
            echo "</script>";
        } else {
            echo "Error: " . $sql_1 .", ". $sql_2 . "<br>" . $conn->error;
        }
    
}
$conn->close();
