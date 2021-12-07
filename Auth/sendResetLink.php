<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '/Exception.php';
require 'Functions/PHPMailer/PHPMailer.php';
require 'Functions/PHPMailer/SMTP.php';

/**
 * Envoi d'un mail de réinitialisation du mot de passe ) l'utilisateur
 * @param $mail
 * @return void
 */
function sendResetLink($email)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'user@example.com';
        $mail->Password   = 'secret';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress($email, 'Joe User');     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Réinitialisation de votre mot de passe';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }





}

$content = file_get_contents('php://input');
$data = json_decode($content);

if (isset($data->email))
    if (existByEmail($data->email))
        sendResetLink($data->email);
