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
		if($q['adminlevel']==3)
			die('Access denied');
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
		<a class="Navigation" href="Home.php">Polls open</a>
		<?php
			if($_SESSION['adminlevel'] == 1){
				echo "<a class='Navigation' href='Createpoll.php'>Create poll</a>
					<a class='Current' href='Yourpolls.php'>Your polls</a>
					<a class='Navigation' href='Signups.php'>Signups</a>";
			}
			elseif ($_SESSION['adminlevel'] == 2) {
				echo "
				<a class='Navigation' href='Createpoll.php'>Create poll</a>
				<a class='Current' href='Yourpolls.php'>Your polls</a>";				
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
			<div id="Polls">
				<?php
					mysqli_select_db($con, "polls");
					if(isset($_POST['delete'])){
						$q = "select optiontable from questions where id = '".$_POST['id']."'";

						$optiontable = mysqli_query($con, $q);
						$optiontable = mysqli_fetch_assoc($optiontable);
						$optiontable = $optiontable['optiontable'];
						$q = "delete from questions where id = '".$_POST['id']."'";
						$q = mysqli_query($con, $q);

						$q = "drop table users".$_POST['id'];
						$q = mysqli_query($con, $q);

						mysqli_select_db($con, "options");
						$q = "drop table ".$optiontable;
						$q = mysqli_query($con, $q);
						
						mysqli_select_db($con, "polls");
					}
					$q =  "select * from questions where author ='".$username."'";
					$questions = mysqli_query($con, $q);
					$rows = mysqli_num_rows($questions);
					for($i=0;$i<$rows;$i++){
						$question = mysqli_fetch_assoc($questions);
						echo "<p class='Polls'>".$question['question']."</p>
						<form action='' method='post'>
							<input type='hidden' value='".$question['id']."' name='id'>
							<input class='Deletebutton' type='submit' name='delete' value='Delete'>
						</form>";
					}
				?>
				
			</div>
		</div>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>