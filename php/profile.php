<?php // Profile algorithm
if(isset($_POST['saveProfileChanges'])) // When customer profile changes are saved
{   // Retrieve customer details
    $CustomerID                     = mysqli_real_escape_string($dbconnect, $_POST['editProfileID']);

    $queryCurrentCustomer           = "SELECT * FROM `Customers` WHERE `CustomerID` = '$CustomerID'";
    $CurrentCustomer                = mysqli_query($dbconnect, $queryCurrentCustomer);
    $foundCustomer                  = mysqli_fetch_assoc($CurrentCustomer);

    $retrievedCustomerEmail         = $foundCustomer['Email'];

    $Email                          = mysqli_real_escape_string($dbconnect, $_POST['changeProfileEmail']);
    $Password                       = mysqli_real_escape_string($dbconnect, $_POST['changeProfilePassword']);
    $HashedPassword                 = mysqli_real_escape_string($dbconnect, password_hash($Password, PASSWORD_DEFAULT));

    $queryEditCustomer              = "UPDATE `Customers` SET
                                    `Email`                     = '$Email',
                                    `Password`                  = '$Password',
                                    `HashedPassword`            = '$HashedPassword'
                                    WHERE
                                    `CustomerID`                = '$CustomerID'";
    if($Email === $retrievedCustomerEmail) // Check if email is unchanged, then update customer profile
    { $editCustomer               = mysqli_query($dbconnect, $queryEditCustomer); }
    else // Check if new email is already in use otherwise
    {
        $queryEmailUsed             = "SELECT * FROM `Customers` WHERE `Email` = '$Email'";
        $emailUsed                  = mysqli_query($dbconnect, $queryEmailUsed);
        if(mysqli_num_rows($emailUsed) > 0) // If customer email taken
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("This email is already taken!", "Please try using another email.");
                </script>
            <?php
            unset($_SESSION['editCustomer']);
        }
        else // Update customer profile
        { $editCustomer           = mysqli_query($dbconnect, $queryEditCustomer); }
    }
    if(isset($editCustomer)) // If customer profile updated
    {   // Send confirmation email
        require_once("php/send-change-confirmation.php");
        if($editCustomer && sendChangeConfirmation($Email)) // If update success and email sent
        {   // Fire error alert & redirect to profile card
            ?>
                <script type="text/javascript">
                    successAlert("Changes Saved!", "Your profile details have been updated.");
                </script>
                <script type="text/javascript">
                    window.location.hash = '#editProfile';
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Something went wrong while trying to update your profile...");
                </script>
            <?php
        }
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to update your profile...");
            </script>
        <?php
    }   // Remove edit tab
    unset($_SESSION['editProfile']);
}
if(isset($_POST['cancelProfileChanges']))
{   // Redirect to top of the page
    ?>
        <script type="text/javascript">
            window.location.hash = '#';
        </script>
    <?php
}
?>