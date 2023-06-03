<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of the script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

// Import PHPMailer classes into the global namespace
require_once "../PHPMailer/PHPMailer.php";
require_once "../PHPMailer/SMTP.php";
require_once "../PHPMailer/Exception.php";

function sendOrderConfirmation($email, $customerID, $collection, $trackingID)
{
    global $dbconnect;
    $pound                              = chr(163);
    $method                             = ($collection == '1' ? 'Delivery':'In-store');

    $queryTrackingData                  = "SELECT * FROM `Orders`
                                        WHERE `TrackingID`              = '$trackingID'
                                        AND `CustomerID`                = '$customerID'";
    $trackingData                       = mysqli_query($dbconnect, $queryTrackingData);

    if(mysqli_num_rows($trackingData) <= 0)
    { die(); }

    $orderData                          = mysqli_fetch_assoc($trackingData);
    $totalPrice                         = number_format($orderData['TotalPrice'], 2, '.', ',');

    $queryRetrieveOrder                 = "SELECT
                                        o.OrderID AS orderID, o.TrackingID, o.CustomerID, ol.*,
                                        ol.ProductQuantity AS orderQuantity, p.*
                                        FROM orders o, orderline ol, products p
                                        WHERE o.CustomerID              = '$customerID'
                                        AND ol.OrderID                  = o.OrderID
                                        AND p.ProductID                 = ol.ProductID
                                        AND o.TrackingID                = '$trackingID'";
    $retrieveOrder                      = mysqli_query($dbconnect, $queryRetrieveOrder);

    if(mysqli_num_rows($retrieveOrder) > 0)
    {
        $productTable                   = "";
        while($orderItem = mysqli_fetch_assoc($retrieveOrder))
        {
            $productID                  = $orderItem['ProductID'];
            $productName                = $orderItem['ProductName'];
            $sellingPrice               = number_format($orderItem['SellingPrice'], 2, '.', ',');
            $quantity                   = $orderItem['orderQuantity'];
            $productTable .=
            "
            <tr>
                <td>
                    <div class='imageContainer'>
                        <img src='cid:$productID' alt='Image'>
                    </div>
                </td>
                <td style='font-size: 14px'>$productName</td>
                <td style='font-size: 16px'>$pound$sellingPrice</td>
                <td style='font-size: 16px'>
                    <div class='quantity'>
                        <p>x $quantity</p>
                    </div>
                </td>
            </tr>
            ";
        }
    }
    else
    {
        $productTable =
        "
        <tr>
            <td></td>
            <td>This shouldn't happen...</td>
            <td>What did you do?</td>
            <td></td>
        </tr>
        ";
    }
    $to                                 = $email;
    $from                               = "your@email.com";
    $password                           = "redacted";
    $compName                           = "Zed's Galaxy";
    $subject                            = "Order [$trackingID] Placed";
    $year                               = date('Y');
    $body = 
    "<head>
        <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
        <style>
            @font-face{ font-family: 'Varela';src: url(../fonts/VarelaRound-Regular.ttf); }
            *{ font-family: 'Varela', sans-serif; }
            .hero{ height: 100%;width: 100%;background: linear-gradient(to bottom, #fff, #555);
                background-position: center;background-size: cover;position: absolute; }
            a, a:link, a:visited{ text-decoration: none;color: #00788a; }
            a:hover{ text-decoration: underline; } .ExternalClass{ width: 100%; }
            .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td{ line-height: 100%; }
            .container{ margin: 0 auto;width: 100%;align-self: center;font-size: 18px;font-weight: 600; }
            .retrieveOrder{ width: 100%;margin: 0 auto; }
            .retrieveOrder .tableResponsive{ max-height: 35vh;width: 100%;overflow: auto;height: auto; }
            .retrieveOrder table{ table-layout: fixed;border-collapse: collapse;width: 100%; }
            .retrieveOrder td{ min-width: 132px; }
            .retrieveOrder thead td{ padding: 1.1rem 0.5rem;font-size: 0.9rem;text-align:
                center;color:#fff;max-width: 15rem;overflow: hidden;text-overflow: ellipsis; }
            .retrieveOrder thead td:nth-child(2){ text-align: left; }
            .retrieveOrder thead td{ background: black;font-weight: 700;
                position: sticky !important;top: 0 !important;border: none;z-index: 3; }
            .retrieveOrder td:first-child{ max-width: 80px; }
            .retrieveOrder tr:last-child td{ border-bottom: 1px solid #000; }
            .retrieveOrder .imageContainer{ display: flex;align-items: center;
                justify-content: center;text-align: center;width: 100%; }
            .retrieveOrder table img{ max-width: 100px; }
            .retrieveOrder tbody td{ text-align: center;background: #fff;
                padding: 10px;padding-bottom: 50px; }
            .retrieveOrder tbody td:nth-child(2){ text-align: left; }
            .retrieveOrder tbody tr:first-child td{ padding-top: 40px; }
            .retrieveOrder .quantity{ width: max-content;margin: 0 auto; }
            .retrieveOrder .quantity p{ color: #000; } .retrieveOrder p::after{ all: unset; }
        </style>
    </head>
    <body style='font-size: 1.25rem;padding:20px; background-color: #FAFAFA; width: 75%;
    max-width: 1280px; min-width: 600px; margin-right: auto; margin-left: auto'>
        <div class='hero'><table cellpadding='12' cellspacing='0' width='100%' style='border-collapse: collapse;margin: auto'>
            <thead><tr><td style='text-align:center; padding-bottom: 20px'>
                <a href='http://localhost/s2106630/public_html/'><img Title='Zed\'s Galaxy' src='cid:Logo' style='max-width: 250px; width: 15%;' /></a>
            </td></tr></thead>
            <tbody><tr><td style='padding: 50px; padding-bottom: 0; background-color: #fff'><table width='100%'><tr><td style='text-align: center'>
                <h1 style='font-size: 30px; color: #202225; margin-top: 0;'>

                    Your order has been placed!
                </h1><p style='font-size: 18px; margin-bottom: 30px; color: #202225; max-width: 60ch; margin-left: auto; margin-right: auto'>

                    Press the button below to see full order details.
                </p><a href='http://localhost/s2106630/public_html/view-order?trackingID=$trackingID' style='background-color: #777;color: #fff;
                padding: 8px 24px; border-radius: 4px; border-style: solid; border-color: #777; font-size: 14px; text-decoration: none; cursor: pointer'>

                    See My Order
                </a><div class='container' style='margin: 0 auto; width: 70%; align-self: center; font-size: 18px; font-weight: 600;'><br>

                <p>Collection: $method</p>
                <p>Your Tracking ID: $trackingID</p><br><br><br>
                <div class='retrieveOrder'><div class='tableResponsive'>
                    <table><thead><tr>
                        <td></td>
                        <td>Product:</td>
                        <td>Price:</td>
                        <td>Quantity:</td>
                    </tr></thead><tbody>
                        $productTable
                    </tbody></table></div><h1 style='font-size: 30px; text-align: center; color: #202225; margin-top: 0;'><br>

                    Total Cost:<br>$pound$totalPrice
                </h1></div><br><a href='http://localhost/s2106630/public_html/view-order?trackingID=$trackingID' style='background-color: #777;color: #fff;
                padding: 8px 24px; border-radius: 4px; border-style: solid; border-color: #777; font-size: 14px; text-decoration: none; cursor: pointer'>

                    See My Order
                </a><br><br><br>
                <p style='font-size: 12px; margin-bottom: 30px; color: #202225; max-width: 60ch; margin-left: auto; margin-right: auto'>

                    You received this email because an order was placed on an account with this email at <br>Zed's Galaxy E-Commerce Store.
                    <br>Don't recognise this email? Contact <a href='http://localhost/s2106630/public_html/contact'>Zed's Galaxy</a>
                </p>
            </td></tr></table></td></tr></tbody>
            <tfoot><tr><td style='text-align: center;color:#B6B6B6; font-size: 9px; background-color: #fff'>
                © $year Zed's Galaxy - All Rights Reserved.
            </td></tr></tfoot></table>
        </div>
    </body>";

    // Create an instance;
    $mail = new PHPMailer();

    try{
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
        $mail->addEmbeddedImage('../images/LogoTransparent.png', 'Logo');

        foreach($retrieveOrder as $product)
        {
            $imgString = "../images/uploads/products/".$product['ProductImage'];
            $mail->addEmbeddedImage($imgString, $product['ProductID']);
        }
        $mail->Body = $body;

        $mail->send();
        return true;
    }
    catch (Exception $e)
    {
        return false;
        echo "<p>Something went wrong: <p> <br><br>" . $mail->ErrorInfo;
    }
};
?>