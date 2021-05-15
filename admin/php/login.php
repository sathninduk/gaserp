<?php
include "../../php/connection.php";

$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = htmlentities($_POST["email"]);
    $password = htmlentities($_POST["password"]);
}

$email    = str_replace("'", "\'", $email);
$password = str_replace("'", "\'", $password);

$email    = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

if (empty($email) || empty($password)) {
    header("Location: ../");
} else {
    $pwd_hash = sha1($password);

    //get last id
    $sql_get = "SELECT * FROM system_users WHERE sysusername='$email' AND password='$pwd_hash' LIMIT 1";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $status = $row['status'];
            $role = $row["role"];

            if ($role == 2) {
                $driver_id = $row['driver_id'];
            }
            

            session_start();
            // Store data in session variables
            if ($role == 1) {
                    $_SESSION["admin_loggedin"] = true;
                    $_SESSION["admin_user"] = $email;
                } elseif ($role == 2) {
                    $_SESSION["driver_loggedin"] = true;
                }

                $_SESSION["email"] = $email;
            

            if ($role == 2) {
                $_SESSION["driver_id"] = $driver_id;
            }


            if ($role == 1) {
            header("Location: ../AdminDashboard.php");
            } elseif ($role == 2) {
                header("Location: ../drivers_dashboard.php");
            }
        }
    } else {
        echo "<script>";
        echo "  alert('Incorrect username or password!');";
        echo "  window.location = '../';";
        echo "</script>";
    }
}
