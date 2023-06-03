<?php // Export data algorithm
if(isset($_POST['exportProductsButton'])) // If staff exports product data
{   // Attach file extension to link and export spreadsheet 
    $filetype = $_POST['exportProducts'];
    header("Location: generate-product-spreadsheet?filetype=$filetype");
}
if(isset($_POST['exportOrdersButton'])) // If staff exports orders data
{   // Attach file extension to link and export spreadsheet 
    $filetype = $_POST['exportOrders'];
    header("Location: generate-orders-spreadsheet?filetype=$filetype");
}
?>