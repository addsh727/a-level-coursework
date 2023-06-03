<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zed's Galaxy | Staff Portal</title>
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script defer src="js/validateLogin.js"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
</head>

<!-- Javascript Files -->
<script src="js/jquery-3.6.2.js"></script>
<script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="js/successTemplate.js"></script>
<script src="js/errorTemplate.js"></script>
<?php
include("php/config.php");
include("php/admin-login-process.php");
if(isset($_SESSION["adminLoggedIn"]) && $_SESSION["adminLoggedIn"]) // Redirect if staff logged in
{ header("Location: admin-dashboard"); }
if(isset($_COOKIE['adminEmail']) && isset($_COOKIE['adminPassword']) && isset($_COOKIE['adminCheckbox']))
{
    $savedEmail         = $_COOKIE['adminEmail'];
    $savedPassword      = $_COOKIE['adminPassword'];
    $savedCheckbox      = $_COOKIE['adminCheckbox'];
}
else
{
    $savedEmail         = "";
    $savedPassword      = "";
    $savedCheckbox      = false;
}
?>      <!-- Staff Portal Page -->
<body>
    <div class="hero">
        <div class="logo">
            <a href="./"><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
        </div>
        <div id="formbox">

            <!-- Error Prompts -->
            <div> <?php if(isset($prompt)) { echo $prompt; } ?> </div>
            <div>
                <h1 class="title">Staff Portal</h1>
            </div>

            <!-- Staff Login Form -->
            <form id="login" class="input-group" method="POST">
                <div class="input-box">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="text" name="adminEmail" id="loginEmail" class="input-field" required="required" value="<?php echo $savedEmail?>">
                    <span class="input-text">Email</span>
                    <div class="formError">‎</div>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" id="loginPassword" name="adminPassword" class="input-field" required="required" value="<?php echo $savedPassword?>">
                    <span class="input-text">Password</span>
                    <span class="eye" onclick="toggleLoginPassword()">
                        <i id="showLogin" class="fa-solid fa-eye"></i>
                        <i id="hideLogin" class="fa-sharp fa-solid fa-eye-slash"></i>
                    </span>
                    <div class="formError">‎</div>
                </div>
                <?php
                if(isset($savedCheckbox))
                {   if($savedCheckbox)
                    { echo '<input type="checkbox" name="rememberAdmin" id="remembercheckbox" class="check-box" checked>'; }
                    else { echo '<input type="checkbox" name="rememberAdmin" id="remembercheckbox" class="check-box">'; }
                } else { echo '<input type="checkbox" name="rememberAdmin" id="remembercheckbox" class="check-box">'; }
                ?>
                <label for="remembercheckbox" id="checkbox-text">Remember Me!</label>
                <br>
                <button type="submit" name="submitAdminLogin" class="submit-btn">Login</button>
            </form>
        </div>
    </div>

    <!-- Miscellaneous Scripts -->
    <script src="js/togglePasswordView.js"></script>
</body>
</html>
