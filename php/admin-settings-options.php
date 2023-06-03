<?php // Settings Options
if( // If any of the settings below are not set yet
    !isset($_SESSION['settingHideCounters'])
    || !isset($_SESSION['settingHideReports'])
    || !isset($_SESSION['settingHideExports']) 
    || !isset($_SESSION['settingHideAnalytics'])
    || !isset($_SESSION['settingShowSession'])
)
{   // Then set them to false
    $_SESSION['settingHideCounters']        = false;
    $_SESSION['settingHideReports']         = false;
    $_SESSION['settingHideExports']         = false;
    $_SESSION['settingHideAnalytics']       = false;
    $_SESSION['settingShowSession']         = false;
}
if(isset($_POST['editStaffProfile'])) // When editing staff profile
{   // Retrieve staff details
    $StaffID                                = mysqli_real_escape_string($dbconnect, $_POST['editStaffID']);

    $queryCurrentStaff                      = "SELECT * FROM `Staff` WHERE `StaffID` = '$StaffID'";
    $CurrentStaff                           = mysqli_query($dbconnect, $queryCurrentStaff);
    $foundStaff                             = mysqli_fetch_assoc($CurrentStaff);

    $_SESSION['editStaffProfile']           = true; // Generate & redirect to edit tab
    ?>
    <script type="text/javascript">
        window.location.hash = '#Settings';
    </script>
<?php
}
if(isset($_POST['saveProfileChanges'])) // When staff changes are saved
{   // Retrieve current staff details and & new changes
    $StaffID                                = mysqli_real_escape_string($dbconnect, $_POST['editStaffID']);

    $queryCurrentStaff                      = "SELECT * FROM `Staff` WHERE `StaffID` = '$StaffID'";
    $CurrentStaff                           = mysqli_query($dbconnect, $queryCurrentStaff);
    $foundStaff                             = mysqli_fetch_assoc($CurrentStaff);

    $retrievedStaffFirstName                = $foundStaff['FirstName'];
    $retrievedStaffSurname                  = $foundStaff['Surname'];
    $retrievedStaffEmail                    = $foundStaff['Email'];
    $retrievedStaffPassword                 = $foundStaff['Password'];

    $FirstName                              = mysqli_real_escape_string($dbconnect, $_POST['changeStaffFirstName']);
    $Surname                                = mysqli_real_escape_string($dbconnect, $_POST['changeStaffSurname']);
    $Email                                  = mysqli_real_escape_string($dbconnect, $_POST['changeStaffEmail']);
    $Password                               = mysqli_real_escape_string($dbconnect, $_POST['changeStaffPassword']);
    $HashedPassword                         = mysqli_real_escape_string($dbconnect, password_hash($Password, PASSWORD_DEFAULT));

    $queryEditStaff                         = "UPDATE `Staff` SET
                                            `FirstName`                     = '$FirstName',
                                            `Surname`                       = '$Surname',
                                            `Email`                         = '$Email',
                                            `Password`                      = '$Password',
                                            `HashedPassword`                = '$HashedPassword'
                                            WHERE
                                            `StaffID`                       = '$StaffID'";
    if($Email === $retrievedStaffEmail) // Check if email is unchanged, then update staff profile
    { $editStaff                            = mysqli_query($dbconnect, $queryEditStaff);}
    else // Check if new email is already in use otherwise
    {
        $queryEmailUsed                     = "SELECT * FROM `Staff` WHERE `Email` = '$Email'";
        $emailUsed                          = mysqli_query($dbconnect, $queryEmailUsed);
        if(mysqli_num_rows($emailUsed) > 0) // If customer email taken
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Email Taken!", "Please use another email for staff details...");
                </script>
            <?php
        }
        else // Update staff profile
        { $editStaff                      = mysqli_query($dbconnect, $queryEditStaff); }
    }

    if(isset($editStaff))
    {
        if($editStaff) // If staff profile updated
        {   // Fire success alert
            ?>
                <script type="text/javascript">
                    successAlert("Changes Saved!", "Staff profile has successfully been updated.");
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error", "Could not submit changes for staff...");
                </script>
            <?php
        }
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error", "Could not submit changes for staff...");
            </script>
        <?php
    }
    ?>  <!-- Redirect to Settings panel -->
        <script type="text/javascript">
            window.location.hash = '#Settings';
        </script>
    <?php // Remove edit tab
    unset($_SESSION['editStaffProfile']);
}
if(isset($_POST['cancelStaffProfile'])) // When cancelled editing
{   // Redirect to Settings panel
    ?>
        <script type="text/javascript">
            window.location.hash = '#Settings';
        </script>
    <?php // Remove edit tab
    unset($_SESSION['editStaffProfile']);
}
if(isset($_POST['saveSettings'])) // When configuration settings saved
{   // Save settings in sessionStorage & fire success alert
    $_SESSION['settingHideCounters']        = isset($_POST['hideCounters'])     ? true : false;
    $_SESSION['settingHideReports']         = isset($_POST['hideReports'])      ? true : false;
    $_SESSION['settingHideExports']         = isset($_POST['hideExports'])      ? true : false;
    $_SESSION['settingHideAnalytics']       = isset($_POST['hideAnalytics'])    ? true : false;
    $_SESSION['settingShowSession']         = isset($_POST['showSession'])      ? true : false;
    ?>
        <script type="text/javascript">
            successAlert("Settings Saved!", "Dashboard has been re-configured.");
        </script>
    <?php
}
?>