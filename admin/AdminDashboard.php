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

	$admin_user = $_SESSION["admin_user"];

	if ($admin_user == "admin") {
		$permission = 1;
	} elseif ($admin_user == "stock") {
		$permission = 2;
	} elseif ($admin_user == "sales") {
		$permission = 3;
	} elseif ($admin_user == "accounts") {
		$permission = 4;
	} elseif ($admin_user == "delivery") {
		$permission = 5;
	}

	$_SESSION["permission"] = $permission;

	$today = date("Y-m-d");
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
		<link rel="stylesheet" href="../style/Admin.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
		<!-- CSS only -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap-grid.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
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
						<a href="./" class="nav-select">
							<i class="fa fa-tachometer-alt"></i>
							<span>Dashboard</span>
						</a>
					</li>
<?php if ($permission == 1 || $permission == 3 || $permission == 4 || $permission == 5) {?>
					<li>
						<a href="./customers.php" class="nav-item">
							<i class="fa fa-users"></i>
							<span>Customers</span>
						</a>
					</li>
<?php } ?>

<?php if ($permission == 1 || $permission == 3 || $permission == 4 || $permission == 5) {?>
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

<?php if ($permission == 1 || $permission == 5) {?>
					<li>
						<a class="nav-item" href="./drivers.php">
							<i class="fa fa-truck"></i>
							<span>Drivers</span>
						</a>
					</li>
<?php } ?>
<?php if ($permission == 1 || $permission == 2 || $permission == 4) {?>
<li>
						<a class="nav-item" href="./suppliers.php">
							<i class="fa fa-link"></i>
							<span>Suppliers</span>
						</a>
					</li>
<?php } ?>
<?php if ($permission == 1 || $permission == 2 || $permission == 4) {?>
					<li>
						<a class="nav-item" href="./supplier-orders.php">
							<i class="fa fa-parachute-box"></i>
							<span>Supply Orders</span>
						</a>
					</li>
<?php } ?>
<?php if ($permission == 1 || $permission == 2 || $permission == 4 || $permission == 5) {?>
					<li>
						<a class="nav-item" href="./stock.php">
							<i class="fa fa-cubes"></i>
							<span>Stock</span>
						</a>
					</li>
<?php } ?>
<?php if ($permission == 1 || $permission == 3 || $permission == 4) {?>
					<li>
						<a class="nav-item" href="./sales.php">
							<i class="fa fa-bar-chart"></i>
							<span>Sales</span>
						</a>
					</li>
<?php } ?>
<?php if ($permission == 1) {?>
					<li>
						<a class="nav-item" href="./feedback.php">
							<i class="fa fa-comment"></i>
							<span>Feedback</span>
						</a>
					</li>
<?php } ?>
<?php if ($permission == 1) {?>
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

			<?php
			$sql = "SELECT * FROM customer WHERE status=1";
			$result = $conn->query($sql);
			$customer_count = $result->num_rows;

			$sql = "SELECT * FROM orders WHERE obtaining_method_id=1 AND status=1";
			$result = $conn->query($sql);
			$delivery_count = $result->num_rows;

			$sql = "SELECT * FROM orders WHERE obtaining_method_id=2 AND status=1";
			$result = $conn->query($sql);
			$pick_count = $result->num_rows;

			$driver_balance = 0;

			$sql = "SELECT * FROM driver_payments WHERE status=1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$driver_balance += $row['amount'];
				}
			} else {
				$driver_balance = 0;
			}
			?>


			<div class="container">
				<div class="row">
					<div class="col-sm">
						<div class="dash_items no-print">Customers<span class="dash-mini"><?php if ($customer_count != 0) {
																						echo $customer_count;
																					}
																					if ($customer_count == 1) {
																						echo " customer";
																					} elseif ($customer_count == 0) {
																						echo "No customers";
																					} else {
																						echo " customers";
																					} ?></span>
						</div>
					</div>
					<div class="col-sm">
						<div class="dash_items no-print">Pending Delivery Orders<span class="dash-mini"><?php if ($delivery_count != 0) {
																									echo $delivery_count;
																								}
																								if ($delivery_count == 1) {
																									echo " order";
																								} elseif ($delivery_count == 0) {
																									echo "No orders";
																								} else {
																									echo " orders";
																								} ?></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="dash_items no-print">Pending Pickup Orders<span class="dash-mini"><?php if ($pick_count != 0) {
																									echo $pick_count;
																								}
																								if ($pick_count == 1) {
																									echo " order";
																								} elseif ($pick_count == 0) {
																									echo "No orders";
																								} else {
																									echo " orders";
																								} ?></span></div>
					</div>
					<div class="col-sm">
						<div class="dash_items no-print">Drivers' Total Salary<span class="dash-mini">LKR <?php echo $driver_balance; ?>.00</span></div>
					</div>
				</div>
				<?php
				$sql = "SELECT * FROM products WHERE product_id=1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock1 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=2";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock2 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=3";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock3 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=4";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock4 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=5";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock5 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=6";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock6 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=7";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock7 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=8";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock8 = $row["availability"];
					}
				}
				$sql = "SELECT * FROM products WHERE product_id=9";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$stock9 = $row["availability"];
					}
				}
				?>
				<div class="row">
					<div class="col-sm yes-print">
						<div class="dash_items" style="width: 665px; height: 100%;">
						
							<p style="font-weight: 500; display: inline;"><span class="print-name">Sethmith Enterprise</span>Stock</p>

							<a onclick="window.print();" style="display: inline; float: right;" class="print no-print">Print</a>
							<canvas id="stock" width="400" height="200"></canvas>
						</div>
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
							<a class="ad-top-btn" href="./"><span class="fa fa-user"><font style="font-weight: 400; font-family: 'Poppins', sans-serif;"> Admin</font></span></a>
							<a class="ad-top-btn" href="./php/logout.php"><span class="fa fa-sign-out-alt"><font style="font-weight: 400; font-family: 'Poppins', sans-serif;"> Logout</font></span></a>
							<div></div>
						</div>
					</header>
				</div>
				<script>
					var ctx = document.getElementById('stock');
					var stock = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['12.5 Kg Cylinders (Refill)', '5.0 Kg Cylinders (Refill)', '2.3 Kg Cylinders (Refill)', '12.5 Kg Cylinders (New)', '5.0 Kg Cylinders (New)', '2.3 Kg Cylinders (New)', 'Regulator', 'Hose', 'Accessory Pack'],
							datasets: [{
								label: 'Stock',
								data: [<?php echo $stock1 . ", " . $stock2 . ", " . $stock3 . ", " . $stock4 . ", " . $stock5 . ", " . $stock6 . ", " . $stock7 . ", " . $stock8 . ", " . $stock9; ?>],
								backgroundColor: [
									'rgba(255, 99, 132, 0.2)',
									'rgba(54, 162, 235, 0.2)',
									'rgba(255, 206, 86, 0.2)',
									'rgba(75, 192, 192, 0.2)',
									'rgba(153, 102, 255, 0.2)',
									'rgba(255, 159, 64, 0.2)',

									'rgba(128, 128, 128, 0.2)',
									'rgba(255, 0, 127, 0.2)',
									'rgba(255, 69, 0, 0.2)'
								],
								borderColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
									'rgba(128, 128, 128, 1)',
									'rgba(255, 0, 127, 1)',
									'rgba(255, 69, 0, 1)'
								],
								borderWidth: 1
							}],
						},
						options: {
							legend: {
								labels: {
									display: false
								}
							},
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				</script>
	</body>

	</html>
<?php
}
?>