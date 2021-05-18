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
		<title>Driver Payments - History</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
		<link rel="stylesheet" href="../style/Admin.css">
	</head>

	<body>
		<div class="sidenav">
			<div class="sidenav-header">
				<h3 class="brand">
					<i class="fa fa-unlink"></i>
					<span>Admin</span>
				</h3>
				<!--<span class="fa fa-bars"></span>-->
			</div>
			<div class="sidenav-menu">
				<ul>
					<li>
						<a class="nav-item" href="./drivers_dashboard.php">
							<i class="fa fa-truck"></i>
							<span>Deliveries</span>
						</a>
					</li>
					<li>
						<a class="nav-select" href="./driver_dashboard_history.php">
							<i class="fa fa-money-bill"></i>
							<span>Payments</span>
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

		<?php
		$sql = "SELECT debit_balance, amount FROM driver_payments WHERE driver_id = '$driver_id' LIMIT 1";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				$debit_balance = $row["debit_balance"];
				$salary = $row["amount"];
			}
		} else {
			echo "0 results";
		}
		?>

		<div class="admin-content">
			<div class="content">
				<div class="ltr-head print-name">
					<img class="con-mid" style="float: left; text-align: left;" src="../images/ltr-logo.jpg">
					<h1>SETHMITH ENTERPRISES</h1>
					<br>
					<h4>No 283, Sri Sudarshanarama rd, Kiribathgoda</h4>
					<h4>0112915527/0717627641</h4>
					<h4><?php echo $today . " &nbsp;&nbsp;&nbsp;" . $time ?></h4>
				</div>
				<h1>Summery</h1>
				<br>
				<p style="width: 350px;"><span><b>Current Debit Balance: </b></span><span style="float: right;">LKR <?php echo $debit_balance; ?>.00</span></p>
				<p style="width: 350px;"><b>Current Salary: </b><span style="float: right;">LKR <?php echo $salary; ?>.00</span></p>
				<br>
				<hr style="width: 65vw;"><br>
				<h1>Payments - History<a onclick="window.print();" class="print">Print</a></h1>

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

				$sql = "SELECT * FROM (driver_payments_history INNER JOIN driver ON driver.driver_id = driver_payments_history.driver_id) WHERE driver_payments_history.driver_id = '$driver_id' ORDER BY driver_payments_history.id";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					echo "
						<table class=\"tbl\">
									<thead>
										
										<th style=\"max-width: 120px;\">Date</th>
										<th style=\"max-width: 80px;\">Driver ID</th>
										<th style=\"max-width: 200px;\">Driver</th>
										<th style=\"max-width: 40px;\">Total Amount (LKR)</th>
										<th style=\"max-width: 80px;\">Payment Type</th>
										
										

									</thead>
									<tbody>";
					// output data of each row
					while ($row = $result->fetch_assoc()) {

						// payment - credit

						if ($row["type"] == "Credit") {
							$payment_type = "Debit Balance";
						} else {
							$payment_type = "Salary";
						}


						echo "<tr>
								
									<td>" . $row["date"] . "</td>
									<td>" . $row["driver_id"] . "</td>
									<td style=\"text-transform: capitalize;\">" . $row["fname"] . " " . $row["lname"] . "</td>
									<td>" . $row["payment"] . ".00</td>
									<td>" . $payment_type . "</td>
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
					<a class="ad-top-btn" href="./"><span class="fa fa-user">
							<font style="font-weight: 400; font-family: 'Poppins', sans-serif;"> Admin</font>
						</span></a>
					<a class="ad-top-btn" href="./php/logout.php"><span class="fa fa-sign-out-alt">
							<font style="font-weight: 400; font-family: 'Poppins', sans-serif;"> Logout</font>
						</span></a>
					<div></div>
				</div>
			</header>
		</div>
	</body>

	</html>
<?php
}
?>