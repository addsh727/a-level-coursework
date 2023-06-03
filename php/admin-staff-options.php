<?php // Staff Options
if(isset($_POST['submitStaff'])) // When new staff added
{   // Retrieve new staff details
    $FirstName                      = mysqli_real_escape_string($dbconnect, $_POST['FirstName']);
    $Surname                        = mysqli_real_escape_string($dbconnect, $_POST['Surname']);
    $Email                          = mysqli_real_escape_string($dbconnect, $_POST['Email']);
    $Password                       = mysqli_real_escape_string($dbconnect, $_POST['Password']);
    $HashedPassword                 = mysqli_real_escape_string($dbconnect, password_hash($Password, PASSWORD_DEFAULT));

    // Check if staff account with the same email already exists
    $queryEmail                     = "SELECT * FROM `Staff` WHERE `Email` = '$Email'";
    $runQueryEmail                  = mysqli_query($dbconnect, $queryEmail);

    if(mysqli_num_rows($runQueryEmail) > 0) // If staff email already taken
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Email Taken!", "Please try to use another email for this staff account.");
            </script>
        <?php
    }
    else // Insert new staff account into the database
    {
        $queryRegisterStaff         = "INSERT INTO `Staff`( `StaffID`, `DateOfCreation`,
                                        `FirstName`, `Surname`, `Email`,
                                        `Password`, `HashedPassword`
                                    ) VALUES( '', CURRENT_TIMESTAMP,
                                        '$FirstName', '$Surname', '$Email',
                                        '$Password', '$HashedPassword'
                                    )";
        $registerStaff              = mysqli_query($dbconnect, $queryRegisterStaff);
        if($registerStaff) // When staff account is inserted
        {   // Fire success alert
            ?>
                <script type="text/javascript">
                    successAlert("Staff Registered!", "New staff profile added to database.");
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Something went wrong while trying to add new staff account...");
                </script>
            <?php
        }
    }   // Redirect to Staff panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Staff';
        </script>
    <?php
}
if(isset($_POST['editStaffButton'])) // When staff profile is edited
{   // Retrieve staff details
    $StaffID                        = mysqli_real_escape_string($dbconnect, $_POST['editStaffID']);

    $queryCurrentStaff              = "SELECT * FROM `Staff` WHERE `StaffID` = '$StaffID'";
    $CurrentStaff                   = mysqli_query($dbconnect, $queryCurrentStaff);
    $foundStaff                     = mysqli_fetch_assoc($CurrentStaff);

    $retrievedStaffFirstName        = $foundStaff['FirstName'];
    $retrievedStaffSurname          = $foundStaff['Surname'];
    $retrievedStaffEmail            = $foundStaff['Email'];
    $retrievedStaffPassword         = $foundStaff['Password'];

    $_SESSION['editStaff']          = true; // Generate & redirect to edit tab
    ?>
        <script type="text/javascript">
            window.location.hash = '#editStaff';
        </script>
    <?php
}
if(isset($_POST['saveStaffChanges'])) // When staff changes are saved
{   // Retrieve current staff details & new changes
    $StaffID                        = mysqli_real_escape_string($dbconnect, $_POST['editStaffID']);

    $queryCurrentStaff              = "SELECT * FROM `Staff` WHERE `StaffID` = '$StaffID'";
    $CurrentStaff                   = mysqli_query($dbconnect, $queryCurrentStaff);
    $foundStaff                     = mysqli_fetch_assoc($CurrentStaff);

    $retrievedStaffFirstName        = $foundStaff['FirstName'];
    $retrievedStaffSurname          = $foundStaff['Surname'];
    $retrievedStaffEmail            = $foundStaff['Email'];
    $retrievedStaffPassword         = $foundStaff['Password'];

    $FirstName                      = mysqli_real_escape_string($dbconnect, $_POST['changeStaffFirstName']);
    $Surname                        = mysqli_real_escape_string($dbconnect, $_POST['changeStaffSurname']);
    $Email                          = mysqli_real_escape_string($dbconnect, $_POST['changeStaffEmail']);
    $Password                       = mysqli_real_escape_string($dbconnect, $_POST['changeStaffPassword']);
    $HashedPassword                 = mysqli_real_escape_string($dbconnect, password_hash($Password, PASSWORD_DEFAULT));

    $queryEditStaff                 = "UPDATE `Staff` SET
                                    `FirstName`                 = '$FirstName',
                                    `Surname`                   = '$Surname',
                                    `Email`                     = '$Email',
                                    `Password`                  = '$Password',
                                    `HashedPassword`            = '$HashedPassword'
                                    WHERE
                                    `StaffID`                   = '$StaffID'";
    if($Email === $retrievedStaffEmail) // Check if email is unchanged, then update staff profile
    { $editStaff                    = mysqli_query($dbconnect, $queryEditStaff); }
    else // Check if new email is already in use otherwise
    {
        $queryEmailUsed             = "SELECT * FROM `Staff` WHERE `Email` = '$Email'";
        $emailUsed                  = mysqli_query($dbconnect, $queryEmailUsed);
        if(mysqli_num_rows($emailUsed) > 0) // If staff email taken
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Email Taken!", "Please try using another email for this staff account.");
                </script>
            <?php
        }
        else  // Update staff profile
        { $editStaff                = mysqli_query($dbconnect, $queryEditStaff); }
    }
    if(isset($editStaff))
    {
        if($editStaff) // If staff profile updated
        {   // Fire success alert
            ?>
                <script type="text/javascript">
                    successAlert("Changes Saved!", "Staff profile has been updated.");
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Something went wrong while trying to submit changes for this staff account...");
                </script>
            <?php
        }
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to submit changes for this staff account...");
            </script>
        <?php
    }
    ?>  <!-- Redirect to Staff panel -->
        <script type="text/javascript">
            window.location.hash = '#Staff';
        </script>
    <?php // Remove edit tab
    unset($_SESSION['editStaff']);
}
if(isset($_POST['cancelStaffChanges'])) // When cancelled editing
{   // Redirect to Staff panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Staff';
        </script>
    <?php // Remove edit tab
    unset($_SESSION['editStaff']);
}
if(isset($_POST['sendStaffDeleteID'])) // When deleting staff profile
{   // Retrieve staff data & remove from database
    $deleteStaffID                  = intval($_POST['sendStaffDeleteID']);

    $queryDeleteStaff               = "DELETE FROM `Staff` WHERE `StaffID` = $deleteStaffID";
    $deleteStaff                    = mysqli_query($dbconnect, $queryDeleteStaff);

    if($deleteStaff) // If customer account deleted successfully
    {   // Fire success alert
        ?>
            <script type="text/javascript">
                successAlert("Successfully Deleted!", "This staff account has been removed from database.");
            </script>
        <?php
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to remove this staff account from database...");
            </script>
        <?php
    }   // Redirect to Staff panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Staff';
        </script>
    <?php
}
?>