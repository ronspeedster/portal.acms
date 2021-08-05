<?php 
require_once('dbh.php');  

function authenticate_user($data)
{
    global $mysqli; 
    
    if(isset($mysqli))
    {
        echo "set"; 
    }
    else 
    {
        echo "unset";
    }

    if(empty($data['password']))
    {
        $_SESSION['errors']['password']  =   "Password is required"; 
    }
    else 
    {
        $statement  =   $mysqli->prepare("SELECT * FROM users WHERE id=? AND password=?"); 
        $statement->bind_param("is", $_SESSION['user_id'], $data['password']); 
        $statement->execute(); 
        $result     =   $statement->get_result();
        
        if(mysqli_num_rows($result) == 1)
        {
            return true; 
        }
    }


    return false; 
}