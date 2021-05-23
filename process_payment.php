<?php 
require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data)
{
    $max_file_size  =   500000;
    $errors = 0;
         
    //! : Check if it belongs to user; 
    if($data["payment"]["user_id"] != $_SESSION['user_id'])
    {
        $_SESSION['errors']['auth'] =   "This Payment does not belong to you"; 
        $errors++; 
    }
    else 
    {
        //! : Check if if already Verified; 
        if($data["payment"]["status"] == "VERIFIED")
        {
            $_SESSION['errors']['status'] =   "Payment is already Verified"; 
            $errors++; 
        }
    }

    // !Check if File is empty 
    if(empty($_FILES['proof_of_payment']['tmp_name']))
    {
        $_SESSION['errors']['file'] =   "Please provide your Proof of Payment"; 
        $errors++; 
    }
    else
    {
        $imageFileType = strtolower(pathinfo(basename($_FILES["proof_of_payment"]["name"]), PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["proof_of_payment"]["tmp_name"]);
    
        if(!$check) 
        {
            $_SESSION['errors']['file'] =   "File Uploaded is not an image"; 
            $errors++;
        }
    
        if($_FILES["proof_of_payment"]["size"] > $max_file_size) 
        {
            $_SESSION['errors']['file'] =   "Sorry, your file is too large.";
            $errors++;
        }
        
        if(!in_array($imageFileType, array('jpg', 'jpeg', 'png'))) 
        {
            $_SESSION['errors']['file'] =   "Sorry, your file type '.{$imageFileType}' is invalid ";
            $errors++;
        } 
    } 

    return $errors; 
}

function upload_file($fileName, $oldFile = null) 
{
    $target_dir    = "storage/proof_of_payment/";
    $target_file   = $target_dir . $fileName;
     
    if (move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target_file)) 
    {
        if(isset($oldFile) && !empty($oldFile))
        {
            unlink($target_dir . $oldFile);
        }

        return true; 
    }

    return false; 
}

if(isset($_POST['upload_proof_of_payment']))
{
    $id     =   $_GET['id'];

    $statement  = $mysqli->prepare("SELECT * FROM user_payments WHERE id=?"); 
    $statement->bind_param("i", $id); 
    $statement->execute();
    
    $result     = $statement->get_result(); 
    $payment    = $result->fetch_assoc(); 

    $errors =   check_errors(compact("id", "payment")); 

    if($errors == 0)
    {
        $imageFileType = strtolower(pathinfo(basename($_FILES["proof_of_payment"]["name"]), PATHINFO_EXTENSION));
        $fileName      =  str_replace(' ', '-', md5($_FILES["proof_of_payment"]["name"]) .'-'.$currentDate . ".{$imageFileType}");    
        
        if(upload_file($fileName, $payment['proof_of_payment']))
        {
            $statement = $mysqli->prepare("UPDATE user_payments SET
                                            proof_of_payment=?,
                                            status=?,
                                            date_of_payment=?,   
                                            updated_at=?
                                            WHERE id=?");
            
            $status     =   "AWAITING VERIFICATION";
            $statement->bind_param('ssssi', $fileName, $status,  $currentDate, $currentDate, $id); 
            $statement->execute();  

            $_SESSION['message'] = "Proof of Payment Successfully Uploaded. Wait for Verification"; 
        }
        else 
        {
            $_SESSION['errors']['sql'] =   "Something went wrong";
        }
    }

    echo "TEST";

    header("location: payment_show.php?user_payment_id={$id}");
}