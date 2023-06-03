<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zed's Galaxy | Verify Account</title>
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" href="css/verify.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src="js/redirectToast.js"></script>
</head>

<!-- PHP Verification Algorithm -->
<?php
$prompt = '';

if(isset($_GET['email']) && (isset($_GET['verification']))) // If email and verification code assigned
{   // Then retrieve both values via GET request & complete verify process
    $Email                                      = $_GET['email'];
    $Verification                               = $_GET['verification'];

    $checkVerification                          = "SELECT * FROM `Customers`
                                                WHERE `Email`               = '$Email'
                                                AND `Verification`          = '$Verification'
                                                LIMIT 1";
    $result                                     = mysqli_query($dbconnect, $checkVerification);
    if($result) // Check if values match with database
    {   // Then continue verification process
        if(mysqli_num_rows($result) == 1) // Check if only one record found
        {   // Then continue verification process
            $resultFetch = mysqli_fetch_assoc($result);
            if($resultFetch['Verified'] == '0') // If customer not verified
            {   // Then set customer accounter status to verified
                $update                         = "UPDATE `Customers` SET
                                                `Verified`                  = '1',
                                                `Verification`              = ''
                                                WHERE `Email`               = '$resultFetch[Email]'
                                                LIMIT 1";
                if(mysqli_query($dbconnect, $update)) // If customer verified
                {   // Then fire success alert & redirect to home page
                    header("Refresh:3; url=./");
                    ?>
                    <script type="text/javascript">
                        $(function(){
                            let timerInterval
                            Swal.fire({
                            icon: 'success',
                            title: 'Email Verified!',
                            html: 'Redirecting in <b></b>...',
                            timer: 3300,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Math.round(Swal.getTimerLeft()/1000)
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval/1000)
                            }
                            })
                        });
                    </script>
                    <?php // In the event of error(s), fire redirect toast, message & redirect to homepage
                } else { $prompt                = "<h1 class='error'>Your account could not be verified.</h1>
                    <script type='text/javascript'>redirectToast('center');</script>"; }
            } else { $prompt                    = "<h1 class='error'>Your account is already verified.</h1>
                <script type='text/javascript'>redirectToast('center');</script>"; }
        } else { $prompt                        = "<h1 class='error'>Incorrect Verification Code.</h1>
            <script type='text/javascript'>redirectToast('center');</script>"; }
    } else { $prompt                            = "<h1 class='error'>Verification Error.<br>Verification code didn't work...</h1>
        <script type='text/javascript'>redirectToast('center');</script>"; }
} else { $prompt                                = "<h1 class='error'>Oops...<br>Something went wrong...</h1>
    <script type='text/javascript'>redirectToast('center');</script>"; }
header("Refresh:3; url=.");
?>

<!-- Verification Page -->
<body>
    <div class="hero">
        <div class="logo">
            <a href="./"><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
        </div>
        <div class="formbox">
            <div class="textbox"><?php if(isset($prompt)) { echo $prompt; } ?></div>
        </div>
    </div>
</body>
</html>