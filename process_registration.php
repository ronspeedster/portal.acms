<?php
	include('dbh.php');
	include('check_registration_errors.php');
	
	if(isset($_POST['register'])){

		$firstName        = trim(strtoupper($_POST['firstName']));
		$middleName       = trim(strtoupper($_POST['middleName']));
		$lastName         = trim(strtoupper($_POST['lastName']));
		$birthDate        = trim($_POST['birthDate']);
		$mailingAddress   = trim(strtoupper($_POST['mailingAddress']));
		$contactNumber    = trim($_POST['contactNumber']);
		$email            = trim($_POST['email']);
		$pmaNumber        = trim($_POST['pmaNumber']);
		$prcNumber        = trim($_POST['prcNumber']);
		$expirationDate   = trim($_POST['expirationDate']);
		$field            = trim(strtoupper($_POST['field']));
		$username         = trim($_POST['username']);
		$password         = trim($_POST['password']);
		$confirm_password = trim($_POST['confirm_password']);

		$checkUser 		  = $mysqli->query("SELECT * FROM users WHERE email='$email' ");
	
		$errors 		  = checkRegistrationErrors(
								[
									"checkUser"		   => $checkUser, 
									"firstName"        => $firstName,
									"middleName"       => $middleName,
									"lastName"         => $lastName,
									"birthDate"        => $birthDate,
									"mailingAddress"   => $mailingAddress,
									"contactNumber"    => $contactNumber,
									"email"            => $email,
									"pmaNumber"        => $pmaNumber,
									"prcNumber"        => $prcNumber,
									"expirationDate"   => $expirationDate,
									"field"            => $field,
									"username"         => $username,
									"password"         => $password,
									"confirm_password" => $confirm_password,
								]
							);
				
		if($errors > 0)
		{
			$urlString	=	"firstName={$firstName}&email={$email}&lastName={$lastName}&middleName={$middleName}&birthDate={$birthDate}&mailingAddress={$mailingAddress}&contactNumber={$contactNumber}&email={$email}&pmaNumber={$pmaNumber}&prcNumber={$prcNumber}&expirationDate={$expirationDate}&field={$field}&username={$username}";
			header("location: register.php?{$urlString}");
		}
		else 
		{

			//! Todo: Add auto assigned Payments to Usesrs 

			//! Todo: Transition to Prepared Statements
			$default_access = "temporary"; 
			$mysqli->query("INSERT INTO users ( first_name, middle_name, last_name, mailing_address, contact_num, email, birthday, pma_number, prc_number, expiration_date, field_of_practice, username, password, level_access) VALUES('$firstName','$middleName','$lastName','$mailingAddress', '$contactNumber', '$email', '$birthDate', '$pmaNumber', '$prcNumber', '$expirationDate', '$field', '$username', '$password', '$default_access') ") or die ($mysqli->error);
	
			$_SESSION['loginError'] = "User Account Creation Successful!";
			header("location: login.php");
		}

		
	}

	// Login Details for users
	if(isset($_POST['login'])){
//		 $email = strtolower($_POST['email']);
		 $username = strtolower($_POST['username']);
		 $password = $_POST['password'];
		 $checkUser = $mysqli->query("SELECT * FROM users WHERE username='$username' AND password='$password' ");

		if(mysqli_num_rows($checkUser)==0){
			$_SESSION['loginError'] = "Login error. Please try again";
			header("location: login.php?email=".$username);
		}
		else{
			$newCheckUser = $checkUser->fetch_array();
			 $_SESSION['level_access'] = $newCheckUser['level_access'];
			 $_SESSION['email'] = $newCheckUser['email'];
			 $_SESSION['is_update'] = $newCheckUser['is_update'];
			 $_SESSION['full_name'] = $newCheckUser['first_name'].' '.$newCheckUser['last_name'];
			 $_SESSION['user_id'] = $newCheckUser['id'];
			 $_SESSION['profile_image'] = $newCheckUser['profile_image'];
			header("location: index.php");
		}
	}


	// Reset Password
	if(isset($_POST['reset_password'])){
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$checkUser = $mysqli->query("SELECT * FROM users WHERE email='$email' ");
		if(mysqli_num_rows($checkUser)==0){
			$_SESSION['registerError'] = "No email registered. Please contact ACMS support.";
			header("location: forgot-password.php");
		}
		else{
			//$token = "resetPasswordThisAccount".$email;
			$token = bin2hex(random_bytes(50));
			$mysqli->query(" INSERT INTO password_reset ( email, token ) VALUES('$email','$token') ") or die ($mysqli->error());

			$to = $email;
			$subject = "Reset your password on ACMS Portal";
			$msg = "Hi there, to reset your password kindly click the ffg: https://member.acms.com/password-reset.php?token=".$token;
			$msg = wordwrap($msg,70);
			$headers = "From: ronieB03@gmail.com";
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