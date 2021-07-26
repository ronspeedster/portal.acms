<?php 

require_once('vendor/autoload.php');
require_once('dbh.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function checkErrors($data)
{
    global $mysqli; 
    $errors = 0; 

    if(empty($data['name']))
    {
        $_SESSION['errors']['name'] = "Name is required"; 
        $errors++;
    }
    else 
    {
        $name = $data['name']; 

        if(isset($data['id']))
        {
            $id = $data['id']; 
            $rows = mysqli_num_rows($mysqli->query("SELECT * FROM settings_notification WHERE name='$name' AND id != '$id'"));
        }
        else 
        {
            $rows = mysqli_num_rows($mysqli->query("SELECT * FROM settings_notification WHERE name='$name'"));
        }

        if($rows > 0)
        {
            $_SESSION['errors']['name'] = "Name is already taken"; 
            $errors++;
        }
    }

    return $errors; 
}

if(isset($_POST['create_setting'])) 
{
    $name       = mysqli_escape_string($mysqli, trim(strtolower($_POST['name'])));
    $email_to   = !empty($_POST['email_to']) ? mysqli_escape_string($mysqli, trim(strtolower($_POST['email_to']))) : null;   

    $errors     = checkErrors(compact('name')); 

    if($errors == 0)
    {
        $statement = $mysqli->prepare("INSERT INTO settings_notification 
                                        (name, is_active, email_to)
                                        VALUES (?, ?, ?)
                                    ") or die($mysqli->error);

        $active     = isset($_POST['is_active']) ? true : false; 

        $statement->bind_param('sis', $name,$active, $email_to); 
        $statement->execute(); 
        
        $_SESSION['message'] = "Setting Created Successfully";
    }

    header('location: manage_notification_settings.php');
}

if(isset($_POST['update_setting']))
{
    $id         = mysqli_escape_string($mysqli, trim(strtoupper($_POST['id']))); 
    
    $name       = mysqli_escape_string($mysqli, trim(strtolower($_POST['name'])));
    $email_to   = !empty($_POST['email_to']) ? mysqli_escape_string($mysqli, trim(strtolower($_POST['email_to']))) : null;   

    $errors     = checkErrors(compact('name', 'id')); 

    if($errors == 0)
    {
        $statement = $mysqli->prepare("UPDATE settings_notification SET 
                                            name=?, 
                                            is_active=?,
                                            email_to=?,
                                            updated_at=? 
                                        WHERE 
                                            id = ?"
                                    ) or die($mysqli->error);

        $active     = isset($_POST['is_active']) ? true : false; 

        $statement->bind_param('sissi', $name,$active, $email_to, $currentDate,  $id); 
        $statement->execute(); 
        
        $_SESSION['message'] = "Setting Updated Successfully";
    }

    header("location: view_notification_setting.php?setting_id={$id}");
}

if(isset($_POST['delete_setting']))
{
    $id = mysqli_escape_string($mysqli, trim(strtoupper($_POST['id']))); 
    
    $mysqli->query("DELETE FROM settings_notification WHERE id='$id'") or die($mysqli->error);

    $_SESSION['message'] =  "Notification Setting Deleted";

    header("location: manage_notification_settings.php");

}