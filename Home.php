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
		<div id="userdiv">
			<a id="user" onclick="toggledropdown()" onblur="closedropdown()"><?php echo "$username"; ?><span id="Droparrow">&#9662</span></a>
		</div>
		<div id="Navs">
			<a class="Current" href="Home.php">Polls open</a>
			<?php
				if($_SESSION['adminlevel'] == 1){
					echo "<a class='Navigation' href='Createpoll.php'>Create poll</a>
						<a class='Navigation' href='Yourpolls.php'>Your polls</a>
						<a class='Navigation' href='Signups.php'>Signups</a>";
				}
				elseif ($_SESSION['adminlevel'] == 2) {
					echo "<a class='Navigation' href='Createpoll.php'>Create poll</a>
						<a class='Navigation' href='Yourpolls.php'>Your polls</a>";				
				}
			?>
			<a class="Navigation" href="Contactus.php">Contact us</a>
		</div>
		<div id="Dropdown">
			<a class="Dropdownlist" href="Profile.php">Profile</a>
			<form action="Logout.php" method="POST">
				<input id="Logout" class="Dropdownlist" type="submit" name="logout" value="Logout">
			</form>
		</div>
	</div>
	<div class="body">
		<div class="Questions">
			<?php
				mysqli_select_db($con, "polls");
				$q = "select * from questions";
				$q = mysqli_query($con, $q);
				$rows = mysqli_num_rows($q);
				for($i=0;$i<$rows;$i++){
					$row = mysqli_fetch_assoc($q);
					echo "	<form action='Detailedpoll.php' method='post'>
								<input type='hidden' name='id' value='".$row['id']."'>
								<p class='Polls' onclick='submit()'>".$row['question']."</p>
								<input type='submit' name='submit' class='Viewbutton' value='View'>
							</form>";
				}
			?>
		</div>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>