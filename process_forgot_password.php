<?php 

require_once('./admin/vendor/autoload.php');
require_once('dbh.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function checkIfEmailExists($email) 
{
    global $mysqli; 

    if(mysqli_num_rows($mysqli->query("SELECT email FROM users WHERE email='$email'")) == 1) 
    {
        return true; 
    }

    return false; 
}

function insertToDatabase($email, $token) 
{
    global $mysqli; 

    $mysqli->query("DELETE FROM password_resets WHERE email='$email'") or die($mysqli->error); 
    $mysqli->query("INSERT INTO password_resets(email, token) VALUES('$email', '$token')") or die($mysqli->error); 
}

function sendEmail($email, $resetLink) 
{
    global $mysqli; 
   
    $setting    =    mysqli_fetch_assoc($mysqli->query("SELECT * FROM settings_email where is_default='1'")) or die($mysqli->error);
    
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;                    
    $mail->isSMTP();                                           
    
    $mail->Host       = $setting['host'];                     
    $mail->SMTPAuth   = $setting['auth'] == 1 ? true : false;          
    $mail->Username   = $setting['username'];                       
    $mail->Password   = $setting['password'];                      
    $mail->Port       = $setting['port'];                                  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    

    $mail->setFrom('1972acms@gmail.com', 'ACMS');

    $mail->addAddress($email);
    $mail->isHTML(true);                              
    $mail->Subject = 'ACMS Member Reset Password Request';
    $mail->Body    = "  <h1>
                            Greetings!
                        </h1>
                        <p>
                            You have requested a reset password from our system. Please click the link below in order to reset your password otherwise, ignore this email.
                        </p>
                        <a href='$resetLink'> 
                            Reset Password Link 
                        </a>  
                    ";

    $mail->send();
}


function generateToken() 
{
    return 	bin2hex(random_bytes(50));
}

function generateLink($token)
{
    global $siteUrl; 

    return $siteUrl . "password_reset.php?token=" . $token;  
}

if(isset($_POST['forgot_password']))
{
    $email = mysqli_escape_string($mysqli, trim(strtolower($_POST['email']))); 
    $errors = 0; 

    if(!checkIfEmailExists($email))
    {
        $_SESSION['errors']['email']  =  "Provided Email: {$email} does not exists in the system"; 
        $errors++; 
    }

    if($errors == 0)
    {
        $token      =   generateToken();
        $resetLink  =   generateLink($token); 

        insertToDatabase($email, $token);
        sendEmail($email,  $resetLink);  

        $_SESSION['message'] = "A Reset Password Email has been sent to {$email}. Please check your Email."; 
    }

    header("location: password_forgot.php"); 
}