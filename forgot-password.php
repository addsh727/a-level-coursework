<?php
include("php/config.php");
if(isset($_COOKIE['Email'])) // Check for cookies
{ $savedEmail = $_COOKIE['Email']; } // Use cookies if cached
else
{ $savedEmail = ""; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zed's Galaxy | Forgot Password</title>
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" href="css/forgot-password.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
</head>

<!-- Javascript Files -->
<script src="js/jquery-3.6.2.js"></script>
<script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="js/successTemplate.js"></script>
<script src="js/errorTemplate.js"></script>

<body>
    <div class="hero">
        <div class="logo">
            <a href="./"><img title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
        </div>
        <div id="formbox">

            <!-- Error Prompts -->
            <div><?php if(isset($prompt)) { echo $prompt; } ?></div>
            <div class="textbox">
                <h1>Reset Password</h1>
            </div>

            <!-- Forgot Password Form -->
            <form id="reset" class="input-group" method="post">
                <div class="input-box">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="email" name="Email" class="input-field" required="required" value="<?= $savedEmail; ?>">
                    <span class="input-text">Email</span>
                    <div class="formError">‎</div>
                </div>
                <button type="submit" name="submitReset" class="submit-btn">Reset</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST["submitReset"])) // When reset password request is assigned
{   // Get Email and generate unique token
    $Email                          = mysqli_real_escape_string($dbconnect, $_POST['Email']);
    $token                          = mysqli_real_escape_string($dbconnect, md5(rand()));

    // Query the database
    $query                          = "SELECT * FROM `Customers`
                                    WHERE `Email`               = '$Email'
                                    LIMIT 1";
    $result                         = mysqli_query($dbconnect, $query);

    // Check if there is an account registered with email
    if(mysqli_num_rows($result)>0)
    {
        // If exists, fetch name and email registered to account
        $row                        = mysqli_fetch_assoc($result);
        $retrieveName               = $row['FirstName'];
        $retrieveEmail              = $row['Email'];

        // Refresh verification code with newer token
        $queryUpdateToken           = "UPDATE `Customers` SET
                                    `Verification`              = '$token'
                                    WHERE `Email`               = '$Email'
                                    LIMIT 1";
        $updateToken                = mysqli_query($dbconnect, $queryUpdateToken);

        if($query) // When database is updated
        {   // Send out reset email
            require_once("php/send-password-reset.php");
            sendPasswordReset($retrieveName, $retrieveEmail, $token);
        }
    }
    header("Refresh:3; url=form"); // Prepare redirct to form page

    ?>  <!-- Fire success alert -->
    <script type="text/javascript">
        $(function(){
            let timerInterval
            Swal.fire({
                icon: 'success',
                title: 'Request Received!',
                html: 'If your email matches, we will send over an email<br>Redirecting in <b></b>...',
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
    <?php
}
?>