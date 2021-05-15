<?php
include "connection.php";

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
    header("Location: ../login.php");
} else {
    $pwd_hash = sha1($password);

    //get last id
    $sql_get = "SELECT status, customer_id FROM customer_login WHERE username='$email' AND password='$pwd_hash' LIMIT 1";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $status = $row['status'];

            if ($status == 0) {
                echo "<script>";
                echo "  alert('Sorry! Your account has been disabled');";
                echo "  window.location = '../login.php';";
                echo "</script>";
            } else {
                $customer_id = $row['customer_id'];

                $sql_get_two = "SELECT fname, lname, contact_no, nic, email, no, street, city FROM customer WHERE customer_id='$customer_id' LIMIT 1";
                $result = $conn->query($sql_get_two);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $contact_no = $row['contact_no'];
                        $nic = $row['nic'];
                        $email = $row['email'];
                        $no = $row['no'];
                        $street = $row['street'];
                        $city = $row['city'];

                        session_start();
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["customer_id"] = $customer_id;
                        $_SESSION["fname"] = $fname;
                        $_SESSION["lname"] = $lname;
                        $_SESSION["contact_no"] = $contact_no;
                        $_SESSION["nic"] = $nic;
                        $_SESSION["email"] = $email;
                        $_SESSION["no"] = $no;
                        $_SESSION["street"] = $street;
                        $_SESSION["city"] = $city;

                        header("Location: ../Home2.php");
                    }
                }
            }
        }
    } else {
        echo "<script>";
        echo "  alert('Incorrect username or password!');";
        echo "  window.location = '../login.php';";
        echo "</script>";
    }
}
