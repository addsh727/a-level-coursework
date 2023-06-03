<?php // Shopping Cart Process
// Connect to database
$hostname                                       = "localhost";
$dbusername                                     = "root";
$dbpassword                                     = "";
$dbname                                         = "s2106630";
try // Attempt connection
{
    $dbconnect = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
    if($dbconnect)
    { session_start(); } // Create session
    else { throw new Exception(mysqli_connect_error()); }
}
catch(Exception $ex) // In the event of an error
{   // Generate caught error message
    echo $ex->getMessage();
    die();
}

if(isset($_SESSION['customerLoggedIn'])) // Check if customer is logged in to proceed
{   //Customer must be logged in for the following algorithm to work
    if(isset($_POST['scope'])) // When the shopping cart mode is set
    {
        $scope                                  = mysqli_real_escape_string($dbconnect, $_POST['scope']);
        switch($scope)
        {   // Based on the shopping cart mode, execute the following
            case 'add': // If product being added, retrieve customer & shopping cart information
                $customerID                     = $_SESSION['authCustomer']['CustomerID'];
                $productID                      = mysqli_real_escape_string($dbconnect, $_POST['productID']);
                $productQuantity                = mysqli_real_escape_string($dbconnect, $_POST['productQuantity']);

                $queryExistingCart              = "SELECT * FROM `shoppingcarts`
                                                WHERE `ProductID`               = '$productID'
                                                AND `CustomerID`                = '$customerID'";
                $existingCart                   = mysqli_query($dbconnect, $queryExistingCart);

                $querygGetProduct               = "SELECT * FROM `Products`
                                                WHERE `ProductID`               = '$productID'";

                if(mysqli_num_rows($existingCart) > 0) // Check if product already present in shopping cart
                {   // Then retrieve in-stock product quantity then compare
                    $getProduct                 = mysqli_query($dbconnect, $querygGetProduct);
                    $productDetails             = mysqli_fetch_assoc($getProduct);
                    $currentQuantity            = $productDetails['ProductQuantity'];

                    if($currentQuantity >= $productQuantity) // If there is enough in stock
                    {   // Then update shopping cart quantity to desired quantity
                        $queryUpdateCart        = "UPDATE `shoppingcarts` SET
                                                `ProductQuantity`               = '$productQuantity'
                                                WHERE `CustomerID`              = '$customerID'
                                                AND `ProductID`                 = '$productID'";
                        $updateCart             = mysqli_query($dbconnect, $queryUpdateCart);

                        if($updateCart) // If successful
                        { echo 204; }   // Fire success alert
                        else            // Otherwise
                        { echo 500; }   // Fire error alert
                    }
                    else // Otherwise
                    { echo 406; } // Fire error alert
                }
                else // Insert product into shopping cart otherwise
                {   // Retrieve in-stock product quantity then compare
                    $getProduct                 = mysqli_query($dbconnect, $querygGetProduct);
                    $productDetails             = mysqli_fetch_assoc($getProduct);
                    $currentQuantity            = $productDetails['ProductQuantity'];

                    if($currentQuantity >= $productQuantity) // If there is enough in stock
                    {   // Then insert product into shopping cart with desired quantity
                        $queryInsertCart        = "INSERT INTO `shoppingcarts`(`CartID`, `CustomerID`,
                                                    `ProductID`, `ProductQuantity`, `DateofCreation`
                                                ) VALUES('', '$customerID',
                                                    '$productID', '$productQuantity', CURRENT_TIMESTAMP
                                                )";
                        $insertCart             = mysqli_query($dbconnect, $queryInsertCart);
                        
                        if($insertCart) // If successful
                        { echo 201; }   // Fire success alert
                        else            // Otherwise
                        { echo 500; }   // Fire error alert
                    }
                    else // Otherwise
                    { echo 406; } // Fire error alert
                }break;
            case "update": // If product is being updated, retrieve customer & shopping cart information
                $customerID                     = $_SESSION['authCustomer']['CustomerID'];
                $productID                      = mysqli_real_escape_string($dbconnect, $_POST['productID']);
                $productQuantity                = mysqli_real_escape_string($dbconnect, $_POST['productQuantity']);

                $queryExistingCart              = "SELECT * FROM `shoppingcarts`
                                                WHERE `ProductID`               = '$productID'
                                                AND `CustomerID`                = '$customerID'";
                $existingCart                   = mysqli_query($dbconnect, $queryExistingCart);

                if(mysqli_num_rows($existingCart) > 0) // Check if product already present in shopping cart
                {   // Then retrieve in-stock product quantity then compare
                    $querygGetProduct           = "SELECT * FROM `Products`
                                                WHERE `ProductID`               = '$productID'";
                    $getProduct                 = mysqli_query($dbconnect, $querygGetProduct);
                    $productDetails             = mysqli_fetch_assoc($getProduct);
                    $currentQuantity            = $productDetails['ProductQuantity'];

                    if($currentQuantity >= $productQuantity) // If there is enough in stock
                    {   // Then update shopping cart quantity to desired quantity
                        $queryUpdateCart        = "UPDATE `shoppingcarts` SET 
                                                `ProductQuantity`               = '$productQuantity'
                                                WHERE `CustomerID`              = '$customerID'
                                                AND `ProductID`                 = '$productID'";
                        $updateCart             = mysqli_query($dbconnect, $queryUpdateCart);

                        if($updateCart) // If successful
                        { echo 204; }   // Fire success alert
                        else            // Otherwise
                        { echo 500; }   // Fire error alert
                    }
                    else // Otherwise
                    { echo 406; } // Fire error alert
                }
                else // Otherwise
                { echo 500; } // Fire error alert
                break;
            case "delete": // If product is being deleted, retrieve customer & shopping cart information
                $customerID                     = $_SESSION['authCustomer']['CustomerID'];
                $cartID                         = mysqli_real_escape_string($dbconnect, $_POST['cartID']);

                $queryExistingCart              = "SELECT * FROM `shoppingcarts`
                                                WHERE `CartID`                  = '$cartID'
                                                AND `CustomerID`                = '$customerID'";
                $existingCart                   = mysqli_query($dbconnect, $queryExistingCart);

                if(mysqli_num_rows($existingCart) > 0)// If there is enough in stock
                {   // Then remove product from shopping cart
                    $queryDeleteProduct         = "DELETE FROM `shoppingcarts`
                                                WHERE `CartID`                  = '$cartID'";
                    $deleteProduct              = mysqli_query($dbconnect, $queryDeleteProduct);

                    if($deleteProduct)  // If successful
                    { echo 200; }       // Fire success alert
                    else                // Otherwise
                    { echo 500; }       // Fire error alert
                }
                else // Otherwise
                { echo 500; } // Fire error alert
                break;

            default: // Usual response if nothing
                echo 500; // Fire error alert
        }
    }
}
else // Otherwise
{ echo 401; } // Fire error alert
?>