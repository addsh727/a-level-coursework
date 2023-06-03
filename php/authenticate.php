<?php // Logged-in customer authentication
if(!isset($_SESSION['authCustomer'])) // Check if logged in
{   // Otherwise, send to login/register form page and deny access
    header("Location: form");
    $_SESSION['accountAccess']      = false;
    $_SESSION['msg']                = '<span class="error">Please login to continue.</span>';
}
?>