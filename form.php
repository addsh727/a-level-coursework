<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zed's Galaxy | Form</title>
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script defer src="js/validateLogin.js"></script>
    <script defer src="js/validateRegistration.js"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
</head>

<!-- Javascript Files -->
<script src="js/jquery-3.6.2.js"></script>
<script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="js/successTemplate.js"></script>
<script src="js/errorTemplate.js"></script>
<?php
include("php/register.php");
include("php/login.php");
if(isset($_SESSION['customerLoggedIn']))
{ header("Location: account"); }
if(isset($_COOKIE['Email']) && isset($_COOKIE['Password']) && isset($_COOKIE['Checkbox']))
{
    $savedEmail         = $_COOKIE['Email'];
    $savedPassword      = $_COOKIE['Password'];
    $savedCheckbox      = $_COOKIE['Checkbox'];
}
else
{
    $savedEmail         = "";
    $savedPassword      = "";
    $savedCheckbox      = false;
}
?>      <!-- Form Page -->
<body>
    <div class="hero">
        <div class="logo">
            <a href="./"><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
        </div>
        <div id="formbox">

            <!-- Error Prompts -->
            <div>
                <?php
                if(isset($prompt))
                { echo $prompt; }
                else if(isset($_SESSION['msg']))
                {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>

            <!-- Form Buttons -->
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>

            <!-- Customer Login Form -->
            <form id="login" class="input-group" method="POST">
                <div class="input-box">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="text" name="Email" id="loginEmail" class="input-field" required="required" value="<?php echo $savedEmail?>">
                    <span class="input-text">Email</span>
                    <div class="formError">‎</div>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" id="loginPassword" name="Password" class="input-field" required="required" value="<?php echo $savedPassword?>">
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
                    { echo '<input type="checkbox" name="Remember" id="remembercheckbox" class="check-box" checked>'; }
                    else { echo '<input type="checkbox" name="Remember" id="remembercheckbox" class="check-box">'; }
                } else { echo '<input type="checkbox" name="Remember" id="remembercheckbox" class="check-box">'; }
                ?>
                <label for="remembercheckbox" id="checkbox-text">Remember Me!</label>
                <br>
                <a href="forgot-password">I forgot my password!</a>
                <button type="submit" name="submitLogin" class="submit-btn">Login</button>
            </form>

            <!-- Customer Register Form -->
            <form id="register" class="input-group" method="POST">
                <div class="input-box">
                    <span class="material-symbols-outlined">edit</span>
                    <input type="text" name="FirstName" id="registerFirstName" value="" class="input-field" required="required">
                    <span class="input-text">First Name</span>
                    <div class="formError">‎</div>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined">edit</span>
                    <input type="text" name="Surname" id="registerSurname" value="" class="input-field" required="required">
                    <span class="input-text">Surname</span>
                    <div class="formError">‎</div>
                </div>
                <div class="input-box" id="email">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="text" name="Email" id="registerEmail" value="" class="input-field" required="required">
                    <span class="input-text">Email</span>
                    <div class="formError">‎</div>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" id="registerPassword" name="Password" value="" class="input-field" required="required">
                    <span class="input-text">Password</span>
                    <span class="eye" onclick="toggleRegisterPassword()">
                        <i id="showRegister" class="fa-solid fa-eye"></i>
                        <i id="hideRegister" class="fa-sharp fa-solid fa-eye-slash"></i>
                    </span>
                    <div class="formError">‎</div>
                </div>
                <input type="checkbox" id="agree" class="check-box" required>
                <label for="agree" id="checkbox-text">I agree to the terms & conditions.</label>
                <button type="submit" name="submitRegistration" class="submit-btn" id="register">Register</button>
            </form>
        </div>
    </div>

    <!-- Miscellaneous Scripts -->
    <script src="js/form.js"></script>
    <script src="js/togglePasswordView.js"></script>
</body>
</html>
