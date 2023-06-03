<?php // Contact Message algorithm
if(isset($_POST['sendMessage'])) // When contact form is filled out and submitted
{   // Retrieve data from contact form
    $name                                       = mysqli_real_escape_string($dbconnect, $_POST['name']);
    $email                                      = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $subject                                    = mysqli_real_escape_string($dbconnect, $_POST['subject']);
    $content                                    = mysqli_real_escape_string($dbconnect, $_POST['content']);

    // Send confirmation emails to sender & recipient
    require_once('php/send-contact-confirmation.php'); require_once('php/send-contact-message.php');

    // If email sent to both parties
    if(!sendContactConfirmation($name, $email, $subject, $content) || !sendContactMessage($name, $email, $subject, $content))
    {   // Fire success alert
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to send message... Try again later.");
            </script>
        <?php
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                successAlert("Message Sent!", "We will respond to your enquiry in due time.");
            </script>
        <?php
    }   // Redirect to Contact Us form
    ?>
        <script type="text/javascript">
            window.location.hash = '#contactUs';
        </script>
    <?php
}
?>