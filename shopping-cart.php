<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/shopping-cart.css"/>
    <title>Zed's Galaxy | Shopping Cart</title>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src="js/toastTemplate.js"></script>
</head>
<body>
<?php
$_SESSION['accessShoppingCart'] = false;
include("php/authenticate.php");
?>
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
                <a href="#shoppingCart">
                    <i class="fa fa-cart-shopping"></i>
                </a>
            </div>
            <div class="menu-icon">
                <i class="fa-solid fa-bars" onclick="ToggleMenu()"></i>
            </div>
        </div>
    </header>

    <!-- Shopping Cart -->
    <div class="header">
        <div class="headTitle" id="shoppingCart">
            <h1>
                Shopping Cart
                <div class="underline-title"><span></span></div>
            </h1>
        </div>
        <div class="sectionContainer">
            <div class="tableResponsive">
                <table>
                    <?php
                    $customerID             = $_SESSION['authCustomer']['CustomerID'];
                    $queryGetCart           = "SELECT
                                            cart.CartID AS CartID, cart.ProductID, cart.ProductQuantity,
                                            products.ProductID AS ProductID, products.ProductName, products.ProductImage, products.SellingPrice
                                            FROM `shoppingcarts` cart, `products` products
                                            WHERE cart.ProductID = products.ProductID
                                            AND cart.CustomerID = '$customerID'
                                            ORDER BY cart.CartID";
                    $getCart                = mysqli_query($dbconnect, $queryGetCart);
                    ?>
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Product:</td>
                            <td>Quantity:</td>
                            <td>Price:</td>
                            <td>Subtotal:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalCost = 0; // Initialise shopping cart cost
                            if(mysqli_num_rows($getCart) > 0) // Check if there are any items in shopping cart
                            {   // Then retrieve all shopping cart items & display...
                                while($cartItem = mysqli_fetch_assoc($getCart)) // ...each added product
                                {
                                    $subtotal = intval($cartItem['SellingPrice'])*intval($cartItem['ProductQuantity']);
                                    $totalCost += $subtotal;
                                    ?>
                                    <tr>
                                        <td>
                                            <button class="deleteCartItem" value="<?= $cartItem['CartID']; ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="imageContainer">
                                                <img src="images/uploads/products/<?= $cartItem['ProductImage'] ?>" alt="Image">
                                            </div>
                                        </td>
                                        <td><?= $cartItem['ProductName'] ?></td>
                                        <td>
                                            <div class="shopping productDetails">
                                                <div class="quantity">
                                                    <input type="hidden" class="productID" value="<?= $cartItem['ProductID']; ?>">
                                                    <button class="decreaseQ updateQuantity">-</button>
                                                    <input type="text" class="inputQuantity" name="" value="<?= $cartItem['ProductQuantity'] ?>" disabled>
                                                    <button class="incrementQ updateQuantity">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>£<?= number_format($cartItem['SellingPrice'], 2, '.', ','); ?></td>
                                        <td>£<?= number_format($subtotal, 2, '.', ','); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <tr><td></td><td></td><td>
                                Empty Cart!
                                </td><td></td><td></td><td></td></tr>
                                <?php
                            }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total:</td>
                            <td>£<?= number_format($totalCost, 2, '.', ','); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
            if(mysqli_num_rows($getCart) > 0) // If there are any items in shopping cart
            {   // Then total cost for cart & display checkout button 
                ?>
                <div class="checkout">
                    <div class="totalCost">
                        <h2>Total Cost:</h2>
                    </div>
                    <br>
                    <div class="proceed">
                        <h3>£<?= number_format($totalCost, 2, '.', ','); ?></h3>
                    </div>
                    <div class="proceed">
                        <a href="checkout">
                            <button>
                                <i class="fa-solid fa-bag-shopping"></i>
                                Proceed To Checkout →
                            </button>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
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
    <script type="text/javascript" src="js/cart.js"></script>
    <script type="text/javascript" src="js/productQuantity.js"></script>
    <script type="text/javascript" src="js/toggleMenu.js"></script>
    <script type="text/javascript" src="js/stickyNavbar.js"></script>
</body>
</html>