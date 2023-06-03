<?php // Customer logout algorithm
if(isset($_POST['customerLogout'])) // When customer logs outs
{   // Redirect to home page, remove customer session & fire logout toast alert
    header("Location: .");
    unset($_SESSION['accessAccount'],
        $_SESSION['customerLoggedIn'],  $_SESSION['authCustomer'],
        $_SESSION['accessShoppingCart'], $_SESSION['accessCheckout']
    );
    $_SESSION['logoutEvent'] = true;
    die();
}
?>