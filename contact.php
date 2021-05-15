<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	// Logged out
	$log = false;
	echo "<script>";
	echo "  alert('You must login first!');";
	echo "  window.location = './login.php';";
	echo "</script>";
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

?>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title></title>
		<link rel="stylesheet" href="style/contact.css">
		<link rel="stylesheet" href="style/main.css">
	</head>

	<body>
		<section>
			<div class="container">
				<div class="contactinfo">
					<div>
						<h2>Contact Us</h2><br>
						<p>Please write your questions and we are committed to give necessary feedback to the customer.</p>
						<ul class="infor">
							<li>
								<span><img src="images/Address.png"></span>
								<span>No 283 <br>Sri Sudharshanarama Road<br>
									Kiribathgoda<br>
									Kelaniya</span>
							</li>
							<li>
								<span><img src="images/Email.png"></span>
								<span>sethmithenterprise@gmail.com</span>
							</li>
							<li>
								<span><img src="images/Call.png"></span>
								<span>076-870-7910</span>
							</li>
						</ul>
					</div>
					<ul class="social">
						<li><a href="#"><img src="images/Facebook.png"></a></li>
						<li><a href="#"><img src="images/Twitter.png"></a></li>
						<li><a href="#"><img src="images/Instagram.png"></a></li>

					</ul>
				</div>
				<div class="contactbox">
					<h2>Customer Feedback</h2>
					<form method="post" action="./feedback.php">
					<div class="form-box">
						<div class="input-box w100">
							<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
							<textarea name="description" required></textarea>
							<span>Write your feedback here...</span>
						</div>
						<div class="input-box w100">
							<button class="feed-ref" style="padding: 4px 12px 4px 12px;" type="submit">Send</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</section>
	</body>

	</html>
<?php
}
?>