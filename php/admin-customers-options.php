<?php // Customer Options
if(isset($_POST['editCustomerButton'])) // When customer profile is to be edited, retrieve customer data
{
    $CustomerID                         = mysqli_real_escape_string($dbconnect, $_POST['editCustomerID']);

    $queryCurrentCustomer               = "SELECT * FROM `Customers` WHERE `CustomerID` = '$CustomerID'";
    $currentCustomer                    = mysqli_query($dbconnect, $queryCurrentCustomer);
    $foundCustomer                      = mysqli_fetch_assoc($currentCustomer);

    $retrievedCustomerFirstName         = $foundCustomer['FirstName'];
    $retrievedCustomerSurname           = $foundCustomer['Surname'];
    $retrievedCustomerEmail             = $foundCustomer['Email'];
    $retrievedCustomerPassword          = $foundCustomer['Password'];

    $_SESSION['editCustomer']           = true; // Generate & redirect to edit tab
    ?> 
        <script type="text/javascript">
            window.location.hash = '#editCustomer';
        </script>
    <?php
}
if(isset($_POST['saveCustomerChanges'])) // When staff saves customer changes
{   // Retrieve customer data & new changes
    $CustomerID                         = mysqli_real_escape_string($dbconnect, $_POST['editCustomerID']);

    $queryCurrentCustomer               = "SELECT * FROM `Customers` WHERE `CustomerID` = '$CustomerID'";
    $CurrentCustomer                    = mysqli_query($dbconnect, $queryCurrentCustomer);
    $foundCustomer                      = mysqli_fetch_assoc($CurrentCustomer);

    $retrievedCustomerFirstName         = $foundCustomer['FirstName'];
    $retrievedCustomerSurname           = $foundCustomer['Surname'];
    $retrievedCustomerEmail             = $foundCustomer['Email'];
    $retrievedCustomerPassword          = $foundCustomer['Password'];

    $FirstName                          = mysqli_real_escape_string($dbconnect, $_POST['changeCustomerFirstName']);
    $Surname                            = mysqli_real_escape_string($dbconnect, $_POST['changeCustomerSurname']);
    $Email                              = mysqli_real_escape_string($dbconnect, $_POST['changeCustomerEmail']);
    $Password                           = mysqli_real_escape_string($dbconnect, $_POST['changeCustomerPassword']);
    $HashedPassword                     = mysqli_real_escape_string($dbconnect, password_hash($Password, PASSWORD_DEFAULT));

    $queryEditCustomer                  = "UPDATE `Customers` SET
                                        `FirstName`                 = '$FirstName',
                                        `Surname`                   = '$Surname',
                                        `Email`                     = '$Email',
                                        `Password`                  = '$Password',
                                        `HashedPassword`            = '$HashedPassword'
                                        WHERE
                                        `CustomerID`                = '$CustomerID'";
    if($Email === $retrievedCustomerEmail) // Check if email is unchanged, then update customer profile
    { $editCustomer                     = mysqli_query($dbconnect, $queryEditCustomer); }
    else // Check if new email is already in use otherwise
    {
        $queryEmailUsed                 = "SELECT * FROM `Customers` WHERE `Email` = '$Email'";
        $emailUsed                      = mysqli_query($dbconnect, $queryEmailUsed);
        if(mysqli_num_rows($emailUsed) > 0) // If customer email taken
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Email Taken!", "Please use another email for customer details...");
                </script>
            <?php
        }
        else // Update customer profile
        { $editCustomer                 = mysqli_query($dbconnect, $queryEditCustomer); }
    }
    if(isset($editCustomer) && $editCustomer) // If customer profile updated
    {   // Send confirmation email
        require_once("php/send-change-confirmation.php");
        if($editCustomer && sendChangeConfirmation($retrievedCustomerEmail)) // If email sent
        {   // Fire success alert
            ?>
                <script type="text/javascript">
                    successAlert("Changes Saved!", "Customer details have successfully been updated.");
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error", "Something went wrong while trying to submit changes for this customer...");
                </script>
            <?php
        }
    }
    ?>  <!-- Redirect to Customer panel -->
        <script type="text/javascript">
            window.location.hash = '#Customers';
        </script>
    <?php // Remove edit tab
    unset($_SESSION['editCustomer']);
}
if(isset($_POST['cancelCustomerChanges'])) // When cancelled editing
{   // Redirect to Customers panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Customers';
            </script>
    <?php // Remove edit tab
    unset($_SESSION['editCustomer']);
}
if(isset($_POST['sendCustomerDeleteID'])) // When deleting customer profile
{   // Retrieve customer data & remove from database
    $deleteCustomerID                   = intval(mysqli_real_escape_string($dbconnect, $_POST['sendCustomerDeleteID']));
    $queryDeleteCustomer                = "DELETE FROM `Customers` WHERE `CustomerID` = $deleteCustomerID";
    $deleteCustomer                     = mysqli_query($dbconnect, $queryDeleteCustomer);

    if($deleteCustomer) // If customer account deleted successfully
    {   // Fire success alert
        ?>
            <script type="text/javascript">
                successAlert("Successfully Deleted!", "Customer account has been deleted from database.");
            </script>
        <?php
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error", "Something went wrong while deleting this customer's account...");
            </script>
        <?php
    }   // Redirect to Customers panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Customers';
        </script>
    <?php
}
if(isset($_POST['viewCustomerButton'])) // When staff views a customer profile, retrieve customer data
{
    $viewCustomerID                     = mysqli_real_escape_string($dbconnect, $_POST['viewCustomerID']);
    $queryViewCustomer                  = "SELECT * FROM `Customers` WHERE `CustomerID` = '$viewCustomerID'";
    $viewCustomer                       = mysqli_query($dbconnect, $queryViewCustomer);
    $viewingCustomer                    = mysqli_fetch_assoc($viewCustomer);

    $_SESSION['viewCustomer']           = true; // Generate & redirect to view window
    ?>
        <script type="text/javascript">
            window.location.hash = '#view-customer';
        </script>
    <?php
}
if(isset($_POST['closeViewCustomer'])) // When staff closes view window
{   // Redirect to Customers panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Customers';
        </script>
    <?php // Remove view window
    unset($_SESSION['viewCustomer']);
}
if(isset($_POST['submitTestimonial'])) // When new testimonial submitted, insert into database
{
    $testifier                          = mysqli_real_escape_string($dbconnect, $_POST['testifier']);
    $testimonial                        = mysqli_real_escape_string($dbconnect, $_POST['testimonial']);
    $rating                             = mysqli_real_escape_string($dbconnect, $_POST['rating']);

    $queryAddTestimonial                = "INSERT INTO `Testimonials`(
                                            `TestimonialID`, `Rating`, `Testifier`, `Testimonial`, `DateOfCreation`
                                        ) VALUES('', '$rating', '$testifier', '$testimonial', CURRENT_TIMESTAMP
                                        )";
    $addTestimonial                     = mysqli_query($dbconnect, $queryAddTestimonial);
    if($addTestimonial)// If new testimonial addded successfully
    {   // Fire success alert
        ?>
            <script type="text/javascript">
                successAlert("Testimonial Added!", "New testimonial is live on the home page.");
            </script>
        <?php
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error", "Something went wrong while adding this new testimonial...");
            </script>
        <?php
    }
    ?>
        <script type="text/javascript">
            window.location.hash = '#Customers';
        </script>
    <?php
}
?>