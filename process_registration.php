<?php
include('dbh.php');
include('check_registration_errors.php');

if(isset($_POST['register']))
{

	$firstName        = trim(strtoupper($_POST['firstName']));
	$middleName       = trim(strtoupper($_POST['middleName']));
	$lastName         = trim(strtoupper($_POST['lastName']));
	$birthDate        = trim($_POST['birthDate']);
	$mailingAddress   = trim(strtoupper($_POST['mailingAddress']));
	$contactNumber    = trim($_POST['contactNumber']);
	$email            = trim(strtolower($_POST['email']));
	$pmaNumber        = trim($_POST['pmaNumber']);
	$prcNumber        = trim($_POST['prcNumber']);
	$expirationDate   = trim($_POST['expirationDate']);
	$field            = trim(strtoupper($_POST['field']));
	$username         = trim($_POST['username']);
	$password         = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	$checkUser 		  = $mysqli->query("SELECT * FROM users WHERE email='$email' ");

	$errors 		  = checkRegistrationErrors(
							compact(
								"checkUser",		   
								"firstName",       
								"middleName",      
								"lastName",       
								"birthDate",       
								"mailingAddress",
								"contactNumber",
								"email",       
								"pmaNumber",       
								"prcNumber",      
								"expirationDate",
								"field",       
								"username",       
								"password",       
								"confirm_password"
							)
						);
			
	if($errors > 0)
	{
		$urlString	=	"firstName={$firstName}&email={$email}&lastName={$lastName}&middleName={$middleName}&birthDate={$birthDate}&mailingAddress={$mailingAddress}&contactNumber={$contactNumber}&email={$email}&pmaNumber={$pmaNumber}&prcNumber={$prcNumber}&expirationDate={$expirationDate}&field={$field}&username={$username}";
		header("location: register.php?{$urlString}");
	}
	else 
	{
		$query 					 =  mysqli_fetch_assoc($mysqli->query("SELECT id FROM member_category WHERE is_default='1'"));
		$default_member_category =  $query['id'];

		// !Transition to Prepared Statements
		$default_access = "temporary"; 
		$statement 	=	$mysqli->prepare("INSERT INTO users( 
											first_name, 
											middle_name, 
											last_name, 
											mailing_address, 
											contact_num, 
											email, 
											birthday, 
											pma_number, 
											prc_number, 
											expiration_date, 
											field_of_practice, 
											username, 
											password, 
											level_access,
											member_category_id) 
											VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ") 
											or die ($mysqli->error);

		$statement->bind_param('ssssssssssssssi', 
								$firstName, 
								$middleName, 
								$lastName, 
								$mailingAddress, 
								$contactNumber, 
								$email, 
								$birthDate, 
								$pmaNumber, 
								$prcNumber, 
								$expirationDate, 
								$field, 
								$username, 
								$password, 
								$default_access,
								$default_member_category);
								
		$statement->execute(); 
		
		$user_id	=	$statement->insert_id; 
		
		// !Add auto assigned Payments to Users 
		$auto_payments = $mysqli->query('SELECT * FROM payments WHERE deleted_at is NULL AND auto_assign=1');

		foreach($auto_payments as $payment)
		{
			$statement = $mysqli->prepare("INSERT INTO user_payments (user_id, payment_id) VALUES (?, ?)"); 
			$statement->bind_param("ii", $user_id, $payment['id']); 
			$statement->execute(); 
		} 

		$_SESSION['loginError'] = "User Account Creation Successful!";
		header("location: login.php");
	}		
}

// Login Details for users
if(isset($_POST['login']))
{
//		 $email = strtolower($_POST['email']);
		$username = strtolower($_POST['username']);
		$password = $_POST['password'];
		$checkUser = $mysqli->query("SELECT * FROM users WHERE username='$username' AND password='$password' ");

	if(mysqli_num_rows($checkUser)==0)
	{
		$_SESSION['loginError'] = "Login error. Please try again";
		header("location: login.php?email=".$username);
	}
	else
	{
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
?>
