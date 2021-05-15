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
    include "../../php/connection.php";

    $today = date("Y-m-d");
    $user = htmlentities($_POST["user"]);
    $old_pw_row = htmlentities($_POST["old_pw"]);
    $new_pw_row = htmlentities($_POST["new_pw"]);
    $veri_row = htmlentities($_POST["veri"]);

    $old_pw = sha1($old_pw_row);
    $new_pw = sha1($new_pw_row);
    $veri = sha1($veri_row);

    $sql = "SELECT password FROM system_users WHERE sysusername = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $old_fetched_pw = $row["password"];
            if ($old_pw == $old_fetched_pw) {
                if ($new_pw == $veri) {
                    $permission = true;
                } else {
                    echo "<script>";
                    echo "  alert('Passwords mismatch!');";
                    echo "  window.location = '../change-pw.php';";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "  alert('Incorrect password!');";
                echo "  window.location = '../change-pw.php';";
                echo "</script>";
            }
        }
    }

    if ($permission == true) {

        $sql = "UPDATE system_users SET password='$veri' WHERE sysusername='$user'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>";
            echo "  alert('Password changed successfully!');";
            echo "  window.location = '../change-pw.php';";
            echo "</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
