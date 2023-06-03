<?php // Staff logout algorithm
if(isset($_POST['logoutRequest'])) // When staff logs out after confirmation
{   // Remove important sessions then redirect to staff portal
    unset($_SESSION['authStaff']);
    unset($_SESSION['adminLoggedIn']);
    header("location: staff-portal#");
}
?>