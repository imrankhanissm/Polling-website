<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
	if(!$con){
		die("server connection error");
	}
	$username = $_SESSION['username'];
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
		<a class="Current" href="Home.php">Polls open</a>
		<a class="Navigation" href="Contactus.php">Contact us</a>
		<div id="userdiv">
			<a id="user" onclick="toggledropdown()" onblur="closedropdown()"><?php echo "$username"; ?><span id="Droparrow">&#9662</span></a>
		</div>
		<div id="Outertri"></div>
		<div id="Innertri"></div>
		<div id="Dropdown">
			<a class="Dropdownlist" href="Profile.php">Profile</a>
			<a id="Logout" class="Dropdownlist" href="Login.php">Log Out</a>
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
	<!-- <div id="Comments">
		<h3>Comments</h3>
		<form>
			<h4 id="Commentas">Comment as</h4>
			<input type="radio" name="Commentas" checked="True">PHP CODE
			<input type="radio" name="Commentas">Anonymous<br>
			<input type="text" name="comment">
			<input type="submit" id="Csubmitbutton" name="submit">
		</form>
	</div> -->
	
	<div class="Footer">
		
	</div>
</body>
</html>