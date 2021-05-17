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
	$nic = $_SESSION["nic"];
	$email = $_SESSION["email"];
	$no = $_SESSION["no"];
	$street = $_SESSION["street"];
	$city = $_SESSION["city"];

	include "./php/connection.php";

	$today = date("Y-m-d");

	// time
	date_default_timezone_set('Asia/Colombo');
	$time = date("H:i:s");

	$sql = "SELECT * FROM driver WHERE status=1";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		//get row count - drivers
		$sql_get_101 = "SELECT * FROM driver WHERE status = 1 AND start < '$time' AND end > '$time'"; // WHERE START AND END
		$result = $conn->query($sql_get_101);
		if ($result->num_rows > 0) {
			$drivers_have = TRUE;
		} else {
			$drivers_have = FALSE;
		}
	} else {
		$drivers_have = FALSE;
	}
?>

	<!DOCTYPE html>
	<html>

	<head>
		<link rel="stylesheet" href="style/Home2.css" type="text/css">
		<link rel="stylesheet" href="style/main.css">
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
		</style>

		<div class="container">
			<!--<div class="content">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>

			</div>-->
			<div class="form-box" style="height: 100vh;">
				<h3>Select the Shopping Method</h3>
				<div class="button-box">
					<div id="btn"></div>

					<button type="button" class="toggle-btn" onclick="delivery()">Delivery</button>

					<button type="button" class="toggle-btn" onclick="pickup()">Pickup</button>
				</div>

				<form id="delivery" class="input-group" method="GET" action="./cart.php">
					<?php
					if ($drivers_have == true) {
					?>
						<p class="delivery-info-home2"><b>Your Name:</b> <?php echo $fname . " " . $lname; ?></p>
						<p class="delivery-info-home2"><b>Your Contact Number:</b> <?php echo $contact_no; ?></p>
						<p class="delivery-info-home2"><b>Your NIC Number:</b> <?php echo $nic; ?></p>
						<br>
						<p class="delivery-info-home2"><b>Enter your Address</b></p>
						<input type="text" class="input-field" name="no" placeholder="Enter No" required>
						<input type="text" class="input-field" name="street1" placeholder="Enter Street 1" required>
						<input type="text" class="input-field" name="street2" placeholder="Enter Street 2">
						<select type="text" class="input-field" name="city" required>
							<option value="">Enter City</option>
							<option value="Kiribathgoda">Kiribathgoda</option>
							<option value="Mahara">Mahara</option>
							<option value="Hunupitiya">Hunupitiya</option>
							<option value="Wattala">Wattala</option>
							<option value="Makola">Makola</option>
							<option value="Dalugama">Dalugama</option>
						</select>
						<textarea style="font-family:'Poppins',sans-serif; width: 280px;" class="input-field" name="description" placeholder="Delivery Message"></textarea>
						<br />
						<br />
						<br />
						<button type="submit" class="submit-btn">Buy Now</button>
						<br><br>
						<span style="font-size: 14px;">*Only customers in the above mentioned areas are eligible for the delivery option.</span>
					<?php } else {
						echo "<p class=\"delivery-info-home2\"><b>Currently unavailable</b></p>";
					} ?>
				</form>

				<form id="pickup" action="./cart.php" method="GET" class="input-group">
					<p class="delivery-info-home2"><b>Your Name:</b> <?php echo $fname . " " . $lname; ?></p>
					<p class="delivery-info-home2"><b>Your Contact Number:</b> <?php echo $contact_no; ?></p>
					<p class="delivery-info-home2"><b>Your NIC Number:</b> <?php echo $nic; ?></p>
					<br /><br /><button type="submit" class="submit-btn">Buy Now</button>
				</form>
			</div>
		</div>

		<!--<a href="./php/logout.php" style="color: #000; width: 100px; text-decoration: none; text-align: center; font-size: 12px;" class="submit-btn">Logout</a>-->

		<script>
			var x = document.getElementById("delivery");
			var y = document.getElementById("pickup");
			var z = document.getElementById("btn");

			function pickup() {
				x.style.left = "-400px";
				y.style.left = "50px";
				z.style.left = "110px";
			}

			function delivery() {
				x.style.left = "50px";
				y.style.left = "450px";
				z.style.left = "0";
			}
		</script>
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