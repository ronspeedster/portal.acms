<?php

require 'vendor/autoload.php';
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

if(isset($_POST['excel_user_payment_list']))
{
    $format     =   $_POST['format']; 
    $route      =   $_POST['route'];

    $errors     =   check_errors(compact('format', 'route'));

    if($errors == 0)
    {
        //! Query 
        $user_payments    =   $mysqli->query("SELECT 
                                    user_payments.id, 
                                    user_payments.status,
                                    user_payments.amount_paid,  
                                    user_payments.proof_of_payment,
                                    user_payments.date_of_payment, 
                                    payments.title, 
                                    payments.amount, 
                                    users.email, 
                                    users.contact_num,
                                    CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                                    FROM user_payments 
                                    JOIN payments ON payments.id=user_payments.payment_id 
                                    JOIN users ON users.id=user_payments.user_id 
                                    WHERE payments.deleted_at is NULL"
                                ) or die(mysqli_error($mysqli)); 

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

        $columns = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];

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

if(isset($_POST['excel_payment_view']))
{
    $format     =   $_POST['format']; 
    $route      =   $_POST['route'];
    $payment_id =   $_GET['payment_id'];

    $errors     =   check_errors(compact('format', 'route'));

    if($errors == 0)
    {
        //! Query 

        $payment          =  mysqli_fetch_assoc($mysqli->query("SELECT * FROM payments WHERE id={$payment_id}"));

        $user_payments    =   $mysqli->query("SELECT 
                                    user_payments.id, 
                                    user_payments.status,
                                    user_payments.amount_paid,  
                                    user_payments.proof_of_payment,
                                    user_payments.date_of_payment, 
                                    payments.title, 
                                    payments.amount, 
                                    users.email, 
                                    users.contact_num,
                                    CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                                    FROM user_payments 
                                    JOIN payments ON payments.id=user_payments.payment_id 
                                    JOIN users ON users.id=user_payments.user_id 
                                    WHERE payments.deleted_at is NULL
                                    AND payments.id={$payment_id}"
                                ) or die(mysqli_error($mysqli)); 

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

        $columns = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];

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
            $row++; 
        } 

        $writer         =   get_excel_type($spreadsheet, $format);

        $currentDate    =   str_replace(' ', '-', $currentDate);
        $fileName       =   "{$payment['title']}_PAYMENTS_LIST-{$currentDate}.{$format}"; 

        header('Content-Type: application/vnd.openxmlformats-officedoument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save("php://output");
    }
    else 
    {
        header("location: {$route}");
    }

}    
