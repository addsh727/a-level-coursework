<?php // Order Options
if(isset($_POST['viewOrderButton'])) // When an order is viewed
{   // Retrieve all order details
    $orderID                        = mysqli_escape_string($dbconnect, $_POST['viewOrderID']);
    $trackingID                     = mysqli_escape_string($dbconnect, $_POST['viewTrackingID']);
    $customerID                     = mysqli_escape_string($dbconnect, $_POST['viewCustomerID']);

    $queryTrackingData              = "SELECT * FROM `Orders`
                                    WHERE `OrderID`                 = '$orderID'
                                    AND `TrackingID`                = '$trackingID'
                                    AND `CustomerID`                = '$customerID'";
    $trackingData                   = mysqli_query($dbconnect, $queryTrackingData);

    if(mysqli_num_rows($trackingData) <= 0) // Check if there is ANY data that is retrieved
    { die(); }

    $orderData                      = mysqli_fetch_assoc($trackingData);
    $queryRetrieveOrder             = "SELECT
                                    o.OrderID AS orderID, o.TrackingID, o.CustomerID, ol.*,
                                    ol.ProductQuantity AS orderQuantity, p.*
                                    FROM orders o, orderline ol, products p
                                    WHERE o.CustomerID              = '$customerID'
                                    AND ol.OrderID                  = o.OrderID
                                    AND p.ProductID                 = ol.ProductID
                                    AND o.TrackingID                = '$trackingID'";
    $retrieveOrder                  = mysqli_query($dbconnect, $queryRetrieveOrder);

    $_SESSION['viewOrder']          = true; //Generate & redirect to the view window 
    ?>
        <script type="text/javascript">
            window.location.hash = '#view-order';
        </script>
    <?php
}
if(isset($_POST['closeViewOrder'])) // When view window is closed
{   // Remove view window and redirect to the Orders panel
    unset($_SESSION['viewOrder']);
    ?>
        <script type="text/javascript">
            window.location.hash = '#Orders';
        </script>
    <?php
}
if(isset($_POST['updateStatusButton'])) // When order status is updated, retrieve the order's details and update order status
{
    $updateOrderStatus              = mysqli_escape_string($dbconnect, $_POST['updateOrderStatus']);
    $updateCustomerID               = mysqli_escape_string($dbconnect, $_POST['updateCustomerID']);
    $updateCollection               = mysqli_escape_string($dbconnect, $_POST['updateCollection']);
    $updateTrackingID               = mysqli_escape_string($dbconnect, $_POST['updateTrackingID']);

    $queryUpdateOrder               = "UPDATE `Orders` SET
                                    `Status`                        = '$updateOrderStatus',
                                    `DateOfUpdate`                  = CURRENT_TIMESTAMP
                                    WHERE `TrackingID`              = '$updateTrackingID'";
    $updateOrder                    = mysqli_query($dbconnect, $queryUpdateOrder);

    if($updateOrder) // When order is updated
    {   // Retrieve email of the customer that placed the order
        $queryGetEmail              = "SELECT `Email` FROM `Customers`
                                    WHERE `CustomerID`              = '$updateCustomerID'";
        $getEmail                   = mysqli_query($dbconnect, $queryGetEmail);
        $foundEmail                 = mysqli_fetch_assoc($getEmail);
        $email                      = $foundEmail['Email'];

        if($updateOrderStatus == 1) // If order is set to complete
        {   // Try sending confirmation email
            require_once("php/send-order-complete.php");
            if(sendOrderComplete($email, $updateCustomerID, $updateCollection, $updateTrackingID)) // When email sent
            {   // Fire success alert
                ?>
                    <script type="text/javascript">
                        successAlert("Order Fulfilled!", "Email confirmation has been sent.");
                    </script>
                <?php
            }
            else// If error is caught
            {   // Fire error alert
                ?>
                    <script type="text/javascript">
                        errorAlert("Error...", "Something went wrong while trying to update this order...");
                    </script>
                <?php
            }
        }
        else if($updateOrderStatus == 2) // If order is set to cancelled
        {   // Try sending confirmation email
            require_once("php/send-order-cancelled.php");
            if(sendOrderCancelled($email, $updateCustomerID, $updateCollection, $updateTrackingID)) // When email sent
            {   // Fire success alert
                ?>
                    <script type="text/javascript">
                        successAlert("Order Cancelled!", "Email confirmation has been sent.");
                    </script>
                <?php
            }
            else// If error is caught
            {   // Fire error alert
                ?>
                    <script type="text/javascript">
                        errorAlert("Error...", "Something went wrong while trying to update this order...");
                    </script>
                <?php
            }
        }
        else// If order status is anything else
        {   // Fire success alert
            ?>
                <script type="text/javascript">
                    successAlert("Successfully Updated!", "Order status has been changed.");
                </script>
            <?php
        }
    }
    else
    {
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to update this order...");
            </script>
        <?php
    }   // and redirect to the Orders panel after any of these above processes
    ?>
        <script type="text/javascript">
            window.location.hash = '#Orders';
        </script>
    <?php
}
if(isset($_POST['deleteOrder'])) // When order is to be deleted and confirmed
{   // Retrieve order details and delete order
    $deleteOrderID                  = intval(mysqli_escape_string($dbconnect, $_POST['deleteOrder']));

    $queryDeleteOrder               = "DELETE FROM `Orders` WHERE `OrderID` = $deleteOrderID";
    $deleteOrder                    = mysqli_query($dbconnect, $queryDeleteOrder);
    if($deleteOrder) // If deleted from database successfully
    {   // Fire success alert
        ?>
            <script type="text/javascript">
                successAlert("Successfully Deleted!", "This order record has been removed from database.");
            </script>
        <?php
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to remove this order record...");
            </script>
        <?php
    }   // Redirect to the Orders panel afterwards
    ?>
        <script type="text/javascript">
            window.location.hash = '#Orders';
        </script>
    <?php
}
?>