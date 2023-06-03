<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of the script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

// Import PHPMailer classes into the global namespace
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

function sendChangeConfirmation($email)
{
    $to                     = $email;
    $from                   = "your@email.com";
    $password               = "redacted";
    $compName               = "Zed's Galaxy";
    $subject                = "Account Details Changed";
    $year                   = date('Y');
    $body = 
    "<head>
        <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
        <style>
            @font-face{ font-family: 'Varela';src: url(../fonts/VarelaRound-Regular.ttf); }
            *{ font-family: 'Varela', sans-serif; }
            .hero{ height: 100%;width: 100%;background: linear-gradient(to bottom, #fff, #555);
                background-position: center;background-size: cover;position: absolute; }
            a, a:link, a:visited{ text-decoration: none;color: #00788a; }
            a:hover{ text-decoration: underline; }
            .ExternalClass p, .ExternalClass span, .ExternalClass font,
            .ExternalClass td { line-height: 100%; } .ExternalClass{ width: 100%; }
        </style>
    </head>
    <body style='font-size: 1.25rem;padding:20px;
    background-color: #FAFAFA; width: 75%; max-width: 1280px; min-width: 600px; margin-right: auto; margin-left: auto'>
        <div class='hero'><table cellpadding='12' cellspacing='0' width='100%' style='border-collapse: collapse;margin: auto'>
            <thead><tr><td style='text-align:center; padding-bottom: 20px'>
                <a href='http://localhost/s2106630/public_html/'><img Title='Zed\'s Galaxy' src='cid:Logo' style='max-width: 250px; width: 15%;' /></a>
            </td></tr></thead><tbody><tr><td style='padding: 50px; padding-bottom: 0; background-color: #fff'>
            <table width='100%'><tr><td style='text-align:center'><h1 style='font-size: 30px; color: #202225; margin-top: 0;'>

                Account Details Changed
            </h1><p style='font-size: 18px; margin-bottom: 30px; color: #202225; max-width: 60ch; margin-left: auto; margin-right: auto'>

                Your account details have been changed. If this request did not come from you, change your account password
                immediately to prevent further unauthorized access or contact us to secure your account.
            </p><p style='font-size: 12px; margin-bottom: 30px; color: #202225; max-width: 60ch; margin-left: auto; margin-right: auto'><br><br><br><br>

                You received this email because you requested to change your profile details. <br>Zed's Galaxy E-Commerce Store.
                <br>Don't recognise this email? Contact <a href='http://localhost/s2106630/public_html/contact'>Zed's Galaxy</a>
            </p></td></tr></table></td></tr></tbody>
            <tfoot><tr><td style='text-align: center;color:#B6B6B6; font-size: 9px'; background-color: #fff'>
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
        $mail->SMTPSecure   = 'ssl';                    // Enable SSL encryption
        $mail->Port         = 465;                      // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->smtpConnect(
            [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ]
            ]
        );

        // Recipients and Email Settings
        $mail->isHTML(true);                            //Set email format to HTML
        $mail->addAddress($to);                         //Add a recipient
        $mail->setFrom($from, $compName);

        // Content
        $mail->Subject = $subject;
        $mail->addEmbeddedImage('images/LogoTransparent.png', 'Logo');
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