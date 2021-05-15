<?php
include "connection.php";

$fname = $lname = $contact_no = $no = $road = $city = $email = $password = $password_verify = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname              = htmlentities($_POST["fname"]);
    $lname              = htmlentities($_POST["lname"]);
    $contact_no         = htmlentities($_POST["contact_no"]);
    $nic                = htmlentities($_POST["nic"]);
    $no                 = htmlentities($_POST["no"]);
    $road               = htmlentities($_POST["road"]);
    $city               = htmlentities($_POST["city"]);
    $email              = htmlentities($_POST["email"]);
    $password           = htmlentities($_POST["password"]);
    $password_verify    = htmlentities($_POST["password_verify"]);
}

$fname              = str_replace("'", "\'", $fname);
$lname              = str_replace("'", "\'", $lname);
$contact_no         = str_replace("'", "\'", $contact_no);
$nic                = str_replace("'", "\'", $nic);
$no                 = str_replace("'", "\'", $no);
$road               = str_replace("'", "\'", $road);
$city               = str_replace("'", "\'", $city);
$email              = str_replace("'", "\'", $email);
$password           = str_replace("'", "\'", $password);
$password_verify    = str_replace("'", "\'", $password_verify);

$fname              = filter_var($fname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$lname              = filter_var($lname, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$contact_no         = filter_var($contact_no, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$nic                = filter_var($nic, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$no                 = filter_var($no, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$road               = filter_var($road, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$city               = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email              = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$password           = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$password_verify    = filter_var($password_verify, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

if (empty($fname) || empty($lname) || empty($contact_no) || empty($nic) || empty($no) || empty($road) || empty($city) || empty($email) || empty($password) || empty($password_verify)) {
    header("Location: ../Registration.html");
} else {
    if ($password_verify == $password) {

        // process
        $pwd_hash = sha1($password);
        $status = 1;

        //get last id
        $sql_get = "SELECT customer_id FROM customer ORDER BY customer_id DESC LIMIT 1";
        $result = $conn->query($sql_get);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cid = $row["customer_id"] + 1;
            }
        } else {
            $cid = 1;
        }

        //insert data
        $sql_one = "INSERT INTO customer (customer_id, fname, lname, contact_no, nic, email, no, street, city, status)
        VALUES ('$cid', '$fname', '$lname', '$contact_no', '$nic', '$email', '$no', '$road', '$city', '$status')";


        $sql_two = "INSERT INTO customer_login (username, password, status, customer_id)
        VALUES ('$email', '$pwd_hash', '$status', '$cid')";


        if ($conn->query($sql_one) === TRUE && $conn->query($sql_two) === TRUE) {
            echo "<script>";
            echo "  alert('Registration successful!');";
            echo "  window.location = '../login.php';";
            echo "</script>";
        } else {
            if ($conn->query($sql_one) === FALSE) {
                echo "Error: " . $sql_one . "<br>" . $conn->error;
            }

            if ($conn->query($sql_two) === FALSE) {
                echo "Error: " . $sql_two . "<br>" . $conn->error;
            }
        }
    } else {
        echo "<script>";
        echo "  alert('Password does not match!');";
        echo "  window.location = '../Registration.html';";
        echo "</script>";
    }
}

$conn->close();
