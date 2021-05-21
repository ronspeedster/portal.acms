<?php 
require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data) 
{
    $errors     =   0; 

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
}


//Payment Creation 
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

//Payment Update
if(isset($_POST['update_payment']))
{
    $id         =   $_GET['id'] ?? null; 
    $title      =   trim(strtoupper($_POST['title'])); 
    $category   =   trim(strtoupper($_POST['category']));
    $amount     =   trim($_POST['amount']); 
    $auto       =   isset($_POST['auto_assign']) == 0 ? 0 : 1; 

    $errors     =   check_errors(
                        compact('id','title', 'category', 'amount', 'auto')
                    ); 


    if($errors > 0)
    {
        header("location: payment_list.php");
    }
    else 
    {
        $statement = $mysqli->prepare("UPDATE payments SET 
                                        title=?, 
                                        category=?, 
                                        amount=?, 
                                        auto_assign=?, 
                                        updated_at=? 
                                        WHERE id=?") or die ($mysqli->error);

        $statement->bind_param('ssdisi', $title, $category, $amount, $auto, $currentDate, $id); 
        $statement->execute(); 
        $_SESSION['message'] = "Payment Successfully Updated"; 
        header("location: payment_view.php?payment_id={$id}");
    } 
}