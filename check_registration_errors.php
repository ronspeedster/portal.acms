<?php 


function checkRegistrationErrors($data) 
{
    $errors = 0; 
  
    if(empty($data['firstName']))
    {
        $_SESSION['errors']['firstName'] = "Your First Name is required";
        $errors++;	
    }

    if(empty($data['middleName']))
    {
        $_SESSION['errors']['middleName'] = "Your Middle Name is required";
        $errors++;	
    }

    if(empty($data['lastName']))
    {
        $_SESSION['errors']['lastName'] = "Your Last Name is required";
        $errors++;	
    }

    if(empty($data['birthDate']))
    {
        $_SESSION['errors']['birthDate'] = "Your Date of Birth is required";
        $errors++;	
    }

    if(empty($data['mailingAddress']))
    {
        $_SESSION['errors']['mailingAddress'] = "Your Mailing Address is required";
        $errors++;	
    }

    if(empty($data['contactNumber']))
    {
        $_SESSION['errors']['contactNumber'] = "Your Contact Number is required";
        $errors++;	
    }

    if(empty($data['field']))
    {
        $_SESSION['errors']['field'] = "Your Field of Practice is required";
        $errors++;	
    }

    if(empty($data['email']))
    {
        $_SESSION['errors']['email'] = "Your email is required";
        $errors++;
    }
    else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errors']['email'] = "email provided is invalid";
        $errors++;
    }
    else if(mysqli_num_rows($data['checkUser']) > 0)
    {
        $_SESSION['errors']['email'] = "Email already taken. Please try another.";
        $errors++; 
    }

    if(empty($data['pmaNumber']))
    {
        $_SESSION['errors']['pma'] = "Your PMA Number is required";
        $errors++;
    }

    if(empty($data['prcNumber']))
    {
        $_SESSION['errors']['prc'] = "Your PRC Number is required";
        $errors++;
    }

    if(empty($data['expirationDate']))
    {
        $_SESSION['errors']['expirationDate'] = "Your License expiration date is required";
        $errors++;
    }

    if(empty($data['username']))
    {
        $_SESSION['errors']['username'] = "Username is required";
        $errors++;
    } 

    if(empty($data['password']))
    {
        $_SESSION['errors']['password'] = "Password is required";
        $errors++; 
    }
    else if($data['password'] != $data['confirm_password'])
    {
        $_SESSION['errors']['password'] = "Passwords do not match. Please try again.";
        $errors++; 
    }

    return $errors; 
}