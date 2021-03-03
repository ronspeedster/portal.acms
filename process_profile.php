<?php
	include("dbh.php");
	$user_id =  $_SESSION['user_id'];
	if(isset($_SESSION['getURI'])){
		$getURI = $_SESSION['getURI'];
	}

	if(isset($_POST['upload_photo'])){
		$currentDate = date_default_timezone_set('Asia/Manila');
		$currentDate = date('Y-m-d-H-i-s');

		$newName = 'PhotoID-'.$user_id.$currentDate;

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
			$_SESSION['message'] = "There was an error uploading the image receipt!";
			$_SESSION['msg_type'] = "danger";
		}
	}

?>