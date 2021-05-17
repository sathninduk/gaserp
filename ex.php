<?php
include "./php/connection.php";

date_default_timezone_set('Asia/Colombo');
$time = date("H:i:s");
//echo $time . "<br>";






//get row count - drivers
$sql_get_101 = "SELECT * FROM driver WHERE status = 1 AND start < '$time' AND end > '$time' AND status = 1"; // WHERE START AND END
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
    echo "Delivery Unavailable!";
    $delivery_available = FALSE;
}




//get last id - driver
$sql_get_1 = "SELECT driver_id FROM delivery WHERE driver_id IN (";
/*
foreach ($driverArray as $value) {
    if ($value == $driverArray[$driver_rowcount - 1]) {
        $sql_get_3_helper = $value;
    } else {
        $sql_get_3_helper = $value . ", ";
    }


    
    $sql_get_3 = $sql_get_3_helper;

}


echo $sql_get_3;*/

$sql_get_2 = ") ORDER BY delivery_id DESC LIMIT 1";


foreach ($driverArray as $value) {
    if ($value == $driverArray[$driver_rowcount - 1]) {
        $sql_get_3_helper .= $value;
    } else {
        $sql_get_3_helper = $value . ", ";
    }
   
}


 $sql_last = $sql_get_1.$sql_get_3_helper.$sql_get_2;
    echo $sql_last;


//$sql_get_1 = "SELECT driver_id FROM delivery WHERE driver_id IN (2,3) ORDER BY delivery_id DESC LIMIT 1";


$result = $conn->query($sql_last);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //echo $row["driver_id"];
        $last_driver = $row["driver_id"];
    }
} else {
    //echo "Error";
}

//echo count($driverArray);


// new driver assign
$driver_position = array_search($last_driver, $driverArray);
if (empty($driverArray[$driver_position + 1])) {
    $next_driver = $driverArray[0];
} else {
    $next_driver = $driverArray[$driver_position + 1];
}

$driver_id = $next_driver;

//echo $last_driver;
//echo $next_driver;

