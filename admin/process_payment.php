<?php 
require_once('dbh.php'); 
require_once('authenticate_user.php');

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


//! Payment Creation 
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

//! Payment Update
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

//! Payment Archive 
if(isset($_POST['archive_payment']))
{
    $password   =   $_POST['password'];
    $id         =   $_GET['id'] ?? null; 

    if(authenticate_user(compact('password')))
    {
        // ! Perform Query Here; 
        $statement = $mysqli->prepare("UPDATE payments SET 
                                        auto_assign=?,
                                        deleted_at=? 
                                        WHERE id=?") or die ($mysqli->error);

        $auto_assign    =   false; 
        $statement->bind_param('isi', $auto_assign, $currentDate, $id); 
        $statement->execute(); 

        $_SESSION['message']  =   "Payment successfully archived, see archived list"; 
        header("location: payment_list.php");
    }
    else 
    {
        $_SESSION['errors']['auth'] = "User Authentication Failed"; 
        header("location: payment_view.php?payment_id={$id}");
    }
}

//! Payment Restore 
if(isset($_POST['restore_payment']))
{    
    $id         =   $_GET['payment_id']; 
    $errors     =   0; 
    
    if(empty($id))
    {
        $_SESSION['errors'] = "Payment Id is required"; 
        $errors++;
    }

    if($errors == 0)
    {
        $statement = $mysqli->prepare("UPDATE payments SET 
                                        deleted_at=? 
                                        WHERE id=?") or die ($mysqli->error);

        $deleted_at    =   null; 
        $statement->bind_param('ii', $deleted_at, $id); 
        $statement->execute(); 

        $_SESSION['message'] = "Payment Restored, See Payment List"; 
    }
    else 
    {
        $_SESSION['errors']['restore'] = "Something went wrong! Payment cannot be restored"; 
    }

    header("location: payment_archives.php");
}

//! Payment Delete 
if(isset($_POST['delete_payment']))
{
    $id         =   $_GET['payment_id']; 
    $errors     =   0; 
    
    if(empty($id))
    {
        $_SESSION['errors'] = "Payment Id is required"; 
        $errors++;
    }

    if($errors == 0)
    {
        $statement = $mysqli->prepare("SELECT * FROM user_payments WHERE payment_id=?") or die ($mysqli->error);

        $statement->bind_param('i', $id); 
        $statement->execute(); 

        $result     =   $statement->get_result();
        $rows       =   mysqli_num_rows($result);  

        if($rows >= 1)
        {
            $_SESSION['errors']['delete'] = "Payment cannot be deleted. There are currently {$rows} users assigned."; 
        }
        else 
        {
            $statement = $mysqli->prepare("DELETE FROM user_payments WHERE payment_id=?") or die ($mysqli->error);

            $statement->bind_param('i', $id); 
            $statement->execute(); 

            $statement = $mysqli->prepare("DELETE FROM payments WHERE id=?") or die ($mysqli->error);

            $statement->bind_param('i', $id); 
            $statement->execute(); 
    
            $_SESSION['errors']['delete'] = "Payment successfully deleted"; 
        }
    }

    header("location: payment_archives.php");
}

