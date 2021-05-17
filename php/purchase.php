<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Logged out
    $log = false;
    header("location: ./login.php");
    exit;
} else {

    include "../php/connection.php";

    $year = date("Y");

    // date
    $date = date("Y-m-d");

    // time
    date_default_timezone_set('Asia/Colombo');
    $time = date("H:i:s");


    $customer_id            = $_SESSION["customer_id"];
    $fname                  = $_SESSION["fname"];
    $lname                  = $_SESSION["lname"];
    $contact_no             = $_SESSION["contact_no"];
    $email                  = $_SESSION["email"];

    if (isset($_POST["total"])) {
        if ($_POST["total"] != 0 || $_POST["total"] != "") {
            $total_price = $_POST["total"];
        } else {
            header("location: ../Home2.php");
            exit;
        }
    } else {
        header("location: ../Home2.php");
        exit;
    }

    // initial variable assigning
    $pid_1 = $pid_2 = $pid_3 = $pid_4 = $pid_5 = $pid_6 = $pid_7 = $pid_8 = $pid_9 = $price_1 = $price_2 = $price_3 = $price_4 = $price_5 = $price_6 = $price_7 = $price_8 = $price_9 = "";

    $qty_1 = $qty_2 = $qty_3 = $qty_4 = $qty_5 = $qty_6 = $qty_7 = $qty_8 = $qty_9 = 0;

    // data collecting section
    $obtaining_method_id    = $_POST["obtaining_method_id"];
    if ($obtaining_method_id == 1) {







        //get row count - drivers
        $sql_get_101 = "SELECT * FROM driver WHERE status = 1 AND start < '$time' AND end > '$time'";
        $result = $conn->query($sql_get_101);
        if ($result->num_rows > 0) {


            $driverArray = array();
            $index = 0;


            while ($row = $result->fetch_assoc()) {
                $driver_rowcount = mysqli_num_rows($result);
                //mysqli_free_result($result);
                $delivery_available = TRUE;

                //echo $row["driver_id"]."<br>";


                $driverArray[$index] = $row["driver_id"];
                $index++;
            }

            if ($delivery_available == TRUE) {
                //echo "<br>" . $driver_rowcount;
            }
        } else {
            //echo "";
           // header ("Location: ../Home2.php");
            

            echo "<script>";
            echo "  alert('Delivery Unavailable!');";
            echo "  window.location = '../Home2.php';";
            echo "</script>";
            exit;
            $delivery_available = FALSE;
        }



        //get last id - driver
        $sql_get_1 = "SELECT driver_id FROM delivery WHERE driver_id IN (";

        foreach ($driverArray as $value) {
            if ($value == $driverArray[$driver_rowcount - 1]) {
                $sql_get_3_helper .= $value;
            } else {
                $sql_get_3_helper = $value . ", ";
            }
            $sql_get_3 = $sql_get_3_helper;
        }

        $sql_get_2 = ") ORDER BY delivery_id DESC LIMIT 1";

        $result = $conn->query($sql_get_1 . $sql_get_3 . $sql_get_2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //echo $row["driver_id"];
                $last_driver = $row["driver_id"];
            }
        } else {
            echo "Error";
        }

        $array_max = count($driverArray) - 1;

        // new driver assign
        $driver_position = array_search($last_driver, $driverArray);
        if ($driver_position == $array_max) {
            $next_driver = $driverArray[0];
        } else {
            $next_driver = $driverArray[$driver_position + 1];
        }

        $driver = $next_driver;



        //get last id - delivery
        $sql_get_1 = "SELECT delivery_id FROM delivery ORDER BY delivery_id DESC LIMIT 1";
        $result = $conn->query($sql_get_1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $delivery_id = $row["delivery_id"] + 1;
            }
        } else {
            $delivery_id = 1;
        }
    

    }
    







    if (isset($_POST["payment_method"])) {
        $payment_method    = $_POST["payment_method"];
    }

    if (isset($_POST["no"])) {
        $no = $_POST["no"];
    }
    if (isset($_POST["street1"])) {
        $street1 = $_POST["street1"];
    }
    if (isset($_POST["street2"])) {
        $street2 = $_POST["street2"];
    }
    if (isset($_POST["city"])) {
        $city = $_POST["city"];
    }
    if (isset($_POST["description"])) {
        $description = $_POST["description"];
    }

    if (isset($_POST["pid_1"])) {
        $pid_1 = $_POST["pid_1"];
    }
    if (isset($_POST["qty_1"])) {
        $qty_1 = $_POST["qty_1"];
    } else {
        $qty_1 = "";
    }
    if (isset($_POST["price_1"])) {
        $price_1 = $_POST["price_1"];
    } else {
        $price_1 = "";
    }

    if (isset($_POST["pid_2"])) {
        $pid_2 = $_POST["pid_2"];
    }
    if (isset($_POST["qty_2"])) {
        $qty_2 = $_POST["qty_2"];
    } else {
        $qty_2 = "";
    }
    if (isset($_POST["price_2"])) {
        $price_2 = $_POST["price_2"];
    } else {
        $price_2 = "";
    }

    if (isset($_POST["pid_3"])) {
        $pid_3 = $_POST["pid_3"];
    }
    if (isset($_POST["qty_3"])) {
        $qty_3 = $_POST["qty_3"];
    } else {
        $qty_3 = "";
    }
    if (isset($_POST["price_3"])) {
        $price_3 = $_POST["price_3"];
    } else {
        $price_3 = "";
    }


    if (isset($_POST["pid_4"])) {
        $pid_4 = $_POST["pid_4"];
    }
    if (isset($_POST["qty_4"])) {
        $qty_4 = $_POST["qty_4"];
    } else {
        $qty_4 = "";
    }
    if (isset($_POST["price_4"])) {
        $price_4 = $_POST["price_4"];
    } else {
        $price_4 = "";
    }

    if (isset($_POST["pid_5"])) {
        $pid_5 = $_POST["pid_5"];
    }
    if (isset($_POST["qty_5"])) {
        $qty_5 = $_POST["qty_5"];
    } else {
        $qty_5 = "";
    }
    if (isset($_POST["price_5"])) {
        $price_5 = $_POST["price_5"];
    } else {
        $price_5 = "";
    }

    if (isset($_POST["pid_6"])) {
        $pid_6 = $_POST["pid_6"];
    }
    if (isset($_POST["qty_6"])) {
        $qty_6 = $_POST["qty_6"];
    } else {
        $qty_6 = "";
    }
    if (isset($_POST["price_6"])) {
        $price_6 = $_POST["price_6"];
    } else {
        $price_6 = "";
    }


    if (isset($_POST["pid_7"])) {
        $pid_7 = $_POST["pid_7"];
    }
    if (isset($_POST["qty_7"])) {
        $qty_7 = $_POST["qty_7"];
    } else {
        $qty_7 = "";
    }
    if (isset($_POST["price_7"])) {
        $price_7 = $_POST["price_7"];
    } else {
        $price_7 = "";
    }

    if (isset($_POST["pid_8"])) {
        $pid_8 = $_POST["pid_8"];
    }
    if (isset($_POST["qty_8"])) {
        $qty_8 = $_POST["qty_8"];
    } else {
        $qty_8 = "";
    }
    if (isset($_POST["price_8"])) {
        $price_8 = $_POST["price_8"];
    } else {
        $price_8 = "";
    }

    if (isset($_POST["pid_9"])) {
        $pid_9 = $_POST["pid_9"];
    }
    if (isset($_POST["qty_9"])) {
        $qty_9 = $_POST["qty_9"];
    } else {
        $qty_9 = "";
    }
    if (isset($_POST["price_9"])) {
        $price_9 = $_POST["price_9"];
    } else {
        $price_9 = "";
    }






    //total price
    //$total_price = ($price_1 * $qty_1) + ($price_2 * $qty_2) + ($price_3 * $qty_3) + ($price_4 * $qty_4) + ($price_5 * $qty_5) + ($price_6 * $qty_6) + ($price_7 * $qty_7) + ($price_8 * $qty_8) + ($price_9 * $qty_9);


    //get last id - order
    $sql_get = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_id = $row["order_id"] + 1;
        }
    } else {
        $order_id = 1;
    }





    //get last stock

    $sql_get = "SELECT availability FROM products WHERE product_id=1";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_1 = $row["availability"];
        }
    }



    $sql_get = "SELECT availability FROM products WHERE product_id=2";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_2 = $row["availability"];
        }
    }



    $sql_get = "SELECT availability FROM products WHERE product_id=3";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_3 = $row["availability"];
        }
    }





    $sql_get = "SELECT availability FROM products WHERE product_id=4";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_4 = $row["availability"];
        }
    }



    $sql_get = "SELECT availability FROM products WHERE product_id=5";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_5 = $row["availability"];
        }
    }



    $sql_get = "SELECT availability FROM products WHERE product_id=6";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_6 = $row["availability"];
        }
    }




    $sql_get = "SELECT availability FROM products WHERE product_id=7";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_7 = $row["availability"];
        }
    }



    $sql_get = "SELECT availability FROM products WHERE product_id=8";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_8 = $row["availability"];
        }
    }



    $sql_get = "SELECT availability FROM products WHERE product_id=9";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stock_9 = $row["availability"];
        }
    }



    if ($qty_1 != "") {
        $new_stock_1 = $stock_1 - $qty_1;
    } else {
        $new_stock_1 = $stock_1;
    }
    if ($qty_2 != "") {
        $new_stock_2 = $stock_2 - $qty_2;
    } else {
        $new_stock_2 = $stock_2;
    }
    if ($qty_3 != "") {
        $new_stock_3 = $stock_3 - $qty_3;
    } else {
        $new_stock_3 = $stock_3;
    }

    if ($qty_4 != "") {
        $new_stock_4 = $stock_4 - $qty_4;
    } else {
        $new_stock_4 = $stock_4;
    }
    if ($qty_5 != "") {
        $new_stock_5 = $stock_5 - $qty_5;
    } else {
        $new_stock_5 = $stock_5;
    }
    if ($qty_6 != "") {
        $new_stock_6 = $stock_6 - $qty_6;
    } else {
        $new_stock_6 = $stock_6;
    }

    if ($qty_7 != "") {
        $new_stock_7 = $stock_7 - $qty_7;
    } else {
        $new_stock_7 = $stock_7;
    }
    if ($qty_8 != "") {
        $new_stock_8 = $stock_8 - $qty_8;
    } else {
        $new_stock_8 = $stock_8;
    }
    if ($qty_9 != "") {
        $new_stock_9 = $stock_9 - $qty_9;
    } else {
        $new_stock_9 = $stock_9;
    }




    //insert delivery db
    if ($obtaining_method_id == 1) {
        $sql_11 = "INSERT INTO delivery (delivery_id, driver_id, no, street1, street2, city, description, date, time, delivery_charge, status, order_id) VALUES ('$delivery_id', '$driver', '$no', '$street1', '$street2', '$city', '$description', '$date', '$time', 100, 1, '$order_id')";
    }



    if ($qty_1 != "") {
        $sql_12 = "UPDATE products SET availability='$new_stock_1' WHERE product_id=1";
    }
    if ($qty_2 != "") {
        $sql_13 = "UPDATE products SET availability='$new_stock_2' WHERE product_id=2";
    }
    if ($qty_3 != "") {
        $sql_14 = "UPDATE products SET availability='$new_stock_3' WHERE product_id=3";
    }

    if ($qty_4 != "") {
        $sql_15 = "UPDATE products SET availability='$new_stock_4' WHERE product_id=4";
    }
    if ($qty_5 != "") {
        $sql_16 = "UPDATE products SET availability='$new_stock_5' WHERE product_id=5";
    }
    if ($qty_6 != "") {
        $sql_17 = "UPDATE products SET availability='$new_stock_6' WHERE product_id=6";
    }

    if ($qty_7 != "") {
        $sql_18 = "UPDATE products SET availability='$new_stock_7' WHERE product_id=7";
    }
    if ($qty_8 != "") {
        $sql_19 = "UPDATE products SET availability='$new_stock_8' WHERE product_id=8";
    }
    if ($qty_9 != "") {
        $sql_20 = "UPDATE products SET availability='$new_stock_9' WHERE product_id=9";
    }







    // db - orders insert section
    if (isset($pid_1) || isset($pid_2) || isset($pid_3) || isset($pid_4) || isset($pid_5) || isset($pid_6) || isset($pid_7) || isset($pid_8) || isset($pid_9)) {
        $sql_10 = "INSERT INTO orders (order_id, date, time, total_price, status, obtaining_method_id, customer_id, payment_type_id) VALUES ('$order_id', '$date', '$time', '$total_price', 1, '$obtaining_method_id', '$customer_id', '$payment_method')";
    }

    // db - order_has_products insert section
    if (isset($pid_1) && isset($sql_1)) {
        $sql_1 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_1', '$year', '$qty_1', '$price_1', 1)";
    }

    if (isset($pid_2) && isset($sql_2)) {
        $sql_2 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_2', '$year', '$qty_2', '$price_2', 1)";
    }

    if (isset($pid_3) && isset($sql_3)) {
        $sql_3 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_3', '$year', '$qty_3', '$price_3', 1)";
    }

    if (isset($pid_4) && isset($sql_4)) {
        $sql_4 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_4', '$year', '$qty_4', '$price_4', 1)";
    }

    if (isset($pid_5) && isset($sql_5)) {
        $sql_5 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_5', '$year', '$qty_5', '$price_5', 1)";
    }

    if (isset($pid_6) && isset($sql_6)) {
        $sql_6 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_6', '$year', '$qty_6', '$price_6', 1)";
    }

    if (isset($pid_7) && isset($sql_7)) {
        $sql_7 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_7', '$year', '$qty_7', '$price_7', 1)";
    }

    if (isset($pid_8) && isset($sql_8)) {
        $sql_8 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_8', '$year', '$qty_8', '$price_8', 1)";
    }

    if (isset($pid_9) && isset($sql_9)) {
        $sql_9 = "INSERT INTO order_has_products (order_id, product_id, year, quantity, price, status) 
    VALUES ('$order_id', '$pid_9', '$year', '$qty_9', '$price_9', 1)";
    }



    // db insert summery
    if ($conn->query($sql_10) === TRUE) {
        //echo "New record created successfully";
        $ok_10 = true;
    } else {
        //echo "Error: " . $sql_0 . "<br>" . $conn->error;
        $ok_10 = false;
    }

    if (isset($pid_1) && isset($sql_1)) {
        if ($conn->query($sql_1) === TRUE) {
            //echo "New record created successfully";
            $ok_1 = true;
        } else {
            //echo "Error: " . $sql_1 . "<br>" . $conn->error;
            $ok_1 = false;
        }
    } else {
        $ok_1 = true;
    }

    if (isset($pid_2) && isset($sql_2)) {
        if ($conn->query($sql_2) === TRUE) {
            //echo "New record created successfully";
            $ok_2 = true;
        } else {
            //echo "Error: " . $sql_2 . "<br>" . $conn->error;
            $ok_2 = false;
        }
    } else {
        $ok_2 = true;
    }

    if (isset($pid_3) && isset($sql_3)) {
        if ($conn->query($sql_3) === TRUE) {
            //echo "New record created successfully";
            $ok_3 = true;
        } else {
            //echo "Error: " . $sql_3 . "<br>" . $conn->error;
            $ok_3 = false;
        }
    } else {
        $ok_3 = true;
    }


    if (isset($pid_4) && isset($sql_4)) {
        if ($conn->query($sql_4) === TRUE) {
            //echo "New record created successfully";
            $ok_4 = true;
        } else {
            //echo "Error: " . $sql_4 . "<br>" . $conn->error;
            $ok_4 = false;
        }
    } else {
        $ok_4 = true;
    }


    if (isset($pid_5) && isset($sql_5)) {
        if ($conn->query($sql_5) === TRUE) {
            //echo "New record created successfully";
            $ok_5 = true;
        } else {
            //echo "Error: " . $sql_5 . "<br>" . $conn->error;
            $ok_5 = false;
        }
    } else {
        $ok_5 = true;
    }


    if (isset($pid_6) && isset($sql_6)) {
        if ($conn->query($sql_6) === TRUE) {
            //echo "New record created successfully";
            $ok_6 = true;
        } else {
            //echo "Error: " . $sql_6 . "<br>" . $conn->error;
            $ok_6 = false;
        }
    } else {
        $ok_6 = true;
    }


    if (isset($pid_7) && isset($sql_7)) {
        if ($conn->query($sql_7) === TRUE) {
            //echo "New record created successfully";
            $ok_7 = true;
        } else {
            //echo "Error: " . $sql_7 . "<br>" . $conn->error;
            $ok_7 = false;
        }
    } else {
        $ok_7 = true;
    }


    if (isset($pid_8) && isset($sql_8)) {
        if ($conn->query($sql_8) === TRUE) {
            //echo "New record created successfully";
            $ok_8 = true;
        } else {
            //echo "Error: " . $sql_8 . "<br>" . $conn->error;
            $ok_8 = false;
        }
    } else {
        $ok_8 = true;
    }


    if (isset($pid_9) && isset($sql_9)) {
        if ($conn->query($sql_9) === TRUE) {
            //echo "New record created successfully";
            $ok_9 = true;
        } else {
            //echo "Error: " . $sql_9 . "<br>" . $conn->error;
            $ok_9 = false;
        }
    } else {
        $ok_9 = true;
    }



    if ($obtaining_method_id == 1) {
        if ($conn->query($sql_11) === TRUE) {
            //echo "New record created successfully";
            $ok_11 = true;
        } else {
            //echo "Error: " . $sql_11 . "<br>" . $conn->error;
            $ok_11 = false;
        }
    } else {
        $ok_11 = true;
    }

    if (isset($sql_12)) {
        if ($conn->query($sql_12) === TRUE) {
            //echo "New record created successfully";
            $ok_12 = true;
        } else {
            //echo "Error: " . $sql_12 . "<br>" . $conn->error;
            $ok_12 = false;
        }
    } else {
        $ok_12 = true;
    }

    if (isset($sql_13)) {
        if ($conn->query($sql_13) === TRUE) {
            //echo "New record created successfully";
            $ok_13 = true;
        } else {
            //echo "Error: " . $sql_13 . "<br>" . $conn->error;
            $ok_13 = false;
        }
    } else {
        $ok_13 = true;
    }

    if (isset($sql_14)) {
        if ($conn->query($sql_14) === TRUE) {
            //echo "New record created successfully";
            $ok_14 = true;
        } else {
            //echo "Error: " . $sql_14 . "<br>" . $conn->error;
            $ok_14 = false;
        }
    } else {
        $ok_14 = true;
    }


    if (isset($sql_15)) {
        if ($conn->query($sql_15) === TRUE) {
            //echo "New record created successfully";
            $ok_15 = true;
        } else {
            //echo "Error: " . $sql_15 . "<br>" . $conn->error;
            $ok_15 = false;
        }
    } else {
        $ok_15 = true;
    }

    if (isset($sql_16)) {
        if ($conn->query($sql_16) === TRUE) {
            //echo "New record created successfully";
            $ok_16 = true;
        } else {
            //echo "Error: " . $sql_16 . "<br>" . $conn->error;
            $ok_16 = false;
        }
    } else {
        $ok_16 = true;
    }

    if (isset($sql_17)) {
        if ($conn->query($sql_17) === TRUE) {
            //echo "New record created successfully";
            $ok_17 = true;
        } else {
            //echo "Error: " . $sql_17 . "<br>" . $conn->error;
            $ok_17 = false;
        }
    } else {
        $ok_17 = true;
    }


    if (isset($sql_18)) {
        if ($conn->query($sql_18) === TRUE) {
            //echo "New record created successfully";
            $ok_18 = true;
        } else {
            //echo "Error: " . $sql_18 . "<br>" . $conn->error;
            $ok_18 = false;
        }
    } else {
        $ok_18 = true;
    }

    if (isset($sql_19)) {
        if ($conn->query($sql_19) === TRUE) {
            //echo "New record created successfully";
            $ok_19 = true;
        } else {
            //echo "Error: " . $sql_19 . "<br>" . $conn->error;
            $ok_19 = false;
        }
    } else {
        $ok_19 = true;
    }

    if (isset($sql_20)) {
        if ($conn->query($sql_20) === TRUE) {
            //echo "New record created successfully";
            $ok_20 = true;
        } else {
            //echo "Error: " . $sql_20 . "<br>" . $conn->error;
            $ok_20 = false;
        }
    } else {
        $ok_20 = true;
    }



    if ($ok_1 == true && $ok_2 == true && $ok_3 == true && $ok_4 == true && $ok_5 == true && $ok_6 == true && $ok_7 == true && $ok_8 == true && $ok_9 == true && $ok_10 == true && $ok_11 == true && $ok_12 == true && $ok_13 == true && $ok_14 == true && $ok_15 == true && $ok_16 == true && $ok_17 == true && $ok_18 == true && $ok_19 == true) {
        echo "<script>";
        echo "  alert('Purchase successful!');";
        echo "  window.location = '../Home2.php';";
        echo "</script>";
    }
    $conn->close();
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Loading...</title>
    </head>

    <body style="background-color: #fff; color: #fff; font-size: 0px;">
    </body>

    </html>

<?php
}

?>