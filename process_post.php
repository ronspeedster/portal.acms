<?php
	include('dbh.php');
//	$user_id =  $_SESSION['user_id'];

	if(isset($_SESSION['getURI'])){
		$getURI = $_SESSION['getURI'];
	}
	$currentDate = date_default_timezone_set('Asia/Manila');
	$currentDate = date('Y-m-d H:i:s');

	if(isset($_POST['status_post'])){
		$status_post = $_POST['status_text'];
		$status_safety = $_POST['status_safety'];
		$client_lng = $_POST['client_lng'];
		$client_lat = $_POST['client_lat'];
		$user_location = $_POST['user_location'];
		$status_post = str_replace('"', "", $status_post);
		$status_post = str_replace("'", "", $status_post);
		$mysqli->query(" INSERT INTO user_posts ( user_id, user_status, user_post, user_long, user_lat, user_location, date_added /*, user_location */) 
		VALUES('$user_id', '$status_safety', '$status_post', '$client_lng' ,'$client_lat', '$user_location','$currentDate' ) ") or die ($mysqli->error());
		
		$_SESSION['message'] = "Status posted!";
		$_SESSION['msg_type'] = "success";
		
		header("location: index.php");
	}

	if(isset($_GET['addlink'])){
		$link_id = $_GET['addlink'];
		$mysqli->query(" INSERT INTO user_links ( from_user_id, to_user_id /*, user_location */) VALUES('$user_id','$link_id' ) ") or die ($mysqli->error());


		$_SESSION['message'] = "Link Request sent!";
		$_SESSION['msg_type'] = "success";

		header("location: ".$getURI);		
	}

	if(isset($_GET['confirmfromlink'])){
		$confirmfromlink = $_GET['confirmfromlink'];
		$tolink = $_GET['tolink'];
		$mysqli->query("UPDATE user_links SET linked='true' WHERE from_user_id='$confirmfromlink' AND to_user_id='$tolink' ") or die ($mysqli->error());
		
		$_SESSION['message'] = "Link Confirmed!";
		$_SESSION['msg_type'] = "success";			
		
		header("location: ".$getURI);
	}
?>