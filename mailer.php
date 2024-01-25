<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require  'vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->SMTPDebug =0;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'eclinicwork@gmail.com';                     //SMTP username
$mail->Password   = 'ebbee djsq lwak norx';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       =  465;  

$mail->isHTML(true);


 
return $mail;



