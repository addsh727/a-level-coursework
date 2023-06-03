<?php // Recording new visitor sessions
if(isset($_POST['ip']))  // If user lands on website, then get connection information
{   // Retrieve network information from ipAPI.co and check if information already recorded
    $IP                         = mysqli_real_escape_string($dbconnect, $_POST['ip']);
    $ORG                        = mysqli_real_escape_string($dbconnect, $_POST['org']);
    $City                       = mysqli_real_escape_string($dbconnect, $_POST['city']);
    $Region                     = mysqli_real_escape_string($dbconnect, $_POST['region']);
    $Country                    = mysqli_real_escape_string($dbconnect, $_POST['country']);
    $Continent                  = mysqli_real_escape_string($dbconnect, $_POST['continent']);

    date_default_timezone_set("Europe/London"); // Set timezone to London
    $currentTimestamp           = date('Y-m-d H:i:s');
    $currentTime                = strtotime($currentTimestamp);
    $timeoutTime                = $currentTime - (30);
    $timeout                    = date('Y-m-d H:i:s', $timeoutTime);

    $querySessionExists         = "SELECT * FROM `Sessions` WHERE `IP` = '$IP'";
    $sessionExists              = mysqli_query($dbconnect, $querySessionExists);
    $sessionCheck               = mysqli_num_rows($sessionExists);

    if($sessionCheck == 0 && $IP != "") // If information not already recorded
    {   // Then insert new session record into database
        $queryAddVisitor        = "INSERT INTO `Sessions`(`SessionID`, `VisitTimestamp`,
                                    `IP`, `Organisation`, `City`, `Region`, `Country`, `Continent`
                                ) VALUES('', '$currentTimestamp',
                                    '$IP', '$ORG', '$City', '$Region', '$Country', '$Continent'
                                )";
        $addVisitor             = mysqli_query($dbconnect, $queryAddVisitor);
    }
    else// Otherwise if a previous visitor
    {   // Then update timestamp of visit for previous visitor
        $queryUpdateVisitor     = "UPDATE `Sessions` SET
                                `VisitTimestamp`        = '$currentTimestamp'
                                WHERE `IP`              = '$IP'";
        $UpdateVisitor          = mysqli_query($dbconnect, $queryUpdateVisitor);
    };
}
?>