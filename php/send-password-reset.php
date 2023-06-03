<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of the script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

// Import PHPMailer classes into the global namespace
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

function sendPasswordReset($retrievedName, $email, $token)
{
    $name                   = ucfirst($retrievedName);
    $to                     = $email;
    $from                   = "your@email.com";
    $password               = "redacted";
    $compName               = "Zed's Galaxy";
    $subject                = "Reset password";
    $year                   = date('Y');
    $body = 
    "
    <head>
        <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
        <style>
            @font-face{ font-family: 'Varela';src: url(../fonts/VarelaRound-Regular.ttf); }
            *{ font-family: 'Varela', sans-serif; }
            .hero{ height: 100%;width: 100%;background: linear-gradient(to bottom, #fff, #555);
                background-position: center;background-size: cover;position: absolute; }
            a, a:link, a:visited{ text-decoration: none;color: #00788a; }
            a:hover{ text-decoration: underline; } .ExternalClass{ width: 100%; }
            .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td{ line-height: 100%; }
        </style>
    </head>
    <body style='font-size: 1.25rem;padding:20px; background-color: #FAFAFA; width: 75%; max-width: 1280px; min-width: 600px; margin-right: auto; margin-left: auto'>
        <div class='hero'><table cellpadding='12' cellspacing='0' width='100%' style='border-collapse: collapse;margin: auto'>
            <thead><tr><td style='text-align:center; padding-bottom: 20px'>
                <a href='http://localhost/s2106630/public_html/'><img Title='Zed\'s Galaxy' src='cid:Logo' style='max-width: 250px; width: 15%;' /></a>
            </td></tr></thead>
            <tbody><tr><td style='padding: 50px; padding-bottom: 0; background-color: #fff'>
                <table width='100%'><tr><td style='text-align:center'>
                    <img src='cid:Lock' style='max-width: 250px; width: 10%;' /><h1 style='font-size: 30px; color: #202225; margin-top: 0;'>

                        Forgot your password?
                    </h1><p style='font-size: 18px; margin-bottom: 30px; color: #202225; max-width: 60ch; margin-left: auto; margin-right: auto'>

                        No worries, $name! Let's get you a new password.
                    </p><a href='http://localhost/s2106630/public_html/change-password.php?email=$email&token=$token' style='background-color: #777; color: #fff;
                    padding: 8px 24px; border-radius: 4px; border-style: solid; border-color: #777; font-size: 14px; text-decoration: none; cursor: pointer'>

                        Reset Password
                    </a><p style='font-size: 12px; margin-bottom: 30px; color: #202225; max-width: 60ch; margin-left: auto; margin-right: auto'><br><br><br><br>

                        You received this email because you requested a password reset at<br>Zed's Galaxy E-Commerce Store.
                        <br>Don't recognise this email? Contact <a href='http://localhost/s2106630/public_html/contact'>Zed's Galaxy</a>
                <p></td></tr></table>
            </td></tr></tbody>
            <tfoot><tr><td style='text-align: center;color:#B6B6B6; font-size: 9px; background-color: #fff'>
                <br>© $year Zed's Galaxy - All Rights Reserved.
            </td></tr></tfoot></table>
        </div>
    </body>";

    // Create an instance;
    $mail = new PHPMailer();

    try {
        // SMTP Server settings
        // $mail->SMTPDebug = 3;                        // Used for debugging
        $mail->isSMTP();                                // Send using SMTP
        $mail->Host         = 'smtp.gmail.com';         // Set the SMTP server to send through
        $mail->SMTPAuth     = true;                     // Enable SMTP authentication
        $mail->Username     = $from;                    // SMTP username
        $mail->Password     = $password;                // SMTP password
        $mail->SMTPSecure   = 'tls';                    // Enable SSL encryption
        $mail->Port         = 587;                      // TCP port to   connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        // $mail->smtpConnect(
        //     [
        //     'ssl' => [
        //         'verify_peer' => false,
        //         'verify_peer_name' => false,
        //         'allow_self_signed' => true
        //         ]
        //     ]
        // );

        // Recipients and Email Settings
        $mail->isHTML(true);                            //Set email format to HTML
        $mail->addAddress($to);                         //Add a recipient
        $mail->setFrom($from, $compName);

        // Content
        $mail->Subject = $subject;
        $mail->addEmbeddedImage('images/LogoTransparent.png', 'Logo');
        $mail->addEmbeddedImage('images/SecurityLock.png', 'Lock');
        $mail->Body = $body;

        $mail->send();
        return true;
    }
    catch (Exception $e)
    {
        return false;
        echo "Something went wrong: <br><br>" . $mail->ErrorInfo;
    }
};
?>