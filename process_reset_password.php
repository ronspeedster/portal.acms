<?php 

require_once('./admin/vendor/autoload.php');
require_once('dbh.php'); 

function checkIfPasswordConfirmed($password, $passwordConfirm)
{
    return $password == $passwordConfirm; 
}

function checkIfRecordExists($email, $token)
{
    global $mysqli; 

    if(mysqli_num_rows($mysqli->query("SELECT * FROM password_resets WHERE email='$email' AND token='$token'")) == 1) 
    {
        return true; 
    }

    return false; 
}

function updatePassword($email, $password)
{
    global $mysqli; 

    $mysqli->query("UPDATE users SET password='$password' WHERE email='$email'") or die($mysqli->error); 
    $mysqli->query("DELETE FROM password_resets WHERE email='$email'") or die($mysqli->error); 
}

function login($email, $password) 
{
    global $mysqli; 

    $user   =   mysqli_fetch_assoc($mysqli->query("SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1")) or die($mysqli->error);  

    $_SESSION['level_access']   = $user['level_access'];
    $_SESSION['email']          = $user['email'];
    $_SESSION['is_update']      = $user['is_update'];
    $_SESSION['full_name']      = $user['first_name'].' '.$user['last_name'];
    $_SESSION['user_id']        = $user['id'];
    $_SESSION['profile_image']  = $user['profile_image'];
}

if(isset($_POST['reset_password']))
{
    $token              = mysqli_escape_string($mysqli, trim($_POST['_token'])); 
    $email              = mysqli_escape_string($mysqli, trim(strtolower($_POST['email']))); 
    $password           = mysqli_escape_string($mysqli, trim($_POST['password'])); 
    $passwordConfirm    = mysqli_escape_string($mysqli, trim($_POST['password_confirm']));
    
    $errors = 0; 

    if(!checkIfPasswordConfirmed($password, $passwordConfirm))
    {
        $_SESSION['errors']['password'] = "Passwords do not Match"; 
        $errors++; 
    }

    if(!checkIfRecordExists($email, $token))
    {
        $_SESSION['errors']['record'] = "Email and Token Combination do not Exist or may have expired"; 
        $errors++;
    }

    if($errors == 0)
    {
        updatePassword($email, $password); 
        login($email, $password); 

        $_SESSION['message']    = "Password was reset Successfully"; 
        $_SESSION['msg_type']   = "success"; 
        
        header("location: index.php");
    }
    else 
    {
        header("location: password_reset.php?token={$token}");
    }


}

