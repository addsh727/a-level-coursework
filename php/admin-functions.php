<?php // All functions used in admin interface
function getAll($table)
{
    global $dbconnect;
    $query                          = "SELECT * FROM $table";
    $runQuery                       = mysqli_query($dbconnect, $query);
    return $runQuery;
}
function getAllOrders()
{
    global $dbconnect;
    $query                          = "SELECT * FROM `Orders` ORDER BY `OrderID` DESC";
    $runQuery                       = mysqli_query($dbconnect, $query);
    return $runQuery;
}
function getCompleteOrders()
{
    global $dbconnect;
    $query                          = "SELECT * FROM `Orders` WHERE `Status` = '1' ORDER BY `OrderID` DESC";
    $runQuery                       = mysqli_query($dbconnect, $query);
    return $runQuery;
}
function getRecentOrders()
{
    global $dbconnect;
    $query                          = "SELECT * FROM `Orders` ORDER BY `OrderID` DESC LIMIT 8";
    $runQuery                       = mysqli_query($dbconnect, $query);
    return $runQuery;
}
function getLatestCustomers()
{
    global $dbconnect;
    $query                          = "SELECT * FROM `Customers` ORDER BY DateOfCreation ASC LIMIT 50";
    $runQuery                       = mysqli_query($dbconnect, $query);
    return $runQuery;
}
function getDateTimeDifference($date) // Format how long ago from today
{
    $currentTimestamp               = strtotime(date('Y-m-d H:i:s'));
    $otherTimestamp                 = $currentTimestamp - strtotime($date);

    if($otherTimestamp < 60)
    { return 'a few seconds ago'; }
    else if($otherTimestamp >= 60 && $otherTimestamp < 3600)
    { return round($otherTimestamp/60).' mins ago'; }
    else if($otherTimestamp >= 3600 && $otherTimestamp < 86400)
    { return round($otherTimestamp/3600).' hours ago'; }
    else if($otherTimestamp >= 86400 && $otherTimestamp < (86400*30))
    { return round($otherTimestamp/(86400)).' days ago'; }
    else if($otherTimestamp >= (86400*30) && $otherTimestamp < (86400*365))
    { return round($otherTimestamp/(86400*30)).' months ago'; }
    else { return round($otherTimestamp/(86400*365)).' years ago'; }
}
?>