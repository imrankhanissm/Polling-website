<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "imran", "gietpoll");
	if(!$con)
	{
		die("connection error");
	}
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		$q = "select * from students where username = '$username'";
		$q = mysqli_query($con, $q);
		$q = mysqli_fetch_assoc($q);
		if($q['adminlevel']!=1)
			die('Access denied');
		if(isset($_SESSION['approveuser']))
			$_POST['username']=$_SESSION['approveuser'];
		if(isset($_POST['approve']))
		{
			$username = $_POST['username'];
			$q = "select * from signups where username = '$username'";
			$q = mysqli_query($con, $q);
			$q = mysqli_fetch_assoc($q);
			$approvecode = $q['approvecode'];
			$usercode = $_POST['approvecode'];
			if($approvecode!=$usercode)
			{
				$_SESSION['approveuser']=$_POST['username'];
				$_SESSION['wrongcode'] = true;
				header('Location: Approve.php');
			}
			else
			{
				unset($_SESSION['approveuser']);
				unset($_SESSION['wrongcode']);
				$firstname = $q['firstname'];
				$lastname = $q['lastname'];
				$password = $q['password'];
				$email = $q['email'];
				$mobile = $q['mobile'];
				$student = $_POST['student'];
				$adminlevel = $_POST['adminlevel'];
				$q = "insert into students (username, firstname, lastname, password, email, mobile, student, adminlevel) values 
										   ('$username', '$firstname', '$lastname', '$password', '$email', '$mobile', $student, $adminlevel)";
				$q = mysqli_query($con, $q);
				if($q){
					$q = "delete from signups where username = '$username'";
					$q = mysqli_query($con, $q);
					if($q)
						header('Location: Userapproved.php');
					else
						die("Approve query error 54");
				}
				else
					die("Approve query error 57");
			}	
		}
		elseif(isset($_POST['app']))
			unset($_SESSION['wrongcode']);
	}
	else
	{
		die("Access denied or your session timed out");
	}
?>

<html>
<head>
	<title>Approve</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
	<div id="Approveblock">
		<h1>Appove user</h1>
		<p id='Approveuser'><?php echo $_POST['username']; ?></p>
		<form action="" method="post">
			<p class="Label">Enter approve code</p>
			<input class="input" type="text" name="approvecode">
			<span class="errors" id="Approvecodeerror"><?php if(isset($_SESSION['wrongcode'])) echo "Wrong approve code"; ?></span><br>
			<input type="hidden" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; else echo $_SESSION['approveuser']; ?>">
			<input class="alradio" type="radio" name="student" value='1' checked="true"><p class="Label">Student</p>
			<input class="alradio" type="radio" name="student" value='0'><p class="Label">Non-student</p><br>
			<p class='Label'>Admin level</p><br>
			<input class='alradio' type='radio' name='adminlevel' value='1'>1<br>
			<input class='alradio' type='radio' name='adminlevel' value='2'>2<br>
			<input class='alradio' type='radio' name='adminlevel' value='3' checked='true'>3<br>
			<input class='Approvebuttonf' id="Approvebuttonf" type='submit' name='approve' value='Approve'>
		</form>
	</div>
</body>
</html>