<?php

if (file_exists($php_email_form = './php-email-form/PHPMailer.php')) {
    include($php_email_form);
    include('./php-email-form/SMTP.php');
    include('./php-email-form/Exception.php');
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$contact = new PHPMailer(true);
$contact->isSMTP();

$sendtoemail = "recipient@mailserver.domain"; // any
$sendtoname =  "Recipient Name"; // any


$contact->Host = 'smtp.gmail.com';
$contact->SMTPAuth = true;
$contact->Port = 587;
$contact->Username = 'sender@gmail.com';
$contact->Password = 'password'; // for gmail, must have 2FA and use the App Password
$contact->SMTPSecure = 'tls';

$contact->setFrom('sender@gmail.com', 'Sender Name'); // should match $contact->Username in the email part
$contact->addAddress($sendtoemail, $sendtoname);
$contact->Subject = 'Test Email'; // any subject
// $contact->addReplyTo($sendtoemail, $sendtoname); // uncomment if needed and put the address and name here



// Enable HTML if needed
$contact->isHTML(true);
// $bodyParagraphs = ["Name: {$_POST['name']}", "Email: {$_POST['email']}", "Message:", nl2br($_POST['message'])];
// $body = join('<br />', $bodyParagraphs);
// $contact->Body = $body;
$contact->Body = "hello<br>this is a sample message"; // any message


// echo $contact->send();
if ($res = $contact->send()) {

    // echo $successMessage = 'OK';
    echo "<script>alert('Notification sent.');</script>";

} else {

    // $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $contact->ErrorInfo;
    echo "<script>alert('Notification not sent. Please try again.');</script>";
}
