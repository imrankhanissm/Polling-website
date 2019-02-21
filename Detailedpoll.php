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
				$totalstudents = "select * from students";
				$totalstudents = mysqli_query($con, $totalstudents);
				$totalstudents = mysqli_num_rows($totalstudents);
				mysqli_select_db($con, "polls");
				$q = "select * from questions where id=".$_POST['id'];
				$q = mysqli_query($con, $q);
				$question = mysqli_fetch_assoc($q);
				$optiontable = $question['optiontable'];

				if(isset($_POST['pollsubmit'])){
					$q = "insert into users".$_POST['id']." values('".$username."', '".$_POST['option']."')";
					$q = mysqli_query($con, $q);
				}
				$submit = "select useroption from users".$_POST['id']." where username = '".$username."'";
				$submit = mysqli_query($con, $submit);
				$f = mysqli_num_rows($submit);

				mysqli_select_db($con, "options");
				$q = "select * from ".$optiontable;
				$options = mysqli_query($con, $q);
				$rows = mysqli_num_rows($options);
				echo "<p class='Question'>".$question['question']."</p>";
				mysqli_select_db($con, "polls");
				if($f){
					$submit = mysqli_fetch_assoc($submit);
					for($i=0;$i<$rows;$i++){
						$option = mysqli_fetch_assoc($options)['options'];
						$answeredstudents = "select * from users".$_POST['id']." where useroption = '".$option."'";
						$answeredstudents = mysqli_query($con, $answeredstudents);
						$answeredstudents = mysqli_num_rows($answeredstudents);
						$percent = round($answeredstudents/$totalstudents*100, 2);
						echo "<input class='radio' type='radio' value='".$option."' disabled='true' ".(($option == $submit['useroption'])? 'checked="true"':"").">
							<p class='Option'>".$option."</p><br>
							<div class='Bars' style='width:".$percent."%'></div>
							<p class='Percent'>".$percent."%</p><br><br>";
						}
					echo "<p>Poll answered</p>";	
				}
				else{
					echo "	<form action='' method='post' onsubmit='return validanswer()'>
							<input type='hidden' name='id' value='".$_POST['id']."'>";
					for($i=0;$i<$rows;$i++){
						$option = mysqli_fetch_assoc($options)['options'];
						$answeredstudents = "select * from users".$_POST['id']." where useroption = '".$option."'";
						$answeredstudents = mysqli_query($con, $answeredstudents);
						$answeredstudents = mysqli_num_rows($answeredstudents);
						$percent = round($answeredstudents/$totalstudents*100, 2);
						echo "<input class='radio' type='radio' name='option' value='".$option."' onclick='clearpollsubmiterror()'>
						<p class='Option'>".$option."</p><br>
						<div class='Bars' style='width:".$percent."%'></div>
						<p class='Percent'>".$percent."%</p><br><br>";
						}
					echo "  <span id='Pollsubmiterror' class='errors'></span>
							<input class='Qsubmitbutton' type='submit' name='pollsubmit'>
							</form>";
				}
			?>
		</div>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>