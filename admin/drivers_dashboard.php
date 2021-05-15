<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["driver_loggedin"]) || $_SESSION["driver_loggedin"] !== true) {
	// Logged out
	$log = false;
	header("location: ./");
	exit;
} else {
	//Logged in
	$log = true;
	include "../php/connection.php";
	$driver_id = $_SESSION["driver_id"];

	$today = date("Y-m-d");
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Delivery</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
		<link rel="stylesheet" href="../style/Admin.css">
	</head>

	<body>
		<div class="sidenav">
			<div class="sidenav-header">
				<h3 class="brand">
					<i class="fa fa-unlink"></i>
					<span>Driver</span>
				</h3>
				<!--<span class="fa fa-bars"></span>-->
			</div>
			<div class="sidenav-menu">
				<ul>
					<li>
						<a class="nav-select" href="./drivers_dashboard.php">
							<i class="fa fa-truck"></i>
							<span>Deliveries</span>
						</a>
					</li>
					<!--<div class="dropdown">
						<li>
							<a class="nav-item">
								<i class="fa fa-user-circle"></i>
								<span>Account<i class="fa fa-caret-down"></i></span>
							</a>
						</li>
						<div class="dropdown-content">
							<a class="nav-item" href="./change-pw.php">Change Password</a>
							<a class="nav-item" href="./php/logout.php">Logout</a>
						</div>
					</div>-->
				</ul>
			</div>
		</div>
		<div class="admin-content">
				<div class="content">
				<h1>Deliveries<a onclick="window.print();" class="print">Print</a></h1>
				<span class="print-name">Sethmith Enterprise</span>
				<br>
					<style>
						.tbl {
							font-size: 14px;
							margin-left: 0px;
							width: 65vw;
							margin-top: 0px;
						}
					</style>
					<?php
					
					// Order Data Fetch
					//$sql = "SELECT * FROM orders WHERE obtaining_method_id=1";
					//$sql = "SELECT * FROM orders INNER JOIN customer ON orders.customer_id=customer.customer_id";

					$sql = "SELECT * FROM (((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN payment_type ON orders.payment_type_id = payment_type.payment_type_id) INNER JOIN delivery ON delivery.order_id = orders.order_id) WHERE orders.obtaining_method_id=1 AND orders.status=1 AND delivery.driver_id='$driver_id' ORDER BY orders.order_id";

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						echo "
						<table class=\"tbl\">
									<thead>
										<th style=\"max-width: 40px;\">Order</th>
										<th style=\"max-width: 120px;\">Date</th>
										<th style=\"max-width: 200px;\">Customer Name</th>
										<th style=\"max-width: 40px;\">Total Amount (LKR)</th>
										<th style=\"max-width: 80px;\">Payment Type</th>
										<!--<th style=\"max-width: 80px;\">Driver ID</th>-->
										<th style=\"max-width: 80px;\">Invoice</th>
										<th style=\"max-width: 200px;\" colspan=\"3\">Action</th>
									</thead>
									<tbody>";
						// output data of each row
						while ($row = $result->fetch_assoc()) {

							

							echo "<tr>
									<td style=\"text-align: center;\">" . $row["order_id"] . "</td>
									<td>" . $row["date"] . "</td>
									<td style=\"text-transform: capitalize;\">" . $row["fname"] . " " . $row["lname"] . "</td>
									<td>" . $row["total_price"] . ".00</td>
									<td>" . $row["type_name"] . "</td>
									<!--<td>" . $row["driver_id"] . "</td>-->
									<td><a target=\"_blank\" href=\"./php/fpdf/invoice_driver.php?order_id=" . $row["order_id"] . "\">Show</a></td>
									<td><a href=\"./php/delivery_charge_driver.php?driver_id=".$row["driver_id"]."&order_id=".$row["order_id"]."\" class=\"edit\">Delivered</a></td>
								</tr>";
						}
						echo "</tbody>
						</table>";
					} else {
						echo "0 results";
					}

					?>


				</div>


		</div>

		<div class="main-content">
			<header class="header">
				<div class="search-bar">
				<span><b>Sethmith Enterprise</b></span>
				</div>
				<div class="social-icons">
					<style>
						.ad-top-btn {
							color: rgba(0, 0, 0, 1);
							font-size: .9rem;
						}

						.ad-top-btn:hover {
							color: rgba(0, 0, 0, .6);
						}
					</style>
					<a class="ad-top-btn" href="./drivers_dashboard.php"><span class="fa fa-user"><b> <?php echo $_SESSION["email"]; ?></b></span></a>
					<a class="ad-top-btn" href="./php/logout.php"><span class="fa fa-sign-out-alt"><font style="font-weight: 400; font-family: 'Poppins', sans-serif;"> Logout</font></span></a>
					<div></div>
				</div>
			</header>
		</div>
	</body>

	</html>
<?php
}
?>