<?php
    require_once('dbh.php');

    if(isset($_SESSION['getURI'])){
        $getURI = $_SESSION['getURI'];
    }
    $currentDate = date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d H:i:s');

    if(isset($_POST['add_user'])){
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

        $mysqli->query(" INSERT INTO users (first_name, middle_name, last_name, mailing_address, contact_num, email, birthday, pma_number, prc_number, expiration_date, field_of_practice, password) VALUES ('$first_name', '$middle_name', '$last_name', '$mailing_address', '$contact_num', '$email', '$birthday', '$pma_number', '$prc_number', '$expiration_date', '$field_of_practice', '$password') ") or die ($mysqli->error);

        $_SESSION['message'] = "User added!";
        $_SESSION['msg_type'] = "success";

        header("location: manage_users.php");
    }
?>