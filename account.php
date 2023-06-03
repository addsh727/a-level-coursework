<?php
include("php/config.php");
include("php/logout.php");
$_SESSION['viewProfile'] = true; // Initialise view profile session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/account.css"/>
    <title>Zed's Galaxy | Account</title>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
</head>
<body>

    <!-- Session Details (if set) -->
    <div class="sessionDetails">
        <?php
        include("php/profile.php");
        include("php/authenticate.php");
            if(isset($_SESSION['customerLoggedIn']) && $_SESSION['settingShowSession'])
            {
                echo 'ID: ' . $_SESSION['authCustomer']['CustomerID'];
                echo '<br>Name: ' . $_SESSION['authCustomer']['CustomerName'];
                echo '<br>Email: ' . $_SESSION['authCustomer']['CustomerEmail'];
            };
        ?>
    </div>

    <!-- Header -->
    <header>

        <!-- Navigation bar -->
        <div class="navbar" id="navbar">
            <div class="logo">
                <a href="."><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="#">Home</a></li>
                    <li><a href="categories#categories">Categories</a></li>
                    <li><a href="about-us">About Us</a></li>
                    <li><a href="contact">Contact</a></li>
                    <li>
                        <a href="<?php if(isset($_SESSION["authCustomer"])){ echo "account";} else{ echo "form"; }; ?>">
                            <?php if(isset($_SESSION["authCustomer"])){ echo "Account";} else{ echo "Login"; }; ?>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="shoppingCart">
                <a href="shopping-cart">
                    <i class="fa fa-cart-shopping"></i>
                </a>
            </div>
            <div class="menu-icon">
                <i class="fa-solid fa-bars" onclick="ToggleMenu()"></i>
            </div>
        </div>
    </header>

    <!-- Account Page -->
    <div class="header">
        <div class="headTitle">
            <h1>
                Account
                <div class="underline-title"><span></span></div>
            </h1>
        </div>
        <div class="sectionContainer" id="editProfile">
            <div class="options">
                <a href="my-orders">My Orders</a>
                <form method="POST">
                    <button type="submit" name="customerLogout">
                        Logout
                    </button>
                </form>
            </div>
            <div class="profile">
                <h2>Profile:</h2>
                <div class="profileContainer">
                    <?php
                        if(isset($_POST['editProfile'])) // If editing profile
                        {   // Redirect to the edit tab
                            ?>
                                <script type="text/javascript">
                                    window.location.hash = '#editProfile';
                                </script>
                            <?php
                            unset($_SESSION['viewProfile']); // Remove view tab
                        } // Retrieve customer profile information
                        $customerID                     = $_SESSION['authCustomer']['CustomerID'];
                        $queryGetProfile                = "SELECT * FROM `Customers`
                                                        WHERE `CustomerID` = '$customerID'";
                        $getProfile                     = mysqli_query($dbconnect, $queryGetProfile);
                        $profile                        = mysqli_fetch_assoc($getProfile);
                        if(isset($_SESSION['viewProfile'])) // When viewing profile, display view tab
                        {
                            ?>
                                <div class="entityEditContainer" id="viewProfile">
                                    <div class="entityEditBox">
                                        <form disabled>
                                            <label for="">First Name:</label>
                                            <div class="input-box">
                                                <input type="text" placeholder="First Name" disabled value="<?= $profile['FirstName']; ?>"></input>
                                            </div>
                                            <label for="">Surname:</label>
                                            <div class="input-box">
                                                <input type="text" placeholder="Surname" disabled value="<?= $profile['Surname']; ?>"></input>
                                            </div>
                                            <label for="">Email:</label>
                                            <div class="input-box">
                                                <input type="email" placeholder="Email" disabled value="<?= $profile['Email']; ?>"></input>
                                            </div>
                                            <label for="">Password:</label>
                                            <div class="input-box">
                                                <input type="password" placeholder="Password" disabled value="<?= $profile['Password']; ?>"></input>
                                            </div>
                                        </form>
                                        <form method="POST">
                                            <input type="hidden" name="editProfileID" value="<?= $customerID ?>"></input>
                                            <div class="input-box button">
                                                <input type="submit" name="editProfile" value="Edit"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                        }
                        if(isset($_POST['editProfile'])) // When editing profile, display edit tab
                        {
                            ?>
                                <div class="entityEditContainer">
                                    <div class="entityEditBox">
                                        <form method="POST">
                                            <input type="hidden" name="editProfileID" value="<?= $customerID; ?>"></input>
                                            <label>First Name:</label>
                                            <div class="input-box">
                                                <input type="text" placeholder="First Name" required disabled value="<?= $profile['FirstName']; ?>"></input>
                                            </div>
                                            <label>Surname:</label>
                                            <div class="input-box">
                                                <input type="text" placeholder="Surname" required disabled value="<?= $profile['Surname']; ?>"></input>
                                            </div>
                                            <span class="edit">Edit:</span>
                                            <label>Email:</label>
                                            <div class="input-box">
                                                <input type="email" name="changeProfileEmail" placeholder="Email" required value="<?= $profile['Email']; ?>"></input>
                                            </div>
                                            <label>Password:</label>
                                            <div class="input-box">
                                                <input type="password" name="changeProfilePassword" placeholder="Password" required value="<?= $profile['Password']; ?>"></input>
                                            </div>
                                            <div class="input-box button">
                                                <input type="submit" name="saveProfileChanges" value="Save Changes"></input>
                                            </div>
                                        </form>
                                        <form method="POST">
                                            <div class="input-box button cancel">
                                                <input type="submit" name="cancelProfileChanges" value="Cancel"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="row-footer">
            <div class="footer-col">
                <a href="#Home"><img src="images/LogoTransparent.png" class="footer-logo"></a>
                <p>
                    Local Galaxy For Online Shopping 
                </p>
            </div>
            <div class="footer-col">
                <h3>
                    Visit Our Store!
                    <div class="underline-footer"><span></span></div>
                </h3>
                <ul>
                    <li>100 Imaginary Street</li>
                    <li>Fiction City</li>
                    <li>I3 6EI</li>
                    <li>United Kingdom</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>
                    More Links
                    <div class="underline-footer"><span></span></div>
                </h3>
                <ul>
                    <li><a href=".">Home</a></li>
                    <li><a href="contact">Map</a></li>
                    <li><a href="about-us#FAQs">FAQs</a></li>
                    <li><a href="./#Popular">Products</a></li>
                    <li>
                        <a href=
                        <?php if(isset( $_SESSION['authStaff'] ) && ($_SESSION['adminLoggedIn'] == true))
                        { echo 'admin-dashboard'; } else { echo 'staff-portal'; } ?> target="_blank">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            Staff
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <div class="social-icons">
                    <h3>
                        Follow us!
                        <div class="underline-footer"><span></span></div>
                    </h3>
                    <ul>
                        <a href="https://www.instagram.com/leytonsixthform/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://twitter.com/leyton6thform" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://www.facebook.com/LeytonSixthFormCollege" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/leyton-sixth-form/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <p class="Copyright" id="year">Adib Shehab © <?= date("Y"); ?> - All Rights Reserved</p>
    </footer>

    <!-- Miscellaneous Scripts -->
    <script type="text/javascript" src="js/toggleMenu.js"></script>
    <script type="text/javascript" src="js/stickyNavbar.js"></script>
</body>
</html>