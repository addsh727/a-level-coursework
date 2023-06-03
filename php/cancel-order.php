<?php // Cancel Order algorithm
if(isset($_POST['cancelOrder'])) // When order is cancelled and confirmed
{   // Retrieve order details
    $trackingID                         = mysqli_real_escape_string($dbconnect, $_POST['cancelTrackingID']);
    $customerID                         = mysqli_real_escape_string($dbconnect, $_POST['cancelCustomerID']);
    $email                              = mysqli_real_escape_string($dbconnect, $_POST['cancelEmail']);

    $queryRetrieveOrder                 = "SELECT
                                        o.OrderID AS orderID, o.TrackingID, o.CustomerID, ol.*,
                                        ol.ProductQuantity AS orderQuantity, p.*
                                        FROM orders o, orderline ol, products p
                                        WHERE o.CustomerID              = '$customerID'
                                        AND ol.OrderID                  = o.OrderID
                                        AND p.ProductID                 = ol.ProductID
                                        AND o.TrackingID                = '$trackingID'";
    $retrieveOrder                      = mysqli_query($dbconnect, $queryRetrieveOrder);
    if(mysqli_num_rows($retrieveOrder) > 0) // When order data found
    {   // Set order status to cancelled
        $retrievedOrder                 = mysqli_fetch_assoc($retrieveOrder);
        $queryCancelOrder               = "UPDATE `Orders` SET
                                        `Status`                        = 2,
                                        `DateOfUpdate`                  = CURRENT_TIMESTAMP
                                        WHERE `CustomerID`              = '$customerID'
                                        AND `TrackingID`                = '$trackingID'";
        $cancelOrder                    = mysqli_query($dbconnect, $queryCancelOrder);
        if($cancelOrder) // If order status set to cancelled
        {   // Send confirmation email
            require_once("php/send-order-cancelled.php");
            $collection                 = isset($retrievedOrder['Collection']);
            if(sendOrderCancelled($email, $customerID, $collection, $trackingID)) // When email sent
            {   // Fire success alert
                ?>
                    <script type="text/javascript">
                        successAlert("Order Cancelled!", "Order status has been updated.");
                    </script>
                <?php
            }
            else
            {   // Fire error alert
                ?>
                    <script type="text/javascript">
                        errorAlert("Error...", "Something went wrong while trying to update this order's status...");
                    </script>
                <?php
            }
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Something went fatally wrong...");
                </script>
            <?php
        }   // Refresh View Order page
        ?>
            <script type="text/javascript">
                setInterval(function(){
                    window.location.href = window.location.href
                }, 1000);
            </script>
        <?php
    }
}
?>