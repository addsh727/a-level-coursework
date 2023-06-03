<?php // All statistic counters and some background calculations
$staffIDToGet                       = $_SESSION['authStaff']['StaffID'];
$queryStaffDetails                  = "SELECT * FROM `Staff` WHERE `StaffID` = '$staffIDToGet'";
$getStaffDetails                    = mysqli_query($dbconnect, $queryStaffDetails);
$staffDetail                        = mysqli_fetch_assoc($getStaffDetails);
$_SESSION["staffName"]              = $staffDetail['FirstName'];

$queryCustomerAccounts              = "SELECT `CustomerID` FROM `Customers`";
$foundAccounts                      = mysqli_query($dbconnect, $queryCustomerAccounts);
$customerAccounts                   = mysqli_num_rows($foundAccounts);

date_default_timezone_set("Europe/London");
$currentTimestamp                   = date('Y-m-d H:i:s');
$currentTime                        = strtotime($currentTimestamp);
$timeoutTime                        = $currentTime - (30);
$timeout                            = date('Y-m-d H:i:s', $timeoutTime);

$getUniqueVisitors                  = getAll('Sessions');
$uniqueVisitors                     = mysqli_num_rows($getUniqueVisitors);

$querySelectTotal                   = "SELECT * FROM `Sessions` WHERE `VisitTimestamp` >= '$timeout'";
$selectTotal                        = mysqli_query($dbconnect, $querySelectTotal);
$totalOnline                        = mysqli_num_rows($selectTotal);

$allCompleteOrders                  = getCompleteOrders();
$completeOrders                     = mysqli_num_rows($allCompleteOrders);

$queryPendingOrders                 = "SELECT * FROM `Orders` WHERE `Status` = '0'";
$getPendingOrders                   = mysqli_query($dbconnect, $queryPendingOrders);
$pendingOrders                      = mysqli_num_rows($getPendingOrders);

$getAllProducts                     = getAll('Products');
$allProducts                        = mysqli_num_rows($getAllProducts);

$totalRevenue                       = 0;
$queryGetOrderCost                  = "SELECT * FROM `Orders` WHERE `PaymentMethod` != 'Admin Test Pay'";
$getOrderCost                       = mysqli_query($dbconnect, $queryGetOrderCost);

foreach($getOrderCost as $order) { $totalRevenue += $order['TotalPrice']; }
// foreach($allCompleteOrders as $order) { $totalRevenue += $order['TotalPrice']; }
?>