<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Logged out
    $log = false;
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type ="text/css" href ="style/Login.css" >
	<link rel="stylesheet" href="style/main.css">
</head>
<body>
<div class="outter-box">
	<div class="box">
		<div class="inner-box">
		<form action="recovery.php">
		<h3> Enter Your Email Address </h3>
		<input type="email" placeholder="Email Address"/>
		<input type="submit" value="Send Recovery Link"/>
		</div>
	</div>
</div>
</body>
</html>
<?php
} else {
    //Logged in
    $log = true;
	header("location: ./login.php");
	exit;
}
?>