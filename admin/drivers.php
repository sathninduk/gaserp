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
		<title>Drivers</title>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
		<link rel="stylesheet" href="../style/Admin.css">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

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
							<a class="nav-select" href="./drivers.php">
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
							<a class="nav-item" href="./stock.php">
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
				<h1>Drivers<a onclick="window.print();" class="print">Print</a></h1>
				<br>

				<style>
					.tbl {
						font-size: 14px;
						margin-left: 0px;
						margin-top: 0px;
						width: 70vw;
					}
				</style>
				<?php
				//$sql = "SELECT driver_id, fname, lname, contact_no, email, status FROM driver";
				$sql = "SELECT * FROM driver INNER JOIN driver_payments ON driver.driver_id=driver_payments.driver_id";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					echo "
						<table class=\"tbl\">
									<thead>
										<th>ID</th>
										<th style=\"max-width: 120px;\">Name</th>
										<th>Contact No</th>
										<th>NIC</th>

										<th>Start</th>
										<th>End</th>

										
										
										<th>Debit Balance (LKR)</th>
										<th>Salary (LKR)</th>
										<th>Last Transaction</th>
										<!--<th>Action</th>-->
									</thead>
									<tbody>";
					// output data of each row
					while ($row = $result->fetch_assoc()) {


						echo "<tr>
									<td>" . $row["driver_id"] . "</td>
									<td style=\"max-width: 120px;\">" . $row["fname"] . " " . $row["lname"] . "</td>
									<td>" . $row["contact_no"] . "</td>
									<td>" . $row["nic"] . "</td>

									<td>" . $row["start"] . "</td>
									<td>" . $row["end"] . "</td>


									
									<td>" . $row["debit_balance"] . ".00 ";
						if ($row["debit_balance"] != 0) {
							echo " &nbsp;&nbsp;
									<a class=\"pay-btn debit-pay\" href=\"./php/driver_collect.php?driver_id=" . $row["driver_id"] . "&debit_balance=" . $row["debit_balance"] . "\" style=\"border: 1px solid #000; padding: 1px 7px 1px 7px; border-radius: 5px; text-decoration: none; color: black; width: 50px; height: 20px;\">Collect</a> ";
						}
						echo "
									</td>

									<td>" . $row["amount"] . ".00";
						if ($row["amount"] != 0) {
							echo " &nbsp;&nbsp;
									<a class=\"pay-btn salary-pay\" href=\"./php/driver_pay.php?driver_id=" . $row["driver_id"] . "&amount=" . $row["amount"] . "\" style=\"border: 1px solid #000; padding: 1px 7px 1px 7px; border-radius: 5px; text-decoration: none; color: black; width: 50px; height: 20px;\">Pay</a>";
						}
						echo "
									</td>

									<td>" . $row["last_date"] . "</td>
									<!--<td><a href=\"#\" class=\"delete\">Delete</a></td>-->

								</tr>";
					}
					echo "</tbody>
						</table>
						<br><br>
						<i class=\"fa fa-history\"><a style=\"color: black;\" href=\"./driver-payments-history.php\"> &nbsp;Payments History</a></i>";
				} else {
					echo "0 results
						<br><br>
						<i class=\"fa fa-history\"><a style=\"color: black;\" href=\"./driver-payments-history.php\"> &nbsp;Payments History</a></i>";
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


			<form action="./php/add_driver.php" method="post" style="margin-top: 50px;">
				<div class="details">
					<h2 class="page-title">Add New Driver</h2>
					<label class="driver_lbl">First Name<input required class="driver_in" type="text" name="fname"></label>
					<label class="driver_lbl">Last Name<input required class="driver_in" type="text" name="lname"></label>
					<label class="driver_lbl">Contact Number<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="10" required class="driver_in" name="contact_no"></label>
					<label class="driver_lbl">NIC Number<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="12" required class="driver_in" name="nic"></label>

					<br>
					<fieldset style="border: 1px solid rgba(0,0,0,.18); border-left: none; border-right: none;">
						<legend>Available Time Slot &nbsp&nbsp&nbsp&nbsp</legend>
						<br>

						<label class="driver_lbl">Starting Time
							<span id='starttime'><input type="time" required class="driver_in" name="start" id="Start_Time"></span>
						</label>
						<label class="driver_lbl">Ending Time
							<span id='endtime'><input type="time" required class="driver_in" name="end" id="Start_Time"></span>
						</label>
						<br>

					</fieldset>
					<br><br>
					<label class="driver_lbl">Email<input class="driver_in" type="email" name="email"></label>
					<label class="driver_lbl">Password<input required class="driver_in" type="password" name="pw"></label>
					<label class="driver_lbl">Re-type Password<input required class="driver_in" type="password" name="veri"></label>


					<button class="print-btn" type="submit">Add</button>
				</div>
			</form>
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

		<script>
			function TimePickerCtrl($) {
				var startTime = $('#starttime').datetimepicker({
					format: 'HH:mm'
				});

				var endTime = $('#endtime').datetimepicker({
					format: 'HH:mm',
					minDate: startTime.data("DateTimePicker").date()
				});

				function setMinDate() {
					return endTime
						.data("DateTimePicker").minDate(
							startTime.data("DateTimePicker").date()
						);
				}

				var bound = false;

				function bindMinEndTimeToStartTime() {

					return bound || startTime.on('dp.change', setMinDate);
				}

				endTime.on('dp.change', () => {
					bindMinEndTimeToStartTime();
					bound = true;
					setMinDate();
				});
			}

			$(document).ready(TimePickerCtrl);
		</script>

	</body>

	</html>
<?php
}
?>