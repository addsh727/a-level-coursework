<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/checkout.css"/>
    <title>Zed's Galaxy | Checkout </title>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src="js/redirectToast.js"></script>
</head>
<body>
<?php
$_SESSION['accessCheckout'] = false;
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
                <a href="shopping-cart">
                    <i class="fa fa-cart-shopping"></i>
                </a>
            </div>
            <div class="menu-icon">
                <i class="fa-solid fa-bars" onclick="ToggleMenu()"></i>
            </div>
        </div>
    </header>

    <!-- Checkout -->
    <div class="header">
        <div class="headTitle" id="shoppingCart">
            <h1>
                Checkout
                <div class="underline-title"><span></span></div>
            </h1>
        </div>
        <?php // Get customer's shopping cart
        $customerID                     = $_SESSION['authCustomer']['CustomerID'];
        $queryGetCart                   = "SELECT
                                        cart.CartID AS CartID, cart.ProductID, cart.ProductQuantity,
                                        products.ProductID AS ProductID, products.ProductName, products.ProductImage, products.SellingPrice
                                        FROM `shoppingcarts` cart, `products` products
                                        WHERE cart.ProductID    = products.ProductID
                                        AND cart.CustomerID     = '$customerID'
                                        ORDER BY cart.CartID";
        $getCart                        = mysqli_query($dbconnect, $queryGetCart);

        if(mysqli_num_rows($getCart) > 0) // If there is at least one item in shopping cart
        {   // Display Checkout Page
        ?>
        <!-- Shopping cart summary of products to be purchased -->
        <div class="order">
            <div class="orderContainer">
                <div class="tableResponsive">
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Product:</td>
                                <td>Price:</td>
                                <td>Quantity:</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalCost = 0; // Initialise total cost variable
                                if(mysqli_num_rows($getCart) > 0)
                                {
                                    while($cartItem = mysqli_fetch_assoc($getCart)) // For each product in shopping cart
                                    {   // Perform calculations & display shopping cart items
                                        $subtotal               = intval($cartItem['SellingPrice'])*intval($cartItem['ProductQuantity']);
                                        $totalCost              += $subtotal; // Add subtotal to total cost
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="imageContainer">
                                                    <img src="images/uploads/products/<?= $cartItem['ProductImage'] ?>" alt="Image">
                                                </div>
                                            </td>
                                            <td><?= $cartItem['ProductName'] ?></td>
                                            <td>£<?= number_format($cartItem['SellingPrice'], 2, '.', ','); ?></td>
                                            <td>
                                                <div class="quantity">
                                                    <input type="hidden" class="productID" value="<?= $cartItem['ProductID']; ?>">
                                                    <input type="text" class="inputQuantity" name="" value="×<?= $cartItem['ProductQuantity'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Empty Cart!</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Total Cost Card -->
                <div class="total">
                    <div class="totalCost">
                        <h2>Total Cost:</h2>
                    </div>
                    <br>
                    <div class="final">
                        <h3>£<?= number_format($totalCost, 2, '.', ','); ?></h3>
                    </div>
                </div>
            </div>

            <!--  Billing and Delivery Details Form -->
            <div class="bigContainer">
                <div class="checkoutContainer">
                    <div class="checkout">
                        <h2>Order Details:</h2>
                        <div class="checkoutBox">
                            <form action="php/place-order.php" method="POST">
                                <div class="checkoutRow">
                                    <div class="checkoutCol">
                                        <h3 class="title">Contact:</h3>
                                        <div class="inputBox">
                                            <span>First Name:</span>
                                            <input type="text" required name="FirstName" id="FirstName" placeholder="Enter First Name" value="<?php if(isset($_SESSION['authCustomer'])){ echo $_SESSION['authCustomer']['CustomerName']; }?>">
                                            <small class="errorMsg FirstName"></small>
                                        </div>
                                        <div class="inputBox">
                                            <span>Surname:</span>
                                            <input type="text" required name="Surname" id="Surname" placeholder="Enter Surname" value="<?php if(isset($_SESSION['authCustomer'])){ echo $_SESSION['authCustomer']['CustomerSurname']; }?>">
                                            <small class="errorMsg Surname"></small>
                                        </div>
                                        <div class="inputBox">
                                            <span>Phone Number:</span>
                                            <input type="text" required name="PhoneNumber" id="PhoneNumber" placeholder="+(44-)---------">
                                            <small class="errorMsg PhoneNumber"></small>
                                        </div>
                                        <div class="inputBox">
                                            <span>Collection:</span>
                                            <select name="Collection" id="Collection" required>
                                                <option value="0" selected>In-store</option>
                                                <option value="1">Delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="checkoutCol">
                                        <h3 class="title">Billing Address:</h3>
                                        <div class="inputBox">
                                            <span>Address:</span>
                                            <textarea type="text" required name="Address" id="Address" placeholder="Where do you live?"></textarea>
                                            <small class="errorMsg Address"></small>
                                        </div>
                                        <div class="flex">
                                            <div class="inputBox">
                                                <span>City:</span>
                                                <input type="text" required name="City" id="City" placeholder="Unicity">
                                                <small class="errorMsg City"></small>
                                            </div>
                                            <div class="inputBox">
                                                <span>Postcode:</span>
                                                <input type="text" required name="Postcode" id="Postcode" placeholder="A12 3BC">
                                                <small class="errorMsg Postcode"></small>
                                            </div>
                                        </div>
                                        <div class="inputBox">
                                            <span>Delivery Instructions:</span>
                                            <textarea type="text" required name="Instructions" id="Instructions" placeholder="Drop off in front of my door!"></textarea>
                                            <small class="errorMsg Instructions"></small>
                                        </div>
                                        <div class="inputBox">
                                            <span>Accepted Payment Methods:</span>
                                            <img src="images/acceptedMethods.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="paypalBoxContainer">
                                    <div id="paypal-button-container"></div>
                                </div>
                                <?php // Staff Order Button
                                if(isset($_SESSION['authStaff'])) // Check if staff is logged in
                                {   // Then display Staff Order button
                                    ?>
                                    <div class="proceed">
                                        <input type="hidden" name="PaymentID" value="">
                                        <input type="hidden" name="PaymentMethod" value="Admin Test Pay">
                                        <button type="submit" name="placeOrder">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                            Place Order for Staff →
                                        </button>
                                    </div>
                                    <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        else// Do not show checkout if there are no items in shopping cart
        {   // Fire error alert, message & redirect to customer's shopping cart
            ?>
            <head>
                <title>Zed's Galaxy | Not Found </title>
            </head>
            <h1 style='padding-top: 100px; text-align: center; height: 90vh;'>Fill up shopping cart first!</h1>
            <script type="text/javascript">redirectToast("center");</script>
            <?php
            header("Refresh:3; url=shopping-cart");
        }
        ?>
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

    <!-- PayPal Checkout Process -->
    <?php $token                    = 'paste PayPal API token here'; ?>
    <script src="https://www.paypal.com/sdk/js?client-id=<?= $token; ?>&currency=GBP"></script>
    <script>
        paypal.Buttons({    // PayPal Button Generation, Validation & Settings
            onClick(){      // Initialise variables
                var firstName           = $('#FirstName').val();
                var surname             = $('#Surname').val();
                var phoneNumber         = $('#PhoneNumber').val();
                var address             = $('#Address').val();
                var city                = $('#City').val();
                var postcode            = $('#Postcode').val();
                var instructions        = $('#Instructions').val();

                // Billing and Delivery Form Validation
                if(firstName.length == 0){ $('.FirstName').text("*This field is required."); }
                else{ $('.FirstName').text(""); }
                if(surname.length == 0){ $('.Surname').text("*This field is required."); }
                else{ $('.Surname').text(""); }
                if(phoneNumber.length == 0){ $('.PhoneNumber').text("*This field is required."); }
                else{ $('.PhoneNumber').text(""); }
                if(address.length == 0){ $('.Address').text("*This field is required."); }
                else{ $('.Address').text(""); }
                if(city.length == 0){ $('.City').text("*This field is required."); }
                else{ $('.City').text(""); }
                if(postcode.length == 0){ $('.Postcode').text("*This field is required."); }
                else{ $('.Postcode').text(""); }
                if(instructions.length == 0){ $('.Instructions').text("*This field is required."); }
                else{ $('.Instructions').text(""); }

                if(firstName.length == 0 || surname.length == 0 || phoneNumber.length == 0
                || address.length == 0 || city.length == 0 || postcode.length == 0 || instructions.length == 0)
                { return false; }
            },
            style:{
                shape: 'pill' // Paypal Button Shape
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?= $totalCost; ?> // Append total cost for the payment transaction
                        }
                    }]
                });
            },
            onApprove: function(data, actions) { // After transaction complete
                return actions.order.capture().then(function (orderData) { // Reinitialise variables
                    const transaction = orderData.purchase_units[0].payments.captures[0]; // Capture payment data

                    var firstName       = $('#FirstName').val();
                    var surname         = $('#Surname').val();
                    var phoneNumber     = $('#PhoneNumber').val();
                    var address         = $('#Address').val();
                    var city            = $('#City').val();
                    var postcode        = $('#Postcode').val();
                    var collection      = $('#Collection').val();
                    var instructions    = $('#Instructions').val();

                    var data = {    // Create order data array
                        'placeOrder': true,
                        'FirstName': firstName,
                        'Surname': surname,
                        'PhoneNumber': phoneNumber,
                        'Address': address,
                        'City': city,
                        'Postcode': postcode,
                        'Collection': collection,
                        'Instructions': instructions,
                        'PaymentMethod': "Paypal",
                        'PaymentID': transaction.id,
                    };
                    $.ajax({    // Fire AJAX request to place new order
                        method: "POST",
                        url: "php/place-order.php",
                        data: data,
                        success: function (response) {
                            if(response == 201){ window.location.href = 'my-orders'; }
                            else{ console.log(response); }
                        }
                    });
                })
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>