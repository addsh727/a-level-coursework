<?php // Customer login algorithm
if(isset($_POST['submitLogin'])) // When user logs in
{   // Retrieve login details from database
    $Email                                          = $_POST['Email'];
    $Password                                       = $_POST['Password'];
    $HashedPass                                     = password_hash($Password, PASSWORD_DEFAULT);
    $findEmail                                      = "SELECT * FROM `Customers` WHERE `Email` = '$Email'";
    $result                                         = mysqli_query($dbconnect, $findEmail);
    $count                                          = mysqli_num_rows($result);
    $row                                            = mysqli_fetch_assoc($result);

    if($count == 1) // Check if customer account exists with given email
        if(password_verify($Password, $row['HashedPassword'])) // Compare hashed passwords & verify
        {   // Login user, fire login toast alert & create session with customer details
            $_SESSION["customerLoggedIn"]           = true;
            $_SESSION["loginEvent"]                 = true;
            $_SESSION['authCustomer'] = [
                'CustomerID'                        => $row['CustomerID'],
                'CustomerName'                      => $row['FirstName'],
                'CustomerSurname'                   => $row['Surname'],
                'CustomerEmail'                     => $row['Email']
            ];
            if(isset($_POST['Remember'])) // If 'Remember Me' box checked for customer
            {   // Store customer login credentials as cookies in cached memory for 30 days
                $day                                = 60*60*24;
                $cookieEmail                        = $Email;
                $cookiePassword                     = $Password;
                $cookieCheckbox                     = true;

                setcookie('Email', $cookieEmail, time() + 30*$day);
                setcookie('Password', $cookiePassword, time() + 30*$day);
                setcookie('Checkbox', $cookieCheckbox, time() + 30*$day);
            }
            else // Remove cookies for customer login credentials
            {
                $day = 60*60*24;
                setcookie('Email', '', time() - 30*$day);
                setcookie('Password', '', time() - 30*$day);
                setcookie('Checkbox', false, time() - 30*$day);
            }

            if(isset($_SESSION['accessAccount'])) // If customer tried accessing from account or orders
            {   // Redirect to account
                $_SESSION['accessAccount']          = true;
                header("Location: account");
                unset($_SESSION['accessAccount']);
                die();
            }
            else if(isset($_SESSION['accessShoppingCart'])) // If customer tried accessing from shopping cart
            {   // Redirect to shopping cart
                $_SESSION['accessShoppingCart']     = true;
                header("Location: shopping-cart");
                unset($_SESSION['accessShoppingCart']);
                die();
            }
            else if(isset($_SESSION['accessCheckout'])) // If customer tried accessing from checkout
            {   // Redirect to checkout
                $_SESSION['accessCheckout']         = true;
                header("Location: checkout");
                unset($_SESSION['accessCheckout']);
                die();
            }
            else // Redirect to home page
            { header("location: ./"); }
            exit();
        }   // Error event(s)
        else
        { $prompt                                   = '<span class="error">Invalid email or password.</span>'; }
    else
    { $prompt                                       = '<span class="error">Invalid email or password.</span>'; }
}
?>