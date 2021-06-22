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
    $errors = 0; 

    if(empty($data['name']))
    {
        $_SESSION['errors']['name'] = "Name is required"; 
        $errors++;
    }

    if(empty($data['host']))
    {
        $_SESSION['errors']['host'] = "Host is required"; 
        $errors++;
    }

    if(empty($data['username']))
    {
        $_SESSION['errors']['username'] = "Username is required"; 
        $errors++;
    }

    if(empty($data['password']))
    {
        $_SESSION['errors']['password'] = "Password is required"; 
        $errors++;
    }

    if(empty($data['port']))
    {
        $_SESSION['errors']['port'] = "Port is required"; 
        $errors++;
    }

    return $errors; 
}

function setSettingByDefault($id)
{
    global $mysqli; 

    $mysqli->query("UPDATE settings_email SET is_default='0' WHERE is_default='1'") or die($mysqli->error);
    $mysqli->query("UPDATE settings_email SET is_default='1' WHERE id='$id'") or die($mysqli->error);
}

if(isset($_POST['create_setting'])) 
{
    $name       = mysqli_escape_string($mysqli, trim(strtolower($_POST['name'])));
    $host       = mysqli_escape_string($mysqli, trim(strtolower($_POST['host'])));
    $username   = mysqli_escape_string($mysqli, trim($_POST['username']));
    $password   = mysqli_escape_string($mysqli, trim($_POST['password']));
    $port       = mysqli_escape_string($mysqli, trim($_POST['port']));


    $errors     = CheckErrors(compact(
                            'name', 
                            'host', 
                            'username', 
                            'password', 
                            'port')
                    );

    if($errors == 0)
    {
        $statement = $mysqli->prepare("INSERT INTO settings_email 
                                        (name, host, username, password, port, auth)
                                        VALUES (?, ?, ?, ?, ?, ?)
                                    ") or die($mysqli->error);

        $auth   = isset($_POST['auth']) ? true : false; 

        $statement->bind_param('ssssii', $name, $host, $username, $password, $port, $auth); 
        $statement->execute(); 
        
        $_SESSION['message'] = "Setting Created Successfully";

        if(isset($_POST['default']))
        {
            $id = $statement->insert_id; 
            setSettingByDefault($id);

            $_SESSION['message'] .=  ". Setting Set by default";
        }
    }

    header('location: manage_email_settings.php');
}

if(isset($_POST['update_setting']))
{
    $name       = mysqli_escape_string($mysqli, trim(strtolower($_POST['name'])));
    $host       = mysqli_escape_string($mysqli, trim(strtolower($_POST['host'])));
    $username   = mysqli_escape_string($mysqli, trim($_POST['username']));
    $password   = mysqli_escape_string($mysqli, trim($_POST['password']));
    $port       = mysqli_escape_string($mysqli, trim($_POST['port']));
    $id         = mysqli_escape_string($mysqli, trim($_POST['id']));


    $errors     = CheckErrors(compact(
                            'name', 
                            'host', 
                            'username', 
                            'password', 
                            'port')
                    );

    if($errors == 0)
    {
        $statement = $mysqli->prepare("UPDATE settings_email SET 
                                            name=?, 
                                            host=?, 
                                            username=?, 
                                            password=?, 
                                            port=?, 
                                            auth=?,
                                            updated_at=? 
                                        WHERE 
                                            id = ?"
                                     ) or die($mysqli->error);

        $auth   = isset($_POST['auth']) ? true : false; 

        $statement->bind_param('ssssiisi', $name, $host, $username, $password, $port, $auth, $currentDate, $id); 
        $statement->execute(); 
        
        $_SESSION['message'] = "Setting Updated Successfully";

        if(isset($_POST['default']))
        {
            setSettingByDefault($id);

            $_SESSION['message'] .=  ". Setting Set by default";
        }
    }

    header("location: view_email_setting.php?setting_id={$id}");
}

if(isset($_POST['delete_setting']))
{
    $id = mysqli_escape_string($mysqli, trim(strtoupper($_POST['id']))); 
    
    $mysqli->query("DELETE FROM settings_email WHERE id='$id'") or die($mysqli->error);

    $_SESSION['message'] =  "Email Setting Deleted";

    header("location: manage_email_settings.php");
  
}

if(isset($_POST['test_setting']))
{
    $id = mysqli_escape_string($mysqli, trim(strtoupper($_POST['id']))); 

    $setting = mysqli_fetch_assoc($mysqli->query("SELECT * FROM settings_email where id='$id'")) or die($mysqli->error);

    //! Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //* Enable verbose debug output
    $mail->SMTPDebug = 2;                    
    
    //* Send using SMTP
    $mail->isSMTP();                                           
    
    //* Set the SMTP server to send through
    $mail->Host       = $setting['host'];                     
    
    //* Enable SMTP authentication
    $mail->SMTPAuth   = $setting['auth'] == 1 ? true : false;                                 
    
    //* SMTP username && password
    $mail->Username =  $setting['username'];
    $mail->Password =  $setting['password'];                      

    //* TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Port     = $setting['port'];                                  
    
    //* Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    

    //* Recipients
    $mail->setFrom('1972acms@gmail.com', 'ACMS');

    $mail->addAddress($_SESSION['email'], $_SESSION['full_name']);
    $mail->isHTML(true);                              
    $mail->Subject = 'ACMS Test Email';
    $mail->Body    = "<h1>Hello, {$_SESSION['full_name']}! This a test email</h1>";

    $mail->send();
    
    $_SESSION['message'] = "Email sent to {$_SESSION['email']}"; 

    header("location: view_email_setting.php?setting_id={$id}");
}