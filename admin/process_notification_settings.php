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

if(isset($_POST['test_setting']))
{
    $id         =   mysqli_escape_string($mysqli, trim(strtoupper($_POST['id']))); 

    $setting    =   mysqli_fetch_assoc($mysqli->query("SELECT * FROM settings_email where is_default='1'")) or die($mysqli->error);
    $email      =   mysqli_fetch_assoc($mysqli->query("SELECT * FROM settings_notification where id='$id'")) or die($mysqli->error); 

    if($email['email_to'] != null && $email['is_active'] != 0)
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;                    
        $mail->isSMTP();                                           
        
        $mail->Host       = $setting['host'];                     
        
        $mail->SMTPAuth   = $setting['auth'] == 1 ? true : false;                                 
        
        $mail->Username =  $setting['username'];
        $mail->Password =  $setting['password'];                      
    
        $mail->Port     = $setting['port'];                                  
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
    
        $mail->setFrom('1972acms@gmail.com', 'ACMS');
    
        $mail->addAddress($email['email_to']);
        $mail->isHTML(true);                              
        $mail->Subject = "Test {$email['name']} Email Notification";
        $mail->Body    = "Hello This is a test notification email sent to the 'email to' address that you provided";
    
        $_SESSION['message'] = "Email sent to {$email['email_to']}, Test Notifications sent to Admins";
        
        $admins     = $mysqli->query("SELECT id FROM users WHERE level_access='admin'"); 

        $message    = "An admin tested the notification system";

        foreach($admins as $admin)
        {
            $user_id = $admin['id'];
            $mysqli->query("INSERT INTO user_notifications (user_id, notification) VALUES ('$user_id', '$message')") or die($mysqli->error);
        }

        $mail->send();
    }
    else 
    {
        $_SESSION['errors']['email'] = "Email to is Empty or Setting is not set to Active"; 
    }

    header("location: view_notification_setting.php?setting_id={$id}");
}