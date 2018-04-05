<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

$msg = '';


echo("New Demo Request");
echo($_POST['address']);


//Don't run this unless we're handling a form submission
if (array_key_exists('address', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    require '../vendor/autoload.php';


    // sanitize the inputs
    $client_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $client_country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
    $client_zip = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
    $client_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "alexander.nemtsov@gmail.com";
    //Password to use for SMTP authentication
    $mail->Password = "pdrvoqperqhwjdxt";

    //Set who the message is to be sent from
    $mail->setFrom('alexander.nemtsov@gmail.com', 'Alexander Nemtsov');
    //Set an alternative reply-to address
    $mail->addReplyTo('alexander.nemtsov@gmail.com', 'Alexaner Nemtsov');
    //Set who the message is to be sent to
    $mail->addAddress('alexander.nemtsov@gmail.com', 'Vam Pismo');

    //Set the subject line
    $mail->Subject = 'New Task :: Demo Request';

    $mail->Body = <<<EOT
Name:  {$client_name}
Country: {$client_country}
Address: {$client_zip} - {$client_address}
EOT;

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $msg = json_encode(array('success' => false));
    } else {
        echo "Message sent!";
        $msg = json_encode(array('success' => true));
    }

}

die($msg)

?>