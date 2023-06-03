<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/product.css"/>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src="js/toastTemplate.js"></script>
    <script src="js/redirectToast.js"></script>
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

        <!-- Navbar -->
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

<?php
if(isset($_GET['productID']) && isset($_GET['category'])) // If product & category IDs assigned
{   // Retrieve product & category IDs via GET request then retrieve product
    $getProductID = $_GET['productID'];
    $getCategory = $_GET['category'];

    $queryGetProduct                            = "SELECT * FROM `Products` WHERE `ProductID` = '$getProductID' AND `ProductVisibility` = '1'";
    $getProduct                                 = mysqli_query($dbconnect, $queryGetProduct);
    $product                                    = mysqli_fetch_assoc($getProduct);
    if($product) // When product is found
    {   // Generate...
        ?> <!-- Product Page -->
        <head>
            <title><?= $product['ProductName']; ?></title>
        </head>
        <div class="sectionContainer">
            <div class="productContainer productDetails">
                <div class="productSection">
                    <h2><?= $getCategory; ?></h2>
                    <h1>
                        <?= $product['ProductName']; ?>
                    </h1>
                    <h3>
                        £<?= number_format($product['SellingPrice'], 2, '.', ','); ?>
                        <span>£<?= number_format($product['RetailPrice'], 2, '.', ','); ?></span>
                    </h3>
                    <?php
                    if($product['ProductQuantity'] > 0)
                    {
                        ?>
                            <h4>In stock: <?= $product['ProductQuantity']; ?></h4>
                            <div class="shopping">
                                <div class="quantity">
                                    <button class="decreaseQ">-</button>
                                    <input type="text" class="inputQuantity" name="" value="1" disabled>
                                    <button class="incrementQ">+</button>
                                </div>
                                <div class="addToCart">
                                    <button type="submit" class="addToCartButton" value="<?= $product['ProductID']?>">
                                        <i class="fa fa-cart-shopping"></i>
                                        Add To Cart
                                    </button>
                                </div>
                            </div>
                        <?php
                    } else{ ?> <h4 style="color: red;">Out of stock</h4> <?php }
                    ?>
                    <div class="description">
                        <p><?= $product['ProductDescription']; ?></p>
                        <a class="readMoreButton">Read More</a>
                    </div>
                </div>
                <div class="imageContainer">
                    <img src="images/uploads/products/<?= $product['ProductImage']; ?>" alt="">
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
    <?php
    }
    else// Do not show product page if there is any error
    {   // Fire error alert, message & redirect to categories page
        ?>
        <head>
            <title>Zed's Galaxy | Not Found </title>
        </head>
        <h1 style='text-align: center; padding-top: 100px;'>Something went wrong...</h1>
        <script type='text/javascript'>redirectToast("center");</script>
        <?php
        header("Refresh:3; url=categories#categories");
    }
}
else// Do not show product page if there is any error
{   // Fire error alert, message & redirect to categories page
    ?>
    <head>
        <title>Zed's Galaxy | Not Found </title>
    </head>
    <h1 style='text-align: center; padding-top: 100px;'>Something went wrong...</h1>
    <script type='text/javascript'>redirectToast("center");</script>
    <?php
    header("Refresh:3; url=categories#categories");
}
?>  <!-- Miscellaneous Scripts -->
    <script type="text/javascript" src="js/readMore.js"></script>
    <script type="text/javascript" src="js/productQuantity.js"></script>
    <script type="text/javascript" src="js/addToCart.js"></script>
    <script type="text/javascript" src="js/toggleMenu.js"></script>
    <script type="text/javascript" src="js/stickyNavbar.js"></script>
</body>
</html>