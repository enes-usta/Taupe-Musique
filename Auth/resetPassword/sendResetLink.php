<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Functions/PHPMailer/Exception.php';
require 'Functions/PHPMailer/PHPMailer.php';
require 'Functions/PHPMailer/SMTP.php';
require 'Auth/smtp.params.php';
require 'Database/DB.php';


/**
 * Envoi d'un mail de réinitialisation du mot de passe à l'utilisateur
 * @param $email
 * @return void
 */
function sendResetLink($email)
{
    global $host, $username, $password, $port;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Mailer = 'smtp';
        $mail->Host       = $host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $port;

        $mail->setFrom($username, 'Bot TaupeMusique');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Réinitialisation de votre mot de passe';
        $link = 'https://100.66.52.23/Auth/resetPassword.php?email='.$email .'&token='.generateToken($email);

        $mail->Body    = 'Voici le lien de réinitialisation pour votre mot de passe :  <a href="' .$link .'">' .$link .'</a>';
        $mail->AltBody = 'Voici le lien de réinitialisation pour votre mot de passe : ' .$link;

        $mail->send();
    } catch (Exception $e) { echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";}
}

$content = file_get_contents('php://input');
$data = json_decode($content);
if (isset($data->email))
    if (existByEmail($data->email))
        sendResetLink($data->email);
