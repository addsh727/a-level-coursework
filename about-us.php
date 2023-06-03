<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/about-us.css"/>
    <title>Zed's Galaxy | About Us</title>
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

    <!-- Landing Section -->
    <div class="header">
        <div class="headTitle">
            <h1>
                About Us
                <div class="underline-title"><span></span></div>
            </h1>
        </div>
        <div class="container-1">
            <div class="row">
                <div class="col-2">
                    <img src="images/FrontPageS22.png">
                </div>
                <div class="col-2">
                    <h1>
                        WE SELL TECH!
                    </h1>
                    <p>Accessiblility to technology like never before!
                        <br>
                        <br>
                        We bring online shopping to your local area.
                    </p>
                </div>
            </div>
        </div>
        <a href="#info">
            <div class="scrollDownBox">
            </div>
        </a>
        <div class="scrollDown">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Infographics -->
    <div class="sectionContainer" id="info">
        <div class="infoGrid">
            <div class="info">
                <img src="images/aboutUs-1.jpg" alt="(Image)">
                <h2>Who are we?</h2>
                <p>Zed's Galaxy is an electronics store that sells phones, computers, televisions, peripherals, appliances and other such items. Our small local store also works as an internet café on the high street. </p>
            </div>
            <div class="info">
                <img src="images/aboutUs-2.jpg" alt="(Image)">
                <h2>What's our purpose?</h2>
                <p>We aim to establish a technological presence locally and provide new electronics to the locals in our area, enabling them with access to modern developments.</p>
            </div>
            <div class="info">
                <img src="images/aboutUs-3.jpg" alt="(Image)">
                <h2>What do we do?</h2>
                <p>We provide tech support, printing services, device repairs, buying and selling hardware, applying screen protectors etc.</p>
            </div>
            <div class="info">
                <img src="images/aboutUs-4.jpg" alt="(Image)">
                <h2>How did we get here?</h2>
                <p>Zed's Galaxy started off as a tiny business that a couple of tech-savvy friends had launched. Through the years, the company grew and started to expand its outreach to the globe.</p>
            </div>
        </div>
    </div>

    <!-- FAQs Dropdown Accordions -->
    <div class="accordionContainer" id="FAQs">
        <div class="FAQTitle">
            <h2>
                FAQs:
                <div class="underline-title"><span></span></div>
            </h2>
        </div>
        <ul class="accordionFAQ">
            <li>
                <input type="radio" name="accordion" id="1">
                <label for="1">When will my order be shipped?</label>
                <div class="content">
                    <p>
                        For deliveries, we aim to dispatch your order within 7 working days.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="2">
                <label for="2">Do you ship internationally?</label>
                <div class="content">
                    <p>
                        Unfortunately, we only ship to the UK. We are planning to make international shipping available by 2024.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="3">
                <label for="3">I want to change my order details. How can I do this?</label>
                <div class="content">
                    <p>
                        <a href="contact" target="_blank">Contact us here</a> with your Tracking ID and your new details and we will update your details.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="4">
                <label for="4">Is there a warranty?</label>
                <div class="content">
                    <p>
                        Yes, most certainly. Free from manufacturing defects, all sold products come with a 1-year warranty from the date of purchase.
                        <br>Please notify us your product arrives damaged upon delivery. The warranty however, does not cover any normal wear and tear, scratches, or lost/stolen items. Please exercise caution as any abuse or misuse of bought products will void your warranty.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="5">
                <label for="5">What is your return/exchange policy?</label>
                <div class="content">
                    <p>
                        Reach out to us via email or visit us in-person <a href="contact" target="_blank">(click here for more details)</a> and we will sort you out.
                        <br>
                        <br>Newly purchased products can be returned for a full refund within 30 days of delivery. We offer hassle-free returns without charge for all orders, however expedited shipping costs are cannot be refunded.
                        <br>
                        <br>To start your return, please locate your order number. Print your return label then attach the label to your return package. If possible, use the same shipping materials that you received your order with.
                        <br>Remove any previous labels and securely attach the new shipping label onto your package. A designated carrier will come to collect the item from you.
                        <br>
                        <br>Please note:
                        <br>
                        <br>• Make sure you are only returning item(s) that your return label has listed. Any additional item(s) may not be appropriately processed if no return is requested.
                        <br>• Allow up to 7 working days from day od send-off to our warehouse to be processed.
                        <br>• Refunds will be returned to via the same form of payment.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="6">
                <label for="6">Can I get a refund?</label>
                <div class="content">
                    <p>
                        To initiate your refund request, locate your tracking ID and please visit our <a href="contact#contactUs">Contact</a> page, and fill out your request form with your subsequent details.
                        <br>We aim to respond to your enquiries within 24 hours. You can expect a swift response from our team.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="7">
                <label for="7">Missing items(s)/received the wrong item(s). What now?</label>
                <div class="content">
                    <p>
                        <a href="contact#contactUs" target="_blank">Contact us here</a> with your Tracking ID and we will see to your dilemma.
                    </p>
                </div>
            </li>
        </ul>
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
    <script type="text/javascript" src="js/cart.js"></script>
    <script type="text/javascript" src="js/productQuantity.js"></script>
    <script type="text/javascript" src="js/toggleMenu.js"></script>
    <script type="text/javascript" src="js/stickyNavbar.js"></script>
</body>
</html>