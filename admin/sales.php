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

	$year = date("Y");

	$tot_quantity_1 = $tot_1_quantity_1 = $tot_2_quantity_1 = $tot_3_quantity_1 = 0;
	$tot_quantity_2 = $tot_1_quantity_2 = $tot_2_quantity_2 = $tot_3_quantity_2 = 0;
	$tot_quantity_3 = $tot_1_quantity_3 = $tot_2_quantity_3 = $tot_3_quantity_3 = 0;

	$tot_quantity_4 = $tot_1_quantity_4 = $tot_2_quantity_4 = $tot_3_quantity_4 = 0;
	$tot_quantity_5 = $tot_1_quantity_5 = $tot_2_quantity_5 = $tot_3_quantity_5 = 0;
	$tot_quantity_6 = $tot_1_quantity_6 = $tot_2_quantity_6 = $tot_3_quantity_6 = 0;

	$tot_quantity_7 = $tot_1_quantity_7 = $tot_2_quantity_7 = $tot_3_quantity_7 = 0;
	$tot_quantity_8 = $tot_1_quantity_8 = $tot_2_quantity_8 = $tot_3_quantity_8 = 0;
	$tot_quantity_9 = $tot_1_quantity_9 = $tot_2_quantity_9 = $tot_3_quantity_9 = 0;

	// Product Quantities - This year
	$sql = "SELECT * FROM order_has_products WHERE product_id=1 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {

			if ($row["year"] == $year) {
				$tot_quantity_1 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_1 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_1 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_1 += $row['quantity'];
			}
		}
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=2 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_2 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_2 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_2 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_2 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_2 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=3 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_3 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_3 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_3 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_3 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_3 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=4 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_4 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_4 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_4 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_4 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_4 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=5 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_5 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_5 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_5 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_5 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_5 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=6 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_6 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_6 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_6 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_6 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_6 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=7 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_7 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_7 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_7 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_7 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_7 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=8 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_8 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_8 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_8 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_8 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_8 = 0;
	}

	$sql = "SELECT * FROM order_has_products WHERE product_id=9 AND status=0";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($row["year"] == $year) {
				$tot_quantity_9 += $row['quantity'];
			} elseif ($row["year"] == ($year - 1)) {
				$tot_1_quantity_9 += $row['quantity'];
			} elseif ($row["year"] == ($year - 2)) {
				$tot_2_quantity_9 += $row['quantity'];
			} elseif ($row["year"] == ($year - 3)) {
				$tot_3_quantity_9 += $row['quantity'];
			}
		}
	} else {
		$tot_quantity_9 = 0;
	}

	$total_sales = $tot_quantity_1 + $tot_quantity_2 + $tot_quantity_3 + $tot_quantity_4 + $tot_quantity_5 + $tot_quantity_6 + $tot_quantity_7 + $tot_quantity_8 + $tot_quantity_9

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Sales Report</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
		<link rel="stylesheet" href="../style/Admin.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
		<!-- CSS only -->
		<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">-->

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
						<a class="nav-select" href="./sales.php">
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
			<div class="content">

				<h2>Sales details of the year <?php echo $year; ?><a onclick="window.print();" class="print">Print</a></h2>
				<span class="print-name">Sethmith Enterprise</span>
				<br>
				<canvas id="sales" width="400" height="200"></canvas>
				<script>
					var ctx = document.getElementById('sales');
					var sales = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['12.5 Kg Cylinders', '5.0 Kg Cylinders', '2.3 Kg Cylinders', 'Regulator', 'Hose', 'Accessory Pack'],
							datasets: [{
									label: 'New',
									data: [<?php echo $tot_quantity_4 . ", " . $tot_quantity_5 . ", " . $tot_quantity_6 . ", " . $tot_quantity_7 . ", " . $tot_quantity_8 . ", " . $tot_quantity_9; ?>],
									backgroundColor: [
										'rgba(54, 162, 235, 0.2)',
										'rgba(54, 162, 235, 0.2)',
										'rgba(54, 162, 235, 0.2)',
										'rgba(75, 192, 192, 0.2)',
										'rgba(153, 102, 255, 0.2)',
										'rgba(255, 159, 64, 0.2)'
									],
									borderColor: [
										'rgba(54, 162, 235, 1)',
										'rgba(54, 162, 235, 1)',
										'rgba(54, 162, 235, 1)',
										'rgba(75, 192, 192, 1)',
										'rgba(153, 102, 255, 1)',
										'rgba(255, 159, 64, 1)'
									],
									borderWidth: 1
								},
								{
									label: 'Refill',
									data: [<?php echo $tot_quantity_1 . ", " . $tot_quantity_2 . ", " . $tot_quantity_3; ?>],
									backgroundColor: [
										'rgba(255, 99, 132, 0.2)',
										'rgba(255, 99, 132, 0.2)',
										'rgba(255, 99, 132, 0.2)'
									],
									borderColor: [
										'rgba(255, 99, 132, 1)',
										'rgba(255, 99, 132, 1)',
										'rgba(255, 99, 132, 1)'
									],
									borderWidth: 1
								}
							]
						},
						options: {
							responsive: true,
							scales: {
								x: {
									stacked: true,
								},
								y: {
									stacked: true
								}
							}
						}
					});
				</script>


				<br><br>
				<hr><br><br>
				<h2>Annual Sales</h2>
				<br>
				<canvas id="annualSales" width="400" height="200"></canvas>
				<script>
					var ctx = document.getElementById('annualSales');
					var annualSales = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
							labels: [<?php echo ($year-3).", ".($year-2).", ".($year-1).", ".$year ?>],
							datasets: [{
								label: '12.5 Kg Cylinders',
								data: [<?php echo ($tot_3_quantity_1 + $tot_3_quantity_4).", ".($tot_2_quantity_1 + $tot_2_quantity_4).", ".($tot_1_quantity_1 + $tot_1_quantity_4).", ".($tot_quantity_1 + $tot_quantity_4); ?>],
								backgroundColor: [
									'rgba(255, 99, 132, 0.2)',
									'rgba(255, 99, 132, 0.2)',
									'rgba(255, 99, 132, 0.2)',
									'rgba(255, 99, 132, 0.2)'
								],
								borderColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(255, 99, 132, 1)',
									'rgba(255, 99, 132, 1)',
									'rgba(255, 99, 132, 1)'
								],
								borderWidth: 1
							},
							{
								label: '5.0 Kg Cylinders',
								data: [<?php echo ($tot_3_quantity_2 + $tot_3_quantity_5).", ".($tot_2_quantity_2 + $tot_2_quantity_5).", ".($tot_1_quantity_2 + $tot_1_quantity_5).", ".($tot_quantity_2 + $tot_quantity_5); ?>],
								backgroundColor: [
									'rgba(54, 162, 235, 0.2)',
									'rgba(54, 162, 235, 0.2)',
									'rgba(54, 162, 235, 0.2)',
									'rgba(54, 162, 235, 0.2)'
								],
								borderColor: [
									'rgba(54, 162, 235, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(54, 162, 235, 1)'
								],
								borderWidth: 1
							},
							{
								label: '2.3 Kg Cylinders',
								data: [<?php echo ($tot_3_quantity_3 + $tot_3_quantity_6).", ".($tot_2_quantity_3 + $tot_2_quantity_6).", ".($tot_1_quantity_3 + $tot_1_quantity_6).", ".($tot_quantity_3 + $tot_quantity_6); ?>],
								backgroundColor: [
									'rgba(255, 206, 86, 0.2)',
									'rgba(255, 206, 86, 0.2)',
									'rgba(255, 206, 86, 0.2)',
									'rgba(255, 206, 86, 0.2)'
								],
								borderColor: [
									'rgba(255, 206, 86, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(255, 206, 86, 1)'
								],
								borderWidth: 1
							},
							{
								label: 'Accessories',
								data: [<?php echo ($tot_3_quantity_7 + $tot_3_quantity_8 + $tot_3_quantity_9).", ".($tot_2_quantity_7 + $tot_2_quantity_8 + $tot_2_quantity_9).", ".($tot_1_quantity_7 + $tot_1_quantity_8 + $tot_1_quantity_9).", ".($tot_quantity_7 + $tot_quantity_8 + $tot_quantity_9); ?>],
								backgroundColor: [
									'rgba(75, 192, 192, 0.2)',
									'rgba(75, 192, 192, 0.2)',
									'rgba(75, 192, 192, 0.2)',
									'rgba(75, 192, 192, 0.2)'
								],
								borderColor: [
									'rgba(75, 192, 192, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(75, 192, 192, 1)'
								],
								borderWidth: 1
							}
						],
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				</script>
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
	</body>

	</html>
<?php
}
?>