<?php 
require_once('dbh.php'); 
require_once('authenticate_user.php');

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

//! Mass Assignment 
function mass_assignment($payment_id)
{
    global $mysqli; 

    $count = 0; 

    //* GET USERS 
    $users = $mysqli->query("SELECT id FROM users WHERE level_access!='admin'"); 

    foreach($users as $user)
    {
        $user_id = $user['id']; 
        
        $payment_exists = $mysqli->query("SELECT id FROM user_payments 
                                            WHERE user_id='$user_id' 
                                            AND payment_id='$payment_id'"
                                        ) or die ($mysqli->error); 

        if(mysqli_num_rows($payment_exists) == 0)
        {
            $statement  =   $mysqli->prepare("INSERT INTO user_payments (user_id, payment_id) VALUES(?, ?)") or die($mysqli->error); 
            $statement->bind_param('ii', $user_id, $payment_id);
            $statement->execute();
            
            $count++;
        }
    }  

    return $count; 
}

//! Assign by Member Category
function assignByMemberCategory($category, $payment_id)
{
    global $mysqli; 

    $count = 0; 

    //* GET USERS 
    $users = $mysqli->query("SELECT id FROM users WHERE level_access!='admin' AND member_category_id='$category'"); 

    foreach($users as $user)
    {
        $user_id = $user['id']; 
        
        $payment_exists = $mysqli->query("SELECT id FROM user_payments 
                                            WHERE user_id='$user_id' 
                                            AND payment_id='$payment_id'"
                                        ) or die ($mysqli->error); 

        if(mysqli_num_rows($payment_exists) == 0)
        {
            $statement  =   $mysqli->prepare("INSERT INTO user_payments (user_id, payment_id) VALUES(?, ?)") or die($mysqli->error); 
            $statement->bind_param('ii', $user_id, $payment_id);
            $statement->execute();
            
            $count++;
        }
    }  

    return $count; 
} 

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


//! Payment Create
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
        
        if(isset($_POST['member_category']))
        {
            $payment_id = $statement->insert_id; 
            $users = 0; 
    
            foreach($_POST['member_category'] as $category)
            {
                $users += assignByMemberCategory($category, $payment_id);
            }
    
            $_SESSION['message'] .= ". {$users} current/pending Members succesfully assigned";
        }
        
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
        $statement = $mysqli->prepare(  "SELECT 
                                        * 
                                        FROM 
                                            user_payments 
                                        WHERE 
                                            payment_id=?
                                        AND 
                                            status IN ('AWAITING VERIFICATION', 'VERIFIED')
                                        ") or die ($mysqli->error);

        $statement->bind_param('i', $id); 
        $statement->execute(); 

        $result     =   $statement->get_result();
        $rows       =   mysqli_num_rows($result);  

        if($rows >= 1)
        {
            $_SESSION['errors']['delete'] = "Payment cannot be deleted. There are currently {$rows} users with status AWAITING VERIFICATION and VERIFIED assigned."; 
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

//! Payment Verify 
if(isset($_POST['verify_payment'])) 
{
    $id     =   $_GET['id']; 
    $amount =   $_POST['amount_paid'];
    $status =   $_POST['status'];  

    $errors =   0;

    if(empty($id))
    {
        $_SESSION['errors']['id']   =   "ID is required";
        $errors++; 
    }

    if(empty($amount))
    {
        $_SESSION['errors']['amount']   =   "Amount is required";
        $errors++; 
    }

    if(empty($status))
    {
        $_SESSION['errors']['status']   =   "Payment Status is required";
        $errors++; 
    }
    else if(!in_array($status, ['AWAITING VERIFICATION', 'VERIFIED']))
    {
        $_SESSION['errors']['status']   =   "Payment Status is invalid";
        $errors++; 
    }

    if($errors == 0)
    {
        $statement = $mysqli->prepare("UPDATE user_payments SET
                                        status=?,
                                        amount_paid=?, 
                                        updated_at=?
                                        WHERE id=?"
                                    );

        $statement->bind_param('sssi', $status, $amount,  $currentDate, $id); 
        $statement->execute();  

        $_SESSION['message'] = "Payment Status Modified. Please Notify the user"; 
    }

    header("location: payment_user_view.php?user_payment_id={$id}");
}

//! Mass Assignment 
if(isset($_POST['mass_assign']))
{
    $payment_id = $_POST['id']; 

    $users = mass_assignment($payment_id);

    $_SESSION['message'] .= "{$users} current/pending Members succesfully assigned";

    header("location: payment_view.php?payment_id={$payment_id}");
}

//! Payment assign by Category 
if(isset($_POST['payment_mass_assign']))
{
    $id = $_POST['id'];

    if(isset($_POST['member_category']))
    {
        $payment            =  mysqli_fetch_assoc($mysqli->query("SELECT * FROM payments WHERE id='$id'"));
        $users = 0; 

        foreach($_POST['member_category'] as $category)
        {
            $users += assignByMemberCategory($category, $payment['id']);
        }

        $_SESSION['message'] = "{$users} current/pending Members succesfully assigned";
    }
    else 
    {
        $_SESSION['errors']['category'] = "Please choose a category";
    }
    
    header("location: payment_view.php?payment_id={$id}");
}