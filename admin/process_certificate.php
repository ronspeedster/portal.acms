
<?php 
require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data = [])
{
    $max_file_size  =   500000;
    $errors = 0;

    if(empty($data['holder']))
    {
        $_SESSION['errors']['holder'] =   "Please provide the Signature Holder's Name"; 
        $errors++;
    }

    // !Check if File is empty 
    if(empty($_FILES['signature']['tmp_name']))
    {
        $_SESSION['errors']['file'] =   "Please provide the Holder's Signature"; 
        $errors++; 
    }
    else
    {
        $imageFileType = strtolower(pathinfo(basename($_FILES["signature"]["name"]), PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["signature"]["tmp_name"]);
    
        if(!$check) 
        {
            $_SESSION['errors']['file'] =   "File Uploaded is not an image"; 
            $errors++;
        }
    
        if($_FILES["signature"]["size"] > $max_file_size) 
        {
            $_SESSION['errors']['file'] =   "Sorry, your file is too large.";
            $errors++;
        }
        
        if(!in_array($imageFileType, array('png'))) 
        {
            $_SESSION['errors']['file'] =   "Sorry, your file type '.{$imageFileType}' is invalid ";
            $errors++;
        } 
    } 

    return $errors; 
}

function upload_file($fileName, $oldFile = null) 
{
    $target_dir    = "../storage/certificate/";
    $target_file   = $target_dir . $fileName;
     
    if (move_uploaded_file($_FILES["signature"]["tmp_name"], $target_file)) 
    {
        if(isset($oldFile) && !empty($oldFile))
        {
            unlink($target_dir . $oldFile);
        }

        return true; 
    }

    return false; 
}

if(isset($_POST['upload_signature']))
{
    $query                  = $mysqli->query("SELECT * from certificates WHERE name='GOOD STANDING'"); 
    $holder                 = mysqli_escape_string($mysqli, trim(strtoupper($_POST['holder'])));
    $exists                 = false; 
    $cert['signature']      = null; 

    if(mysqli_num_rows($query) == 1)
    {
        $exists             = true;
        $cert               = $query->fetch_assoc();
    }
    
    $errors =   check_errors(compact('holder')); 

    if($errors == 0)
    {
        $imageFileType = strtolower(pathinfo(basename($_FILES["signature"]["name"]), PATHINFO_EXTENSION));
        $fileName      =  str_replace(' ', '-', md5($_FILES["signature"]["name"]) .'-'.$currentDate . ".{$imageFileType}");    
        
        if(upload_file($fileName, $cert['signature']))
        {
            if($exists)
            {
                $statement = $mysqli->prepare("UPDATE certificates SET
                                                signature=?, 
                                                holder=?
                                                WHERE name='GOOD STANDING'"
                                                ) or die ($mysqli->error);
                
                $statement->bind_param('ss', $fileName, $holder); 
                $statement->execute();  
               
            }
            else 
            {
                $statement = $mysqli->prepare("INSERT INTO certificates 
                                        (name, signature, holder)      
                                        VALUES('GOOD STANDING', ?, '')" 
                                    ) or die ($mysqli->error); 

                $statement->bind_param('s', $fileName); 
                $statement->execute();  
            }

            $_SESSION['message'] = "Signature Uploaded Successfully, Please Check first"; 
        }
        else 
        {
            $_SESSION['errors']['sql'] =   "Something went wrong";
        }
    }

    header("location: manage_certificate.php");
}

if(isset($_POST['check_certificate']))
{
    //* GET USER
    $statement  =   $mysqli->prepare("SELECT 
                        CONCAT(last_name, ', ' ,first_name , ' ' ,middle_name) AS fullname, 
                        pma_number 
                        FROM users 
                        WHERE id=?"
                    ); 

    $query      =   $mysqli->query("SELECT * from certificates WHERE name='GOOD STANDING'") or die ($mysqli->error); 
    $cert       =   $query->fetch_assoc(); 
    $holder     =   $cert['holder'];
    $cert       =   $cert['signature'];

    $id         =   $_SESSION["user_id"];

    $statement->bind_param("i", $id); 
    $statement->execute(); 

    $user       = $statement->get_result()->fetch_assoc();

   
    $html       =       "<!DOCTYPE html>
                        <html lang='en'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <link href='css/sb-admin-2.min.css' rel='stylesheet'>
                            <title>CERTIFICATE OF GOOD STANDING</title>
                        </head>
                        <body>
                        <div class='m-4 p-2'>
                            <header class='h-25 mb-2'>
                                <div class='d-flex justify-content-between'>
                                    <span>
                                        <img src='./pdf/acms.png' width='150px' height='150px'>
                                    </span>
                                    <div class='text-center'>
                                        <h2 class='font-weight-bold'>ANGELES CITY MEDICAL SOCIETY</h2>
                                        <p>Founded in 1972</p>
                                        <p>Component Society of the Philippine Medical Association</p>
                                    </div>
                                    <span class='float-right'>
                                        <img src='./pdf/pma.png' width='150px' height='150px'>
                                    </span>
                                </div>
                            </header>
                            <hr>
                            <main class='my-5'>
                                <h2 class='text-center font-weight-bold mb-4'>CERTIFICATE OF GOOD STANDING</h2>
                                <p class='text-justify text-height-5 mt-4'>
                                    This is to certify that 
                                    <strong class='font-weight-bold'>{$user['fullname']} </strong> 
                                    of the Angeles City Medical Society, a component of the 
                                    <strong class='font-weight-bold'>PHILIPPINE MEDICAL ASSOCIATION</strong>, with PMA No. 
                                    <strong class='font-weight-bold'>{$user['pma_number']}</strong> 
                                    is a bonafide 
                                    <strong class='font-weight-bold'>MEMBER IN GOOD STANDING</strong> 
                                    and is entitled to all the rights and privileges appertaining thereof.  
                                </p>
                                <p class='text-justify text-height-5'>
                                    Membership dues for 2021-2022 have been settled and this certification is valid until  <strong class='font-weight-bold'>May 31, 2022</strong>.
                                </p>
                            </main>
                            <footer class='mt-1'>
                                <div class='text-center'>
                                    <img src='../storage/certificate/{$cert}'>
                                    <h4 class='font-weight-bold'>{$holder}</h4>
                                </div>
                            </footer>
                        </div>
                    </body>
                    </html>";

    echo $html; 
}