<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
	if(!$con){
		die("connection error");
		die();
	}
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$q = "select * from students where username = '$username'";
		$q = mysqli_query($con, $q);
		$q = mysqli_fetch_assoc($q);
		if($q['adminlevel']!=1){
			die("Access denied");
		}
		$signups = "select * from signups";
		$signups = mysqli_query($con, $signups);
		$rows = mysqli_num_rows($signups);
	}
	else{
		die("Access denied or your session timed out");
	}
	
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
			<a class="Navigation" href="Home.php">Polls open</a>
			<?php
				if($_SESSION['adminlevel'] == 1){
					echo "<a class='Navigation' href='Createpoll.php'>Create poll</a>
						<a class='Navigation' href='Yourpolls.php'>Your polls</a>
						<a class='Current' href='Signups.php'>Signups</a>";
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
			<table>
				<tr>
					<th>Sl no</th>
					<th>Username</th>
					<th>First name</th>
					<th>Last name</th>
					<th>Email</th>
					<th>Mobile</th>
				</tr>
				
				<?php
					for($i = 0;$i<$rows;$i++){
						$row = mysqli_fetch_assoc($signups);
						echo 	"<tr>
									<td>".($i+1)."</td>
									<td>{$row['username']}</td>
									<td>{$row['firstname']}</td>
									<td>{$row['lastname']}</td>
									<td>{$row['email']}</td>
									<td>{$row['mobile']}</td>
									<td>
									<div class='Rejectblock'>
										<form action='Reject.php' method='post' target='iframe'>
											<input type='hidden' name='username' value='{$row['username']}'>
											<input class='Rejectbutton' type='submit' name='rej' value='Reject' onclick='showiframe(this)''>
										</form>
									</div>
									</td>
									<td>
										<div class='Approveblock'>
											<form action='Approve.php' method='post' target='iframe'>
												<input type='hidden' name='username' value='{$row['username']}'>
												<input class='Approvebutton' type='submit' name='app' value='Approve' onclick='showiframe(this)'>
											</form>
										</div>
									</td>
								</tr>";
					}
				?>
			</table>
		</div>
	</div>
	<div id="iframebackground" onclick="hideiframe(this)">
			<iframe src="about:blank" name="iframe" id="iframe" scrolling="no"></iframe>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>