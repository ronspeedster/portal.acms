<?php 

require_once('vendor/autoload.php');
require_once('dbh.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$query = $mysqli->query("SELECT * FROM settings_email where is_default='1'") or die($mysqli->error);

if(mysqli_num_rows($query) == 0 )
{
    $_SESSION['errors']['email'] = "No Default Email Setting found. Please create one or set one by default"; 
  
    header("location: manage_email_settings.php");    
}

$setting = $query->fetch_assoc();

try 
{
    //! Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //* Enable verbose debug output
    $mail->SMTPDebug = false;                    
    
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

    //* Add a recipient
    //$mail->addAddress('joe@example.net', 'Joe User');     

    //* Name is optional
    //$mail->addAddress('ellen@example.com');             
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //! Attachments
    
    //* Add attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');        
    
    //* Optional name
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

    //! Content

    //* Set email format to HTML
    //$mail->isHTML(true);                              
    //$mail->Subject = 'Here is the subject';
    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //$mail->send();
} 
catch (Exception $e) 
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

if(isset($_POST['verify_payment_certificate']))
{
    $id = $_POST['id'];

    $user       =    mysqli_fetch_assoc($mysqli->query("SELECT   
                        pma_number,
                        email,
                        CONCAT(last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                    FROM users
                    WHERE id='$id'")
                    ) or die($mysqli->error); 

    $cert       =   mysqli_fetch_assoc($mysqli->query("SELECT * from certificates WHERE name='GOOD STANDING'")) or die ($mysqli->error);  
    $holder     =   $cert['holder'];
    $cert       =   $cert['signature'];

    //* Add a recipient

    if(!empty($user['email']))
    {
        $mail->addAddress($user['email'], $user['fullname']);
        
        $mail->AddEmbeddedImage('../pdf/acms.png', 'acms_logo');
        $mail->AddEmbeddedImage('../pdf/pma.png', 'pma_logo');
        $mail->AddEmbeddedImage("../storage/certificate/{$cert}", 'cert_signature');
    
        $css = file_get_contents("../css/sb-admin-2.min.css"); 
        $mail->isHTML(true);                              
        $mail->Subject = 'Verified Payment Certificate';
        $mail->Body    = "<!DOCTYPE html>
                            <html lang='en'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <title>CERTIFICATE OF GOOD STANDING</title>
                                <style>
                                    {$css}
                                </style>
                            </head>
                            <body>
                            <div class='m-4 p-2'>
                                <header class='h-25 mb-2'>
                                    <div class='d-flex justify-content-between'>
                                        <span>
                                            <img src='cid:acms_logo' width='150px' height='150px'>
                                        </span>
                                        <div class='text-center'>
                                            <h2 class='font-weight-bold'>ANGELES CITY MEDICAL SOCIETY</h2>
                                            <p>Founded in 1972</p>
                                            <p>Component Society of the Philippine Medical Association</p>
                                        </div>
                                        <span class='float-right'>
                                            <img src='cid:pma_logo' width='150px' height='150px'>
                                        </span>
                                    </div>
                                </header>
                                <hr>
                                <main class='my-5'>
                                    <h2 class='text-center font-weight-bold mb-2'>CERTIFICATE OF GOOD STANDING</h2>
                                    <br>
                                    <p class='text-justify text-height-5 mt-4'>
                                        This is to certify that <strong class='font-weight-bold'>{$user['fullname']} </strong> of the Angeles City Medical Society, 
                                        a component of the <strong class='font-weight-bold'>PHILIPPINE MEDICAL ASSOCIATION</strong>
                                        , with PMA No. <strong class='font-weight-bold'>{$user['pma_number']}</strong> is a bonafide 
                                        <strong class='font-weight-bold'>MEMBER IN GOOD STANDING</strong> and is entitled 
                                        to all the rights and privileges appertaining thereof. 
                                    </p>
                                    <p class='text-justify text-height-5'>
                                        Membership dues for 2021-2022 have been settled and this certification is valid until  <strong class='font-weight-bold'>May 31, 2022</strong>.
                                    </p>
                                </main>
                                <br>
                                <footer class='mt-5'>
                                    <div class='text-center'>
                                        <img src='cid:cert_signature'>
                                        <h4 class='font-weight-bold'>{$holder}</h4>
                                    </div>
                                </footer>
                            </div>
                        </body>
                        </html>";
    
        $mail->send();
        
        $_SESSION['message'] = "Email sent to {$user['email']}"; 
    }
    else 
    {
        $_SESSION['errors']['email'] = "{$user['fullname']} has no email address set. Please set it first"; 
    }


    header("location: certificate_send_list.php");
}