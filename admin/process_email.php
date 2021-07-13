<?php 

require_once('vendor/autoload.php');
require_once('dbh.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

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
} 
catch (\Exception $e) 
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

function generateCertificate($member, $pma, $signatureHolder)
{
    global $currentDate;

    $directory          =   './certificate/';
    $filename           =   "{$member}_certificate_{$currentDate}"; 
    $targetDirectory    =    $directory . $filename; 


    $font               =   './certificate/times-new-roman.ttf'; 
    $image              =   imagecreatefromjpeg('./certificate/template.jpg') or die('Cannot Initialize new GD image stream'); 
    $color              =   imagecolorallocate($image, 40, 90, 10); 
    $title              =   "CERTIFICATE"; 
    $type               =   "OF GOOD STANDING";
    $present            =   "THIS CERTIFICATE IS PRESENTED TO"; 
    $person             =   $member; 
    $detailLine1        =   "of the ANGELES CITY MEDICAL SOCIETY, a component of the PHILIPPINE MEDICAL ASSOCIATION, with";
    $detailLine2        =   "PMA No. {$pma} is a bonafide MEMBER IN GOOD STANDING  and is entitled to all the rights and";
    $detailLine3        =   "privileges appertaining thereof.";
    $detailLine4        =   "Membership dues for 2021-2022 have been settled and this certification is valid until May 31, 2022.";
    $dateValue          =   date('d F, Y');
    $date               =   "DATE"; 
    $signatureValue     =   $signatureHolder; 
    $signature          =   "SIGNATURE"; 

    imagettftext($image, 82, 0, 700, 200, $color, $font, $title); 
    imagettftext($image, 44, 0, 1200, 280, $color, $font, $type); 
    imagettftext($image, 26, 0, 900, 350, $color, $font, $present); 
    imagettftext($image, 52, 0, 800, 475, $color, $font, $person); 
    imagettftext($image, 18, 0, 750, 550, $color, $font, $detailLine1); 
    imagettftext($image, 18, 0, 750, 600, $color, $font, $detailLine2); 
    imagettftext($image, 18, 0, 750, 650, $color, $font, $detailLine3); 
    imagettftext($image, 18, 0, 750, 750, $color, $font, $detailLine4); 
    imagettftext($image, 18, 0, 800, 900, $color, $font, strtoupper($dateValue)); 
    imagettftext($image, 18, 0, 850, 950, $color, $font, $date); 
    imagettftext($image, 18, 0, 1450, 900, $color, $font, $signatureValue); 
    imagettftext($image, 18, 0, 1450, 950, $color, $font, $signature); 

    imagejpeg($image, $targetDirectory, 100); 
    imagedestroy($image); 

    return $targetDirectory;
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
        //$file   =   generateCertificate($user['fullname'], $user['pma_number'], $cert['holder']);

        $filename   =   generateCertificate($user['fullname'], $user['pma_number'], $holder);
        $mail->addAddress($user['email'], $user['fullname']);
        $mail->isHTML(true);                              
        $mail->Subject = 'Verified Payment Certificate';
        $mail->Body    = "Greetings <strong>{$user['fullname']}</strong>, <br><br> Your Certificate of Good Standing is attached in this email.";
        $mail->addAttachment($filename, 'certificate.jpg');
    
        $mail->send();

        if(file_exists($filename))
        {
            unlink($filename); 
        }
        
        $_SESSION['message'] = "Email sent to {$user['email']}"; 
    }
    else 
    {
        $_SESSION['errors']['email'] = "{$user['fullname']} has no email address set. Please set it first"; 
    }


    header("location: certificate_send_list.php");
}