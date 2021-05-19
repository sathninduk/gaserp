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
	include "../php/connection.php";
	$permission = $_SESSION["permission"];

	$today = date("Y-m-d");
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Stock</title>
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
						<a href="./" class="nav-item">
							<i class="fa fa-tachometer-alt"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<?php if ($permission == 1 || $permission == 3 || $permission == 4 || $permission == 5) { ?>
						<li>
							<a href="./customers.php" class="nav-item">
								<i class="fa fa-users"></i>
								<span>Customers</span>
							</a>
						</li>
					<?php } ?>

					<?php if ($permission == 1 || $permission == 3 || $permission == 4 || $permission == 5) { ?>
						<div class="dropdown">
							<li>
								<a class="nav-item">
									<i class="fa fa-list"></i>
									<span>Orders<i class="fa fa-caret-down"></i></span>
								</a>
							</li>
							<div class="dropdown-content">
								<a class="nav-item" href="./delivery.php">Delivery</a>
								<?php if ($permission != 5) { ?>
									<a class="nav-item" href="./pickup.php">Pickup</a>
								<?php } ?>
							</div>
						</div>
					<?php } ?>

					<?php if ($permission == 1 || $permission == 5) { ?>
						<li>
							<a class="nav-item" href="./drivers.php">
								<i class="fa fa-truck"></i>
								<span>Drivers</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($permission == 1 || $permission == 2 || $permission == 4) { ?>
						<li>
							<a class="nav-item" href="./suppliers.php">
								<i class="fa fa-link"></i>
								<span>Suppliers</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($permission == 1 || $permission == 2 || $permission == 4) { ?>
						<li>
							<a class="nav-item" href="./supplier-orders.php">
								<i class="fa fa-parachute-box"></i>
								<span>Supply Orders</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($permission == 1 || $permission == 2 || $permission == 4 || $permission == 5) { ?>
						<li>
							<a class="nav-select" href="./stock.php">
								<i class="fa fa-cubes"></i>
								<span>Stock</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($permission == 1 || $permission == 3 || $permission == 4) { ?>
						<li>
							<a class="nav-item" href="./sales.php">
								<i class="fa fa-bar-chart"></i>
								<span>Sales</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($permission == 1) { ?>
						<li>
							<a class="nav-item" href="./feedback.php">
								<i class="fa fa-comment"></i>
								<span>Feedback</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($permission == 1) { ?>
						<div class="dropdown">
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
						</div>
					<?php } ?>

				</ul>
			</div>
		</div>
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
				<h1>Stock<a onclick="window.print();" class="print">Print</a></h1>
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
				$sql = "SELECT * FROM products";
				//$sql = "SELECT * FROM orders INNER JOIN customer ON orders.customer_id=customer.customer_id";

				//$sql = "SELECT * FROM ((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN payment_type ON orders.payment_type_id = payment_type.payment_type_id) WHERE orders.obtaining_method_id=1";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					echo "
						<table class=\"tbl\">
									<thead>
										<th style=\"max-width: 40px;\">Product ID</th>
										<th style=\"max-width: 120px;\">Name</th>
										<th style=\"max-width: 200px;\">Type</th>
										<th style=\"max-width: 40px;\">Unit Price</th>
										<th style=\"max-width: 80px;\">Stock</th>
										<!--<th style=\"max-width: 200px;\">Action</th>-->
									</thead>
									<tbody>";
					// output data of each row
					while ($row = $result->fetch_assoc()) {
						echo "<tr>
									<td style=\"text-align: center;\">" . $row["product_id"] . "</td>
									<td>" . $row["name"] . "</td>
									<td style=\"text-transform: capitalize;\">" . $row["type"] . "</td>
									<td>" . $row["price"] . ".00</td>
									<td>" . $row["availability"] . "</td>

									<!--<td><a href=\"#\" class=\"delete\">Disable</a></td>-->
								</tr>";
					}
					echo "</tbody>
						</table>";
				} else {
					echo "0 results";
				}

				?>

				<div class="print-name">
					<br><br>
					<span class="report-foot">Checked by:</span>
					<br>
					<span class="report-foot">Approved by:</span>
					<br>
					<span class="report-foot">Date: <?php echo $today; ?></span>
				</div>


			</div>
			<form action="./php/stock_update.php" method="post" style="margin-top: 50px;">
				<div class="details">
					<h2 class="page-title">Add New Stock</h2>
					<label>Product<select class="driver_in" type="number" required name="product_id">
							<option value="">Select Product</option>
							<option value="1">1 - 12.5 Kg Cylinders (Refill)</option>
							<option value="2">2 - 5.0 Kg Cylinders (Refill)</option>
							<option value="3">3 - 2.3 Kg Cylinders (Refill)</option>

							<option value="4">4 - 12.5 Kg Cylinders (New)</option>
							<option value="5">5 - 5.0 Kg Cylinders (New)</option>
							<option value="6">6 - 2.3 Kg Cylinders (New)</option>

							<option value="7">7 - Regulator</option>
							<option value="8">8 - Hose</option>
							<option value="9">9 - Accessory Pack</option>
						</select></label>
					<label>New Stock<input class="driver_in" type="number" name="availability" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
					</label>

					<button class="print-btn" type="submit">Add</button>

			</form>

			<form action="./php/unitprice_update.php" method="post" style="margin-top: 50px;">
				<div class="details">
					<h2 class="page-title">Update Unit Price</h2>
					<label>Product<select class="driver_in" type="number" required name="product_id">
							<option value="">Select Product</option>
							<option value="1">1 - 12.5 Kg Cylinders (Refill)</option>
							<option value="2">2 - 5.0 Kg Cylinders (Refill)</option>
							<option value="3">3 - 2.3 Kg Cylinders (Refill)</option>

							<option value="4">4 - 12.5 Kg Cylinders (New)</option>
							<option value="5">5 - 5.0 Kg Cylinders (New)</option>
							<option value="6">6 - 2.3 Kg Cylinders (New)</option>

							<option value="7">7 - Regulator</option>
							<option value="8">8 - Hose</option>
							<option value="9">9 - Accessory Pack</option>
						</select></label>
					<label>New Price<input class="driver_in" type="number" name="unit_price" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
					</label>

					<button class="print-btn" type="submit">Update</button>

			</form>
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