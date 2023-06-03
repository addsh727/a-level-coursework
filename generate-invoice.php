<?php
header('Content-Type: text/html;charset=utf-8');
require('fpdf185/fpdf.php');
require('php/config.php');

if((isset($_GET['orderID']) && $_GET['trackingID']) && isset($_GET['customerID'])) // Check if invoice to retrieve details assigned 
{   // Then fetch details via GET request and retrieve full order details
    $orderID                = $_GET['orderID'];
    $trackingID             = $_GET['trackingID'];
    $customerID             = $_GET['customerID'];

    $queryTrackingData      = "SELECT * FROM `Orders`
                            WHERE `OrderID`                 = '$orderID'
                            AND `TrackingID`                = '$trackingID'
                            AND `CustomerID`                = '$customerID'";
    $trackingData           = mysqli_query($dbconnect, $queryTrackingData);

    if(mysqli_num_rows($trackingData) <= 0) { die(); } // If no purchases, then break algorithm

    $orderData              = mysqli_fetch_assoc($trackingData);

    $queryGetOrder          = "SELECT
                            o.OrderID AS orderID, o.TrackingID, o.CustomerID, ol.*,
                            ol.ProductQuantity AS orderQuantity, p.ProductName
                            FROM orders o, orderline ol, products p
                            WHERE o.CustomerID              = '$customerID'
                            AND ol.OrderID                  = o.OrderID
                            AND p.ProductID                 = ol.ProductID
                            AND o.TrackingID                = '$trackingID'";
    $getOrder               = mysqli_query($dbconnect, $queryGetOrder);
}
// Initialise variables
$date                       = date("d/m/Y");
$pound                      = chr(163);

$name                       = $orderData['FirstName']." ".$orderData['Surname'];
$address                    = $orderData['Address'];
$region                     = $orderData['City'].", ".$orderData['Postcode'];
$phoneNumber                = $orderData['PhoneNumber'];
$paymentMethod              = $orderData['PaymentMethod'];
$paymentID                  = $orderData['PaymentID'];
$totalPrice                 = $pound.number_format($orderData['TotalPrice'], 2, '.', ',');
$orderDate                  = date('d/m/Y', strtotime($orderData['DateOfCreation']));

// Create PDF object
$pdf = new FPDF('P','mm','A4');
// Add new page
$pdf->AddPage();
// Set font to Arial, Bold, 14pt
$pdf->SetFont('Arial','B',14);

// Cell(width , height , text , border , end line , [align])
$pdf->Cell(125, 5, 'ZED\'S GALAXY', 0, 0);
$pdf->Cell(55, 5, 'INVOICE', 0, 1); // end of line

$pdf->SetFont('Arial','',12); // Set font to arial, regular, 12pt

$pdf->Cell(59, 5, '', 0, 1); // end of line

$pdf->Cell(125, 5, '100 Imaginary Street', 0, 0);
$pdf->Cell(30, 5, 'Invoice Date:', 0, 0);
$pdf->Cell(34, 5, $date, 0, 1); //end of line

$pdf->Cell(125, 5, 'Fiction City', 0, 0);
$pdf->Cell(30, 5, 'Order Date:', 0, 0);
$pdf->Cell(34, 5, $orderDate, 0, 1); // end of line

$pdf->Cell(125, 5, 'I3 6EI', 0, 0);
$pdf->Cell(30, 5, 'Order:', 0, 0);
$pdf->Cell(34, 5, $trackingID, 0, 1); // end of line

$pdf->Cell(125, 5, 'United Kingdom', 0, 0);
$pdf->Cell(30, 5, 'Customer ID:', 0, 0);
$pdf->Cell(34, 5, $customerID, 0, 1); // end of line

$pdf->Cell(125, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Payment:', 0, 0);
$pdf->Cell(34, 5, $paymentMethod, 0, 1);

if(!$paymentID == '')
{
    $pdf->Cell(125, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'Payment ID:', 0, 0);
    $pdf->Cell(34, 5, $paymentID, 0, 1); // end of line
}

// Make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 10, '', 0, 1); // end of line

// Billing address
$pdf->Cell(189, 5, 'Recipient:', 0, 1); // end of line
$pdf->Cell(189, 3, '', 0, 1); // end of line

// Add dummy cell at beginning of each line for indentation
$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $name, 0, 1);

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $address, 0, 1);

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $region, 0, 1);

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $phoneNumber, 0, 1);

// Make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 10, '', 0, 1); // end of line

// Invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(80, 8, 'Product:', 1, 0);
$pdf->Cell(35, 8, 'Price:', 1, 0, 'C');
$pdf->Cell(35, 8, 'Quantity:', 1, 0, 'C');
$pdf->Cell(39, 8, 'Subtotal:', 1, 1, 'C'); //end of line

foreach($getOrder as $order) // Numbers are right-aligned so we give 'R' after new line parameter
{   // Insert details for each purchase
    if(strlen($order['ProductName']) >= 30)
    { $productName          = substr($order['ProductName'], 0, 30). "..."; }
    else { $productName     = $order['ProductName']; }

    $sub                    = intval($order['SellingPrice'])*intval($order['ProductQuantity']);
    $subtotal               = $pound.number_format($sub, 2, '.', ',');
    $sellingPrice           = $pound.number_format($order['SellingPrice'], 2, '.', ',');

    $pdf->Cell(80, 8, $productName, 1, 0);
    $pdf->Cell(35, 8, $sellingPrice, 1, 0, 'C');
    $pdf->Cell(35, 8, "x ".$order['ProductQuantity'], 1, 0, 'C');
    $pdf->Cell(39, 8, $subtotal, 1, 1, 'C'); //end of line
}

// Final Costs
$pdf->Cell(106, 5, '', 0, 0);
$pdf->Cell(44, 10, 'Total Due:', 0, 0, 'R');
$pdf->Cell(39, 10, $totalPrice, 1, 1, 'C'); //end of line

$pdf->Output($trackingID.'-'.$date.'.pdf', 'I');
?>