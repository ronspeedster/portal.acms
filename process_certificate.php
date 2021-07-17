<?php

require_once('dbh.php');

if(isset($_POST['generate_certificate']))
{    
    //* GET USER
    $statement  =   $mysqli->prepare("SELECT 
                        CONCAT(last_name, ', ' ,first_name , ' ' ,middle_name) AS fullname, 
                        pma_number 
                        FROM users 
                        WHERE id=?"
                    ); 

    $query      =   $mysqli->query("SELECT * from certificates WHERE name='GOOD STANDING'") or die ($mysqli->error); 
    $cert       =   $query->fetch_assoc(); 
    $holder     =   $cert['holder'];
    $cert       =   $cert['signature'];

    $id         =   $_SESSION["user_id"];

    $statement->bind_param("i", $id); 
    $statement->execute(); 

    $user       = $statement->get_result()->fetch_assoc();

    $html   =       "<!DOCTYPE html>
                        <html lang='en'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <link href='css/sb-admin-2.min.css' rel='stylesheet'>
                            <title>CERTIFICATE OF GOOD STANDING</title>
                        </head>
                        <body>
                        <div class='m-4 p-2'>
                            <header class='h-25 mb-2'>
                                <div class='d-flex justify-content-between'>
                                    <span>
                                        <img src='./pdf/acms.png' width='150px' height='150px'>
                                    </span>
                                    <div class='text-center'>
                                        <h2 class='font-weight-bold'>ANGELES CITY MEDICAL SOCIETY</h2>
                                        <p>Founded in 1972</p>
                                        <p>Component Society of the Philippine Medical Association</p>
                                    </div>
                                    <span class='float-right'>
                                        <img src='./pdf/pma.png' width='150px' height='150px'>
                                    </span>
                                </div>
                            </header>
                            <hr>
                            <main class='my-5'>
                                <h2 class='text-center font-weight-bold mb-4'>CERTIFICATE OF GOOD STANDING</h2>
                                <p class='text-justify text-height-5 mt-4'>
                                    This is to certify that 
                                    <strong class='font-weight-bold'>{$user['fullname']} </strong> 
                                    of the Angeles City Medical Society, a component of the 
                                    <strong class='font-weight-bold'>PHILIPPINE MEDICAL ASSOCIATION</strong>, with PMA No. 
                                    <strong class='font-weight-bold'>{$user['pma_number']}</strong> 
                                    is a bonafide 
                                    <strong class='font-weight-bold'>MEMBER IN GOOD STANDING</strong> 
                                    and is entitled to all the rights and privileges appertaining thereof.  
                                </p>
                                <p class='text-justify text-height-5'>
                                    Membership dues for 2021-2022 have been settled and this certification is valid until  <strong class='font-weight-bold'>May 31, 2022</strong>.
                                </p>
                            </main>
                            <footer class='mt-1'>
                                <div class='text-center'>
                                    <img src='../storage/certificate/{$cert}'>
                                    <h4 class='font-weight-bold'>{$holder}</h4>
                                </div>
                            </footer>
                        </div>
                    </body>
                    </html>";

    echo $html;
    
}