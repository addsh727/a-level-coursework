<?php // Staff login process
if(isset($_POST['submitAdminLogin'])) // When user tries to login
{   // Get staff login details & fetch from database
    $Email                                  = mysqli_real_escape_string($dbconnect, $_POST['adminEmail']);
    $Password                               = mysqli_real_escape_string($dbconnect, $_POST['adminPassword']);
    $HashedPass                             = password_hash($Password, PASSWORD_DEFAULT);
    $findEmail                              = "SELECT * FROM `Staff` WHERE `Email` = '$Email'";
    $result                                 = mysqli_query($dbconnect, $findEmail);
    $count                                  = mysqli_num_rows($result);
    $row                                    = mysqli_fetch_assoc($result);

    if($count == 1) // Check if staff account exists with given email
        if(password_verify($Password, $row['HashedPassword'])) // Compare hashed password values and verify
        {   // Login staff, fire success toast & create authorised staff session with staff details
            $_SESSION["mixinPopup"]         = true;
            $_SESSION["adminLoggedIn"]      = true;
            $_SESSION["authStaff"] = [
                'StaffID'                   => $row['StaffID'],
                'StaffName'                 => $row['FirstName'],
                'StaffEmail'                => $row['Email']
            ];
            header("location: admin-dashboard"); // Redirect to admin interface
            if(isset($_POST['rememberAdmin'])) // If 'Remember Me' box checked for admin
            {   // Store staff login credentials as cookies in cached memory for 30 days
                $day                        = 60*60*24;
                $cookieEmail                = $Email;
                $cookiePassword             = $Password;
                $cookieCheckbox             = true;

                setcookie('adminEmail', $cookieEmail, time() + 30*$day);
                setcookie('adminPassword', $cookiePassword, time() + 30*$day);
                setcookie('adminCheckbox', $cookieCheckbox, time() + 30*$day);
            }
            else // Remove cookies for staff login credentials
            {
                $day = 60*60*24;
                setcookie('adminEmail', '', time() - 30*$day);
                setcookie('adminPassword', '', time() - 30*$day);
                setcookie('adminCheckbox', false, time() - 30*$day);
            }
            exit();
        }   // Error event(s)
        else { $prompt                      = '<span class="error">Invalid email or password.</span>'; }
    else { $prompt                          = '<span class="error">Invalid email or password.</span>'; }
}
?>