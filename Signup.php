<?php
	//error_reporting(0);
	session_start();
	$usernameexists = 0;
	if(isset($_POST['submit'])){
		$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
		if(!$con){
			die("connection error");
		}
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$email = trim($_POST['email']);
		$mobile = trim($_POST['mobile']);
		$student = trim($_POST['studentradio']);
		$approvecode = mt_rand(100000, 999999);
		$checkuserinsignups = "select * from signups where username='$username'";
		$checkuserinstudents = "select * from students where username='$username'";
		$checkuserinsignups = mysqli_query($con, $checkuserinsignups);
		$checkuserinstudents = mysqli_query($con, $checkuserinstudents);
		if(!mysqli_num_rows($checkuserinsignups)){
			if(!mysqli_num_rows($checkuserinstudents)){
				$q = "insert into signups(username, password, firstname, lastname, email, mobile, student, approvecode)values('$username', '$password', '$firstname', '$lastname', '$email', '$mobile', '$student', '$approvecode')";
				$q = mysqli_query($con, $q);
				if($q){
					$_SESSION['approvecode'] = $approvecode;
					header("Location: Signupcode.php");
				}
				else{
					echo "query error";
				}
			}
			else{
				$usernameexists = 1;
			}
		}
		else{
			$usernameexists = 2;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign up</title>
		<link rel="stylesheet" type="text/css" href="Style.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<div id="Header">
			<a id="Logo" href="Login.php">
				<p id="Poll">Logo</p>
			</a>
			<a class="Button" href="Index.php">Login</a>
		</div>
		<div class="body">
			<div class="Logblock">
				<h1>Sign up</h1>
				<form action="Signup.php" onsubmit="return validsignupform()" method="post">
					<div class="Studentradio">
						<input id="Studentradioselected" class="radio" type="radio" name="studentradio" checked="True" onclick="changetopin()" value="1">Student
					</div>
					<div class="Facultyradio">
						<input id="Facultyradioselected" class="radio" type="radio" name="studentradio" onclick="changetousername()" value="0">Faculty
					</div>
					<p id="Spin">Pin number</p>
					<input class="input" type="text" name="username" id="Susername" onblur="svalidusername()" oninput="susernamedefault(this)">
					<span id="Susernameerror" class="errors"></span>
					<p>First name</p>
					<input class="input" type="text" name="firstname" id="Sname" onblur="svalidname()" oninput="snamedefault(this)">
					<span id="Snameerror" class="errors"></span>
					<p>Last name</p>
					<input class="input" type="text" name="lastname" id="Slastname">
					<p>Password</p>
					<input class="input" type="password" name="password" id="Spassword" onblur="svalidpassword()" oninput="spassworddefault(this)">
					<span id="Spassworderror" class="errors"></span>
					<p>Confirm password</p>
					<input class="input" type="password" name="cpassword" id="Scpassword" onblur="svalidcpassword()" oninput="scpassworddefault(this)">
					<span id="Scpassworderror" class="errors"></span>
					<p>Email</p>
					<input class="input" type="text" name="email" id="Semail" onblur="svalidemail()" oninput="semaildefault(this)">
					<span id="Semailerror" class="errors"></span>
					<p>Mobile no</p>
					<input class="input" type="text" name="mobile" id="Smobile" maxlength="10" onblur="svalidmobile()" oninput="smobiledefault(this)">
					<span id="Smobileerror" class="errors"></span>
					<input class="Submitbutton" type="submit" value="Sign up" name="submit">
				</form>
			</div>
		</div>
		<div class="Footer">
			
		</div>
		<?php 
		if($usernameexists == 1) 
			echo "<script type='text/javascript'>susernameexists('Username already exists');</script>";
		elseif($usernameexists == 2)
			echo "<script type='text/javascript'>susernameexists('User already signed up');</script>";
		?>
	</body>
</html>

					