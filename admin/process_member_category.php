<?php 

require_once('dbh.php'); 

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

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
        
        if(isset($data['id']))
        {
            $id = $data['id'];
            $query  = $mysqli->query("SELECT * FROM member_category where name='$name' AND id!='$id'"); 
        }
        else 
        {
            $query  = $mysqli->query("SELECT * FROM member_category where name='$name'");
        }

        if(mysqli_num_rows($query) >= 1)
        {
            $_SESSION['errors']['database'] = "Name is already taken"; 
            $errors++;
        }
    }

    return $errors; 
}

function setCategoryByDefault($id)
{
    global $mysqli; 

    $mysqli->query("UPDATE member_category SET is_default='0' WHERE is_default='1'") or die($mysqli->error);
    $mysqli->query("UPDATE member_category SET is_default='1' WHERE id='$id'") or die($mysqli->error);
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
                                        VALUES(?, ?)"
                                    )or die($mysqli->error);
    
        $statement->bind_param('ss', $name, $desc); 
        $statement->execute(); 
        
        $_SESSION['message'] = "Member Category Created Successfully";

        if(isset($_POST['default']))
        {
            $category_id = $statement->insert_id; 
            setCategoryByDefault($category_id);

            $_SESSION['message'] .=  ". Category set by default";
        }
    }


    header("location: manage_member_category.php"); 
}

if(isset($_POST['update_category']))
{
    $name = mysqli_escape_string($mysqli, trim(strtoupper($_POST['name'])));
    $desc = mysqli_escape_string($mysqli, trim(strtoupper($_POST['desc'])));
    $id   = $_POST['id']; 

    $errors = checkErrors(compact('name', 'desc', 'id')); 

    if($errors == 0)
    {
        $is_active = isset($_POST['active']) ? 1 : 0; 

        $statement = $mysqli->prepare("Update member_category SET 
                                        name=?, 
                                        description=?,
                                        is_active=?, 
                                        updated_at=?
                                        WHERE id=?"
                                    )or die($mysqli->error);
    
        $statement->bind_param('ssisi', $name, $desc, $is_active, $currentDate, $id); 

        $statement->execute();
        
        $_SESSION['message'] = "Member Category Updated Successfully";

        if(isset($_POST['default']))
        {
            setCategoryByDefault($id);

            $_SESSION['message'] .=  ". Category set by default";
        }
    }

    header("location: member_category_view.php?category_id={$id}");
}

if(isset($_POST['delete_category']))
{
    $id = mysqli_escape_string($mysqli, trim(strtoupper($_POST['id'])));

    $users = $mysqli->query("SELECT * FROM users WHERE member_category_id='$id'");

    if(mysqli_num_rows($users) >= 1)
    {
        $count = mysqli_num_rows($users); 

        $_SESSION['errors']['database'] =  "Cannot Delete Category. There are current {$count} users assigned";

        header("location: member_category_view.php?category_id={$id}");
    }
    else 
    {     
        $mysqli->query("DELETE FROM member_category WHERE id='$id'");

        $_SESSION['message'] =  "Category Deleted";
    
        header("location: manage_member_category.php");
    }

}