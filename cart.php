<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	// Logged out
	$log = false;
	header("location: ./login.php");
	exit;
} else {

	$no = $street1 = $street2 = $city = $description = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["no"])) {$no = htmlentities($_GET["no"]);}
		if (isset($_GET["street1"])) {$street1 = htmlentities($_GET["street1"]);}
		if (isset($_GET["street2"])) {$street2 = htmlentities($_GET["street2"]);}
		if (isset($_GET["city"])) {$city = htmlentities($_GET["city"]);}
		if (isset($_GET["description"])) {$description = htmlentities($_GET["description"]);}
	}

	$no = str_replace("'", "\'", $no);
	$street1 = str_replace("'", "\'", $street1);
	$street2 = str_replace("'", "\'", $street2);
	$city = str_replace("'", "\'", $city);
	$description = str_replace("'", "\'", $description);

	$no = filter_var($no, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$street1 = filter_var($street1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$street2 = filter_var($street2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$city = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$description = filter_var($description, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

	if (empty($city)) {
		$delivery = false;
		$obtaining_method_id = 2;
	} else {
		$delivery = true;
		$obtaining_method_id = 1;
	}

	//Logged in
	$log = true;

	$customer_id = $_SESSION["customer_id"];
	$fname = $_SESSION["fname"];
	$lname = $_SESSION["lname"];
	$contact_no = $_SESSION["contact_no"];
	$email = $_SESSION["email"];


	include "./php/connection.php";

	$today = date("Y-m-d");

	$sql_stock_1 = "SELECT availability, price FROM products WHERE product_id=1";
	$result = $conn->query($sql_stock_1);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_1 = $row["availability"];
			$price_1 = $row["price"];
		}
	}

	$sql_stock_2 = "SELECT availability, price FROM products WHERE product_id=2";
	$result = $conn->query($sql_stock_2);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_2 = $row["availability"];
			$price_2 = $row["price"];
		}
	}

	$sql_stock_3 = "SELECT availability, price FROM products WHERE product_id=3";
	$result = $conn->query($sql_stock_3);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_3 = $row["availability"];
			$price_3 = $row["price"];
		}
	}


	$sql_stock_4 = "SELECT availability, price FROM products WHERE product_id=4";
	$result = $conn->query($sql_stock_4);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_4 = $row["availability"];
			$price_4 = $row["price"];
		}
	}

	$sql_stock_5 = "SELECT availability, price FROM products WHERE product_id=5";
	$result = $conn->query($sql_stock_5);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_5 = $row["availability"];
			$price_5 = $row["price"];
		}
	}

	$sql_stock_6 = "SELECT availability, price FROM products WHERE product_id=6";
	$result = $conn->query($sql_stock_6);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_6 = $row["availability"];
			$price_6 = $row["price"];
		}
	}


	$sql_stock_7 = "SELECT availability, price FROM products WHERE product_id=7";
	$result = $conn->query($sql_stock_7);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_7 = $row["availability"];
			$price_7 = $row["price"];
		}
	}

	$sql_stock_8 = "SELECT availability, price FROM products WHERE product_id=8";
	$result = $conn->query($sql_stock_8);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_8 = $row["availability"];
			$price_8 = $row["price"];
		}
	}

	$sql_stock_9 = "SELECT availability, price FROM products WHERE product_id=9";
	$result = $conn->query($sql_stock_9);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$availability_9 = $row["availability"];
			$price_9 = $row["price"];
		}
	}

	if ($availability_1 == 0) {
		echo "
		<style>
			.cart-1{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_2 == 0) {
		echo "
		<style>
			.cart-2{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_3 == 0) {
		echo "
		<style>
			.cart-3{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_4 == 0) {
		echo "
		<style>
			.cart-4{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_5 == 0) {
		echo "
		<style>
			.cart-5{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_6 == 0) {
		echo "
		<style>
			.cart-6{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_7 == 0) {
		echo "
		<style>
			.cart-7{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_8 == 0) {
		echo "
		<style>
			.cart-8{
				display: none!important;
			}
		</style>
		";
	}

	if ($availability_9 == 0) {
		echo "
		<style>
			.cart-9{
				display: none!important;
			}
		</style>
		";
	}


?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Cart List </title>
		<link rel="stylesheet" href="style/cart.css" />
		<link rel="stylesheet" href="style/main.css">
		<script src="js/cart.js" async></script>
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
		<section style="margin-top: 100px;" class="container content-section cart-section">
			<h2 class="section-header">REFILLING CYLINDERS</h2>
			<div class="cart-items">
				<div class="cart-item cart-1">
					<span style="display: none;" class="cart-item-id">1</span>
					<span class="cart-item-title">12.5 Kg Cylinders (Refill)</span>
					<img class="cart-item-image" src="images/12kg.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_1; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
				<div class="cart-item cart-2">
					<span style="display: none;" class="cart-item-id">2</span>
					<span class="cart-item-title">5.0 Kg Cylinders (Refill)</span>
					<img class="cart-item-image" src="images/5kg.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_2; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
				<div class="cart-item cart-3">
					<span style="display: none;" class="cart-item-id">3</span>
					<span class="cart-item-title">2.3 Kg Cylinders (Refill)</span>
					<img class="cart-item-image" src="images/2kg.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_3; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
			</div>
		</section>
		
		<section class="container content-section cart-section">
			<h2 class="section-header">NEW CYLINDERS</h2>
			<div class="cart-items">
				<div class="cart-item cart-4">
					<span style="display: none;" class="cart-item-id">4</span>
					<span class="cart-item-title">12.5 Kg Cylinders </span>
					<img class="cart-item-image" src="images/12kg.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_4; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
				<div class="cart-item cart-5">
					<span style="display: none;" class="cart-item-id">5</span>
					<span class="cart-item-title">5.0 Kg Cylinders </span>
					<img class="cart-item-image" src="images/5kg.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_5; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
				<div class="cart-item cart-6">
					<span style="display: none;" class="cart-item-id">6</span>
					<span class="cart-item-title">2.3 Kg Cylinders </span>
					<img class="cart-item-image" src="images/2kg.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_6; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
			</div>
		</section>
		
		<section class="container content-section cart-section">
			<h2 class="section-header">ACCESSORIES</h2>
			<div class="cart-items">
				<div class="cart-item cart-7">
					<span style="display: none;" class="cart-item-id">7</span>
					<span class="cart-item-title"> Regulator </span>
					<img class="cart-item-image" src="images/Regulator1.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_7; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
				<div class="cart-item cart-8">
					<span style="display: none;" class="cart-item-id">8</span>
					<span class="cart-item-title"> Hose </span>
					<img class="cart-item-image" src="images/hose3.png">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_8; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
				<div class="cart-item cart-9">
					<span style="display: none;" class="cart-item-id">9</span>
					<span class="cart-item-title"> Accessory Pack </span>
					<img class="cart-item-image" src="images/REG.jpeg">
					<div class="cart-item-details">
						Rs <span class="cart-item-price"><?php echo $price_9; ?>.00</span>
						<button class="btn btn-primary cart-item-button" type="button"> ADD TO CART </button>
					</div>
				</div>
			</div>
		</section>
		
		<section class="container content-section">
			<form action="./php/purchase.php" method="POST">
				<h2 class="section-header">CART</h2>
				<div class="shop-row">
					<span class="shop-item shop-header shop-column"> ITEM </span>
					<span class="shop-price shop-header shop-column"> PRICE (Rs) </span>
					<span class="shop-quantity shop-header shop-column"> QUANTITY</span>
				</div>
				<div class="shop-items">
				</div>
				<div class="shop-total">
					<strong class="shop-total-title">Total</strong>
					<span class="shop-total-price">Rs 0.0</span>
					<input class="shop-total-price" type="hidden" value="" id="total_input" name="total">
				</div>
				<div style="float: right;">
					<span style="color: #000; font-size: 14px;">Payment Method: &nbsp;&nbsp;</span>
					<select required name="payment_method" style="margin-top: 20px; font-size: 14px; outline: none;">
						<option value="">Select method</option>
						<option value="1">Credit card</option>
						<option value="2">Cash on delivery</option>
					</select>
				</div>
				<input type="hidden" value="<?php echo $obtaining_method_id; ?>" name="obtaining_method_id">

				<input type="hidden" value="<?php echo $no; ?>" name="no">
				<input type="hidden" value="<?php echo $street1; ?>" name="street1">
				<input type="hidden" value="<?php echo $street2; ?>" name="street2">
				<input type="hidden" value="<?php echo $city; ?>" name="city">
				<input type="hidden" value="<?php echo $description; ?>" name="description">

				<button class="btn btn-primary btn-purchase" type="submit">PURCHASE</button>
			</form>
		</section>
	</body>

	</html>

<?php
}
?>