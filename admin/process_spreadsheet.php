<?php

require_once('vendor/autoload.php');
require_once('dbh.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Writer\Csv; 
use PhpOffice\PhpSpreadsheet\Writer\Xls;

$currentDate = date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');

function check_errors($data)
{
    $errors = 0; 
    $formats = ['csv', 'ods', 'xls', 'xlsx',];

    if(empty($data['format']))
    {
        $_SESSION['errors']['format'] = "File format is empty";
        $errors++;  
    }
    else if(!in_array($data['format'], $formats))
    {
        $_SESSION['errors']['format'] = "File format is invalid";
        $errors++;  
    }

    if(empty($data['date']))
    {
        $_SESSION['errors']['generate'] = "Generate by is Empty";
        $errors++;  
    }
    else 
    {
        switch($data['date'])
        {
            case 'month': 
                if(empty($_POST['month']))
                {
                    $_SESSION['errors']['generate'] = "Please provide a month";
                    $errors++;
                }
                break; 

            case 'from and to': 
                if(empty($_POST['date_from']))
                {   
                    $_SESSION['errors']['date_from'] = "Date From is empty";
                    $errors++;
                }
    
                if(empty($_POST['date_to']))
                {   
                    $_SESSION['errors']['date_to'] = "Date To is empty";
                    $errors++;
                }
                break; 

            case 'year':
                if(empty($_POST['year']))
                {   
                    $_SESSION['errors']['generate'] = "Please provide a Year";
                    $errors++;
                }
                break; 
    
            default: 
                break; 
        }
    }

    return $errors; 
}

function get_excel_type($spreadsheet, $format)
{
    $writer = null; 

    switch($format)
    {
        case "csv": 
            $writer = new Csv($spreadsheet);
            break; 

        case "ods": 
            $writer = new Ods($spreadsheet);
            break; 

        case "xls": 
            $writer = new Xls($spreadsheet);
            break; 

        case "xlsx": 
            $writer = new Xlsx($spreadsheet);
            break; 
    }

    return $writer; 
}

function getQuery($date) 
{
    global $mysqli; 

    $query = null; 

    switch($date)
    {
        case 'today':
            $query          =   "SELECT 
                                    user_payments.id, 
                                    user_payments.status,
                                    user_payments.amount_paid,  
                                    user_payments.proof_of_payment,
                                    user_payments.date_of_payment,
                                    user_payments.created_at,  
                                    payments.title, 
                                    payments.amount, 
                                    users.email, 
                                    users.contact_num,
                                    CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                                    FROM user_payments 
                                JOIN payments ON payments.id=user_payments.payment_id 
                                JOIN users ON users.id=user_payments.user_id 
                                WHERE payments.deleted_at is NULL 
                                    AND CAST(user_payments.created_at as DATE)=CURRENT_DATE";
            break; 

            
            case 'from and to': 

                $date_from  =   $_POST['date_from'];
                $date_to    =   $_POST['date_to'];
                
            
                $query      =   "SELECT 
                                    user_payments.id, 
                                    user_payments.status,
                                    user_payments.amount_paid,  
                                    user_payments.proof_of_payment,
                                    user_payments.date_of_payment,
                                    user_payments.created_at,  
                                    payments.title, 
                                    payments.amount, 
                                    users.email, 
                                    users.contact_num,
                                    CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                                FROM user_payments 
                                JOIN payments ON payments.id=user_payments.payment_id 
                                JOIN users ON users.id=user_payments.user_id 
                                WHERE payments.deleted_at is NULL 
                                    AND CAST(user_payments.created_at as DATE)  
                                    BETWEEN '$date_from' AND '$date_to'";  
          
            break; 
            
        case 'month': 
            
            $month  =       $_POST['month']; 
            $query  =       "SELECT 
                                user_payments.id, 
                                user_payments.status,
                                user_payments.amount_paid,  
                                user_payments.proof_of_payment,
                                user_payments.date_of_payment,
                                user_payments.created_at,  
                                payments.title, 
                                payments.amount, 
                                users.email, 
                                users.contact_num,
                                CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                            FROM user_payments 
                            JOIN payments ON payments.id=user_payments.payment_id 
                            JOIN users ON users.id=user_payments.user_id 
                            WHERE payments.deleted_at is NULL 
                                AND MONTHNAME(user_payments.created_at)='$month'";   
            break; 

        case 'year':
            
            $year       =   $_POST['year']; 
            $query      =   "SELECT 
                                user_payments.id, 
                                user_payments.status,
                                user_payments.amount_paid,  
                                user_payments.proof_of_payment,
                                user_payments.date_of_payment,
                                user_payments.created_at,  
                                payments.title, 
                                payments.amount, 
                                users.email, 
                                users.contact_num,
                                CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                            FROM user_payments 
                            JOIN payments ON payments.id=user_payments.payment_id 
                            JOIN users ON users.id=user_payments.user_id 
                            WHERE payments.deleted_at is NULL 
                                AND YEAR(user_payments.created_at)='$year'";
                                
            break; 

        default: 
            $query      =   "SELECT 
                                user_payments.id, 
                                user_payments.status,
                                user_payments.amount_paid,  
                                user_payments.proof_of_payment,
                                user_payments.date_of_payment, 
                                user_payments.created_at,  
                                payments.title, 
                                payments.amount, 
                                users.email, 
                                users.contact_num,
                                CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                            FROM user_payments 
                            JOIN payments ON payments.id=user_payments.payment_id 
                            JOIN users ON users.id=user_payments.user_id 
                            WHERE payments.deleted_at is NULL"; 
            break; 
    }

    if(isset($_POST['payment_id']))
    {
        $query .=   " AND payments.id={$_POST['payment_id']}"; 
    }

    $query      =   $mysqli->query($query) or die(mysqli_error($mysqli));

    return $query; 
}


if(isset($_POST['excel_user_payment_list']))
{
    $format     =   $_POST['format']; 
    $route      =   $_POST['route'];
    $date       =   $_POST['date']; 

    $errors     =   check_errors(compact('format', 'route', 'date'));

    if($errors == 0)
    {
        //! Query 
        $user_payments    =   getQuery($date);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'MEMBER FULLNAME');
        $sheet->setCellValue('C1', 'MEMBER EMAIL');
        $sheet->setCellValue('D1', 'MEMBER CONTACT NUMBER');
        $sheet->setCellValue('E1', 'PAYMENT TITLE');
        $sheet->setCellValue('F1', 'PAYMENT AMOUNT');
        $sheet->setCellValue('G1', 'PAYMENT AMOUNT PAID');
        $sheet->setCellValue('H1', 'PROOF OF PAYMENT');
        $sheet->setCellValue('I1', 'DATE OF PAYMENT');
        $sheet->setCellValue('J1', 'PAYMENT STATUS');
        $sheet->setCellValue('K1', 'CREATED AT');

        $columns = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K"];

        foreach($columns as $column)
        {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        //! Insert data

        $row = 2; 
        
        foreach($user_payments as $data)
        {
            $sheet->setCellValue('A' . $row, ($row-1));
            $sheet->setCellValue('B' . $row, $data['fullname']);
            $sheet->setCellValue('C' . $row, $data['email']);
            $sheet->setCellValue('D' . $row, $data['contact_num']);
            $sheet->setCellValue('E' . $row, $data['title']);
            $sheet->setCellValue('F' . $row, $data['amount']);
            $sheet->setCellValue('G' . $row, $data['amount_paid']);
            $sheet->setCellValue('H' . $row, isset($data['proof_of_payment']) ? 'YES' : 'N/A');
            $sheet->setCellValue('I' . $row, $data['date_of_payment'] ?? "N/A" );
            $sheet->setCellValue('J' . $row, $data['status']);
            $sheet->setCellValue('K' . $row, $data['created_at']);
            $row++; 
        } 

        $writer         =   get_excel_type($spreadsheet, $format);

        $currentDate    =   str_replace(' ', '-', $currentDate);
        $fileName       =   "USERS_PAYMENTS_LIST-{$currentDate}.{$format}"; 

        header('Content-Type: application/vnd.openxmlformats-officedoument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save("php://output");
    }
    else 
    {
        header("location: {$route}");
    }

}    

