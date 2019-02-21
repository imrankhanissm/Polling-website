<?php
	session_start();
	//error_reporting(0);
	$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
	if(!$con){
		die("connection error");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up success</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
	<script type="text/javascript" src="Script.js"></script>
</head>
<body>
	<div id="Header">
		<a id="Logo" href="Index.php">
			<p id="Poll">Logo</p>
		</a>
		<a class="Button" href="Index.php">Login</a>
	</div>
	<div class="body">
		<div id="Logintopmargin"></div>
		<div class="Logblock">
			<h1>Sign up successful</h1>
			<p id="Approvemsg">Please note this Approval code we will contact you.</p>
			<p id="Approvalcode" type="text" name="Approval code"><?php echo $_SESSION['approvecode']; ?></p>
		</div>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>