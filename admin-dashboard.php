<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/Favicon.png">
    <link rel="stylesheet" type ="text/css" href="css/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="js/jquery-3.6.2.js"></script>
    <script src="js/SweetAlerts/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/ScrollReveal/node_modules/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="js/Number-Rolling-Animation-jQuery-numberAnimate/numberAnimate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="js/getVisitors.js"></script>
    <script src="js/animateCounters.js"></script>
    <script src="js/successTemplate.js"></script>
    <script src="js/errorTemplate.js"></script>
    <script src="js/toastTemplate.js"></script>
    <script src="js/redirectToast.js"></script>
    <title>Admin Dashboard</title>
</head>
<?php

// All Admin Panel Processes
include("php/admin-access.php");
include("php/admin-functions.php");
include("php/admin-customers-options.php");
if(isset($_SESSION['settingHideAnalytics']) && !$_SESSION['settingHideAnalytics'])
{ include("php/admin-analytics.php"); }
include("php/admin-products-options.php");
include("php/admin-orders-options.php");
include("php/admin-staff-options.php");
include("php/admin-settings-options.php");
include("php/export-data.php");
include("php/admin-logout.php");

// Check if admin is logged in
if(isset($_SESSION["adminLoggedIn"]))
{   // Load admin dashboard after session verified
    ?>
    <body>
    <?php
    if($_SESSION["adminLoggedIn"] === true) // When logging in
    {   // Fire success alert if set
        if(isset($_SESSION["mixinPopup"]))
        {
            ?>
                <script type="text/javascript">toastAlert("top-end", "success", "Signed in successfully!");</script>
            <?php
            unset($_SESSION["mixinPopup"]); // Prevent repeat success alerts
        }
        // Dashboad Queries
        include("php/admin-dashboard-process.php");
        ?>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Logo & Company Name -->
            <div class="logo-details">
                <img src="images/LogoTransparent.png" alt="logo">
                <div class="logo_name">ZED'S GALAXY</div>
                <span id="btn" class="material-symbols-outlined">menu</span>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="#Dashboard" class="active">
                        <span class="material-symbols-outlined">dashboard</span>
                        <h3 class="links_name">Dashboard</h3>
                    </a>
                    <h3 class="tooltip">Dashboard</h3>
                </li>
                <li>
                    <a href="#Customers">
                        <span class="material-symbols-outlined">group</span>
                        <h3 class="links_name">Customers</h3>
                    </a>
                    <h3 class="tooltip">Customers</h3>
                </li>
                <?php
                if(!$_SESSION['settingHideAnalytics']) // Show if not hidden
                {
                    ?>
                        <li>
                            <a href="#Analytics">
                                <span class="material-symbols-outlined">insights</span>
                                <h3 class="links_name">Analytics</h3>
                            </a>
                            <h3 class="tooltip">Analytics</h3>
                        </li>
                    <?php
                }
                ?>
                <li>
                    <a href="#Products">
                        <span class="material-symbols-outlined">package</span>
                        <h3 class="links_name">Products</h3>
                    </a>
                <h3 class="tooltip">Products</h3>
                </li>
                <li>
                    <a href="#Orders">
                        <span class="material-symbols-outlined">pending_actions</span>
                        <h3 class="links_name">Orders</h3>
                        <?php
                        if(isset($pendingOrders)) // If orders pending, then show no. of pending orders
                        {
                            if($pendingOrders <= 0)
                            { echo ""; }
                            else if($pendingOrders > 10)
                            { echo "<div class='orderCountPing'><small>9+</small></div>"; }
                            else
                            { echo "<div class='orderCountPing'><small>$pendingOrders</small></div>"; }
                        }
                        ?>
                        <?php
                        if(isset($pendingOrders)) // If orders pending, then show no. of pending orders
                        {
                            if($pendingOrders <= 0)
                            { echo ""; }
                            else if($pendingOrders > 10)
                            { echo "<div class='orderCount'><small>9+</small></div>"; }
                            else
                            { echo "<div class='orderCount'><small>$pendingOrders</small></div>"; }
                        }
                        ?>
                        </a>
                    <h3 class="tooltip">Orders</h3>
                </li>
                <li>
                    <a href="#Invoices">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <h3 class="links_name">Invoices</h3>
                    </a>
                    <h3 class="tooltip">Invoices</h3>
                </li>
                <?php
                if($_SESSION['authStaff']['StaffID'] == 1) // If owner is logged in
                {   // Show Staff panel
                    ?>
                        <li>
                            <a href="#Staff">
                                <span class="material-symbols-outlined">military_tech</span>
                                <h3 class="links_name">Staff</h3>
                            </a>
                            <h3 class="tooltip">Staff</h3>
                        </li>
                    <?php
                }
                if(!$_SESSION['settingHideReports']) // Show if not hidden
                {
                    ?>
                        <li>
                            <a href="#Reports">
                                <span class="material-symbols-outlined">report</span>
                                <h3 class="links_name">Reports</h3>
                            </a>
                            <h3 class="tooltip">Reports</h3>
                        </li>
                    <?php
                }
                ?>
                <li>
                    <a href="#Settings">
                        <span class="material-symbols-outlined">settings</span>
                        <h3 class="links_name">Settings</h3>
                    </a>
                    <h3 class="tooltip">Settings</h3>
                </li>

                <!-- Logout Button -->
                <li class="logout">
                    <a href="javascript" onclick="return logoutAdmin(document.getElementById('logoutForm'))">
                        <span class="material-symbols-outlined" id="logout">logout</span>
                        <h3 class="links_name">Logout</h3>
                    </a>
                    <h3 class="tooltip">Log Out</h3>
                </li>
            </ul>
            <form method="POST" action="" id="logoutForm">
                <input type="hidden" name="logoutRequest" value="logout"></input>
            </form>
            <script src="js/logoutConfirmation.js"></script>
        </div>

        <!-- All panels in the admin interface -->
        <div class="admin-panels">

            <!-- Dashboard Panel -->
            <section id="Dashboard" class="home-section">
                <div class="text">Welcome, <?= ucfirst($_SESSION["staffName"]); ?></div>
                <?php
                if(!$_SESSION['settingHideCounters']) // Show counters if not hidden
                {
                    ?>
                        <div class="cards">
                            <div class="cardItem">
                                <?php
                                    if(isset($customerAccounts))
                                    { ?><script>animateCounter('dashboardCustomerCounter', '<?= number_format($customerAccounts); ?>')</script><?php }
                                    else { ?><script>animateCounter('dashboardCustomerCounter', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="dashboardCustomerCounter"></h2></div>
                                    <span>Customers</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">group</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($completeOrders))
                                    { ?><script>animateCounter('dashboardCompleteOrders', '<?= $completeOrders; ?>')</script><?php }
                                    else { ?><script>animateCounter('dashboardCompleteOrders', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="dashboardCompleteOrders"></h2></div>
                                    <span>Complete Orders</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">inventory</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($allProducts))
                                    { ?><script>animateCounter('dashboardProducts', '<?= $allProducts; ?>')</script><?php }
                                    else { ?><script>animateCounter('dashboardProducts', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="count">
                                        <h2 id="dashboardProducts"></h2>
                                    </div>
                                    <span>Products</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">package</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($totalRevenue))
                                    { ?><script>animateCounter('dashboardRevenue', '<?= number_format($totalRevenue, 2, '.', ','); ?>')</script><?php }
                                    else { ?><script>animateCounter('dashboardRevenue', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="revenue counter">
                                        <h2>£</h2>
                                        <h2 id="dashboardRevenue"></h2>
                                    </div>
                                    <span>Revenue</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">insights</span>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
                <div class="largeSection">

                    <!-- Recent Orders Table -->
                    <div class="recentOrders">
                        <div class="card">
                            <div class="cardHeader">
                                <h2>Recent Orders</h2>
                                <a href="#Orders" style="text-decoration: none;">
                                    <button>See all<span class="material-symbols-outlined">expand_more</span></button>
                                </a>
                            </div>
                        </div>
                        <div class="cardBody">
                            <div class="tableResponsive DashboardTable">
                                <table width="100%">
                                    <thead>
                                        <tr class="tableRow">
                                            <td class="tableHeader">Tracking ID:</td>
                                            <td class="tableHeader">Recipient:</td>
                                            <td class="tableHeader">Total Cost:</td>
                                            <td class="tableHeader">Status:</td>
                                            <td class="tableHeader">Collection:</td>
                                            <td class="tableHeader">Order Date:</td>
                                            <td class="tableHeader"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getRecentOrders = getRecentOrders();
                                        if(mysqli_num_rows($getRecentOrders) > 0)
                                        {
                                            while($retrievedOrder = mysqli_fetch_assoc($getRecentOrders))
                                            {
                                                ?>
                                                <tr class="tableRow">
                                                    <td><?= $retrievedOrder['TrackingID']; ?></td>
                                                    <td><?= $retrievedOrder['FirstName']." ".$retrievedOrder['Surname']; ?></td>
                                                    <td>£<?= number_format($retrievedOrder['TotalPrice'], 2, '.', ','); ?></td>
                                                    <td>
                                                        <?php
                                                        if($retrievedOrder['Status'] == 0)
                                                        {
                                                            ?>
                                                            <span class="status pending"></span>
                                                            Pending
                                                            <?php
                                                        }
                                                        else if($retrievedOrder['Status'] == 1)
                                                        {
                                                            ?>
                                                            <span class="status complete"></span>
                                                            Complete
                                                            <?php
                                                        }
                                                        else if($retrievedOrder['Status'] == 2)
                                                        {
                                                            ?>
                                                            <span class="status cancelled"></span>
                                                            Cancelled
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $retrievedOrder['Collection'] == '1' ? 'Delivery':'In-Store'; ?></td>
                                                    <td><?= $retrievedOrder['DateOfCreation']; ?></td>
                                                    <td>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="viewOrderID" value="<?= $retrievedOrder['OrderID']; ?>"></input>
                                                            <input type="hidden" name="viewTrackingID" value="<?= $retrievedOrder['TrackingID']; ?>"></input>
                                                            <input type="hidden" name="viewCustomerID" value="<?= $retrievedOrder['CustomerID']; ?>"></input>
                                                            <button type="submit" name="viewOrderButton" class="viewEntity">
                                                                View
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>No record found</td>
                                                <td></td>
                                                <td></td>
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
                        </div>
                    </div>

                    <!-- New Customers Card -->
                    <div class="customers">
                        <div class="card">
                            <div class="cardHeader">
                                <h2>New Customers</h2>
                                <a href="#Customers" style="text-decoration: none;">
                                    <button>See all<span class="material-symbols-outlined">expand_more</span></button>
                                </a>
                            </div>
                            <div class="cardBody">
                                <div class="customer">
                                    <?php
                                    $getLatestCustomers = getLatestCustomers();
                                    if(mysqli_num_rows($getLatestCustomers)>0)
                                        {
                                            while($retrievedLatest = mysqli_fetch_assoc($getLatestCustomers))
                                            {
                                                ?>
                                                <div class="details">
                                                    <span class='material-symbols-outlined'>account_circle</span>
                                                    <div>
                                                        <h4><?= $retrievedLatest['FirstName'].' '.$retrievedLatest['Surname']; ?></h4>
                                                        <small>Customer</small>
                                                    </div>
                                                    <div class="joinTime">
                                                        <span>Joined <?= getDateTimeDifference($retrievedLatest['DateOfCreation']); ?></span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    else { echo ''; }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Customers Panel -->
            <section id="Customers" class="home-section">
                <div class="text">Customers</div>
                <div class="addTestimonial">
                    <div id="addTestimonial" class="modal">
                        <div class="wrapper">
                            <form method="POST">
                                <h2 style="text-align: center;">Add Testimonial</h2>
                                <div class="input-box">
                                    <input type="text" name="testifier" placeholder="Testifier" required>
                                </div>
                                <div class="input-box">
                                    <input type="text" name="testimonial" placeholder="Testimonial" required>
                                </div>
                                <div class="rating-container">
                                    <p>Star Rating?</p>
                                    <div class="star-rating">
                                        <input type="radio" required name="rating" value="5">
                                        <input type="radio" required name="rating" value="4">
                                        <input type="radio" required name="rating" value="3">
                                        <input type="radio" required name="rating" value="2">
                                        <input type="radio" required name="rating" value="1">
                                    </div>
                                </div>
                                <div class="input-box button">
                                    <input type="submit" name="submitTestimonial" value="Submit Testimonial">
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="#addTestimonial" data-modal="#addTestimonial" rel="modal:open" style="text-decoration: none;">
                        <button class="addEntity">
                            Add Testimonial
                            <span class="material-symbols-outlined" style="margin-left: 5px;">add</span>
                        </button>
                    </a>
                </div>
                <?php
                if(!$_SESSION['settingHideCounters']) // Show counters if not hidden
                {
                    ?>
                        <div class="cards">
                            <div class="cardItem">
                                <?php
                                    if(isset($customerAccounts))
                                    { ?><script>animateCounter('customerCounter', '<?= $customerAccounts; ?>')</script><?php }
                                    else { ?><script>animateCounter('customerCounter', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="customerCounter"></h2></div>
                                    <span>Customers</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">group</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($uniqueVisitors))
                                    { ?><script>animateCounter('uniqueVisitorsCounter', '<?= $uniqueVisitors; ?>')</script><?php }
                                    else { ?><script>animateCounter('uniqueVisitorsCounter', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="uniqueVisitorsCounter"></h2></div>
                                    <span>
                                        <?php 
                                        if($uniqueVisitors == 1)
                                        { echo 'Unique Visitor'; }
                                        else
                                        { echo 'Unique Visitors'; }
                                        ?>
                                    </span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">fingerprint</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($totalOnline))
                                    { ?><script>animateCounter('totalOnlineCount', '<?= $totalOnline; ?>')</script><?php }
                                    else { ?><script>animateCounter('totalOnlineCount', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="totalOnlineCount"></h2></div>
                                    <span>
                                        <?php
                                        if($totalOnline == 1)
                                        { echo 'Contemporary Visitor'; }
                                        else
                                        { echo 'Contemporary Visitors'; }
                                        ?>
                                    </span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">travel_explore</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <div class="cardText">
                                    <?php
                                        if(isset($pendingOrders))
                                        { ?><script>animateCounter('customerPendingOrders', '<?= $pendingOrders; ?>')</script><?php }
                                        else { ?><script>animateCounter('customerPendingOrders', '------')</script><?php }
                                    ?>
                                    <div class="counter"><h2 id="customerPendingOrders"></h2></div>
                                    <span>
                                        <?php 
                                        if(isset($pendingOrders))
                                        {
                                            if($pendingOrders == 1)
                                            { echo 'Pending Order'; }
                                            else
                                            { echo 'Pending Orders'; }
                                        }
                                        else
                                        { echo 'Pending Orders'; }
                                        ?>
                                    </span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">pending_actions</span>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
                <div class="largeSection">

                    <!-- Customers Section -->
                    <div class="smallSection">
                        <div class="card">
                            <div class="cardHeader customersTitle">
                                <h2>Account Profiles</h2>

                                <!-- Search Bar -->
                                <div class="search">
                                    <input type="text" id="searchCustomer" placeholder="Search Customer">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Accounts Table -->
                        <div class="cardBody CustomerTable">
                            <div class="tableResponsive">
                                <?php
                                    $getCustomers = getAll('Customers');
                                ?>
                                <table width="99%" class="threeTableButtons" id="tableOfCustomers">
                                    <thead>
                                        <tr>
                                            <td class="tableHeader">ID</td>
                                            <td class="tableHeader">Customer</td>
                                            <td class="tableHeader">Email</td>
                                            <td class="tableHeader">Hashed Password</td>
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(mysqli_num_rows($getCustomers)>0)
                                        {
                                            while($retrievedCustomer = mysqli_fetch_assoc($getCustomers))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $retrievedCustomer['CustomerID']; ?></td>
                                                    <td><?= $retrievedCustomer['FirstName'].' '.$retrievedCustomer['Surname']; ?></td>
                                                    <td><?= $retrievedCustomer['Email']; ?></td>
                                                    <td><?= $retrievedCustomer['HashedPassword']; ?></td>
                                                    <td>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="viewCustomerID" value="<?= $retrievedCustomer['CustomerID']; ?>"></input>
                                                            <button type="submit" name="viewCustomerButton" class="viewEntity">
                                                                View
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="editCustomerID" value="<?= $retrievedCustomer['CustomerID']; ?>"></input>
                                                            <button type="submit" name="editCustomerButton" class="editEntity">
                                                                Edit
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="" onsubmit="return submitForm(this);">
                                                            <input type="hidden" name="sendCustomerDeleteID" value="<?= $retrievedCustomer['CustomerID']; ?>"></input>
                                                            <button type="submit" class="deleteEntity">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- All New Customers Card -->
                    <div class="customers">
                        <div class="card">
                            <div class="cardHeader customersTitle">
                                <h2>New Customers</h2>
                            </div>
                            <div class="cardBody">
                                <div class="customer">
                                    <?php
                                    $queryGetLatestCustomer         = "SELECT * FROM `Customers` ORDER BY DateOfCreation ASC LIMIT 100";
                                    $getLatestCustomers             = mysqli_query($dbconnect, $queryGetLatestCustomer);
                                    if(mysqli_num_rows($getLatestCustomers)>0)
                                        {
                                            while($retrievedLatest = mysqli_fetch_assoc($getLatestCustomers))
                                            {
                                                ?>
                                                <div class="details">
                                                    <span class='material-symbols-outlined'>account_circle</span>
                                                    <div>
                                                        <h4><?= $retrievedLatest['FirstName'].' '.$retrievedLatest['Surname']; ?></h4>
                                                        <small>Customer</small>
                                                    </div>
                                                    <div class="joinTime">
                                                        <span>Joined <?= getDateTimeDifference($retrievedLatest['DateOfCreation'])?></span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    else
                                    { echo ''; }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php   // Edit Customer Tab
                    if(isset($_SESSION['editCustomer']))
                    {
                        ?>
                        <div class="entityMargins">
                            <div class="entityEditContainer" id="editCustomer">
                                <div class="cardHeader">
                                    <h2>Edit Customer</h2>
                                </div>
                                <div class="entityEditBox">
                                    <form method="POST">
                                        <input type="hidden" name="editCustomerID" value="<?= $CustomerID; ?>"></input>
                                        <div class="input-box">
                                            <input type="text" name="changeCustomerFirstName" placeholder="First Name" required value="<?= $retrievedCustomerFirstName; ?>"></input>
                                        </div>
                                        <div class="input-box">
                                            <input type="text" name="changeCustomerSurname" placeholder="Surname" required value="<?= $retrievedCustomerSurname; ?>"></input>
                                        </div>
                                        <div class="input-box">
                                            <input type="email" name="changeCustomerEmail" placeholder="Email" required value="<?= $retrievedCustomerEmail; ?>"></input>
                                        </div>
                                        <div class="input-box">
                                            <input type="password" name="changeCustomerPassword" placeholder="Password" required value="<?= $retrievedCustomerPassword; ?>"></input>
                                        </div>
                                        <div class="input-box button">
                                            <input type="submit" name="saveCustomerChanges" value="Save Changes"></input>
                                        </div>
                                    </form>
                                    <form method="POST">
                                        <div class="input-box button cancel">
                                            <input type="submit" name="cancelCustomerChanges" value="Cancel"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['editCustomer']);
                    }
                ?>
                <?php   // View Customer Window
                    if(isset($_SESSION['viewCustomer']))
                    {
                        ?>
                        <div class="entityMargins" id="view-customer">
                            <div class="card">
                                <div class="cardHeader">
                                    <h2>Currently viewing Customer #<?= $viewingCustomer['CustomerID'];?></h2>
                                    <div class="closeView">
                                        <form method="POST">
                                            <button type="submit" name="closeViewCustomer" class="closeButton">
                                                <span class="material-symbols-outlined" style="margin-left: 5px;">close</span>
                                                Close
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="cardBody viewCustomer">
                                    <div class="customerDetails">
                                        <div class="profileSection">
                                            <div class="profileInfo">
                                                <h3>Profile:</h3>
                                                <label for="">First Name:</label>
                                                <div class="dataRow">
                                                    <?= $viewingCustomer['FirstName']; ?>
                                                </div>
                                                <label for="">Surname:</label>
                                                <div class="dataRow">
                                                    <?= $viewingCustomer['Surname']; ?>
                                                </div>
                                                <label for="">Email:</label>
                                                <div class="dataRow">
                                                    <?= $viewingCustomer['Email']; ?>
                                                </div>
                                                <form action="" method="POST">
                                                    <div class="input-box button">
                                                        <input type="hidden" name="editCustomerID" value="<?= $viewingCustomer['CustomerID']; ?>">
                                                        <button type="submit" name="editCustomerButton" class="editEntity">Edit Profile</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="ordersSection">
                                            <div class="tableResponsive">
                                                <table>
                                                    <?php
                                                    $ordersCustomerID           = $viewingCustomer['CustomerID'];
                                                    $queryGetOrders             = "SELECT * FROM `Orders`
                                                                                WHERE `CustomerID` = '$ordersCustomerID'
                                                                                ORDER BY `OrderID` DESC 
                                                                                ";
                                                    $getOrders                  = mysqli_query($dbconnect, $queryGetOrders);
                                                    $totalCost = 0;
                                                    if(mysqli_num_rows($getOrders) > 0)
                                                    {
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
                                                                    if($order['Status'] == 0)
                                                                    { echo 'In progress'; }

                                                                    if($order['Status'] == 1)
                                                                    { echo 'Complete'; }

                                                                    if($order['Status'] == 2)
                                                                    { echo 'Cancelled'; }
                                                                    ?>
                                                                </td>
                                                                <td><?= $order['Collection'] == '1' ? 'Delivery':'In-Store'; ?></td>
                                                                <td><?= $order['DateOfCreation']; ?></td>
                                                                <td>
                                                                    <form method="POST">
                                                                    <input type="hidden" name="viewOrderID" value="<?= $order['OrderID'];?>"></input>
                                                                    <input type="hidden" name="viewTrackingID" value="<?= $order['TrackingID'];?>"></input>
                                                                    <input type="hidden" name="viewCustomerID" value="<?= $order['CustomerID'];?>"></input>
                                                                        <button type="submit" name="viewOrderButton" class="viewEntity">View</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    { echo 'No order history found.'; }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    unset($_SESSION['viewCustomer']);
                    }
                ?>
            </section>

            <!-- Analytics Panel -->
            <?php
            if(!$_SESSION['settingHideAnalytics']) // Show Analytics panel if not hidden
            {
                ?>
                    <section id="Analytics" class="home-section">
                        <div class="text">Analytics</div>
                        <?php
                        if(!$_SESSION['settingHideCounters']) // Show counters if not hidden
                        {
                            ?>
                                <div class="cards">
                                    <div class="cardItem">
                                        <?php
                                            if(isset($customerAccounts))
                                            { ?><script>animateCounter('analyticsCustomerCounter', '<?= $customerAccounts; ?>')</script><?php }
                                            else { ?><script>animateCounter('analyticsCustomerCounter', '------')</script><?php }
                                        ?>
                                        <div class="cardText">
                                            <div class="counter"><h2 id="analyticsCustomerCounter"></h2></div>
                                            <span>Customers</span>
                                        </div>
                                        <div class="cardIcon">
                                            <span class="material-symbols-outlined">group</span>
                                        </div>
                                    </div>
                                    <div class="cardItem">
                                        <div class="cardText">
                                            <?php
                                                if(isset($pendingOrders))
                                                { ?><script>animateCounter('analyticsPendingOrders', '<?= $pendingOrders; ?>')</script><?php }
                                                else { ?><script>animateCounter('analyticsPendingOrders', '------')</script><?php }
                                            ?>
                                            <div class="counter"><h2 id="analyticsPendingOrders"></h2></div>
                                            <span>
                                                <?php 
                                                if(isset($pendingOrders))
                                                {
                                                    if($pendingOrders == 1)
                                                    { echo 'Pending Order'; }
                                                    else
                                                    { echo 'Pending Orders'; }
                                                }
                                                else
                                                { echo 'Pending Orders'; }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="cardIcon">
                                            <span class="material-symbols-outlined">pending_actions</span>
                                        </div>
                                    </div>
                                    <div class="cardItem">
                                        <?php
                                            if(isset($allProducts))
                                            { ?><script>animateCounter('dashboardProducts', '<?= $allProducts; ?>')</script><?php }
                                        ?>
                                        <div class="cardText">
                                            <div class="count">
                                                <h2 id="dashboardProducts"></h2>
                                            </div>
                                            <span>Products</span>
                                        </div>
                                        <div class="cardIcon">
                                            <span class="material-symbols-outlined">package</span>
                                        </div>
                                    </div>
                                    <div class="cardItem">
                                        <?php
                                            if(isset($totalRevenue))
                                            { ?><script>animateCounter('analyticsRevenue', '<?= number_format($totalRevenue, 2, '.', ','); ?>')</script><?php }
                                            else { ?><script>animateCounter('analyticsRevenue', '------')</script><?php }
                                        ?>
                                        <div class="cardText">
                                            <div class="revenue counter">
                                                <h2>£</h2>
                                                <h2 id="analyticsRevenue"></h2>
                                            </div>
                                            <span>Revenue</span>
                                        </div>
                                        <div class="cardIcon">
                                            <span class="material-symbols-outlined">insights</span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>

                        <!-- Analytics Charts and Graphs -->
                        <div class="dashboardGraphs">
                            <div class="cardItem">
                                <div class="analyticHead">
                                    <h2><?= date("Y"); ?> Monthly Sales & Revenue</h2>
                                </div>
                                <div class="salesChart">
                                    <canvas id="salesChart" style="width: 100%;"></canvas>
                                </div>
                            </div>
                            <div class="cardItem">
                                <div class="analyticHead">
                                    <h2>Products</h2>
                                </div>
                                <div class="productsChart">
                                    <canvas id="productsChart" style="width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Script to generate the charts and graphs -->
                        <script>
                            const salesChart = document.getElementById('salesChart');
                            new Chart(salesChart, {
                                type: 'line',
                                data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                datasets: [{
                                    label: 'Revenue',
                                    data: <?php echo json_encode($revenueArr) ?>,
                                    tension: 0.3,
                                    yAxisID: 'revenue'
                                },{
                                    label: 'Sales',
                                    data: <?php echo json_encode($monthlySales) ?>,
                                    tension: 0.3,
                                    yAxisID: 'sales'
                                }]
                                },
                                options: {
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    if (context.dataset.label == 'Revenue') {
                                                        function currencyFormat(num) {
                                                            return '£' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                                        }
                                                        return `${context.dataset.label}: ${currencyFormat(context.raw)}`
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        revenue: {
                                            beginAtZero: true,
                                            type: 'linear',
                                            position: 'left',
                                            grace: 1000,
                                            ticks: {
                                                stepSize: 2000,
                                                callback: function(value, index, values) {
                                                    return `£${value.toLocaleString("en-US")}`
                                                }
                                            }
                                        },
                                        sales: {
                                            beginAtZero: true,
                                            type: 'linear',
                                            position: 'right',
                                            grace: 1,
                                            ticks: {
                                                stepSize: 1,
                                            },
                                            grid: {
                                                drawOnChartArea: false
                                            }
                                        },
                                    }
                                }
                            });
                            const productsChart = document.getElementById('productsChart');
                            new Chart(productsChart, {
                                type: 'doughnut',
                                data: {
                                    labels: <?php echo json_encode($categoryNames) ?>,
                                    datasets: [{
                                        label: 'Products',
                                        data: <?php echo json_encode($categoryAllProducts) ?>,
                                        borderWidth: 1,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgb(153, 102, 255)',
                                            'rgb(255, 159, 64)',
                                        ],
                                        cutout: '70%'
                                    }]
                                }
                            });
                        </script>
                    </section>
                <?php
            }
            ?>

            <!-- Product Panel -->
            <section id="Products" class="home-section">
                <div class="text">Products</div>
                <?php
                if(!$_SESSION['settingHideCounters']) // Show counters if not hidden
                {
                    ?>
                        <div class="cards">
                            <div class="cardItem">
                                <?php
                                    if(isset($customerAccounts))
                                    { ?><script>animateCounter('productCustomerCounter', '<?= $customerAccounts; ?>')</script><?php }
                                    else { ?><script>animateCounter('productCustomerCounter', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="productCustomerCounter"></h2></div>
                                    <span>Customers</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">group</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <div class="cardText">
                                    <?php
                                        if(isset($pendingOrders))
                                        { ?><script>animateCounter('productsPendingOrders', '<?= $pendingOrders; ?>')</script><?php }
                                        else { ?><script>animateCounter('productsPendingOrders', '------')</script><?php }
                                    ?>
                                    <div class="counter"><h2 id="productsPendingOrders"></h2></div>
                                    <span>
                                        <?php 
                                        if(isset($pendingOrders))
                                        {
                                            if($pendingOrders == 1)
                                            { echo 'Pending Order'; }
                                            else
                                            { echo 'Pending Orders'; }
                                        }
                                        else
                                        { echo 'Pending Orders'; }
                                        ?>
                                    </span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">pending_actions</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($allProducts))
                                    { ?><script>animateCounter('productsProducts', '<?= $allProducts; ?>')</script><?php }
                                    else { ?><script>animateCounter('productsProducts', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="count">
                                        <h2 id="productsProducts"></h2>
                                    </div>
                                    <span>Products</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">package</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($totalRevenue))
                                    { ?><script>animateCounter('productsRevenue', '<?= number_format($totalRevenue, 2, '.', ','); ?>')</script><?php }
                                    else { ?><script>animateCounter('productsRevenue', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="revenue counter">
                                        <h2>£</h2>
                                        <h2 id="productsRevenue"></h2>
                                    </div>
                                    <span>Revenue</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">insights</span>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
                <!-- Products Section -->
                <div class="singleGrid">
                    <div class="smallSection" id="ProductsTable">
                        <div class="card">
                            <div class="cardHeader">
                                <h2>Products</h2>

                                <!-- Search Bar -->
                                <div class="search">
                                    <input type="text" id="searchProduct" placeholder="Search Product">
                                    <span class="material-symbols-outlined">search</span>
                                </div>

                                <!-- Filter By Dates -->
                                <div class="datesContainer">
                                    <form method="POST">
                                        <div class="dates">
                                            <div class="date">
                                                <label>From:</label>
                                                <input type="date" name="productsDateFrom" value="<?php if(isset($_POST['productsDateFrom'])) { echo $_POST['productsDateFrom']; }?>">
                                            </div>
                                            <div class="date">
                                                <label>To:</label>
                                                <input type="date" name="productsDateTo" value="<?php if(isset($_POST['productsDateTo'])) { echo $_POST['productsDateTo']; }?>">
                                            </div>
                                            <div class="date">
                                                <button type="submit">→</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php   // Show export button if not hidden
                                if(!$_SESSION['settingHideExports'])
                                {
                                    ?>
                                        <div class="exportProducts">
                                            <form method="POST">
                                                <select name="exportProducts">
                                                    <option value="xlsx">.XLSX</option>
                                                    <option value="xls">.XLS</option>
                                                    <option value="csv">.CSV</option>
                                                </select>
                                                <button type="submit" class="exportButton" name="exportProductsButton">
                                                    Export
                                                    <span class="material-symbols-outlined" style="margin-left: 5px;">input</span>
                                                </button>
                                            </form>
                                        </div>
                                    <?php
                                }
                                ?>

                                <!-- Add Product Modal -->
                                <div class="addProduct">
                                    <div id="addProduct" class="modal">
                                        <div class="wrapper">
                                            <form method="POST" enctype="multipart/form-data">
                                                <h2 style="text-align: center;">Add Product</h2>
                                                <label for="">Select Category</label><br>
                                                <div class="selectBox">
                                                    <select name="productCategoryID" required>
                                                        <option selected>----</option>
                                                        <?php
                                                            $selectCategories = getAll('Categories');
                                                            if(mysqli_num_rows($selectCategories) > 0)
                                                            {
                                                                foreach($selectCategories as $value)
                                                                {
                                                                    ?>
                                                                        <option value="<?= $value['CategoryID']; ?>"><?= $value['CategoryName']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            { echo 'No categories  found...'; }
                                                        ?>
                                                    </select>
                                                </div>
                                                <br>
                                                <label for="">Name</label><br>
                                                <div class="input-box">
                                                    <input type="text" name="productName" placeholder="Enter Product Name" required>
                                                </div>
                                                <div class="formCheckboxes">
                                                    <div class="formCheckbox">
                                                        <input type="checkbox" id="productVisibility" name="productVisibility">
                                                        <label for="productVisibility">Visible</label>
                                                    </div>
                                                    <div class="formCheckbox">
                                                        <input type="checkbox" id="productPopular" name="productPopular">
                                                        <label for="productPopular">Popular</label>
                                                    </div>
                                                </div>
                                                <label for="">Quantity</label><br>
                                                <div class="input-box">
                                                    <input type="number" min="0" name="productQuantity" placeholder="Enter Quantity" required>
                                                </div>
                                                <label for="">Retail Price</label><br>
                                                <div class="input-box priceInput">
                                                    <span class="material-symbols-outlined">currency_pound</span>
                                                    <input type="number" step="0.01" min="0" name="productRetailPrice" placeholder="00.00" required>
                                                </div>
                                                <label for="">Selling Price</label><br>
                                                <div class="input-box priceInput">
                                                    <span class="material-symbols-outlined">currency_pound</span>
                                                    <input type="number" step="0.01" min="0" name="productSellingPrice" placeholder="00.00" required>
                                                </div>
                                                <div class="imageContainer">
                                                    <div class="uploadButton">
                                                        <input type="file" name="productImage" id="uploadProduct" placeholder="Product Image" required accept="image/*">
                                                        <label for="uploadProduct">
                                                            <span class="material-symbols-outlined">upload</span>
                                                            <p>Choose Photo</p>
                                                        </label>
                                                    </div>
                                                    <figure>
                                                        <figcaption id="productImageName"></figcaption>
                                                        <img id="chosenProductImage">
                                                    </figure>
                                                </div>
                                                <label for="">Description</label><br>
                                                <textarea rows="2" name="productDescription" placeholder="Enter Description" required></textarea>
                                                <h2 style="text-align: center;">SEO</h2>
                                                <label for="">Meta Title</label><br>
                                                <textarea rows="2" name="productMetaTitle" placeholder="Enter Meta Title" required></textarea>
                                                <br><label for="">Meta Description</label><br>
                                                <textarea rows="2" name="productMetaDescription" placeholder="Enter Meta Description" required></textarea>
                                                <br><label for="">Meta Keywords</label><br>
                                                <textarea rows="2" name="productMetaKeywords" placeholder="Enter Meta Keywords" required></textarea>
                                                <div class="input-box button">
                                                    <input type="submit" name="submitProduct" value="Submit Details">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="#addProduct" data-modal="#addProduct" rel="modal:open" style="text-decoration: none;">
                                        <button class="addEntity productButton">
                                            Add Product
                                            <span class="material-symbols-outlined" style="margin-left: 5px;">add</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Product Table -->
                        <div class="cardBody ProductTable">
                            <div class="tableResponsive">
                                <?php
                                    if(isset($_POST['productsDateFrom']) && isset($_POST['productsDateTo']))
                                    {
                                        $productsDateFrom           = $_POST['productsDateFrom'];
                                        $productsDateTo             = $_POST['productsDateTo'];
                                        $queryProductTable          = "SELECT * FROM `Products`
                                                                    WHERE `DateOfCreation`
                                                                    BETWEEN
                                                                    '$productsDateFrom' AND '$productsDateTo'";
                                        $getProducts                = mysqli_query($dbconnect, $queryProductTable);
                                        ?>
                                            <script type="text/javascript">
                                                setTimeout(function(){
                                                    window.location.hash = '#ProductsTable';
                                                }, 1000);
                                            </script>
                                        <?php
                                    }
                                    else
                                    { $getProducts                  = getAll('Products'); }
                                ?>
                                <table width="100%" class="twoTableButtons" id="tableOfProducts">
                                    <thead>
                                        <tr>
                                            <td class="tableHeader">ID:</td>
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader">Product:</td>
                                            <td class="tableHeader">Quantity:</td>
                                            <td class="tableHeader">Price:</td>
                                            <td class="tableHeader">Description:</td>
                                            <td class="tableHeader">Visibility:</td>
                                            <td class="tableHeader">Popularity:</td>
                                            <td class="tableHeader">Date Created:</td>
                                            <td class="tableHeader">Date Updated:</td>
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(mysqli_num_rows($getProducts)>0)
                                        {
                                            while($retrievedProducts = mysqli_fetch_assoc($getProducts))
                                            {
                                                ?>
                                                <tr class="tableRow">
                                                    <td><?= $retrievedProducts['ProductID']; ?></td>
                                                    <td>
                                                        <img src="./images/uploads/products/<?= $retrievedProducts['ProductImage']; ?>" alt="<?= $retrievedProducts['ProductName']; ?>">
                                                    </td>
                                                    <td><?= $retrievedProducts['ProductName']; ?></td>
                                                    <td><?= $retrievedProducts['ProductQuantity']; ?></td>
                                                    <td>
                                                        <h4>£<?= number_format($retrievedProducts['SellingPrice'], 2, '.', ','); ?></h4>
                                                        <p>£<?= number_format($retrievedProducts['RetailPrice'], 2, '.', ','); ?></p>
                                                    </td>
                                                    <td><span><?= $retrievedProducts['ProductDescription']; ?></span></td>
                                                    <td><?= $retrievedProducts['ProductVisibility'] == '1' ? "Visible":"Hidden"; ?></td>
                                                    <td><?= $retrievedProducts['ProductPopular'] == '1' ? "Popular":"Normal"; ?></td>
                                                    <td><?= $retrievedProducts['DateOfCreation']; ?></td>
                                                    <td><?= $retrievedProducts['DateOfUpdate']; ?></td>
                                                    <td>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="editProductID" value="<?= $retrievedProducts['ProductID']; ?>"></input>
                                                            <button type="submit" name="editProductButton" class="editEntity">
                                                                Edit
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="" onsubmit="return submitForm(this);">
                                                            <input type="hidden" name="sendProductDeleteID" value="<?= $retrievedProducts['ProductID']; ?>"></input>
                                                            <button type="submit" class="deleteEntity">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Product Tab (if set) -->
                <div class="entityMargins">
                    <?php
                    if(isset($_SESSION['editProduct']))
                    {
                        ?>
                        <div class="entityEditContainer" id="editProduct">
                            <div class="cardHeader">
                                <h2>Edit Product</h2>
                            </div>
                            <div class="entityEditBox">
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="changeProductID" value="<?= $productID; ?>"></input>
                                    <label for="">Select Category</label><br>
                                    <div class="selectBox">
                                        <select name="changeProductCategoryID" required>
                                            <?php
                                                $selectCategories = getAll('Categories');
                                                if(mysqli_num_rows($selectCategories) > 0)
                                                {
                                                    foreach($selectCategories as $value)
                                                    {
                                                        ?>
                                                            <option value="<?= $value['CategoryID']; ?>" <?= $retrievedProductCategoryID == $value['CategoryID'] ? 'selected':'' ?>><?= $value['CategoryName']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                else
                                                { echo 'No categories  found...'; }
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                    <label for="">Name</label><br>
                                    <div class="input-box">
                                        <input type="text" name="changeProductName" placeholder="Enter Product Name" value='<?= $retrievedProductName; ?>' required>
                                    </div>
                                    <div class="formCheckboxes">
                                        <div class="formCheckbox">
                                            <input type="checkbox" id="productChangeVisibility" name="changeProductVisibility" <?= $retrievedProductVisibility == '1' ? "checked":"" ; ?>>
                                            <label for="productChangeVisibility">Visible</label>
                                        </div>
                                        <div class="formCheckbox">
                                            <input type="checkbox" id="productChangePopular" name="changeProductPopular" <?= $retrievedProductPopular == '1' ? "checked":""; ?>>
                                            <label for="productChangePopular">Popular</label>
                                        </div>
                                    </div>
                                    <label for="">Quantity</label><br>
                                    <div class="input-box">
                                        <input type="number" min="0" name="changeProductQuantity" placeholder="Enter Quantity" value="<?= $retrievedProductQuantity; ?>" required>
                                    </div>
                                    <label for="">Retail Price</label><br>
                                    <div class="input-box priceInput">
                                        <span class="material-symbols-outlined">currency_pound</span>
                                        <input type="number" step="0.01" min="0" name="changeRetailPrice" placeholder="00.00" value="<?= $retrievedRetailPrice; ?>" required>
                                    </div>
                                    <label for="">Selling Price</label><br>
                                    <div class="input-box priceInput">
                                        <span class="material-symbols-outlined">currency_pound</span>
                                        <input type="number" step="0.01" min="0" name="changeSellingPrice" placeholder="00.00" value="<?= $retrievedSellingPrice; ?>" required>
                                    </div>
                                    <div class="imageContainer">
                                        <input type="hidden" name="oldImage" value="<?= $retrievedProductImage ?>">
                                        <div class="uploadButton">
                                            <input type="file" name="productChangeImage" id="uploadChangeProduct" placeholder="Product Image" accept="image/*">
                                            <label for="uploadChangeProduct">
                                                <span class="material-symbols-outlined">upload</span>
                                                <p>Choose Photo</p>
                                            </label>
                                        </div>
                                        <figure>
                                            <figcaption id="changeProductImageName"></figcaption>
                                            <img id="chosenChangeProductImage"
                                            <?php
                                            if(isset($retrievedProductImage))
                                            {
                                                $setOldImage = "src='./images/uploads/products/$retrievedProductImage'";
                                                echo $setOldImage;
                                                unset($setOldImage);
                                            }
                                            ?>
                                            >
                                        </figure>
                                    </div>
                                    <label for="">Description</label><br>
                                    <textarea rows="2" name="changeProductDescription" placeholder="Enter Product Description" required><?= $retrievedProductDescription; ?></textarea>
                                        <h2 style="text-align: center;">SEO</h2>
                                    <label for="">Meta Title</label><br>
                                    <textarea rows="2" name="changeProductMetaTitle" placeholder="Enter Meta Title" required><?= $retrievedMetaTitle; ?></textarea>
                                    <br><label for="">Meta Description</label><br>
                                    <textarea rows="2" name="changeProductMetaDescription" placeholder="Enter Meta Description" required><?= $retrievedMetaDescription; ?></textarea>
                                    <br><label for="">Meta Keywords</label><br>
                                    <textarea rows="2" name="changeProductMetaKeywords" placeholder="Enter Meta Keywords" required><?= $retrievedMetaKeywords; ?></textarea>
                                    <div class="input-box button">
                                        <input type="submit" name="saveProductChanges" value="Update">
                                    </div>
                                </form>
                                <form method="POST">
                                    <div class="input-box button cancel">
                                        <input type="submit" name="cancelProductChanges" value="Cancel"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['editProduct']);
                    }
                    ?>
                </div>

                <br>

                <!-- Category Section -->
                <div class="singleGrid">
                    <div class="smallSection" id="Categories">
                        <div class="card">
                            <div class="cardHeader">
                                <h2>Categories</h2>

                                <!-- Search Bar -->
                                <div class="search">
                                    <input type="text" id="searchCategory" placeholder="Search Category">
                                    <span class="material-symbols-outlined">search</span>
                                </div>

                                <!-- Filter By Dates -->
                                <div class="datesContainer">
                                    <form method="POST">
                                        <div class="dates">
                                            <div class="date">
                                                <label>From:</label>
                                                <input type="date" name="categoriesDateFrom" value="<?php if(isset($_POST['categoriesDateFrom'])) { echo $_POST['categoriesDateFrom']; }?>">
                                            </div>
                                            <div class="date">
                                                <label>To:</label>
                                                <input type="date" name="categoriesDateTo" value="<?php if(isset($_POST['categoriesDateTo'])) { echo $_POST['categoriesDateTo']; }?>">
                                            </div>
                                            <div class="date">
                                                <button type="submit">→</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Add Category Modal -->
                                <div class="addCategory">
                                    <div id="addCategory" class="modal">
                                        <div class="wrapper">
                                            <form method="POST" enctype="multipart/form-data">
                                                <h2 style="text-align: center;">Add Category</h2>
                                                <label for="">Name</label><br>
                                                <div class="input-box">
                                                    <input type="text" name="categoryName" placeholder="Enter Category Name" required>
                                                </div>
                                                <div class="formCheckboxes">
                                                    <div class="formCheckbox">
                                                        <input type="checkbox" id="categoryVisibility" name="categoryVisibility">
                                                        <label for="categoryVisibility">Visible</label>
                                                    </div>
                                                    <div class="formCheckbox">
                                                        <input type="checkbox" id="categoryPopular" name="categoryPopular">
                                                        <label for="categoryPopular">Popular</label>
                                                    </div>
                                                </div>
                                                <label for="">Description</label><br>
                                                <div class="input-box">
                                                    <input type="text" name="categoryDescription" placeholder="Enter Category Description" required>
                                                </div>
                                                <div class="imageContainer">
                                                    <div class="uploadButton">
                                                        <input type="file" name="categoryImage" id="uploadCategory" placeholder="Category Image" required accept="image/*">
                                                        <label for="uploadCategory">
                                                            <span class="material-symbols-outlined">upload</span>
                                                            <p>Choose Photo</p>
                                                        </label>
                                                    </div>
                                                    <figure>
                                                        <figcaption id="categoryImageName"></figcaption>
                                                        <img id="chosenCategoryImage">
                                                    </figure>
                                                </div>
                                                    <h2 style="text-align: center;">SEO</h2>
                                                <label for="">Meta Title</label><br>
                                                <textarea rows="2" name="categoryMetaTitle" placeholder="Enter Meta Title" required></textarea>
                                                <br><label for="">Meta Description</label><br>
                                                <textarea rows="2" name="categoryMetaDescription" placeholder="Enter Meta Description" required></textarea>
                                                <br><label for="">Meta Keywords</label><br>
                                                <textarea rows="2" name="categoryMetaKeywords" placeholder="Enter Meta Keywords" required></textarea>
                                                <div class="input-box button">
                                                    <input type="submit" name="submitCategory" value="Submit Details">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="#addCategory" data-modal="#addCategory" rel="modal:open" style="text-decoration: none;">
                                        <button class="addEntity categoryButton">
                                            Add Category
                                            <span class="material-symbols-outlined" style="margin-left: 5px;">add</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Category Table -->
                        <div class="cardBody CategoryTable">
                            <div class="tableResponsive">
                                <table width="99%" class="twoTableButtons" id="tableOfCategories">
                                    <thead>
                                        <tr class="tableRow">
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader">Category:</td>
                                            <td class="tableHeader">Description:</td>
                                            <td class="tableHeader">Visibility:</td>
                                            <td class="tableHeader">Popularity:</td>
                                            <td class="tableHeader">Keywords:</td>
                                            <td class="tableHeader">Date Created:</td>
                                            <td class="tableHeader">Date Updated:</td>
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_POST['categoriesDateFrom']) && isset($_POST['categoriesDateTo']))
                                        {
                                            $categoriesDateFrom         = $_POST['categoriesDateFrom'];
                                            $categoriesDateTo           = $_POST['categoriesDateTo'];
                                            $queryCategoryTable         = "SELECT * FROM `Categories`
                                                                        WHERE `DateOfCreation`
                                                                        BETWEEN
                                                                        '$categoriesDateFrom' AND '$categoriesDateTo'";
                                            $getCategories              = mysqli_query($dbconnect, $queryCategoryTable);
                                            ?>
                                                <script type="text/javascript">
                                                    setTimeout(function(){
                                                        window.location.hash = '#Categories';
                                                    }, 1000);
                                                </script>
                                            <?php
                                        }
                                        else
                                        { $getCategories = getAll('Categories'); }
                                        if(mysqli_num_rows($getCategories)>0)
                                        {
                                            while($retrievedCategories = mysqli_fetch_assoc($getCategories))
                                            {
                                                ?>
                                                <tr class="tableRow">
                                                    <td>
                                                        <img src="./images/uploads/categories/<?= $retrievedCategories['CategoryImage']; ?>" alt="<?= $retrievedCategories['CategoryName']; ?>">
                                                    </td>
                                                    <td><?= $retrievedCategories['CategoryName']; ?></td>
                                                    <td><?= $retrievedCategories['CategoryDescription']; ?></td>
                                                    <td><?= $retrievedCategories['CategoryVisibility'] == '1' ? "Visible":"Hidden"; ?></td>
                                                    <td><?= $retrievedCategories['CategoryPopular'] == '1' ? "Popular":"Normal"; ?></td>
                                                    <td><?= $retrievedCategories['MetaKeywords']; ?></td>
                                                    <td><?= $retrievedCategories['DateOfCreation']; ?></td>
                                                    <td><?= $retrievedCategories['DateOfUpdate']; ?></td>
                                                    <td>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="editCategoryID" value="<?= $retrievedCategories['CategoryID']; ?>"></input>
                                                            <button type="submit" name="editCategoryButton" class="editEntity">
                                                                Edit
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="" onsubmit="return submitForm(this);">
                                                            <input type="hidden" name="sendCategoryDeleteID" value="<?= $retrievedCategories['CategoryID']; ?>"></input>
                                                            <button type="submit" class="deleteEntity">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                                <td>No record found</td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Category Tab (if set) -->
                <div class="entityMargins">
                    <?php
                    if(isset($_SESSION['editCategory']))
                    {
                        ?>
                        <div class="entityEditContainer" id="editCategory">
                            <div class="cardHeader">
                                <h2>Edit Category</h2>
                            </div>
                            <div class="entityEditBox">
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="changeCategoryID" value="<?= $categoryID; ?>"></input>
                                    <label for="">Name</label><br>
                                    <div class="input-box">
                                        <input type="text" name="changeCategoryName" placeholder="Enter Category Name" value="<?= $retrievedCategoryName; ?>" required>
                                    </div>
                                    <div class="formCheckboxes">
                                        <div class="formCheckbox">
                                            <input type="checkbox" id="categoryChangeVisibility" name="changeCategoryVisibility" <?= $retrievedCategoryVisibility == '1' ? "checked":"" ; ?>>
                                            <label for="categoryChangeVisibility">Visible</label>
                                        </div>
                                        <div class="formCheckbox">
                                            <input type="checkbox" id="categoryChangePopular" name="changeCategoryPopular" <?= $retrievedCategoryPopular == '1' ? "checked":""; ?>>
                                            <label for="categoryChangePopular">Popular</label>
                                        </div>
                                    </div>
                                    <label for="">Description</label><br>
                                    <div class="input-box">
                                        <input type="text" name="changeCategoryDescription" placeholder="Enter Category Description" value="<?= $retrievedCategoryDescription; ?>" required>
                                    </div>
                                    <div class="imageContainer">
                                        <input type="hidden" name="oldImage" value="<?= $retrievedCategoryImage ?>">
                                        <div class="uploadButton">
                                            <input type="file" name="categoryChangeImage" id="uploadChangeCategory" placeholder="Category Image" accept="image/*">
                                            <label for="uploadChangeCategory">
                                                <span class="material-symbols-outlined">upload</span>
                                                <p>Choose Photo</p>
                                            </label>
                                        </div>
                                        <figure>
                                            <figcaption id="changeCategoryImageName"></figcaption>
                                            <img id="chosenChangeCategoryImage"
                                            <?php
                                            if(isset($retrievedCategoryImage))
                                            {
                                                $setOldImage = "src='./images/uploads/categories/$retrievedCategoryImage'";
                                                echo $setOldImage;
                                                unset($setOldImage);
                                            }
                                            ?>
                                            >
                                        </figure>
                                    </div>
                                        <h2 style="text-align: center;">SEO</h2>
                                    <label for="">Meta Title</label><br>
                                    <textarea rows="2" name="changeCategoryMetaTitle" placeholder="Enter Meta Title" required><?= $retrievedMetaTitle; ?></textarea>
                                    <br><label for="">Meta Description</label><br>
                                    <textarea rows="2" name="changeCategoryMetaDescription" placeholder="Enter Meta Description" required><?= $retrievedMetaDescription; ?></textarea>
                                    <br><label for="">Meta Keywords</label><br>
                                    <textarea rows="2" name="changeCategoryMetaKeywords" placeholder="Enter Meta Keywords" required><?= $retrievedMetaKeywords; ?></textarea>
                                    <div class="input-box button">
                                        <input type="submit" name="saveCategoryChanges" value="Update">
                                    </div>
                                </form>
                                <form method="POST">
                                    <div class="input-box button cancel">
                                        <input type="submit" name="cancelCategoryChanges" value="Cancel"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['editCategory']);
                    }
                    ?>
                </div>

                <!-- Script for uploads buttons for add/edit product/category -->
                <script src="js/uploadImageButton.js"></script>
            </section>

            <!-- Orders Panel -->
            <section id="Orders" class="home-section">
                <div class="text">Orders</div>
                <?php
                if(!$_SESSION['settingHideCounters']) // Show counters if not hidden
                {
                    ?>
                        <div class="cards">
                            <div class="cardItem">
                                <?php
                                    if(isset($pendingOrders))
                                    { ?><script>animateCounter('ordersPendingOrders', '<?= number_format($pendingOrders); ?>')</script><?php }
                                    else { ?><script>animateCounter('ordersPendingOrders', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="ordersPendingOrders"></h2></div>
                                    <span>
                                        <?php 
                                        if(isset($pendingOrders))
                                        {
                                            if($pendingOrders == 1)
                                            { echo 'Pending Order'; }
                                            else
                                            { echo 'Pending Orders'; }
                                        }
                                        else
                                        { echo 'Pending Orders'; }
                                        ?>
                                    </span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">pending_actions</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($completeOrders))
                                    { ?><script>animateCounter('ordersCompleteOrders', '<?= $completeOrders; ?>')</script><?php }
                                    else { ?><script>animateCounter('ordersCompleteOrders', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="ordersCompleteOrders"></h2></div>
                                    <span>Completed Orders</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">inventory</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($customerAccounts))
                                    { ?><script>animateCounter('ordersCustomerCounter', '<?= number_format($customerAccounts); ?>')</script><?php }
                                    else { ?><script>animateCounter('ordersCustomerCounter', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="counter"><h2 id="ordersCustomerCounter"></h2></div>
                                    <span>Customers</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">group</span>
                                </div>
                            </div>
                            <div class="cardItem">
                                <?php
                                    if(isset($totalRevenue))
                                    { ?><script>animateCounter('ordersRevenue', '<?= number_format($totalRevenue, 2, '.', ','); ?>')</script><?php }
                                    else { ?><script>animateCounter('ordersRevenue', '------')</script><?php }
                                ?>
                                <div class="cardText">
                                    <div class="revenue counter">
                                        <h2>£</h2>
                                        <h2 id="ordersRevenue"></h2>
                                    </div>
                                    <span>Revenue</span>
                                </div>
                                <div class="cardIcon">
                                    <span class="material-symbols-outlined">insights</span>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>

                <!-- Orders Section -->
                <div class="singleGrid">
                    <div class="smallSection" id="Orders">
                        <div class="card">
                            <div class="cardHeader">
                                <h2>All Orders</h2>

                                <!-- Search Bar -->
                                <div class="search">
                                    <input type="text" id="searchOrder" placeholder="Search Order">
                                    <span class="material-symbols-outlined">search</span>
                                </div>

                                <!-- Filter By Dates -->
                                <div class="datesContainer">
                                    <form method="POST">
                                        <div class="dates">
                                            <div class="date">
                                                <label>From:</label>
                                                <input type="date" name="ordersDateFrom" value="<?php if(isset($_POST['ordersDateFrom'])) { echo $_POST['ordersDateFrom']; }?>">
                                            </div>
                                            <div class="date">
                                                <label>To:</label>
                                                <input type="date" name="ordersDateTo" value="<?php if(isset($_POST['ordersDateTo'])) { echo $_POST['ordersDateTo']; }?>">
                                            </div>
                                            <div class="date">
                                                <button type="submit">→</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php   // Show exports button if not hidden
                                if(!$_SESSION['settingHideExports'])
                                {
                                    ?>
                                        <div class="exportOrders">
                                            <form method="POST">
                                                <select name="exportOrders">
                                                    <option value="xlsx">.XLSX</option>
                                                    <option value="xls">.XLS</option>
                                                    <option value="csv">.CSV</option>
                                                </select>
                                                <button type="submit" class="exportButton" name="exportOrdersButton">
                                                    Export
                                                    <span class="material-symbols-outlined" style="margin-left: 5px;">input</span>
                                                </button>
                                            </form>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Orders Table -->
                        <div class="cardBody OrderTable">
                            <div class="tableResponsive">
                                <table width="99%" class="twoTableButtons" id="tableOfOrders">
                                    <thead>
                                        <tr class="tableRow">
                                            <td class="tableHeader">Order ID:</td>
                                            <td class="tableHeader">Tracking ID:</td>
                                            <td class="tableHeader">Customer ID:</td>
                                            <td class="tableHeader">Recipient:</td>
                                            <td class="tableHeader">Total Cost:</td>
                                            <td class="tableHeader">Payment Method:</td>
                                            <td class="tableHeader">Status:</td>
                                            <td class="tableHeader">Collection:</td>
                                            <td class="tableHeader">Order Date:</td>
                                            <td class="tableHeader">Date Updated:</td>
                                            <td class="tableHeader"></td>
                                            <td class="tableHeader"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(isset($_POST['ordersDateFrom']) && isset($_POST['ordersDateTo']))
                                            {
                                                $ordersDateFrom             = $_POST['ordersDateFrom'];
                                                $ordersDateTo               = $_POST['ordersDateTo'];
                                                $queryOrderTable            = "SELECT * FROM `Orders`
                                                                            WHERE `DateOfCreation`
                                                                            BETWEEN
                                                                            '$ordersDateFrom' AND '$ordersDateTo'
                                                                            ORDER BY `DateOfCreation` DESC";
                                                $getOrders                  = mysqli_query($dbconnect, $queryOrderTable);
                                                ?>
                                                    <script type="text/javascript">
                                                        setTimeout(function(){
                                                            window.location.hash = '#Orders';
                                                        }, 1000);
                                                    </script>
                                                <?php
                                            }
                                            else
                                            { $getOrders = getAllOrders(); }
                                            if(mysqli_num_rows($getOrders) > 0)
                                            {
                                                while($retrievedOrder = mysqli_fetch_assoc($getOrders))
                                                {
                                                    ?>
                                                    <tr class="tableRow">
                                                        <td><?= $retrievedOrder['OrderID'];?></td>
                                                        <td><?= $retrievedOrder['TrackingID'];?></td>
                                                        <td><?= $retrievedOrder['CustomerID'];?></td>
                                                        <td><?= $retrievedOrder['FirstName']." ".$retrievedOrder['Surname'];?></td>
                                                        <td>£<?= number_format($retrievedOrder['TotalPrice'], 2, '.', ','); ?></td>
                                                        <td><?= $retrievedOrder['PaymentMethod'];?></td>
                                                        <td>
                                                            <?php
                                                            if($retrievedOrder['Status'] == 0)
                                                            {
                                                                ?>
                                                                <span class="status pending"></span>
                                                                Pending
                                                                <?php
                                                            }
                                                            else if($retrievedOrder['Status'] == 1)
                                                            {
                                                                ?>
                                                                <span class="status complete"></span>
                                                                Complete
                                                                <?php
                                                            }
                                                            else if($retrievedOrder['Status'] == 2)
                                                            {
                                                                ?>
                                                                <span class="status cancelled"></span>
                                                                Cancelled
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $retrievedOrder['Collection'] == '1' ? 'Delivery':'In-Store' ;?></td>
                                                        <td><?= $retrievedOrder['DateOfCreation'];?></td>
                                                        <td><?= $retrievedOrder['DateOfUpdate'];?></td>
                                                        <td>
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="viewOrderID" value="<?= $retrievedOrder['OrderID'];?>"></input>
                                                                <input type="hidden" name="viewTrackingID" value="<?= $retrievedOrder['TrackingID'];?>"></input>
                                                                <input type="hidden" name="viewCustomerID" value="<?= $retrievedOrder['CustomerID'];?>"></input>
                                                                <button type="submit" name="viewOrderButton" class="viewEntity">
                                                                    View
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form method="POST" action="" onsubmit="return submitForm(this);">
                                                                <input type="hidden" name="deleteOrder" value=""></input>
                                                                <button type="submit" class="deleteEntity">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                </tr>
                                                <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php   // View Order Window
                    if(isset($_SESSION['viewOrder']))
                    {
                        ?>
                        <div class="entityMargins" id="view-order">
                            <div class="card">
                                <div class="cardHeader">
                                    <h2>Currently Viewing Order [<?= $orderData['TrackingID'];?>]</h2>
                                    <div class="closeView">
                                        <form method="POST">
                                            <button type="submit" name="closeViewOrder" class="closeButton">
                                                <span class="material-symbols-outlined" style="margin-left: 5px;">close</span>
                                                Close
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="cardBody viewOrder">
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
                                                    <?= $orderData['Collection'] == '1' ? 'Delivery':'In-Store'; ?>
                                                </div>
                                                <label for="">Instructions:</label>
                                                <div class="dataRow">
                                                    <?= $orderData['Instructions']; ?>
                                                </div>
                                                <label for="">Order Status:</label>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="updateCustomerID" value="<?= $orderData['CustomerID'] ?>"></input>
                                                    <input type="hidden" name="updateCollection" value="<?= $orderData['Collection'] ?>"></input>
                                                    <input type="hidden" name="updateTrackingID" value="<?= $orderData['TrackingID'] ?>"></input>
                                                    <div class="selectBox updateOrder">
                                                        <select name="updateOrderStatus">
                                                            <option value="0" <?= $orderData['Status'] == 0 ? 'selected':'' ?>>Order Pending</option>
                                                            <option value="1" <?= $orderData['Status'] == 1 ? 'selected':'' ?>>Order Fulfilled</option>
                                                            <option value="2" <?= $orderData['Status'] == 2 ? 'selected':'' ?>>Order Cancelled</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-box button">
                                                        <button type="submit" name="updateStatusButton" class="editEntity updateOrderText">Update Order Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
                                                                if(mysqli_num_rows($retrieveOrder) > 0)
                                                                {
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
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>This shouldn't happen...</td>
                                                                        <td>What did you do?</td>
                                                                        <td></td>
                                                                    </tr>
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
                                                <label for="">Payment Method:</label>
                                                <div class="dataRow">
                                                    <?= $orderData['PaymentMethod'];?>
                                                </div>
                                                <?php
                                                if($orderData['PaymentID'] != "")
                                                {
                                                    ?>
                                                    <label for="">Payment ID:</label>
                                                    <div class="dataRow">
                                                        <?= $orderData['PaymentID'];?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['viewOrder']);
                    }
                    ?>
            </section>

            <!-- Invoices Panel -->
            <section id="Invoices" class="home-section">
                <div class="text">Invoices</div>
                <div class="card">
                    <div class="cardHeader">

                        <!-- Search Bar -->
                        <div class="search invoiceSearch">
                            <input type="text" id="searchInvoice" placeholder="Search Invoice">
                            <span class="material-symbols-outlined">search</span>
                        </div>

                        <!-- Filter By Dates -->
                        <div class="datesContainer invoiceDates">
                            <form method="POST">
                                <div class="dates">
                                    <div class="date">
                                        <label>From:</label>
                                        <input type="date" name="invoicesDateFrom" value="<?php if(isset($_POST['invoicesDateFrom'])) { echo $_POST['invoicesDateFrom']; }?>">
                                    </div>
                                    <div class="date">
                                        <label>To:</label>
                                        <input type="date" name="invoicesDateTo" value="<?php if(isset($_POST['invoicesDateTo'])) { echo $_POST['invoicesDateTo']; }?>">
                                    </div>
                                    <div class="date">
                                        <button type="submit">→</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Invoice Table -->
                <div class="singleGrid">
                    <div class="smallSection">
                        <div class="cardBody InvoiceTable">
                            <div class="tableResponsive">
                                <table width="99%" id="tableOfInvoices">
                                    <thead>
                                        <tr class="tableRow">
                                            <td class="tableHeader">Order ID:</td>
                                            <td class="tableHeader">Tracking ID:</td>
                                            <td class="tableHeader">Customer ID:</td>
                                            <td class="tableHeader">Recipient:</td>
                                            <td class="tableHeader">Total Cost:</td>
                                            <td class="tableHeader">Payment Method:</td>
                                            <td class="tableHeader">Status:</td>
                                            <td class="tableHeader">Order Date:</td>
                                            <td class="tableHeader">Date Updated:</td>
                                            <td class="tableHeader"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(isset($_POST['invoicesDateFrom']) && isset($_POST['invoicesDateTo']))
                                            {
                                                $invoicesDateFrom           = $_POST['invoicesDateFrom'];
                                                $invoicesDateTo             = $_POST['invoicesDateTo'];
                                                $queryInvoiceTable          = "SELECT * FROM `Orders`
                                                                            WHERE
                                                                            `Status`        = '1'
                                                                            AND
                                                                            `DateOfCreation`
                                                                            BETWEEN
                                                                            '$invoicesDateFrom' AND '$invoicesDateTo'
                                                                            ORDER BY `OrderID` DESC";
                                                $getCompleteOrders          = mysqli_query($dbconnect, $queryInvoiceTable);
                                                ?>
                                                    <script type="text/javascript">
                                                        setTimeout(function(){
                                                            window.location.hash = '#Invoices';
                                                        }, 1000);
                                                    </script>
                                                <?php
                                            }
                                            else
                                            { $getCompleteOrders = getCompleteOrders(); }

                                            if(mysqli_num_rows($getCompleteOrders) > 0)
                                            {
                                                while($retrievedOrder = mysqli_fetch_assoc($getCompleteOrders))
                                                {
                                                    ?>
                                                    <tr class="tableRow">
                                                        <td><?= $retrievedOrder['OrderID']; ?></td>
                                                        <td><?= $retrievedOrder['TrackingID']; ?></td>
                                                        <td><?= $retrievedOrder['CustomerID']; ?></td>
                                                        <td><?= $retrievedOrder['FirstName']." ".$retrievedOrder['Surname']; ?></td>
                                                        <td>£<?= number_format($retrievedOrder['TotalPrice'], 2, '.', ','); ?></td>
                                                        <td><?= $retrievedOrder['PaymentMethod']; ?></td>
                                                        <td>
                                                            <?php
                                                            if($retrievedOrder['Status'] == 0)
                                                            {
                                                                ?>
                                                                <span class="status pending"></span>
                                                                Pending
                                                                <?php
                                                            }
                                                            else if($retrievedOrder['Status'] == 1)
                                                            {
                                                                ?>
                                                                <span class="status complete"></span>
                                                                Complete
                                                                <?php
                                                            }
                                                            else if($retrievedOrder['Status'] == 2)
                                                            {
                                                                ?>
                                                                <span class="status cancelled"></span>
                                                                Cancelled
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $retrievedOrder['DateOfCreation'];?></td>
                                                        <td><?= $retrievedOrder['DateOfUpdate'];?></td>
                                                        <td>
                                                            <a target="_blank" href="generate-invoice?orderID=<?= $retrievedOrder['OrderID']; ?>&trackingID=<?= $retrievedOrder['TrackingID']; ?>&customerID=<?= $retrievedOrder['CustomerID'];?>">
                                                                <button class="deleteEntity">
                                                                    PDF
                                                                    <span class="material-symbols-outlined">
                                                                    arrow_outward
                                                                    </span>
                                                                </button>
                                                            </a>
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                    <td>No record found</td>
                                                </tr>
                                                <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Staff Panel (Owner Only) -->
            <?php
            if($_SESSION['authStaff']['StaffID'] == 1) // Check if staff account is owner
            {   // Then display Staff Panel
                ?>
                    <section id="Staff" class="home-section">
                        <div class="text">Staff</div>
                        <div class="singleGrid">
                            <div class="entityMargins">
                                <div style="display: flex; justify-content: center;">
                                    <?php
                                    if(!$_SESSION['settingHideCounters']) // Show counters if not hidden
                                    {
                                        ?>
                                            <div class="summaries">
                                                <div class="cardItem">
                                                    <?php
                                                        $getStaff                           = getAll('Staff');
                                                        $staffAccounts                      = mysqli_num_rows($getStaff);
                                                        if(isset($staffAccounts))
                                                        { ?><script>animateCounter('staffCounter', '<?= $staffAccounts; ?>')</script><?php }
                                                        else { ?><script>animateCounter('', '------')</script><?php }
                                                    ?>
                                                    <div class="cardText">
                                                        <div class="counter"><h2 id="staffCounter"></h2></div>
                                                        <span>Staff Accounts</span>
                                                    </div>
                                                    <div class="cardIcon">
                                                        <span class="material-symbols-outlined">military_tech</span>
                                                    </div>
                                                </div>
                                                <div class="cardItem">
                                                    <?php
                                                        if(isset($pendingOrders))
                                                        { ?><script>animateCounter('staffPendingOrders', '<?= number_format($pendingOrders); ?>')</script><?php }
                                                        else { ?><script>animateCounter('staffPendingOrders', '------')</script><?php }
                                                    ?>
                                                    <div class="cardText">
                                                        <div class="counter"><h2 id="staffPendingOrders"></h2></div>
                                                        <span>
                                                            <?php 
                                                            if(isset($pendingOrders))
                                                            {
                                                                if($pendingOrders == 1)
                                                                { echo 'Pending Order'; }
                                                                else
                                                                { echo 'Pending Orders'; }
                                                            }
                                                            else
                                                            { echo 'Pending Orders'; }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="cardIcon">
                                                        <span class="material-symbols-outlined">pending_actions</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <!-- Staff Section -->
                                <div class="card">
                                    <div class="cardHeader">
                                        <h2>Admin Profiles</h2>

                                        <!-- Search Bar -->
                                        <div class="search">
                                            <input type="text" id="searchStaff" placeholder="Search Staff">
                                            <span class="material-symbols-outlined">search</span>
                                        </div>

                                        <!-- Add Staff Modal -->
                                        <div class="staffRegister">
                                            <div id="addStaff" class="modal">
                                                <div class="wrapper">
                                                    <form method="POST">
                                                        <h2 style="text-align: center;">Add Staff</h2>
                                                        <div class="input-box">
                                                            <input type="text" name="FirstName" placeholder="First Name" required>
                                                        </div>
                                                        <div class="input-box">
                                                            <input type="text" name="Surname" placeholder="Surname" required>
                                                        </div>
                                                        <div class="input-box">
                                                            <input type="email" name="Email" placeholder="Email" required>
                                                        </div>
                                                        <div class="input-box">
                                                            <input type="password" name="Password" placeholder="Password" required>
                                                        </div>
                                                        <div class="input-box button">
                                                            <input type="submit" name="submitStaff" value="Submit Details">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <a href="#addStaff" data-modal="#addStaff" rel="modal:open" style="text-decoration: none;">
                                                <button class="addEntity">
                                                    Add Staff
                                                    <span class="material-symbols-outlined" style="margin-left: 5px;">add</span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff Accounts Table -->
                                <div class="cardBody StaffTable">
                                    <div class="tableResponsive">
                                        <table width="99%" class="twoTableButtons" id="tableOfStaff">
                                            <thead>
                                                <tr>
                                                    <td class="tableHeader">ID</td>
                                                    <td class="tableHeader">Staff Fullname</td>
                                                    <td class="tableHeader">Email</td>
                                                    <td class="tableHeader">Hashed Password</td>
                                                    <td class="tableHeader"></td>
                                                    <td class="tableHeader"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $getStaff = getAll('Staff');
                                                if(mysqli_num_rows($getStaff)>0)
                                                {
                                                    while($retrievedStaff = mysqli_fetch_assoc($getStaff))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?= $retrievedStaff['StaffID']; ?></td>
                                                            <td><?= $retrievedStaff['FirstName'].' '.$retrievedStaff['Surname']; ?></td>
                                                            <td><?= $retrievedStaff['Email']; ?></td>
                                                            <td><?= $retrievedStaff['HashedPassword']; ?></td>
                                                            <td>
                                                                <form method="POST" action="">
                                                                    <input type="hidden" name="editStaffID" value="<?= $retrievedStaff['StaffID']; ?>"></input>
                                                                    <button type="submit" name="editStaffButton" class="editEntity">
                                                                        Edit
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form method="POST" action="" onsubmit="return submitForm(this);">
                                                                    <input type="hidden" name="sendStaffDeleteID" value="<?= $retrievedStaff['StaffID']; ?>"></input>
                                                                    <button type="submit" class="deleteEntity">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <tr>
                                                        <td>No record found</td>
                                                        <td>No record found</td>
                                                        <td>No record found</td>
                                                        <td>No record found</td>
                                                        <td>No record found</td>
                                                    </tr>
                                                    <?php 
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php   // Edit Staff Tab
                                if(isset($_SESSION['editStaff']))
                                {
                                    ?>
                                    <div class="entityEditContainer" id="editStaff">
                                        <div class="cardHeader">
                                            <h2>Edit Staff</h2>
                                        </div>
                                            <div class="entityEditBox">
                                                <form method="POST">
                                                    <input type="hidden" name="editStaffID" value="<?= $StaffID; ?>"></input>
                                                    <div class="input-box">
                                                        <input type="text" name="changeStaffFirstName" placeholder="First Name" required value="<?= $retrievedStaffFirstName; ?>"></input>
                                                    </div>
                                                    <div class="input-box">
                                                        <input type="text" name="changeStaffSurname" placeholder="Surname" required value="<?= $retrievedStaffSurname; ?>"></input>
                                                    </div>
                                                    <div class="input-box">
                                                        <input type="email" name="changeStaffEmail" placeholder="Email" required value="<?= $retrievedStaffEmail; ?>"></input>
                                                    </div>
                                                    <div class="input-box">
                                                        <input type="password" name="changeStaffPassword" placeholder="Password" required value="<?= $retrievedStaffPassword; ?>"></input>
                                                    </div>
                                                    <div class="input-box button">
                                                        <input type="submit" name="saveStaffChanges" value="Save Changes"></input>
                                                    </div>
                                                </form>
                                                <form method="POST">
                                                    <div class="input-box button cancel">
                                                        <input type="submit" name="cancelStaffChanges" value="Cancel"></input>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    unset($_SESSION['editStaff']);
                                }
                                ?>
                        </div>
                    </section>
                <?php
            }?>

            <!-- Reports Panel -->
            <?php
            if(!$_SESSION['settingHideReports']) // Show Reports panel if not hidden
            {
                ?>
                    <!-- All Notes Section -->
                    <section id="Reports" class="home-section">
                        <div class="text">Reports</div>
                        <div class="entityMargins">
                            <div class="notePopupBox">
                                <div class="notePopup">

                                    <!-- Add New Note button -->
                                    <div class="popupContent">
                                        <header>
                                            <p>Add new Note</p>
                                            <span class="material-symbols-outlined">close</span>
                                        </header>
                                        <form action="#">
                                            <div class="noteRow noteTitle">
                                                <label>Title:</label>
                                                <input type="text" placeholder="Staff Name | Subject">
                                            </div>
                                            <div class="noteRow noteDescription">
                                                <label>Note Content:</label>
                                                <textarea placeholder="Enter text"></textarea>
                                            </div>
                                            <button>Add Note</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Note Window (if opened) -->
                            <div class="noteWrapper">
                                <li class="addNoteBox" onclick="relocate()">
                                    <div class="noteIcon"><span class="material-symbols-outlined">add</span></div>
                                    <p>Add New Note</p>
                                </li>
                            </div>
                        </div>

                        <!-- Script for Report Notes -->
                        <script src="js/notes.js"></script>
                    </section>
                <?php
            }
            ?>

            <!-- Settings Panel -->
            <section id="Settings" class="home-section">
                <div class="text">Settings</div>
                <div class="entityEditContainer" id="editStaff">
                    <div class="entityMargins flexCard">
                        <?php
                        $_SESSION['accessStaffProfile'] = true;
                        if(isset($_SESSION['editStaffProfile']))    // When editing staff profile
                        {
                            unset($_SESSION['accessStaffProfile']); // Remove view tab
                            ?>
                                <div class="card">
                                    <div class="cardHeader">
                                        <h2>Edit Profile</h2>
                                    </div>
                                    <div class="entityEditBox">
                                        <form method="POST">
                                            <input type="hidden" name="editStaffID" value="<?= $_SESSION['authStaff']['StaffID']; ?>"></input>
                                            <label>First Name:</label>
                                            <div class="input-box">
                                                <input type="text" name="changeStaffFirstName" placeholder="First Name" required value="<?= $foundStaff['FirstName']; ?>"></input>
                                            </div>
                                            <label>Surname:</label>
                                            <div class="input-box">
                                                <input type="text" name="changeStaffSurname" placeholder="Surname" required value="<?= $foundStaff['Surname']; ?>"></input>
                                            </div>
                                            <label>Email:</label>
                                            <div class="input-box">
                                                <input type="email" name="changeStaffEmail" placeholder="Email" required value="<?= $foundStaff['Email']; ?>"></input>
                                            </div>
                                            <label>Password:</label>
                                            <div class="input-box">
                                                <input type="password" name="changeStaffPassword" placeholder="Password" required value="<?= $foundStaff['Password']; ?>"></input>
                                            </div>
                                            <div class="input-box button">
                                                <input type="submit" name="saveProfileChanges" value="Save Changes"></input>
                                            </div>
                                        </form>
                                        <form method="POST">
                                            <div class="input-box button cancel">
                                                <input type="submit" name="cancelStaffProfile" value="Cancel"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            unset($_SESSION['editStaffProfile']);   // Remove edit tab
                        }
                        if(isset($_SESSION['accessStaffProfile']))  // When viewing staff profile
                        {
                            ?>
                            <div class="card">
                                <div class="cardHeader">
                                    <h2>Your Profile</h2>
                                </div>
                                <div class="entityEditBox viewStaffProfile">
                                    <form disabled>
                                        <div class="input-box">
                                            <label>First Name:</label>
                                            <input type="text" disabled value="<?= $staffDetail['FirstName']; ?>"></input>
                                        </div>
                                        <div class="input-box">
                                            <label>Surname:</label>
                                            <input type="text" disabled value="<?= $staffDetail['Surname']; ?>"></input>
                                        </div>
                                        <div class="input-box">
                                            <label>Email:</label>
                                            <input type="email" disabled value="<?= $staffDetail['Email']; ?>"></input>
                                        </div>
                                        <div class="input-box">
                                            <label>Password:</label>
                                            <input type="password" disabled value="<?= $staffDetail['Password']; ?>"></input>
                                        </div>
                                    </form>
                                    <form method="POST">
                                        <div class="input-box button">
                                            <input type="hidden" name="editStaffID" value="<?= $_SESSION['authStaff']['StaffID']; ?>"></input>
                                            <input type="submit" name="editStaffProfile" value="Edit Profile"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <!-- Settings Section -->
                        <div class="settings card">
                            <form method="POST">
                                <div class="cardHeader">
                                    <h2>Configurations</h2>
                                    <button type="submit" name="saveSettings" class="saveButton">
                                        Save Settings
                                    </button>
                                </div>
                                <div class="cardBody">
                                        <label for="hideCounters">
                                            <input <?= $_SESSION['settingHideCounters'] == true ? 'checked':''; ?> type="checkbox" id="hideCounters" name="hideCounters">
                                            Hide Counters
                                        </label>
                                        <label for="hideReports">
                                            <input <?= $_SESSION['settingHideReports'] == true ? 'checked':''; ?> type="checkbox" id="hideReports" name="hideReports">
                                            Hide Reports
                                        </label>
                                        <label for="hideExports">
                                            <input <?= $_SESSION['settingHideExports'] == true ? 'checked':''; ?> type="checkbox" id="hideExports" name="hideExports">
                                            Hide Exports
                                        </label>
                                        <label for="hideAnalytics">
                                            <input <?= $_SESSION['settingHideAnalytics'] == true ? 'checked':''; ?> type="checkbox" id="hideAnalytics" name="hideAnalytics">
                                            Hide Analytics
                                        </label>
                                        <label for="showSession">
                                            <input <?= $_SESSION['settingShowSession'] == true ? 'checked':''; ?> type="checkbox" id="showSession" name="showSession">
                                            Show Session
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Copyright Notice -->
                    <p class="Copyright" id="year">Adib Shehab © <?= date("Y"); ?> - All Rights Reserved</p>
                </div>
            </section>

            <!-- Miscellaneous Scripts -->
            <script src="js/toggleSidebar.js"></script>
            <script src="js/activeDashboardSection.js"></script>
            <script src="js/scrollRevealConfig.js"></script>
            <script src="js/deleteConfirmation.js"></script>
            <script src="js/searchTable.js"></script>
        </div>
    </body>
    <?php
    }
    else
    {   // Display Denied Access Modal
        ?>
            <div class="accessDenied">
                <div id="accessDenied" class="modal">
                    <div class="wrapper" style="text-align: center;">
                        <h1>Access Denied</h1>
                        <p>You do not have permission to access this page.</p>
                    </div>
                </div>
                <a href="#accessDenied" data-modal="#accessDenied" rel="modal:open" style="text-decoration: none;"></a>
                <script>
                    $("#accessDenied").modal({
                        escapeClose: false,
                        clickClose: false,
                        showClose: false
                    });
                </script>
                <script type="text/javascript">redirectToast("top");</script>
            </div>
        <?php // Redirect to home page
        header("Refresh:3; url=.");
    }
}
else
{   // Display Denied Access Modal
    ?>
        <div class="accessDenied">
            <div id="accessDenied" class="modal">
                <div class="wrapper" style="text-align: center;">
                    <h1>Access Denied</h1>
                    <p>You do not have permission to access this page.</p>
                </div>
            </div>
            <a href="#accessDenied" data-modal="#accessDenied" rel="modal:open" style="text-decoration: none;"></a>
            <script>
                $("#accessDenied").modal({
                    escapeClose: false,
                    clickClose: false,
                    showClose: false
                });
            </script>
            <script type="text/javascript">redirectToast("top");</script>
        </div>
    <?php // Redirect to home page
    header("Refresh:3; url=.");
}
?>
</html>