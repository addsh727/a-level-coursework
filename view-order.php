<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/view-order.css"/>
    <title>Zed's Galaxy | My Orders</title>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="js/cancelConfirmation.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src='js/redirectToast.js'></script>
</head>
<body>
<?php
$_SESSION['accountAccess'] = true;
$_SESSION['accessAccount'] = true;
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

    <?php
    if(isset($_GET['trackingID'])) // Check if tracking ID assigned
    {   // Then fetch tracking ID via GET request & retrieve full order details
        $trackingID                     = $_GET['trackingID'];
        $customerID                     = $_SESSION['authCustomer']['CustomerID'];

        $queryTrackingData              = "SELECT * FROM `Orders`
                                        WHERE `TrackingID`      = '$trackingID'
                                        AND `CustomerID`        = '$customerID'";
        $trackingData                   = mysqli_query($dbconnect, $queryTrackingData);

        if(mysqli_num_rows($trackingData) <= 0) // If no order data found
        {   // Then display error message & redirect to account page
            ?>
            <h2 style="padding-top: 100px; text-align: center; height: 90vh; color: red;">Something went wrong...</h2>
            <script type="text/javascript">redirectToast("center");</script>
            <?php
            header("Refresh:3; url=account");
            die();
        } // Or else retrieve order data
        $orderData                      = mysqli_fetch_assoc($trackingData);
    }
    else// IF not assigned
    {   // Then display error message & redirect to account page
        ?>
        <h2 style="padding-top: 100px; text-align: center; height: 90vh; color: red;">Something went wrong...</h2>
        <script type="text/javascript">redirectToast("center");</script>
        <?php
        header("Refresh:3; url=account");
        die();
    }
    ?>

    <!-- View Order Page -->
    <div class="header">
        <div class="headTitle" id="shoppingCart">
            <h1>
                Order Details for [<?= $orderData['TrackingID']; ?>]:
                <div class="underline-title"><span></span></div>
            </h1>
        </div>

        <!-- Order Details -->
        <div class="sectionContainer">

            <!-- Timestamp of Update -->
            <span class="timestamp">Time Updated: <?= $orderData['DateOfUpdate']; ?></span>
            
            <!-- Delivery & Billing Details -->
            <div class="orderDetails">
                <div class="deliverySection">
                    <div class="deliveryInfo">
                        <h3>Delivery Details:</h3>
                        <label for="">First Name:</label>
                        <div class="dataRow">
                            <?= $orderData['FirstName']; ?>
                        </div>
                        <label for="">Surname:</label>
                        <div class="dataRow">
                            <?= $orderData['Surname']; ?>
                        </div>
                        <label for="">Phone Number:</label>
                        <div class="dataRow">
                            <?= $orderData['PhoneNumber']; ?>
                        </div>
                        <label for="">Address:</label>
                        <div class="dataRow">
                            <?= $orderData['Address']; ?>
                        </div>
                        <div class="flex">
                            <div class="inputBox">
                                <span>City:</span>
                                <div class="dataRow">
                                    <?= $orderData['City']; ?>
                                </div>
                            </div>
                            <div class="inputBox">
                                <span>Postcode:</span>
                                <div class="dataRow">
                                    <?= $orderData['Postcode']; ?>
                                </div>
                            </div>
                        </div>
                        <label for="">Collection:</label>
                        <div class="dataRow">
                            <?= $orderData['Collection'] == '1' ? 'Delivery':'In-Store' ;?>
                        </div>
                        <label for="">Instructions:</label>
                        <div class="dataRow">
                            <?= $orderData['Instructions'];?>
                        </div>
                        <label for="">Order Status:</label>
                        <?php
                        if($orderData['Status'] == '0')
                        { ?> <div class="status pending"><p>Pending</p></div> <?php }
                        else if($orderData['Status'] == '1')
                        { ?> <div class="status complete">Complete</div> <?php }
                        else if($orderData['Status'] == '2')
                        { ?> <div class="status cancelled">Cancelled</div> <?php }
                        else
                        { ?> <div class="status cancelled">Unknown - Error</div> <?php }
                        ?>
                    </div>
                </div>
                <?php // Retrieve order purchases
                $queryRetrieveOrder     = "SELECT
                                        o.OrderID AS orderID, o.TrackingID, o.CustomerID, ol.*,
                                        ol.ProductQuantity AS orderQuantity, p.*
                                        FROM orders o, orderline ol, products p
                                        WHERE o.CustomerID      = '$customerID'
                                        AND ol.OrderID          = o.OrderID
                                        AND p.ProductID         = ol.ProductID
                                        AND o.TrackingID        = '$trackingID'";
                $retrieveOrder          = mysqli_query($dbconnect, $queryRetrieveOrder);
                ?>

                <!-- Purchase Summary -->
                <div class="productSection">
                    <div class="productInfo">
                        <h3>Purchases:</h3>
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
                                    if(mysqli_num_rows($retrieveOrder) > 0) // Check if any purchase data retrieved
                                    {   // Then display purchases
                                        while($orderItem = mysqli_fetch_assoc($retrieveOrder))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="imageContainer">
                                                        <img src="images/uploads/products/<?= $orderItem['ProductImage'] ?>" alt="Image">
                                                    </div>
                                                </td>
                                                <td><?= $orderItem['ProductName'] ?></td>
                                                <td>£<?= number_format($orderItem['SellingPrice'], 2, '.', ','); ?></td>
                                                <td>
                                                    <div class="quantity">
                                                        <p>×<?= $orderItem['orderQuantity'] ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr><td></td><td></td><td>
                                        This shouldn't happen... What did you do?
                                        </td><td></td><td></td><td></td></tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <h3>Total Cost:
                            <br>
                            <span>£<?= number_format($orderData['TotalPrice'], 2, '.', ','); ?></span>
                        </h3>

                        <!-- Payment Method -->
                        <label for="">Payment Method:</label>
                        <div class="dataRow">
                            <?= $orderData['PaymentMethod'];?>
                        </div>
                        <?php
                        if($orderData['PaymentID'] != "") // If paid via PayPal
                        {   // Show PayPal Payment ID
                            ?>
                            <label for="">Payment ID:</label>
                            <div class="dataRow">
                                <?= $orderData['PaymentID'];?>
                            </div>
                            <?php
                        }
                        if($orderData['Status'] == '0') // If order still pending
                        {   // Show cancel order button
                            include("php/cancel-order.php");
                            $email = $_SESSION['authCustomer']['CustomerEmail'];
                            ?>
                            <form method="POST" onsubmit="return submitForm(this);">
                                <input type="hidden" name="cancelTrackingID" value="<?= $trackingID; ?>"></input>
                                <input type="hidden" name="cancelEmail" value="<?= $email; ?>"></input>
                                <input type="hidden" name="cancelCustomerID" value="<?= $customerID; ?>"></input>
                                <input type="hidden" name="cancelOrder"></input>
                                <button type="submit" class="status cancelled" style="cursor: pointer;">Cancel Order</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
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