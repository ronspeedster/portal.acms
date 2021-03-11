<?php
require_once('dbh.php');

if(isset($_SESSION['getURI'])){
    $getURI = $_SESSION['getURI'];
}

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');
$isEdit = false;

//Add Candidate
//if(isset($_POST['cast_vote'])){
//    $first_name = mysqli_real_escape_string($mysqli, $_POST['fname']);
//    $middle_name = mysqli_real_escape_string($mysqli, $_POST['mname']);
//    $last_name = mysqli_real_escape_string($mysqli, $_POST['lname']);
//    $last_name = $last_name. ' M.D';
//
//    $mysqli->query(" INSERT INTO candidates (first_name, middle_name, last_name) VALUES ('$first_name', '$middle_name', '$last_name') ") or die ($mysqli->error);
//
//    $_SESSION['message'] = "Vote(s) have been uploaded!";
//    $_SESSION['msg_type'] = "success";
//
//    header("location: index.php");
//}

if(isset($_POST['cast_vote'])) {
    $votes = $_POST['candidate'];
    $user_id = $_SESSION['user_id'];
    foreach ($votes as $vote){
//        echo $vote."<br />";
        $mysqli->query(" INSERT INTO tally (voter_id, candidate_id) VALUES ($user_id, $vote) ") or die ($mysqli->error);
    }

    $_SESSION['message'] = "Votes has been uploaded!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}


//Update Candidate
if(isset($_POST['update_user'])){
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $first_name = mysqli_real_escape_string($mysqli, $_POST['fname']);
    $middle_name = mysqli_real_escape_string($mysqli, $_POST['mname']);
    $last_name = mysqli_real_escape_string($mysqli, $_POST['lname']);
    $last_name = $last_name. ' M.D';

    $mysqli->query(" UPDATE candidates SET
        first_name = '$first_name',
        middle_name = '$middle_name',
        last_name = '$last_name'
        WHERE id = '$user_id' ") or die ($mysqli->error);


    $_SESSION['message'] = "Candidate information has been updated!";
    $_SESSION['msg_type'] = "success";

    header("location: manage_candidates.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query(" DELETE FROM candidates WHERE id = '$id' ") or die ($mysqli->error);

    $_SESSION['message'] = "Candidate information has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: manage_candidates.php");
}


// Get user information when the URI is in edit mode
if(isset($_GET['edit'])){
    $isEdit = true;
    $id = $_GET['edit'];
    $getUserInformation = mysqli_query($mysqli, "SELECT * FROM candidates WHERE id = '$id' ");
    $newUserInformation = $getUserInformation->fetch_array();
}

?>