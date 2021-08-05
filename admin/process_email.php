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

function generateCertificate($member, $pma, $holder, $holderSignature)
{
    global $currentDate;

    $directory          =   './certificate/';
    $filename           =   "{$member}_certificate_{$currentDate}"; 
    $targetDirectory    =    $directory . $filename; 

    $font               =   './certificate/times-new-roman.ttf'; 
    $image              =   imagecreatefromjpeg('./certificate/template.jpg') or die('Cannot Initialize new GD image stream'); 
    $color              =   imagecolorallocate($image, 40, 90, 10); 
    $title              =   "CERTIFICATE OF GOOD STANDING"; 
    $present            =   "THIS CERTIFICATE IS PRESENTED TO"; 
    $person             =   strtoupper($member . ", M.D.") ; 
    $detailLine1        =   "of the ANGELES CITY MEDICAL SOCIETY, a component society of the PHILIPPINE MEDICAL";
    $detailLine2        =   "ASSOCIATION, with PMA No. {$pma} for being a bonafide MEMBER IN GOOD";
    $detailLine3        =   "STANDING and is entitled to all the rights and privileges appertaining thereof.";
    $detailLine4        =   "Membership dues for 2021-2022 have been settled and this certification is valid until May 31, 2022.";
    $dateValue          =   date('d F, Y');
    $date               =   "DATE"; 
    $signature          =    imagecreatefrompng("../storage/certificate/{$holderSignature}");
    $signatureHolder    =    $holder . " M.D."; 
    $signatureTitle     =   "PRESIDENT"; 

    $personFontSize     =  68;

    if(strlen($person) >= 10)
    {
        $personFontSize = 60; 
    }

    if(strlen($person) >= 20)
    {
        $personFontSize = 52; 
    }
    
    if(strlen($person) >= 30)
    {
        $personFontSize = 44; 
    }
    
    if(strlen($person) >= 40)
    {
        $personFontSize = 38; 
    }
    
    $signatureXPosition = 1450; 
    
    if(strlen($signatureHolder) >= 10)
    {
        $signatureXPosition = 1440; 
    }
    
    if(strlen($signatureHolder) >= 20)
    {
        $signatureXPosition = 1350; 
    }
    
    if(strlen($signatureHolder) >= 30)
    {
        $signatureXPosition = 1300; 
    }
    
    if(strlen($signatureHolder) >= 40)
    {
        $signatureXPosition = 1250; 
    }

    imagettftext($image, 70, 0, 200, 200, $color, $font, $title); 
    imagettftext($image, 32, 0, 725, 300, $color, $font, $present); 
    imagettftext($image, $personFontSize, 0, 725, 425, $color, $font, $person); 
    imagettftext($image, 20, 0, 725, 525, $color, $font, $detailLine1); 
    imagettftext($image, 20, 0, 725, 575, $color, $font, $detailLine2); 
    imagettftext($image, 20, 0, 725, 625, $color, $font, $detailLine3); 
    imagettftext($image, 20, 0, 725, 700, $color, $font, $detailLine4); 
    imagettftext($image, 22, 0, 800, 900, $color, $font, strtoupper($dateValue)); 
    imagettftext($image, 22, 0, 850, 950, $color, $font, $date); 
    imagecopy($image, $signature, 1450, 800, 0, 0, imagesx($signature), imagesy($signature));
    imagettftext($image, 22, 0, $signatureXPosition, 900, $color, $font, $signatureHolder); 
    imagettftext($image, 22, 0, 1450, 950, $color, $font, $signatureTitle); 

    imagejpeg($image, $targetDirectory, 100); 
    imagedestroy($image); 

    return $targetDirectory;
}

function addCertificateSentRecord($user_id, $cert_id)
{
    global $mysqli; 

    $mysqli->query("INSERT INTO certificates_sent (user_id, certificate_id) VALUES ('$user_id', '$cert_id')") or die($mysqli->error); 
}

if(isset($_POST['verify_payment_certificate']))
{
    $id = $_POST['id'];

    $user       =    mysqli_fetch_assoc($mysqli->query("SELECT   
                        pma_number,
                        email,
                        last_name, 
                        first_name, 
                        middle_name  
                    FROM users
                    WHERE id='$id'")
                    ) or die($mysqli->error); 

    $cert       =   mysqli_fetch_assoc($mysqli->query("SELECT * from certificates WHERE name='GOOD STANDING'")) or die ($mysqli->error);  
    $holder     =   $cert['holder'];
    $signature  =   $cert['signature'];

    // $fullname   =  strtoupper($user['first_name'] . ' ' . substr($user['middle_name'], 0, 1) . '.' . ' ' . $user['last_name']);
    $fullname   =  strtoupper($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']);
    //* Add a recipient

    if(!empty($user['email']))
    {
        //$file   =   generateCertificate($user['fullname'], $user['pma_number'], $cert['holder']);

        $filename   =   generateCertificate($fullname, $user['pma_number'], $holder, $signature);
        $mail->addAddress($user['email'], $fullname);
        $mail->isHTML(true);                              
        $mail->Subject = 'Verified Payment & Certificate';
        $mail->Body    = "Thank you for your payment, <strong>{$fullname}, M.D.</strong>! <br><br> Attached in this email is your Certificate of Good Standing.";
        $mail->addAttachment($filename, 'certificate.jpg');
    
        $mail->send();

        if(file_exists($filename))
        {
            unlink($filename); 
        }
        
        addCertificateSentRecord($id, $cert['id']); 

        $_SESSION['message'] = "Email sent to {$user['email']}"; 
    }
    else 
    {
        $_SESSION['errors']['email'] = "{$user['fullname']} has no email address set. Please set it first"; 
    }


    header("location: certificate_send_list.php");
}