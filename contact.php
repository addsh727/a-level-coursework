<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/contact.css"/>
    <title>Zed's Galaxy | Contact</title>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
</head>
<body>

    <!-- Session Details (if set) -->
    <div class="sessionDetails">
        <?php
            include("php/contact-message.php");
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

        <!-- Navbar -->
        <div class="navbar" id="navbar">
            <div class="logo">
                <a href="."><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href=".">Home</a></li>
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

    <!-- Contact Us Page -->
    <div class="header">
        <div class="headTitle">
            <h1>
                Contact Us
                <div class="underline-title"><span></span></div>
            </h1>
        </div>

        <!-- Contact Details & Map -->
        <div class="container-1">
            <div class="row">
                <div class="col-2">
                    <p>
                        <br><b>CEO:</b> Zed
                    </p>
                    <p>
                        <br><b>Leyton Sixth Form College</b>
                        <br>Essex Road, Leyton, London, E10 6EQ
                    </p>
                    <p>
                        <br><b>Phone Number:</b> 020 8928 9000
                        <br><b>Fax:</b> 020 8928 9200
                    </p>
                    <p>
                        <br><b>E-mail:</b> addsh727@gmail.com
                    </p>
                    <a href="#contactUs" class="btn">Fill out contact form →</a>
                </div>
                <div class="col-2">
                    <div class="mapContainer">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9918.305647397414!2d-0.0028413!3d51.5759984!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761d8b01c8e7c3%3A0x63d5743a90e0fa64!2sLeyton%20Sixth%20Form%20College!5e0!3m2!1sen!2suk!4v1678186627247!5m2!1sen!2suk" width="100%" height="100%" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <a href="#contactUs">
            <div class="scrollDownBox">
            </div>
        </a>
        <div class="scrollDown">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="sectionContainer" id="contactUs">
        <div class="contactContainer">
            <div class="formTitle">
                <h2>
                    Contact Form
                    <div class="underline-title"><span></span></div>
                </h2>
            </div>
            <div class="contactBox">
                <form method="POST">
                    <input type="text" class="inputField" name="name" placeholder="Your Name" value="<?php if(isset($_SESSION['authCustomer']['CustomerName'])) { echo $_SESSION['authCustomer']['CustomerName']; }; ?>" required>
                    <input type="email" class="inputField" name="email" placeholder="Your Email" value="<?php if(isset($_SESSION['authCustomer']['CustomerEmail'])) { echo $_SESSION['authCustomer']['CustomerEmail']; }; ?>" required>
                    <input type="text" class="inputField" name="subject" placeholder="Subject" required>
                    <textarea type="text" class="inputField" name="content" placeholder="Your Message" required></textarea>
                    <button type="submit" name="sendMessage">Send →</button>
                </form>
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
                        { echo 'admin-dashboard'; }
                        else { echo 'staff-portal'; } ?> target="_blank">
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