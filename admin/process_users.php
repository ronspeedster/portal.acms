<?php
    require_once('dbh.php');
    require_once('authenticate_user.php');

    if(isset($_SESSION['getURI'])){
        $getURI = $_SESSION['getURI'];
    }

    $currentDate = date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d H:i:s');
    $isEdit = false;

    //Add user
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

        $mysqli->query(" INSERT INTO users (first_name, middle_name, last_name, mailing_address, contact_num, email, birthday, pma_number, prc_number, expiration_date, field_of_practice, username, password) VALUES ('$first_name', '$middle_name', '$last_name', '$mailing_address', '$contact_num', '$email', '$birthday', '$pma_number', '$prc_number', '$expiration_date', '$field_of_practice', '$prc_number', '$password') ") or die ($mysqli->error);

        $_SESSION['message'] = "User ".$first_name." added!";
        $_SESSION['msg_type'] = "success";

        header("location: manage_users.php");
    }


    //Update user
    if(isset($_POST['update_user'])){
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
        $member_category = mysqli_real_escape_string($mysqli, $_POST['member_category']);

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
        member_category_id = '$member_category' 
        WHERE id = '$user_id' ") or die ($mysqli->error);
//        UPDATE `users` SET `field_of_practice` = '1' WHERE `users`.`id` = 8;

        $_SESSION['message'] = "User has been updated!";
        $_SESSION['msg_type'] = "success";

        header("location: manage_users.php");
    }

    //Delete User
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        mysqli_query($mysqli, "DELETE FROM users WHERE id = '$id' ");

        $_SESSION['message'] = "User has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: manage_users.php");
    }
    // Get user information when the URI is in edit mode
    if(isset($_GET['edit'])){
        $isEdit = true;
        $id = $_GET['edit'];
        $getUserInformation = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$id' ");
        $newUserInformation = $getUserInformation->fetch_array();
    }

    //! Update User level Access 
    if(isset($_POST['verify_user']))
    {
        $id         =   $_GET['id'] ?? null; 
        $password   =   $_POST['password'];
    
        if(authenticate_user(compact('password')))
        {
            // ! Perform Query Here; 
            $statement = $mysqli->prepare("UPDATE users SET 
                                            level_access=?
                                            WHERE id=?") or die ($mysqli->error);
    
            $access    =   "user"; 
            $statement->bind_param('si',  $access, $id); 
            $statement->execute(); 
    
            $_SESSION['msg_type'] =   'success';
            $_SESSION['message']  =   "User Access Level Changed to 'User'"; 
        }
        else 
        {
            $_SESSION['msg_type'] = 'danger'; 
            $_SESSION['errors']['auth'] = "User Authentication Failed"; 
        }

        header("location: manage_users.php?edit={$id}");
    } 

?>