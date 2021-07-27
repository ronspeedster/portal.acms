<?php 

require_once('dbh.php'); 

if(isset($_POST['mark_read']))
{
    $user_id    =   $_SESSION['user_id']; 

    $mysqli->query("UPDATE user_notifications SET is_read=1 WHERE user_id='$user_id' AND is_read=0"); 

    header("location: index.php"); 
}