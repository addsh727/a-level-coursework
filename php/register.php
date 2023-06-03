<?php // Register algorithm
if(isset($_POST['submitRegistration'])) // When new customer registers
{   // Retrieve new customer details
    $FirstName              = mysqli_real_escape_string($dbconnect, $_POST['FirstName']);
    $Surname                = mysqli_real_escape_string($dbconnect, $_POST['Surname']);
    $Email                  = mysqli_real_escape_string($dbconnect, $_POST['Email']);
    $Password               = mysqli_real_escape_string($dbconnect, $_POST['Password']);
    $HashedPassword         = mysqli_real_escape_string($dbconnect, password_hash($Password, PASSWORD_DEFAULT));
    $Verification           = mysqli_real_escape_string($dbconnect, md5(rand()));

    // Check if customer account with the same email already exists
    $queryAccountCheck      = "SELECT * FROM customers WHERE `Email` = '$Email'";
    $accountCheck           = mysqli_query($dbconnect, $queryAccountCheck);

    if(mysqli_num_rows($accountCheck) > 0) // If customer email already taken, then return error
    { $prompt               = '<span class="error">An account with this email already exists.</span>'; }
    else
    {   // Add new customer account record to database
        $queryAddNewUser    = "INSERT INTO `Customers`(`CustomerID`,`DateOfCreation`,
                                `FirstName`, `Surname`, `Email`, `Verified`,
                                `Password`, `HashedPassword`, `Verification`
                            ) VALUES('', CURRENT_TIMESTAMP,
                                '$FirstName', '$Surname', '$Email', '0',
                                '$Password', '$HashedPassword', '$Verification'
                            )";
        $addNewUser         = mysqli_query($dbconnect, $queryAddNewUser);
        
        // Send register email with verification link to customer email
        require_once('php/send-verification.php');
        if($addNewUser && sendVerification($Email, $Verification)) // When new customer added & register email sent
        {   // Fire success alert
            ?>
                <script type="text/javascript">
                    successAlert("Registration Complete!", "Check your email for verification process.");
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Something went wrong...", "Verification email could not be sent.");
                </script>
            <?php
        }
    };
}
?>