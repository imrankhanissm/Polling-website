<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
	if(!$con){
		die("server connection error");
	}
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$q = "select * from students where username = '$username'";
		$q = mysqli_query($con, $q);
		$q = mysqli_fetch_assoc($q);
		echo mysql_error();
		if($q['adminlevel']!=2){
			die('Access denied');
		}
	}
	else
		die('Access denied or your session timed out');
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
		<a id="Logo" href="Home.php">
			<p id="Poll">Logo</p>
		</a>
		<a class="Current" href="Masterhome.php">Polls open</a>
		<a class="Navigation" href="Createpoll.php">Create poll</a>
		<a class="Navigation" href="Contactus.php">Contact us</a>
		<div id="userdiv">
			<a id="user" onclick="toggledropdown()" onblur="closedropdown()"><?php echo "$username"; ?><span id="Droparrow">&#9662</span></a>
		</div>
		<div id="Dropdown">
			<a class="Dropdownlist" href="Profile.php">Profile</a>
			<a id="Logout" class="Dropdownlist" href="Logout.php">Log Out</a>
		</div>
	</div>
	<div class="body">
		<div class="Questions">
			<h3>Do you like this website</h3>
			<form action="Answered.php" onsubmit="return validpoll()">
				<div id="Options">
					<div id="Yesoption">
						<input id="Yesradio" class="radio" type="radio" name="Yesorno"><h3>Yes</h3>
					</div>
					<div id="Nooption">
						<input id="Noradio" class="radio" type="radio" name="Yesorno"><h3>No</h3>
					</div>
				</div>
				<div id="Bars">
					<div id="Yesbar"></div>
					<h3 id="Yespercent">100%</h3><br>
					<div id="Nobar"> </div>
					<h3 id="Nopercent">30%</h3>
				</div>
				<span id="Pollerror" class="errors"></span>
				<input class="Qsubmitbutton" type="submit" value="Submit">
			</form>
		</div>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>