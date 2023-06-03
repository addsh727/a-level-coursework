<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zed's Galaxy | Change Password</title>
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/change-password.css">
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

<!-- Main Body -->
<body>
    <div class="hero">
        <div class="logo">
            <a href="./"><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
        </div>
        <div id="formbox">

            <!-- Change Password Algorithm -->
            <?php
            if(isset($_POST['passwordChange'])) // When new password is assigned
            {   // Retrieve email and verification token from link via GET request
                if(isset($_GET['email']) && (isset($_GET['token']))) // After getting both values
                {   // Retrieve & hash new password
                    $email                                  = $_GET['email'];
                    $token                                  = $_GET['token'];
                    $newPassword                            = mysqli_real_escape_string($dbconnect, $_POST['Password']);
                    $HashedPassword                         = mysqli_real_escape_string($dbconnect, password_hash($newPassword, PASSWORD_DEFAULT));

                    $queryCheckToken                        = "SELECT `Verification` FROM `Customers`
                                                            WHERE
                                                            `Email`                     = '$email'
                                                            AND
                                                            `Verification`              = '$token'
                                                            LIMIT 1";
                    $checkToken                             = mysqli_query($dbconnect, $queryCheckToken);

                    if(mysqli_num_rows($checkToken) > 0) // Check if token is valid
                    {   // Then update password & remove token 
                        $queryUpdatePassword                = "UPDATE `Customers` SET
                                                            `Password`                  = '$newPassword',
                                                            `HashedPassword`            = '$HashedPassword'
                                                            WHERE `Email`               = '$email'
                                                            AND `Verification`          = '$token'
                                                            LIMIT 1";
                        $updatePassword                     = mysqli_query($dbconnect, $queryUpdatePassword);

                        $queryRemoveToken                   = "UPDATE `Customers` SET
                                                            `Verification`              = ''
                                                            WHERE `Email`               = '$email'
                                                            LIMIT 1";
                        $removeToken                        = mysqli_query($dbconnect, $queryRemoveToken);

                        if($updatePassword && $removeToken) // If password successfully updated & token removed
                        {   // Fire success alert & redirect to form page
                            header("Refresh:3; url=form");
                            ?>
                            <script type="text/javascript">
                                $(function(){
                                    let timerInterval
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Password Changed!',
                                        html: 'Please use your new password to login!<br>Redirecting in <b></b>...',
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
                            <?php // In event of further errors
                        } else { echo "<p class='errorText'>Password could not be updated.</p>"; }
                    } else { echo "<p class='errorText'>Invalid verification code.</p>"; }
                } else  { echo "<p class='errorText'>GET request failed...</p>"; }
            }
            if(isset($_GET['email']) || (isset($_GET['token']))) // Check if either values are assigned to link
            {   // Then display the...
                ?>  <!-- ...Change Password Form -->
                    <div class="textbox">
                        <h1>Change Password</h1>
                    </div>
                    <script defer src="js/validateChangePassword.js"></script>
                    <form id="reset" class="input-group" method="post">
                        <div class="input-box">
                            <span class="material-symbols-outlined">lock</span>
                            <input type="password" id="changePassword" name="Password" class="input-field" required="required" value="">
                            <span class="input-text">Password</span>
                            <span class="eye" onclick="toggleChangePassword()">
                                <i id="showChangePassword" class="fa-solid fa-eye"></i>
                                <i id="hideChangePassword" class="fa-sharp fa-solid fa-eye-slash"></i>
                            </span>
                            <div class="formError">‎</div>
                        </div>
                        <div class="input-box">
                            <span class="material-symbols-outlined">lock</span>
                            <input type="password" id="changeConfirm" name="Confirm" class="input-field" required="required" value="">
                            <span class="input-text">Confirm Password</span>
                            <span class="eye" onclick="toggleConfirmChangePassword()">
                                <i id="showConfirmChangePassword" class="fa-solid fa-eye"></i>
                                <i id="hideConfirmChangePassword" class="fa-sharp fa-solid fa-eye-slash"></i>
                            </span>
                            <div class="formError">‎</div>
                        </div>
                        <button type="submit" name="passwordChange" class="submit-btn">Change</button>
                    </form>
                    <script src="js/togglePasswordView.js"></script>
                <?php
            }
            else
            {   // Fire error alert & text
                ?>
                    <h1 class='error'>Fatal error...</h1>
                    <script type="text/javascript">redirectToast("center");</script>
                <?php
                header("Refresh:3; url=form");
            }
            ?>
        </div>
    </div>
</body>
</html>