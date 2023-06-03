<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zed's Galaxy | Online Shop</title>
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/carousel.css"/>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src="js/toastTemplate.js"></script>
</head>
<body>

    <!-- Session Details (if set) & Toast Alerts -->
    <div class="sessionDetails">
        <?php
        if(isset($_SESSION['customerLoggedIn']) && $_SESSION['settingShowSession'])
        {
            echo 'ID: ' . $_SESSION['authCustomer']['CustomerID'];
            echo '<br>Name: ' . $_SESSION['authCustomer']['CustomerName'];
            echo '<br>Email: ' . $_SESSION['authCustomer']['CustomerEmail'];
        };
        if((isset($_SESSION['logoutEvent']) && ($_SESSION['logoutEvent'] == true)))
        {
            ?>
            <script type="text/javascript">toastAlert("top", "success", "Logged out successfully!");</script>
            <?php
            unset($_SESSION['logoutEvent']);
        }
        else if((isset($_SESSION['loginEvent']) && ($_SESSION['loginEvent'] == true)))
        {
            ?>
            <script type="text/javascript">toastAlert("top", "success", "Logged in successfully!");</script>
            <?php
            unset($_SESSION['loginEvent']);
        }
        ?>
    </div>

    <!-- Header -->
    <header>

        <!-- Navbar -->
        <div class="navbar" id="navbar">
            <div class="logo">
                <a href="#"><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
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

    <!-- Landing Section -->
    <div class="header" id="Home">
        <div class="container-1">
            <div class="row">
                <div class="col-2">
                    <p>Welcome to</p>
                    <h1>
                        ZED'S<br>GALAXY
                    </h1>
                    <p>
                        We just launched our new website!
                    </p>
                    <a href="#Popular" class="btn">Find trendy products →</a>
                </div>
                <div class="col-2">
                    <img src="images/FrontPageS22.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Product Carousels -->
    <div class="small-container" id="Popular">
        <div class="title">
            <h2>
                Popular Products:
                <div class="underline-title"><span></span></div>
            </h2>
        </div>

        <swiper-container
        class                                       = "mySwiper"
        pagination                                  = "true"
        pagination-clickable                        = "true"
        navigation                                  = "true"
        loop                                        = "true"
        slides-per-view                             = "4"
        grab-cursor                                 = "true"
        mousewheel                                  = "true"
        centered-slides                             = "true"
        autoplay-delay                              = "3000"
        autoplay-disable-on-interaction             = "false"
        >
            <?php
            $queryGetPopularProducts                = "SELECT * FROM `Products`
                                                    WHERE `ProductPopular`      = '1'
                                                    AND `ProductVisibility`     = '1'
                                                    ORDER BY `DateOfUpdate`";
            $queryGetPopularProducts                = "SELECT * FROM `Products`
                                                    WHERE `ProductPopular`      = '1'
                                                    AND `ProductVisibility`     = '1'
                                                    ORDER BY RAND()
                                                    LIMIT 20";
            $getPopularProducts                     = mysqli_query($dbconnect, $queryGetPopularProducts);

            foreach($getPopularProducts as $popular)
            {
                $popularProductCategoryID           = $popular['CategoryID'];
                $queryGetCategory                   = "SELECT `CategoryName` FROM `Categories`
                                                    WHERE `CategoryID`          = '$popularProductCategoryID'
                                                    AND `CategoryVisibility`    = '1'";
                $getCategory                        = mysqli_query($dbconnect, $queryGetCategory);
                $popularProductCategory             = mysqli_fetch_assoc($getCategory);
                ?>
                <swiper-slide>
                    <a href="product?category=<?= $popularProductCategory['CategoryName']; ?>&productID=<?= $popular['ProductID']; ?>">
                        <img src="images/uploads/products/<?= $popular['ProductImage']; ?>" alt="Product Image"></img>
                        <h4><?= $popular['ProductName']; ?></h4>
                        <br>
                        <div class="sellingPrice">
                            <h5>£<?= number_format($popular['SellingPrice'], 2, '.', ','); ?></h5>
                        </div>
                        <div class="retailPrice">
                            <h5>£<?= number_format($popular['RetailPrice'], 2, '.', ','); ?></h5>
                        </div>
                    </a>
                </swiper-slide>
                <?php
            }
            ?>
        </swiper-container>
    </div>
    <?php
    $queryGetCategories                             = "SELECT * FROM `Categories`
                                                    WHERE `CategoryVisibility`  = '1'";
    $getCategories                                  = mysqli_query($dbconnect, $queryGetCategories);

    if(mysqli_num_rows($getCategories) > 0)
    {
        $count = 0;
        foreach($getCategories as $category)
        {
            $count++;
            ?>
            <div class="small-container">
                <div class="title">
                    <h2>
                        <?= $category['CategoryName']; ?>:
                        <div class="underline-title"><span></span></div>
                    </h2>
                </div>
                <swiper-container
                class                               = "mySwiper"
                pagination                          = "true"
                pagination-clickable                = "true"
                navigation                          = "true"
                loop                                = "true"
                slides-per-view                     = "4"
                grab-cursor                         = "true"
                mousewheel                          = "true"
                centered-slides                     = "true"
                autoplay-delay                      = "3000"
                autoplay-disable-on-interaction     = "false"
                autoplay-reverse-direction          = "<?= ($count % 2) ? 'true':'false' ?>"
                >
            <?php
                $categoryID                         = $category['CategoryID'];
                $queryGetProducts                   = "SELECT * FROM `Products`
                                                    WHERE `CategoryID`          = '$categoryID'
                                                    AND `ProductVisibility`     = '1'";
                $getProducts                        = mysqli_query($dbconnect, $queryGetProducts);

                foreach($getProducts as $product)
                {
                    ?>
                    <swiper-slide>
                        <a href="product?category=<?= $category['CategoryName']; ?>&productID=<?= $product['ProductID']; ?>">
                            <img src="images/uploads/products/<?= $product['ProductImage']; ?>" alt="Product Image"></img>
                            <h4><?= $product['ProductName']; ?></h4>
                            <br>
                            <div class="sellingPrice">
                                <h5>£<?= number_format($product['SellingPrice'], 2, '.', ','); ?></h5>
                            </div>
                            <div class="retailPrice">
                                <h5>£<?= number_format($product['RetailPrice'], 2, '.', ','); ?></h5>
                            </div>
                        </a>
                    </swiper-slide>
                    <?php
                }
            ?>
                </swiper-container>
            </div>
            <?php
        }
    }
    ?>

    <!-- Testimonials -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row-3">
                <?php
                    $categoryID                     = $category['CategoryID'];
                    $queryGetTestimonials           = "SELECT * FROM `Testimonials` ORDER BY RAND() LIMIT 3";
                    $getTestimonials                = mysqli_query($dbconnect, $queryGetTestimonials);

                    foreach($getTestimonials as $testimonial)
                    {
                        ?>
                        <div class="col-4">
                            <i class="fa-solid fa-quote-left"></i>
                            <p>
                                <?= $testimonial['Testimonial']; ?>
                            </p>
                            <i class="fa-solid fa-quote-right"></i>
                            <img src="images/profile-icon.png" alt="">
                            <h3><?= $testimonial['Testifier']; ?></h3>
                            <div class="rating">
                                <?php
                                $star = 0;
                                for ($x = 1; $x <= intval($testimonial['Rating']); $x++)
                                {
                                    ?><i class="fa fa-solid fa-star"></i><?php
                                    $star++;
                                }
                                while($star != 5)
                                {
                                    ?><i class="fa fa-regular fa-star"></i><?php
                                    $star++;
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <!-- <div class="col-4">
                    <i class="fa-solid fa-quote-left"></i>
                    <p>
                        Lorem ipsum dolor sit amet. Galisum porro et pariatur ipsum qui repellat dolorum.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <img src="images/profile-icon.png" alt="">
                    <h3>Muhammad Adam</h3>
                    <div class="rating">
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-regular fa-star"></i>
                    </div>
                </div>
                <div class="col-4">
                    <i class="fa-solid fa-quote-left"></i>
                    <p>
                        Lorem ipsum dolor sit amet. Galisum porro et pariatur ipsum qui repellat dolorum.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <img src="images/profile-icon.png" alt="">
                    <h3>Adam Khalid</h3>
                    <div class="rating">
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-regular fa-star"></i>
                    </div>
                </div>
                <div class="col-4">
                    <i class="fa-solid fa-quote-left"></i>
                    <p>
                        Lorem ipsum dolor sit amet. Galisum porro et pariatur ipsum qui repellat dolorum.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <img src="images/profile-icon.png" alt="">
                    <h3>Khalid Muhammad</h3>
                    <div class="rating">
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-solid fa-star"></i>
                        <i class="fa fa-regular fa-star"></i>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Brands -->
    <div class="brands">
        <div class="small-container">
            <div class="row-3">
                <div class="col-5">
                    <img src="images/Samsung-logo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/HP-logo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/BenQ-logo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/NVIDIA-logo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/AMD-logo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/ROG-logo.png" alt="">
                </div>
                <div class="col-5">
                    <img src="images/Dell-logo.png" alt="">
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
                    <li><a href="#Home">Home</a></li>
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
    <script type="text/javascript" src="js/SwiperJS/node_modules/swiper/swiper-element-bundle.min.js"></script>
</body>
</html>