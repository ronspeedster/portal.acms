<?php
	include('dbh.php');
	
	if(isset($_POST['register'])){
		$fname = ucfirst($_POST['fname']);
		$lname = ucfirst($_POST['lname']);
		$email = strtolower($_POST['email']);
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		$checkUser = $mysqli->query("SELECT * FROM users WHERE email='$email' ");
		if(mysqli_num_rows($checkUser)>0){
			$_SESSION['registerError'] = "Email already taken. Please try another.";
			header("location: register.php?fname=".$fname."&lname=".$lname);
		}
		else if($password1!=$password2){
			$_SESSION['registerError'] = "Password not match. Please try again.";
			header("location: register.php?fname=".$fname."&lname=".$lname."&email=".$email);
		}
		else{
			$mysqli->query(" INSERT INTO users ( firstname, lastname, email, password) VALUES('$fname','$lname','$email','$password1') ") or die ($mysqli->error());

			$_SESSION['loginError'] = "User Account Creation Successful!";
			header("location: login.php");
		}
	}

	// Login Details for users
	if(isset($_POST['login'])){
		 $email = strtolower($_POST['email']);
		 $password = $_POST['password'];
		 $checkUser = $mysqli->query("SELECT * FROM users WHERE email='$email' AND password='$password' ");

		if(mysqli_num_rows($checkUser)==0){
			$_SESSION['loginError'] = "Login error. Please try again";
			header("location: login.php?email=".$email);
		}
		else{
			$newCheckUser = $checkUser->fetch_array();
			 $_SESSION['level_access'] = $newCheckUser['level_access'];
			 $_SESSION['email'] = $newCheckUser['email'];
			 $_SESSION['full_name'] = $newCheckUser['firstname'].' '.$newCheckUser['lastname'];
			 $_SESSION['user_id'] = $newCheckUser['id'];
			 $_SESSION['profile_image'] = $newCheckUser['profile_image'];
			header("location: index.php");
		}
	}

	if(isset($_POST['reset_password'])){
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$checkUser = $mysqli->query("SELECT * FROM users WHERE email='$email' ");
		if(mysqli_num_rows($checkUser)==0){
			$_SESSION['registerError'] = "No email registered. Please create an account";
			header("location: forgot-password.php");
		}
		else{
			//$token = "resetPasswordThisAccount".$email;
			$token = bin2hex(random_bytes(50));
			$mysqli->query(" INSERT INTO password_reset ( email, token ) VALUES('$email','$token') ") or die ($mysqli->error());

			$to = $email;
			$subject = "Reset your password on LNTDMP";
			$msg = "Hi there, to reset your password kindly click the ffg: https://lntdmp.ausmxgp.com/password-reset.php?token=".$token;
			$msg = wordwrap($msg,70);
			$headers = "From: akheala22@gmail.com";
			mail($to, $subject, $msg, $headers);

			$_SESSION['loginError'] = "Password instruction sent to your email account. Please check you inbox or spam folder.";
			header("location: login.php");
		}

	}

	if(isset($_POST['new_password'])){
		$token = $_POST['token'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		if($password1!=$password2){
			$_SESSION['registerError'] = "Password not match. Please try again.";
			header("location: password-reset.php?token=".$token);
		}
		else{
			$getEmail = $mysqli->query(" SELECT email FROM password_reset WHERE token = '$token' LIMIT 1 ") or die ($mysqli->error());
			$email = mysqli_fetch_assoc($getEmail)['email'];

			if($email){
				$mysqli->query(" UPDATE users SET password='$password1' WHERE email='$email' ") or die ($mysqli->error());
				$_SESSION['loginError'] = "Changing password successful. Please login.";
				
				$to = $email;
				$subject = "Password change in LNTDMP";
				$msg = "This is a notice that your password was changed.";
				$msg = wordwrap($msg,70);
				$headers = "From: akheala22@gmail.com";
				mail($to, $subject, $msg, $headers);
				header('location: index.php');
			}
			else{
				$mysqli->query(" UPDATE users SET password='$password1' WHERE email='$email' ") or die ($mysqli->error());
				$_SESSION['loginError'] = "Changing password successful. Please login.";
				header('location: index.php');

				/* Email password changed successful */
				$to = $email;
				$subject = "Password change in LNTDMP";
				$msg = "This is a notice that your password was changed.";
				$msg = wordwrap($msg,70);
				$headers = "From: akheala22@gmail.com";
				mail($to, $subject, $msg, $headers);
				/* Email password changed successful */
				header('location: index.php');
			}
		}

	}
?>