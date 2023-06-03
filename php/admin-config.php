<?php // Connect to database
$hostname                           = "localhost";
$dbusername                         = "root";
$dbpassword                         = "";
$dbname                             = "s2106630";

try // Attempt connection
{
    $dbconnect = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
    if($dbconnect) { return; } else { throw new Exception(mysqli_connect_error()); }
}
catch(Exception $ex) // In the event of an error
{   // Generate caught error message
    $caughtErr = $ex->getMessage();
    echo "
        <div id='warning' class='modal'>
            <p style='text-align: center; font-size: 48px;'>Access Denied</p>
            <br>
            <p style='text-align: center;'>Connection Failed: $caughtErr</p>
            <br>
        </div>

        <script>
            $('#warning').modal({
                escapeClose: false,
                clickClose: false,
                showClose: false
            });
        </script>
    ";
    header("Refresh:3; url=.");
    die();
}
?>