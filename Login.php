<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		if($_SESSION['adminlevel'] == 1)
		{
			header('Location: Masterhome.php');
		}
		elseif($_SESSION['adminlevel'] == 2)
		{
			header('Location: Adminhome.php');
		}
		else
		{
			header('Location: Home.php');
		}
	}
	if(isset($_POST['submit']))
	{
		$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
		if(!$con)
		{
			die("connection error");
		}
		$username = strtoupper($_POST['username']);
		$password = $_POST['password'];
		$q = "select * from students where username='$username'";
		$q = mysqli_query($con, $q);
		if(mysqli_num_rows($q))
		{
			$q = mysqli_fetch_assoc($q);
			if($q['password'] == $password)
			{
				$_SESSION['username'] = $username;
				if($q['adminlevel'] == 1)
				{
					$_SESSION['adminlevel']= 1;
					header('Location: Masterhome.php');
				}
				elseif($q['adminlevel'] == 2)
				{
					$_SESSION['adminlevel']= 2;
					header('Location: Adminhome.php');
				}
				else
				{
					$_SESSION['adminlevel']= 3;
					header('Location: Home.php');
				}
			}
			else
			{
				$error = "Invalid username or password";
			}
		}
		else
		{
			$error = "Invalid username or password";
		}
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
		<a id="Logo" href="Login.php">
			<p id="Poll">Logo</p>
		</a>
	</div>
	<div class="body">
		<div id="Logintopmargin"></div>
		<div class="Logblock">
			<h1 id="Login">Login</h1>
			<span class="errors" id="Lusernameexisterror"><?php if(isset($error)) echo $error; ?></span>
			<form action="" onsubmit=" return validloginform()" name="Loginform" method="post">
				<p>Pin number/Username</p>
				<input class="input" type="text" id="Lusername" maxlength="15" autofocus="true" oninput="lusernamedefault(this)" name="username">
				<span id="Lusernameerror" class="errors"></span>
				<p>Password</p>
				<input class="input" type="password" id="Lpassword" onfocus="lvalidusername()" maxlength="20" onkeypress="lpassworddefault(this)" name="password">
				<span id="Lpassworderror" class="errors"></span>
				<!-- <a class="Logbutton" href="Home.html">Login</a> -->
				<input class="Submitbutton" type="submit" value="Login" onblur="validloginform()" name="submit">
			</form>
			<a id="Forgotpassword" href="Forgotpassword.html">Forgot password</a>
			<p>Don't have an account?</p>
			<a class="Signupbutton" href="Signup.php">Signup</a>
		</div>
	</div>
	<div class="Footer">

	</div>
</body>
