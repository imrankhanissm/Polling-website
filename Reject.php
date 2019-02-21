<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
	if(!$con){
		die("connection error");
		die();
	}
	if(isset($_SESSION['username'])){
		if(isset($_POST['username'])){
		}
		else{
			die('Access denied');
		}
	}
	else{
		die("Access denied or your session timed out");
	}
?>

<html>
<head>
	<title>Reject</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body style="min-width: 390px">
	<div id="Rejectblock">
		<h1>Reject user</h1>
		<p id='Approveuser'><?php echo $_POST['username']; ?></p>
		<form action="Userrejected.php" method="_POST">
			<input type="hidden" name="username" value="<?php echo $_POST['username']; ?>">
			<input class="Approvebuttonf" id='Rejectbuttonf' type='submit' name='reject' value='Reject'>
		</form>
	</div>
</body>
</html>