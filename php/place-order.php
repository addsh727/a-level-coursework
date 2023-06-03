<?php // Place Order algorithm
include("config.php");
if(isset($_SESSION['authCustomer'])) // Check customer is logged in and details assigned to session
{   // Retrieve customer details
    $accountEmail = $_SESSION['authCustomer']['CustomerEmail'];

    if(isset($_POST['placeOrder'])) // When order is placed
    {   // Retrieve submitted order details
        $firstname                          = mysqli_real_escape_string($dbconnect, $_POST['FirstName']);
        $surname                            = mysqli_real_escape_string($dbconnect, $_POST['Surname']);
        $phoneNumber                        = mysqli_real_escape_string($dbconnect, $_POST['PhoneNumber']);
        $address                            = mysqli_real_escape_string($dbconnect, $_POST['Address']);
        $city                               = mysqli_real_escape_string($dbconnect, $_POST['City']);
        $postcode                           = mysqli_real_escape_string($dbconnect, $_POST['Postcode']);
        $collection                         = mysqli_real_escape_string($dbconnect, $_POST['Collection']);
        $instructions                       = mysqli_real_escape_string($dbconnect, $_POST['Instructions']);
        $paymentMethod                      = mysqli_real_escape_string($dbconnect, $_POST['PaymentMethod']);
        $paymentID                          = mysqli_real_escape_string($dbconnect, $_POST['PaymentID']);

        // Validation of order details
        if($firstname == "" || $surname == "" || $phoneNumber == "" || $address == "" || $city == "" || $postcode == "" || $instructions == "" )
        {   // Fire error alert if any invalid fields
            ?>
                <script type="text/javascript">
                    errorAlert("All Fields Are Mandatory!", "Please fill all details without leaving blanks.");
                </script>
            <?php
            die(); // Prevent algorithm from continuing
        }

        // Get Customer ID, Email and generate random Tracking ID
        $customerID                         = $_SESSION['authCustomer']['CustomerID'];
        $accountEmail                       = $_SESSION['authCustomer']['CustomerEmail'];
        $trackingID                         = "ZDG".rand(111111,9999999).substr($city, 0, -3);

        // Get customer's current shopping cart
        $queryGetCart                       = "SELECT
                                            cart.CartID AS CartID, cart.ProductID, cart.ProductQuantity,
                                            products.ProductID AS ProductID, products.ProductName, products.ProductImage, products.SellingPrice
                                            FROM `shoppingcarts` cart, `products` products
                                            WHERE cart.ProductID                = products.ProductID
                                            AND cart.CustomerID                 = '$customerID'
                                            ORDER BY cart.CartID";
        $getCart                            = mysqli_query($dbconnect, $queryGetCart);

        $totalPrice = 0; // Initialise variable for total price

        foreach($getCart as $cartItem) // Calculate shopping cart's total price
        { $totalPrice                       += intval($cartItem['SellingPrice'])*intval($cartItem['ProductQuantity']); }

        // Insert new order into database
        $queryInsertOrder                   = "INSERT INTO `Orders`(`OrderID`, `TrackingID`,
                                                `CustomerID`, `FirstName`, `Surname`, `PhoneNumber`,
                                                `Address`, `City`, `Postcode`, `TotalPrice`, `PaymentMethod`,
                                                `PaymentID`, `Status`, `Collection`, `Instructions`,
                                                `DateOfCreation`, `DateOfUpdate`
                                            ) VALUES('', '$trackingID',
                                                '$customerID', '$firstname', '$surname', '$phoneNumber',
                                                '$address', '$city', '$postcode', '$totalPrice', '$paymentMethod',
                                                '$paymentID', '', '$collection', '$instructions',
                                                CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                                            )";
        $insertOrder                        = mysqli_query($dbconnect, $queryInsertOrder);

        if($insertOrder) // If order placement successful 
        {   // Complete rest of the order processes
            $orderID                                    = mysqli_insert_id($dbconnect); // Get Order ID of new added order
            foreach($getCart as $cartItem) // Process each cart item
            {
                // Fetch order purchase details from cart
                $productID                              = $cartItem['ProductID'];
                $sellingPrice                           = $cartItem['SellingPrice'];
                $productQuantity                        = $cartItem['ProductQuantity'];

                // Get product and its quantity from database
                $queryGetProduct                        = "SELECT * FROM `Products`
                                                        WHERE `ProductID`       = $productID";
                $getProduct                             = mysqli_query($dbconnect, $queryGetProduct);
                $foundProduct                           = mysqli_fetch_assoc($getProduct);
                $currentQuantity                        = $foundProduct['ProductQuantity'];

                // Insert purchases into orderline
                $queryGenerateOrderline                 = "INSERT INTO `orderline`(`OrderLineID`, `OrderID`,
                                                            `ProductID`, `SellingPrice`, `ProductQuantity`,
                                                            `DateOfCreation`
                                                        ) VALUES('', '$orderID',
                                                            '$productID', '$sellingPrice', '$productQuantity',
                                                            CURRENT_TIMESTAMP
                                                        )";
                $generateOrderline                      = mysqli_query($dbconnect, $queryGenerateOrderline);

                // Calculate new quantity to be updated
                $newQuantity                            = intval($currentQuantity) - intval($productQuantity);

                // Update product quantity in database
                $queryUpdateQuantity                    = "UPDATE `Products` SET
                                                        `ProductQuantity`       = '$newQuantity'
                                                        WHERE `ProductID`       = $productID";
                $updateQuantity                         = mysqli_query($dbconnect, $queryUpdateQuantity);
            }

            // Remove customer's current shopping cart
            $queryDeleteCart                            = "DELETE FROM `shoppingcarts`
                                                        WHERE `CustomerID`      = '$customerID'";
            $deleteCart                                 = mysqli_query($dbconnect, $queryDeleteCart);

            if($paymentMethod == "Admin Test Pay") // When staff places order
            {   // Check if order confirmation email sent
                require_once('send-order-confirmation.php'); // Send confirmation email
                if(sendOrderConfirmation($accountEmail, $customerID, $collection, $trackingID)) // When email sent
                {   // Redirect to customer's order page
                    header("Location: ../my-orders");
                    $_SESSION['orderPlaced']            = true;
                    die();
                }
                else
                {   // Fire error alert
                    ?>
                        <script type="text/javascript">
                            errorAlert("Error...", "Something went wrong while placing this order...");
                        </script>
                    <?php
                    die();
                }
            }
            else// When transaction done via PayPal
            {   // Check if order confirmation email sent
                require_once('send-paypal-order-confirmation.php'); // Send confirmation email
                if(sendPaypalOrderConfirmation($accountEmail, $customerID, $collection, $trackingID)) // When email sent
                {   // Henceforth, fire success alert & redirect to customer's order page
                    $_SESSION['orderPlaced']            = true;
                    echo 201;
                    die();
                }
                else
                {   // Fire error alert
                    ?>
                        <script type="text/javascript">
                            errorAlert("Error...", "Something went wrong while placing this order...");
                        </script>
                    <?php
                    die();
                }
            }
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Something went wrong while placing this order...");
                </script>
            <?php
            die();
        }
    }
}
else // Error event - redirect to home
{ header("Location: ."); }
?>