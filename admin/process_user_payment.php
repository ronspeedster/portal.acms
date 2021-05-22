<?php 
require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data) 
{
    global $mysqli; 

    $errors     =   0; 
    
    if(empty($data['user_id']))
    {
        $_SESSION['errors']['user']     =   "User is required"; 
        $errors++; 
    }

    if(empty($data['payment_id']))
    {
        $_SESSION['errors']['payment']  =   "Payment is required"; 
        $errors++; 
    }

    // ! Check if user and payment combination exists 
    if($errors == 0)
    {
        $statement  =   $mysqli->prepare("SELECT * FROM user_payments WHERE user_id=? AND payment_id=?"); 
        $statement->bind_param('ii', $data['user_id'], $data['payment_id']);
        $statement->execute(); 
    
        $result     =   $statement->get_result();
                
        if(mysqli_num_rows($result) >= 1)
        {
            $_SESSION['errors']['exists']  =   "User is already assigned to this payment"; 
            $errors++; 
        }
    }
        
    return $errors; 
}

//Assign Payment to user 
if(isset($_POST['assign_user_payment']))
{
    $user_id    =   $_POST['user'];  
    $payment_id =   $_POST['payment'];
    $route      =   $_POST['route'] ?? null;
    $errors     =   check_errors(compact('user_id', 'payment_id')); 

    // ! Insert to user_payments Table 
    if($errors == 0)
    {
        $statement  =   $mysqli->prepare("INSERT INTO user_payments (user_id, payment_id) VALUES(?, ?)") or die($mysqli->error); 
        $statement->bind_param('ii', $user_id, $payment_id);
        $statement->execute();

        $_SESSION['message'] = "User successfully assigned to this payment";
    }
    
    if(isset($route))
    {
        header("location: payment_user_list.php"); 
    }
    else 
    {
        header("location: payment_view.php?payment_id={$payment_id}"); 
    }
}