<?php 
require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data) 
{
    $errors     =   0; 

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
}


if(isset($_POST['create_payment']))
{
    $title      =   trim(strtoupper($_POST['title'])); 
    $category   =   trim(strtoupper($_POST['category']));
    $amount     =   trim($_POST['amount']); 
    $auto       =   isset($_POST['auto_assign']) == 0 ? 0 : 1; 

    $errors     =   check_errors(
                        compact('title', 'category', 'amount', 'auto')
                    ); 

    if($errors > 0)
    {
        header("location: payment_list.php");
    }
    else 
    {
        $statement = $mysqli->prepare("INSERT INTO payments(title, category, amount, auto_assign, created_at) VALUES(?, ? ,? ,? ,?)") or die ($mysqli->error);
        $statement->bind_param('ssdis', $title, $category, $amount, $auto, $currentDate); 
        $statement->execute(); 
        $_SESSION['message'] = "Payment Successfully Added"; 
        header("location: payment_list.php");
    } 
}