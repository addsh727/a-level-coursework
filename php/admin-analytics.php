<?php // Initialise analytic variables 
$monthCount                         = 1;
$monthlySales                       = [];
$revenueArr                         = [];
$categoryNames                      = [];
$categoryAllProducts                = [];
$monthlyRevenue                     = 0;
while($monthCount <= 12) // Produce analytics for each month
{
    $queryGetSales                  = "SELECT
                                    `OrderID`, `TotalPrice`, MONTH(`DateOfCreation`) AS `OrderMonth`
                                    FROM `Orders`
                                    WHERE `Status`                  = '1'
                                    AND YEAR(`DateOfCreation`)      = YEAR(CURRENT_TIMESTAMP)
                                    AND MONTH(`DateOfCreation`)     = '$monthCount'
                                    AND `PaymentMethod`             != 'Admin Test Pay'
                                    ";
    $getSales                       = mysqli_query($dbconnect, $queryGetSales);

    // Calculate monthly revenue then store values into an array
    $monthlyRevenue                 = 0;
    foreach($getSales as $saleData)
    { $monthlyRevenue               += $saleData['TotalPrice']; }
    $monthlySales[]                 += mysqli_num_rows($getSales);
    $revenueArr[]                   += $monthlyRevenue;
    $monthCount                     += 1;
}

// Get categories from database
$getCategoryNames                   = "SELECT * FROM `Categories` WHERE `CategoryVisibility` = '1'";
$retrieveCategoryNames              = mysqli_query($dbconnect, $getCategoryNames);
foreach($retrieveCategoryNames as $category) // category information into an array
{
    $categoryNames[]                = $category['CategoryName'];
    $tempCategoryID                 = $category['CategoryID'];

    // Insert number of products in each category into an array
    $getCategoryProducts            = "SELECT * FROM `Products`
                                    WHERE `CategoryID`              = '$tempCategoryID'
                                    AND `ProductVisibility`         = '1'";
    $categoryProducts               = mysqli_query($dbconnect, $getCategoryProducts);
    $categoryAllProducts[]          += mysqli_num_rows($categoryProducts);
}
?>