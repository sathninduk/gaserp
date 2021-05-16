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
    $sql_get_1 = "SELECT driver_id FROM driver ORDER BY driver_id DESC LIMIT 1";
    $result = $conn->query($sql_get_1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $driver_id = $row["driver_id"] + 1;
        }
    } else {
        $driver_id = 1;
    }

    $fname = $lname = $contact_no = $email = "";

    $fname          = $_POST["fname"];
    $lname          = $_POST["lname"];
    $contact_no     = $_POST["contact_no"];
    $nic            = $_POST["nic"];
    $start          = $_POST["start"];
    $end            = $_POST["end"];
    $email          = $_POST["email"];
    $pw             = $_POST["pw"];
    $veri           = $_POST["veri"];

    if ($pw != $veri) {
        echo "<script>";
        echo "  alert('Password do not match!');";
        echo "  window.location = '../drivers.php';";
        echo "</script>";
    } else {

        $pw_hash = sha1($pw);

        $sql_1 = "INSERT INTO driver (driver_id, fname, lname, contact_no, nic, start, end, email, status) VALUES ('$driver_id', '$fname', '$lname',  '$contact_no', '$nic', '$start', '$end', '$email', 1)";

        $sql_2 = "INSERT INTO driver_payments (driver_id, amount, status) VALUES ('$driver_id', 0, 1)";

        $sql_3 = "INSERT INTO system_users (sysusername, password, status, driver_id, role) VALUES ('$email', '$pw_hash', 1, '$driver_id', 2)";

        if ($conn->query($sql_1) === TRUE && $conn->query($sql_2) === TRUE && $conn->query($sql_3) === TRUE) {
            echo "<script>";
            echo "  alert('Driver added successful!');";
            echo "  window.location = '../drivers.php';";
            echo "</script>";
        } else {
            echo "Error: " . $sql_1 . "<br>" . $conn->error;
        }
    }
}
$conn->close();
