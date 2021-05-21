<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Logged out
    $log = false;
    header("location: ./login.php");
    exit;
} else {

    //Logged in
    $log = true;

    $customer_id = $_SESSION["customer_id"];
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $contact_no = $_SESSION["contact_no"];
    $email = $_SESSION["email"];
    $no = $_SESSION["no"];
    $street = $_SESSION["street"];
    $city = $_SESSION["city"];

    include "./php/connection.php";

    $today = date("Y-m-d");
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="style/cart.css" />
        <link rel="stylesheet" href="style/main.css">
        <link rel="stylesheet" href="style/Admin.css">
        <script src="Js/cart.js" async></script>
    </head>

    <body>
        <div class="nav">
            <div style="color: #000; float: right; margin-right: 60px; margin-top: 20px; font-size: 14px;">
                <a href="./Home2.php" class="feed-ref">New Order</a>
                <span>&nbsp;&nbsp;&nbsp;</span>
                <a href="./my_orders.php" class="feed-ref">My orders</a>
                <span>&nbsp;&nbsp;</span>
                <a href="./php/logout.php" class="feed-ref" style="border: 1px solid rgba(0,0,0,.3);">Logout</a>
            </div>
        </div>
        <style>
            .nav {
                width: 100vw;
                height: 60px;
                position: fixed;
                top: 0px;
                background-color: rgba(255, 255, 255, .2);
                backdrop-filter: blur(20px);
                -ms-backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                -moz-backdrop-filter: blur(20px);
            }

            .cell {
                color: #000;
                padding: 5px 10px 5px 10px;
            }
            table {
                margin: 0px;
                width: 80vw;
                font-size: 14px;
                border-color: transparent;
            }
        </style>
        <center>
            <div style="width: 100vw; margin-top: 150px;">

            <h1 style="text-align: left; width: 80vw; margin-bottom: 40px;">Your Pending Orders</h1>

                <!-- table -->
                <?php

                /*$sql_0 = "SELECT * FROM orders WHERE customer_id = '$customer_id'";
                $result = $conn->query($sql_0);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $payment_type_id = $row["payment_type_id"];
                        $obtaining_method_id = $row["obtaining_method_id"];
                    }
                }

                $sql_2 = "SELECT * FROM payment_type WHERE payment_type_id='$payment_type_id'";
                $result = $conn->query($sql_2);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $payment_type_name = $row["type_name"];
                    }
                }


                $sql_1 = "SELECT * FROM obtaining_method WHERE obtaining_method_id='$obtaining_method_id'";
                $result = $conn->query($sql_1);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $obtaining_method_name = $row["method_type"];
                    }
                }*/



                $sql = "SELECT * FROM orders WHERE customer_id = '$customer_id' AND status = 1";
                //$sql = "SELECT * FROM ((orders INNER JOIN obtaining_method ON orders.customer_id = obtaining_method.obtaining_method_id) INNER JOIN payment_type ON orders.payment_type_id = payment_type.payment_type_id) WHERE orders.customer_id='$customer_id'";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table class=\"tbl\" border=\"1\">
            <tr>
            <th class=\"cell\">ID</th>
            <th class=\"cell\">Order Placed Date</th>
            <th class=\"cell\">Total Amount</th>
            <th class=\"cell\">Obtaining Method</th>
            <th class=\"cell\">Payment Type</th>
            <th style=\"text-align: center;\" class=\"cell\">Status</th>
            <th style=\"text-align: center;\" class=\"cell\">Invoice</th>
            </tr>";
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if ($row["status"] == 1) {
                            $status = "Active";
                        } elseif ($row["status"] == 0) {
                            $status = "Expired";
                        }

                        if ($row["obtaining_method_id"] == 1) {
                            $obtaining_method_type = "Delivery";
                            $final_total = $row["total_price"] + 100;
                        } elseif ($row["obtaining_method_id"] == 2) {
                            $obtaining_method_type = "Pickup";
                            $final_total = $row["total_price"];
                        }

                        if ($row["payment_type_id"] == 2) {
                            $payment_type = "Cash on Delivery";
                        } elseif ($row["payment_type_id"] == 1) {
                            $payment_type = "Credit Card";
                        }
                        echo "<tr>
              <td class=\"cell\">" . $row["order_id"] . "</td>
              <td class=\"cell\">" . $row["date"] . "</td>
              <td class=\"cell\">LKR " . $final_total . ".00</td>
              <td class=\"cell\">" . $obtaining_method_type . "</td>
              <td class=\"cell\">" . $payment_type . "</td>
              <td style=\"text-align: center;\" class=\"cell\">" . $status . "</td>
              <td class=\"cell show-cell\"><a target=\"_blank\" href=\"./admin/php/fpdf/invoice_user.php?order_id=" . $row["order_id"] . "\">Show</a></td>
              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No orders yet!";
                }

                ?>
            </div>
        </center>
        <style>
            .feed {
                z-index: 1000;
                position: fixed;
                bottom: 20px;
                right: 20px;
            }
        </style>
        <div class="feed">
            <a class="feed-ref" href="./contact.php"><b>Feedback</b></a>
        </div>
    </body>

    </html>
<?php
}
?>