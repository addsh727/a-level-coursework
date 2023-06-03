<?php include("php/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/my-orders.css"/>
    <title>Zed's Galaxy | My Orders</title>
    <script src="https://kit.fontawesome.com/29d654acca.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/getVisitors.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
</head>
<body>
<?php
$_SESSION['accountAccess'] = true;
$_SESSION['accessAccount'] = true;
include("php/authenticate.php");
if(isset($_SESSION['orderPlaced']))
{
    if($_SESSION['orderPlaced'] == true) // Check if order placed
    {   // Fire success alert
        ?>
            <script type="text/javascript">
                successAlert("Order Placed!", "We've sent you a confirmation email. Check your orders page for more details.");
            </script>
        <?php
    }
}
unset($_SESSION['orderPlaced']);
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
        <div class="navbar" id="navbar">
            <div class="logo">
                <a href="."><img Title="Zed's Galaxy" src="images/LogoTransparent.png"></a>
            </div>

            <!-- Navbar -->
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

    <!-- My Orders Page -->
    <div class="header">
        <div class="headTitle" id="shoppingCart">
            <h1>
                My Orders:
                <div class="underline-title"><span></span></div>
            </h1>
        </div>

        <!-- Orders History Table -->
        <div class="sectionContainer">
            <div class="tableResponsive">
                <table>
                    <?php // Fetch Customer Orders
                    $customerID         = $_SESSION['authCustomer']['CustomerID'];
                    $queryGetOrders     = "SELECT * FROM `Orders`
                                        WHERE `CustomerID` = '$customerID'
                                        ORDER BY `OrderID` DESC";
                    $getOrders          = mysqli_query($dbconnect, $queryGetOrders);
                    $totalCost          = 0;
                    if(mysqli_num_rows($getOrders) > 0) // If any orders found
                    {   // Display orders
                        ?>
                            <thead>
                                <tr>
                                    <td>Tracking ID:</td>
                                    <td>Total Cost:</td>
                                    <td>Payment Method:</td>
                                    <td>Payment ID:</td>
                                    <td>Status:</td>
                                    <td>Collection:</td>
                                    <td>Order Date:</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        while($order = mysqli_fetch_assoc($getOrders))
                        {
                            ?>
                            <tr>
                                <td><?= $order['TrackingID']; ?></td>
                                <td>£<?= number_format($order['TotalPrice'], 2, '.', ','); ?></td>
                                <td><?= $order['PaymentMethod']; ?></td>
                                <td><?php if($order['PaymentID'] != "") { echo $order['PaymentID']; } else { echo 'N/A'; } ?></td>
                                <td>
                                    <?php
                                    if($order['Status'] == 0) { echo 'In progress'; };
                                    if($order['Status'] == 1) { echo 'Complete'; };
                                    if($order['Status'] == 2) { echo 'Cancelled'; };
                                    ?>
                                </td>
                                <td><?= $order['Collection'] == '1' ? 'Delivery':'In-Store'; ?></td>
                                <td><?= $order['DateOfCreation']; ?></td>
                                <td>
                                    <a href="view-order?trackingID=<?= $order['TrackingID']; ?>" class="viewEntity">View Details</a>
                                </td>
                            </tr>
                            <?php
                        }   // Display nothing otherwise
                    } else { echo 'No order history found.'; }
                    ?>
                    </tbody>
                </table>
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
        <p class="Copyright" id="year"></p>
        <script src="js/copyrightYear.js"></script>
    </footer>

    <!-- Miscellaneous Scripts -->
    <script type="text/javascript" src="js/toggleMenu.js"></script>
    <script type="text/javascript" src="js/stickyNavbar.js"></script>
</body>
</html>