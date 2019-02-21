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
		if(isset($_POST['createpoll'])){
			$question = $_POST['question'];
			$author = $username;
			$options = $_POST['number'];
			mysqli_select_db($con, "polls");
			$q = "insert into questions(question, author, options)values('$question', '$author', '$options')";
			$q = mysqli_query($con, $q);
			if(!$q){
				die('internal error 23');
			}
			$id = "select id from questions where question = '$question'";
			$id = mysqli_query($con, $id);
			$id = mysqli_fetch_array($id)[0];
			$q = "update questions set optiontable = '".$author.$id."' where id='".$id."'";
			$q = mysqli_query($con, $q);
			if(!$q){
				die("internal error 31");
			}
			$q = "create table users".$id."(username varchar(50), useroption varchar(100))";
			$q = mysqli_query($con, $q);
			if(!$q){
				die("internal error 36");
			}
			$q = "update questions set answered = 'users".$id."' where id='".$id."'";
			$q = mysqli_query($con, $q);
			if(!$q){
				die("internal error 40");
			}
			mysqli_select_db($con, "options");
			$q = "create table ".$author.$id."(options varchar(100))";
			$q = mysqli_query($con, $q);
			if(!$q){
				die("internal error 46");
			}
			for($i=1;$i<=$options;$i++){
				$q = "insert into ".$author.$id."(options)values('".$_POST["option$i"]."')";
				$q = mysqli_query($con, $q);
				if(!$q){
					die("internal error 52");
				}
			}
			header("Location: pollcreatesuccess.php");
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
	<div id="userdiv">
		<a id="user" onclick="toggledropdown()" onblur="closedropdown()"><?php echo "$username"; ?><span id="Droparrow">&#9662</span></a>
	</div>
	<div id="Navs">
		<a class="Navigation" href="Home.php">Polls open</a>
		<?php
			if($_SESSION['adminlevel'] == 1){
				echo "<a class='Current' href='Createpoll.php'>Create poll</a>
					<a class='Navigation' href='Yourpolls.php'>Your polls</a>
					<a class='Navigation' href='Signups.php'>Signups</a>";
			}
			elseif ($_SESSION['adminlevel'] == 2) {
				echo "<a class='Current' href='Createpoll.php'>Create poll</a>
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
			<form id="Questionform" action="" method="post" onsubmit="return validcreatepoll()">
				<p class="Label">Question</p>
				<textarea id="Questioninput" form="Questionform" name="question" oninput="inputdefault(this)"></textarea>
				<span class="errors" id="Questionerror"></span>
				<p class="Label">No of option</p>
				<input id="inputnumber" type="number" name="number" value="2" min="2" maxlength="1" oninput="createoptions(this)">
				<span class="errors" id="inputerror"></span><br>
				<input class="Optioninput" type="text" name="option1" placeholder="Option 1" oninput="inputdefault(this)">
				<span class="errors" id="Optionerror1"></span><br>
				<input class="Optioninput" type="text" name="option2" placeholder="Option 2" oninput="inputdefault(this)">
				<span class="errors" id="Optionerror2"></span><br>
				<div id="inputoptions"></div>
				<input class="Qsubmitbutton" type="submit" name="createpoll" value="Submit">
			</form>
		</div>
	</div>
	<div id="createpolliframebackground">
		<iframe src="pollcreatesuccess.php" id="pollcreatesuccess" scrolling="no"></iframe>
	</div>
	<div class="Footer">
		
	</div>
</body>
</html>