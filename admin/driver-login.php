<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    // Logged out
    $log = false;
?>
<html>
<head>
<title></title>
<link rel="stylesheet" type ="text/css" href ="../style/Login.css" >
<title>Admin Login</title>
</head>
<body>
	<img class="icon" src="../images/background.png">
	<div class="container">
		<div class="img">
			<img src="../images/gas-1.jpg">
		</div>
		<div class="login-form">
			<form action="./php/login.php" method="POST">
				<img class="profile" src="../images/Profile.png">
				<h2>DRIVER LOGIN</h2>
					<div class="input-fields one focus">
						<div>
							<h5>Username</h5>
							<input class="input" type="text" name="email" required>
						</div>
					</div>
					<div class="input-fields two focus">
						<div>
							<h5>Password</h5>
							<input class="input" type="password" name="password" required>
						</div>
					</div>
					<button type="submit" class="btn">Login</button>
			</form>
		</div>
	</div>
</body>
</html>
<?php
} else {
    //Logged in
    $log = true;
	header("location: ./AdminDashboard.php");
	exit;
}
?>