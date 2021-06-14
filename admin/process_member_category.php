<?php 

require_once('dbh.php'); 

function checkErrors($data)
{
    global $mysqli;

    $errors = 0; 

    if(empty($data['name']))
    {
        $_SESSION['errors']['name'] = "Name is required"; 
        $errors++;
    }

    if(empty($data['desc']))
    {
        $_SESSION['errors']['description'] = "Description is required"; 
        $errors++;
    }

    if($errors == 0)
    {
        $name   = $data['name']; 
        $query  = $mysqli->query("SELECT * FROM member_category where name='$name'");

        if(mysqli_num_rows($query) >= 1)
        {
            $_SESSION['errors']['database'] = "Name is already taken"; 
            $errors++;
        }
    }

    return $errors; 
}

if(isset($_POST['create_category']))
{
    $name = mysqli_escape_string($mysqli, trim(strtoupper($_POST['name'])));
    $desc = mysqli_escape_string($mysqli, trim(strtoupper($_POST['desc'])));

    $errors = checkErrors(compact('name', 'desc')); 

    if($errors == 0)
    {
        $statement = $mysqli->prepare("INSERT into member_category 
                                        (name, description) 
                                        VALUES
                                        (?, ?)"
                                    )or die($mysqli->error);
    
        $statement->bind_param('ss', $name, $desc); 
        $statement->execute(); 

        $_SESSION['message'] = "Member Category Created Successfully";
    }


    header("location: manage_member_category.php"); 
}