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
			<a id="user" onclick="toggledropdown()" onblur="closedropdown()">welcome user <span id="Droparrow">&#9662</span></a>
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
			<h3 id="Question">Do you like this website</h3>
			<div id="Options">
				<div id="Yesoption">
					<input id="Yesradioans" class="radio" type="radio" name="Yesorno" disabled="true"><h3>Yes</h3>
				</div>
				<div id="Nooption">
					<input id="Noradioans" class="radio" type="radio" name="Yesorno" disabled="true"><h3>No</h3>
				</div>
			</div>
			<div id="Bars">
				<div id="Yesbar"></div>
				<h3 id="Yespercent">100%</h3><br>
				<div id="Nobar"> </div>
				<h3 id="Nopercent">30%</h3>
			</div>
			<br>
			<br>
			<h3>Poll answered</h3>
		</div>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>