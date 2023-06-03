<?php
require_once 'PHPOffice/vendor/autoload.php'; // Load PHPSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

include("php/config.php");
include("php/admin-functions.php");

function generateOrdersSpreadsheet($ext)
{   // Spreadsheet Info
    global $dbconnect;

    $filename                               = "orders(".date("d-m-Y").")";
    $spreadsheet                            = new Spreadsheet();
    $sheet                                  = $spreadsheet->getActiveSheet();

    // Initialise variables & arrays
    $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
    $align = 'center';

    $allOrders                              = getAll('Orders'); // Retrieve products data from database

    // Format table header
    $sheet->getRowDimension(1)->setRowHeight(30);
    foreach(range('A','O') as $column)
    {
        $sheet->getColumnDimension($column)->setAutoSize(true);
        $sheet->getStyle($column.'1')->getAlignment()->setVertical($align);
        $sheet->getStyle($column.'1')->getAlignment()->setHorizontal($align);
        $sheet->getStyle($column.'1')->getAlignment()->setWrapText(true);
    }

    $sheet->getColumnDimension('P')->setWidth(15);
    $sheet->getColumnDimension('Q')->setWidth(15);

    // Table Headers
    $sheet->setCellValue('A1', 'Order ID:');
    $sheet->setCellValue('B1', 'Tracking ID:');
    $sheet->setCellValue('C1', 'CustomerID:');
    $sheet->setCellValue('D1', 'First Name:');
    $sheet->setCellValue('E1', 'Surname:');
    $sheet->setCellValue('F1', 'Phone Number:');
    $sheet->setCellValue('G1', 'Address:');
    $sheet->setCellValue('H1', 'City:');
    $sheet->setCellValue('I1', 'Postcode:');
    $sheet->setCellValue('J1', 'Total Price:');
    $sheet->setCellValue('K1', 'Payment Method:');
    $sheet->setCellValue('L1', 'Payment ID (for PayPal):');
    $sheet->setCellValue('M1', 'Status:');
    $sheet->setCellValue('N1', 'Collection:');
    $sheet->setCellValue('O1', 'Instructions:');
    $sheet->setCellValue('P1', 'Date Created:');
    $sheet->setCellValue('Q1', 'Date Updated:');

    $rowCount                               = 2;

    foreach($allOrders as $data) // Get all product details into table
    {   // For each order, create row of data in table
        if($data['PaymentID'] == "")
        { $paymentID                        = "N/A"; }
        else { $paymentID                   = $data['PaymentID']; }

        if($data['Status'] == '0')
        { $status                           = 'Pending'; }
        else if($data['Status'] == '1')
        { $status                           = 'Complete'; }
        else if($data['Status'] == '2')
        { $status                           = 'Cancelled'; }
        else { $status                      = 'Unknown - error'; }

        // Embed into cells
        $sheet->setCellValue('A'.$rowCount, $data['OrderID']);
        $sheet->setCellValue('B'.$rowCount, $data['TrackingID']);
        $sheet->setCellValue('C'.$rowCount, $data['CustomerID']);
        $sheet->setCellValue('D'.$rowCount, $data['FirstName']);
        $sheet->setCellValue('E'.$rowCount, $data['Surname']);
        $sheet->setCellValue('F'.$rowCount, $data['PhoneNumber']);
        $sheet->setCellValue('G'.$rowCount, $data['Address']);
        $sheet->setCellValue('H'.$rowCount, $data['City']);
        $sheet->setCellValue('I'.$rowCount, $data['Postcode']);
        $sheet->setCellValue('J'.$rowCount, '£'.number_format($data['TotalPrice'], 2, '.', ','));
        $sheet->setCellValue('K'.$rowCount, $data['PaymentMethod']);
        $sheet->setCellValue('L'.$rowCount, $paymentID);
        $sheet->setCellValue('M'.$rowCount, $status);
        $sheet->setCellValue('N'.$rowCount, $data['Collection'] == '1' ? "Delivery":"In-Store");
        $sheet->setCellValue('O'.$rowCount, $data['Instructions']);
        $sheet->setCellValue('P'.$rowCount, strval($data['DateOfCreation']));
        $sheet->setCellValue('Q'.$rowCount, strval($data['DateOfUpdate']));

        // Align last two columns horizontally
        $sheet->getStyle('P'.$rowCount)->getAlignment()->setHorizontal($align);
        $sheet->getStyle('Q'.$rowCount)->getAlignment()->setHorizontal($align);
        $rowCount++;
    }
    for($i = 2; $i < $rowCount; $i++) // Autosize, align & wrap cells
    {
        foreach($columns as $column)
        {
            $sheet->getColumnDimension($column)->setAutoSize(true);
            $sheet->getRowDimension($i)->setRowHeight(80);
            $sheet->getStyle($column.$i)->getAlignment()->setVertical($align);
            $sheet->getStyle($column.$i)->getAlignment()->setHorizontal($align);
            $sheet->getStyle($column.$i)->getAlignment()->setWrapText(true);
        }

        $sheet->getStyle('P'.$i)->getAlignment()->setVertical($align);
        $sheet->getStyle('P'.$i)->getAlignment()->setHorizontal($align);
        $sheet->getStyle('P'.$i)->getAlignment()->setWrapText(true);
        $sheet->getStyle('Q'.$i)->getAlignment()->setVertical($align);
        $sheet->getStyle('Q'.$i)->getAlignment()->setHorizontal($align);
        $sheet->getStyle('Q'.$i)->getAlignment()->setWrapText(true);
    }
    if($ext == 'xlsx') // Export according to chosen spreadsheet extension 
    {
        $writer                             = new Xlsx($spreadsheet);
        $final_filename                     = $filename.'.xlsx';
    }
    else if($ext == 'xls')
    {
        $writer                             = new Xls($spreadsheet);
        $final_filename                     = $filename.'.xls';
    }
    else if($ext == 'csv')
    {
        $writer                             = new Csv($spreadsheet);
        $final_filename                     = $filename.'.csv';
    }  else{ return false; exit(); }

    // Download Generated Excel Spreadsheet
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
    $writer->save('php://output');
    return true; exit();
}

$filetype                                   = $_GET['filetype']; // Fetch filetype from link via GET request
generateOrdersSpreadsheet($filetype);       // Call above function

?>