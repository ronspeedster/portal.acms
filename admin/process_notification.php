<?php 

require_once('dbh.php'); 

if(isset($_POST['mark_read']))
{
    $user_id    =   $_SESSION['user_id']; 

    $mysqli->query("UPDATE user_notifications SET is_read=1 WHERE user_id='$user_id' AND is_read=0"); 

    header("location: index.php"); 
}

if(isset($_POST['clear_all']))
{
    $user_id    =   $_SESSION['user_id']; 
    
    $mysqli->query("DELETE FROM user_notifications WHERE user_id='$user_id'") or die($mysqli->error); 
    
    header("location: index.php"); 
}