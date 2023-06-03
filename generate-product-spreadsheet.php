<?php
require_once 'PHPOffice/vendor/autoload.php'; // Load PHPSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

include("php/config.php");
include("php/admin-functions.php");

function generateProductSpreadsheet($ext)
{   // Spreadsheet Info
    global $dbconnect;

    $filename                               = "products(".date("d-m-Y").")";
    $spreadsheet                            = new Spreadsheet();
    $sheet                                  = $spreadsheet->getActiveSheet();

    // Initialise variables & arrays
    $columns = ['A', 'B', 'G', 'H', 'I', 'J', 'K'];
    $resize = ['D', 'E', 'F', 'M', 'L'];
    $align = 'center';

    $allProducts                            = getAll('Products'); // Retrieve products data from database

    // Format table header
    $sheet->getRowDimension(1)->setRowHeight(30);
    foreach(range('A','M') as $column)
    {
        $sheet->getStyle($column.'1')->getAlignment()->setHorizontal($align);
        $sheet->getStyle($column.'1')->getAlignment()->setWrapText(true);
    }

    // Set widths for text-heavy columns
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(90);
    $sheet->getColumnDimension('F')->setWidth(50);
    $sheet->getColumnDimension('L')->setWidth(15);
    $sheet->getColumnDimension('M')->setWidth(15);

    // Table Headers
    $sheet->setCellValue('A1', 'Product ID:');
    $sheet->setCellValue('B1', 'Category:');
    $sheet->setCellValue('C1', 'Image:');
    $sheet->setCellValue('D1', 'Name:');
    $sheet->setCellValue('E1', 'Description:');
    $sheet->setCellValue('F1', 'Keywords:');
    $sheet->setCellValue('G1', 'Quantity:');
    $sheet->setCellValue('H1', 'Retail Price:');
    $sheet->setCellValue('I1', 'Selling Price:');
    $sheet->setCellValue('J1', 'Visibility:');
    $sheet->setCellValue('K1', 'Popularity:');
    $sheet->setCellValue('L1', 'Date Created:');
    $sheet->setCellValue('M1', 'Date Updated:');

    $rowCount                               = 2;

    foreach($allProducts as $data) // Get all product details into table
    {   // For each product, create row of data in table
        $findCategoryID                     = $data['CategoryID'];
        $queryGetCategory                   = "SELECT * FROM `Categories` WHERE `CategoryID` = '$findCategoryID'";
        $getCategory                        = mysqli_query($dbconnect, $queryGetCategory);
        $foundCategory                      = mysqli_fetch_assoc($getCategory);

        // Embed into cells
        $sheet->setCellValue('A'.$rowCount, $data['ProductID']);
        $sheet->setCellValue('B'.$rowCount, $foundCategory['CategoryName']);

        $categoryName                       = $foundCategory['CategoryName'];
        $productName                        = $data['ProductName'];
        $imgDir                             = $data['ProductImage'];

        // Add products images
        $drawing                            = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName($productName);
        $drawing->setDescription($categoryName);
        $drawing->setPath('images/uploads/products/'.$imgDir);
        $drawing->setCoordinates('C'.$rowCount);
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);
        $drawing->setResizeProportional(true);
        $drawing->setHeight(100);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $sheet->setCellValue('D'.$rowCount, $data['ProductName']);
        $sheet->setCellValue('E'.$rowCount, $data['ProductDescription']);
        $sheet->setCellValue('F'.$rowCount, $data['MetaKeywords']);
        $sheet->setCellValue('G'.$rowCount, $data['ProductQuantity']);
        $sheet->setCellValue('H'.$rowCount, '£'.number_format($data['RetailPrice'], 2, '.', ','));
        $sheet->setCellValue('I'.$rowCount, '£'.number_format($data['SellingPrice'], 2, '.', ','));
        $sheet->setCellValue('J'.$rowCount, $data['ProductVisibility'] == '1' ? "Visible":"Hidden");
        $sheet->setCellValue('K'.$rowCount, $data['ProductPopular'] == '1' ? "Popular":"Normal");
        $sheet->setCellValue('L'.$rowCount, strval($data['DateOfCreation']));
        $sheet->setCellValue('M'.$rowCount, strval($data['DateOfUpdate']));

        foreach($resize as $column) // Align resized columns to center & wrap text
        {
            $sheet->getStyle($column.$rowCount)->getAlignment()->setVertical($align);
            $sheet->getStyle($column.$rowCount)->getAlignment()->setWrapText(true);
        }

        // Align Last Two Columns Horizontally
        $sheet->getStyle('L'.$rowCount)->getAlignment()->setHorizontal($align);
        $sheet->getStyle('M'.$rowCount)->getAlignment()->setHorizontal($align);
        $rowCount++;
    }
    foreach($columns as $column) // Autosize, align & wrap cells
    {
        $sheet->getColumnDimension($column)->setAutoSize(true);
        for($i = 2; $i < $rowCount; $i++)
        {
            $sheet->getRowDimension($i)->setRowHeight(80);
            $sheet->getStyle($column.$i)->getAlignment()->setVertical($align);
            $sheet->getStyle($column.$i)->getAlignment()->setHorizontal($align);
            $sheet->getStyle($column.$i)->getAlignment()->setWrapText(true);
        }
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
    }
    else { return false; exit(); }

    // Download Generated Excel Spreadsheet
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
    $writer->save('php://output');
    return true; exit();
}

$filetype                                   = $_GET['filetype']; // Fetch filetype from link via GET request
generateProductSpreadsheet($filetype);      // Call above function
?>