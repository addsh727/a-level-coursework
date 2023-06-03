<?php // Connect to database
$hostname                           = "localhost";
$dbusername                         = "root";
$dbpassword                         = "";
$dbname                             = "s2106630";
try // Attempt connection
{
    $dbconnect = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
    if($dbconnect)
    { session_start(); } // Create session
    else
    { throw new Exception(mysqli_connect_error()); }
}
catch(Exception $ex) // In the event of an error
{   // Generate caught error message
    $caughtErr = $ex->getMessage();
    echo "
        <p style='text-align: center; font-size: 48px;'>Connection Error</p>
        <br>
        <p style='text-align: center;'>Connection Failed: $caughtErr</p>
        <br>
    ";
    header("Refresh:3; url=.");
    die();
}
// Check if staff logged in and show session details set
if(!(isset($_SESSION['settingShowSession']) && isset($_SESSION["authStaff"])))
{ $_SESSION['settingShowSession']   = false; } // Otherwise, keep show session to false
include("visitorSession.php"); // Record session data
?>