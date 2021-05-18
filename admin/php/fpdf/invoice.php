<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
  // Logged out
  $log = false;
  echo "<script>";
  echo "  alert('Please login first!');";
  echo "  window.location = '../../../';";
  echo "</script>";
  exit;
} else {
  require "./fpdf.php";

  include "../../../php/connection.php";

  $order_id = htmlentities($_GET["order_id"]);

  $sql = "SELECT * FROM (orders INNER JOIN customer ON orders.customer_id = customer.customer_id) WHERE order_id = '$order_id';";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $date = $row["date"];
      $total_price = $row["total_price"];
      $status = $row["status"];
      $obtaining_method_id = $row["obtaining_method_id"];
      $customer_id = $row["customer_id"];

      $fname = $row["fname"];
      $fname = strtoupper($fname);

      $lname = $row["lname"];
      $lname = strtoupper($lname);

      $contact_no = $row["contact_no"];
      $nic = $row["nic"];

      $no = $row["no"];
      $no = ucfirst($no);

      $street = $row["street"];
      $street = ucfirst($street);

      $city = $row["city"];
      $city = ucfirst($city);
    }
  } else {
    echo "<script>";
    echo "  alert('Incorrect Order!');";
    echo "  window.location = '../../../';";
    echo "</script>";
  }

  if ($obtaining_method_id == 1) {
    $shipping = 100;
    $sql = "SELECT * FROM delivery WHERE order_id='$order_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $delivery_no = $row["no"];
        $delivery_street1 = $row["street1"];
        $delivery_street2 = $row["street2"];
        $delivery_city = $row["city"];
      }
    }

    if ($delivery_street2 == "") {
      $delivery_street = $delivery_street1;
    } else {
      $delivery_street = $delivery_street1 . ", " . $delivery_street2;
    }
    $delivery_address = $delivery_no . ", " . $delivery_street . ", " . $delivery_city;
  } elseif ($obtaining_method_id == 2) {
    $shipping = 0;
    $delivery_address = "N/A (PICKUP)";
  }



  $pdf = new FPDF();
  $pdf->AddPage();

  $pdf->SetFont('Arial', 'B', 24);
  $pdf->Cell(60, 10, 'SETHMITH ENTERPRISES', 0, 1, 'L');

  $pdf->SetFont('Arial', '', 12);
  
  $pdf->Cell(60, 6, 'No 283, Sri Sudarshanarama rd, Kiribathgoda', 0, 1, 'L');


  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(60, 6, '0112915527 / 0717627641', 0, 0, 'L');
  $pdf->Cell(67, 6, '', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(40, 6, 'Invoice Number: ', 0, 0, 'L');
  $pdf->Cell(30, 6, $order_id . '     ', 0, 1, 'R');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(60, 6, 'sethmithenterprise@gmail.com', 0, 0, 'L');
  $pdf->Cell(67, 6, '', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(40, 6, 'Invoice Date: ', 0, 0, 'L');
  $pdf->Cell(30, 6, $date . '     ', 0, 1, 'R');

  $pdf->Ln(5);
  $pdf->Cell(190, 0.1, '', 1, 1, 'C');
  $pdf->Ln(5);


  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(95, 10, 'Billing Information', 0, 0, 'L');
  $pdf->Cell(95, 10, 'Shipping Information', 0, 1, 'L');

  $pdf->Ln(5);

  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(95, 10, 'Name', 0, 0, 'L');
  $pdf->Cell(95, 10, 'Delivery Address', 0, 1, 'L');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(95, 3, $fname . ' ' . $lname, 0, 0, 'L');
  $pdf->Cell(95, 3, $delivery_address, 0, 1, 'L');

  $pdf->Ln(3);

  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(95, 10, 'Address', 0, 0, 'L');
  $pdf->Cell(95, 10, '', 0, 1, 'L');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(95, 3, $no . ', ' . $street . ', ' . $city, 0, 0, 'L');
  $pdf->Cell(95, 3, '', 0, 1, 'L');

  $pdf->Ln(3);

  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(95, 10, 'Contact Number', 0, 0, 'L');
  $pdf->Cell(95, 10, '', 0, 1, 'L');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(95, 3, $contact_no, 0, 0, 'L');
  $pdf->Cell(95, 3, '', 0, 1, 'L');

  $pdf->Ln(3);

  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(95, 10, 'NIC', 0, 0, 'L');
  $pdf->Cell(95, 10, '', 0, 1, 'L');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(95, 3, $nic, 0, 0, 'L');
  $pdf->Cell(95, 3, '', 0, 1, 'L');

  $pdf->Ln(10);
  $pdf->Cell(190, 0.1, '', 1, 1, 'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(190, 10, 'Products', 0, 1, 'L');
  $pdf->Ln(5);

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetFillColor(74, 74, 74);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(100, 10, '  Description', 1, 0, 'L', TRUE);
  $pdf->Cell(30, 10, 'Unit Price (Rs)', 1, 0, 'C', TRUE);
  $pdf->Cell(30, 10, 'Qty.', 1, 0, 'C', TRUE);
  $pdf->Cell(30, 10, 'Amount (Rs)', 1, 1, 'C', TRUE);

  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', '', 10);

  $sql = "SELECT *
FROM order_has_products
INNER JOIN products ON order_has_products.product_id = products.product_id WHERE order_id='$order_id'";

  $result = $conn->query($sql);
  $num_products = $result->num_rows;

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $pdf->Cell(100, 7, " " . $row["name"], 1, 0, 'L');
      $pdf->Cell(30, 7, $row["price"] . ".00", 1, 0, 'C');
      $pdf->Cell(30, 7, $row["quantity"], 1, 0, 'C');
      $pdf->Cell(30, 7, ($row["price"] * $row["quantity"]) . ".00", 1, 1, 'R');
    }
  }

  $blank_row = 9 - $num_products;

  for ($i = 0; $i <= ($blank_row - 1); $i++) {
    $pdf->Cell(100, 7, '', 1, 0, 'L');
    $pdf->Cell(30, 7, '', 1, 0, 'C');
    $pdf->Cell(30, 7, '', 1, 0, 'C');
    $pdf->Cell(30, 7, '-   ', 1, 1, 'R');
  }

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(160, 7, 'Subtotal', 1, 0, 'L');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(30, 7, $total_price . ".00", 1, 1, 'R');

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(160, 7, 'Shipping', 1, 0, 'L');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(30, 7, $shipping . '.00', 1, 1, 'R');

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(160, 7, 'Total', 1, 0, 'L');
  $pdf->Cell(30, 7, ($total_price + $shipping) . ".00", 1, 1, 'R');

  $pdf->SetFont('Arial', '', 10);

  $pdf->Ln(11);

  $pdf->Cell(190, 0.1, '', 1, 1, 'C');
  $pdf->Ln(3);
  $pdf->SetFont('Arial', 'I', 6);
  $pdf->Cell(190, 3, '*This is a system generated invoice', 0, 1, 'L');
  /*$pdf->SetFont('Arial', 'B', 7);
  $pdf->Cell(190, 3, 'SETHMITH ENTERPRICE', 0, 1, 'C');
  $pdf->SetFont('Arial', '', 7);
  $pdf->Cell(190, 3, 'TEL: 071 123 4567 | WEB: WWW.SETHMITH.LK', 0, 1, 'C');*/
  //$pdf->Ln(5);


  $pdf->Output();
}