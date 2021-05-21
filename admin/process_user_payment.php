<?php 
require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data) 
{
    $errors     =   0; 

    /*
    if(isset($_POST['update_payment']))
    {
        if(empty($data['id']))
        {
            $_SESSION['errors']['id']    = 'ID is required'; 
            $errors++; 
        }
    }

    if(empty($data['title']))
    {
        $_SESSION['errors']['title']    = 'Title is required'; 
        $errors++; 
    }

    if(empty($data['category']))
    {
        $_SESSION['errors']['category'] = 'Category is required'; 
        $errors++; 
    }

    if(empty($data['amount']))
    {
        $_SESSION['errors']['amount']   = 'Amount is required'; 
        $errors++; 
    }
    else if(!is_numeric($data['amount']))
    {
        $_SESSION['errors']['amount']   = 'Amount is should be a number'; 
        $errors++; 
    } 

    return $errors; 
    */
}

//Assign Payment to user 
if(isset($_POST['assign_user_payment']))
{
     $user_id    =   $_POST['user_id'];  
    $payment_id =   $_POST['payment_id'];

    echo $user_id;
    echo $payment_id;

    $statement  =   $mysqli->prepare("INSERT INTO user_payments (user_id, payment_id) VALUES(?, ?)") or die($mysqli->error); 
    $statement->bind_param('ii', $user_id, $payment_id);
    $statement->execute();

    echo "test";

    //header("location : payment_view.php"); 

}