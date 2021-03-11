<?php
	include("dbh.php");
	$user_id =  $_SESSION['user_id'];
	if(isset($_SESSION['getURI'])){
		$getURI = $_SESSION['getURI'];
	}

	if(isset($_POST['upload_photo'])){
		$currentDate = date_default_timezone_set('Asia/Manila');
		$currentDate = date('Y-m-d-H-i-s');

		$newName = 'PhotoID-'.$user_id.'-'.$currentDate;

		// get details of the uploaded file
		$fileTmpPath = $_FILES['profile_image']['tmp_name'];
		$fileName = $_FILES['profile_image']['name'];
		$fileSize = $_FILES['profile_image']['size'];
		$fileType = $_FILES['profile_image']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		//print_r($fileNameCmps);
		$newFileName = $newName . '.' . $fileExtension;
		//print_r($newFileName);

		// directory in which the uploaded file will be moved
		$uploadFileDir = 'img/assets/';
		$dest_path = $uploadFileDir . $newFileName;

		if(move_uploaded_file($fileTmpPath, $dest_path))
		{		
			$_SESSION['message'] = "Profile Image changed successful!";
			$_SESSION['msg_type'] = "success";

			$mysqli->query("UPDATE users SET profile_image ='$dest_path' WHERE id='$user_id' ") or die ($mysqli->error());
			header("location: ".$getURI);
		}
		else{
			$_SESSION['message'] = "There was an error uploading the image!";
			$_SESSION['msg_type'] = "danger";
		}
	}

	if(isset($_POST['update_profile'])){
        $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
        $first_name = mysqli_real_escape_string($mysqli, $_POST['fname']);
        $middle_name = mysqli_real_escape_string($mysqli, $_POST['mname']);
        $last_name = mysqli_real_escape_string($mysqli, $_POST['lname']);
        $mailing_address = mysqli_real_escape_string($mysqli, $_POST['mailing_address']);
        $contact_num = mysqli_real_escape_string($mysqli, $_POST['contact_num']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $birthday = mysqli_real_escape_string($mysqli, $_POST['birthday']);
        $pma_number = mysqli_real_escape_string($mysqli, $_POST['pma_number']);
        $prc_number= mysqli_real_escape_string($mysqli, $_POST['prc_number']);
        $expiration_date = mysqli_real_escape_string($mysqli, $_POST['expiration_date']);
        $field_of_practice = mysqli_real_escape_string($mysqli, $_POST['field_of_practice']);

        $password = substr($prc_number, -4);

        $date = date_create($birthday);
        $birthday =  date_format($date,"Y-m-d");

        $date = date_create($expiration_date);
        $expiration_date =  date_format($date,"Y-m-d");

        $mysqli->query(" UPDATE users SET
        first_name = '$first_name',
        middle_name = '$middle_name',
        last_name = '$last_name',
        mailing_address = '$mailing_address',
        contact_num = '$contact_num',
        email = '$email',
        birthday = '$birthday',
        pma_number = '$pma_number',
        prc_number = '$prc_number',
        expiration_date = '$expiration_date',
        field_of_practice = '$field_of_practice',
        is_update = '1'
        WHERE id = '$user_id' ") or die ($mysqli->error);

        $_SESSION['message'] = "User has been updated!";
        $_SESSION['msg_type'] = "success";

        header("location: profile.php");
    }

?>