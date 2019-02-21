<?php
	session_start();
	if(isset($_POST['logout']))
		session_destroy();
	else
		die("Access denied");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="Style.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<div id="Header">
			<a id="Logo" href="Login.php">
				<p id="Poll">Logo</p>
			</a>
		</div>
		<div class="body">
			<div id="Logintopmargin"></div>
			<div class="Logblock">
				<p>Logout successful</p>
				<a class="Submitbutton" href="index.php">Login</a>
			</div>
		</div>
		<div class="Footer">

		</div>
	</body>
</html>