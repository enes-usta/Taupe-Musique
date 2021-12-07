<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '/Exception.php';
require 'Functions/PHPMailer/PHPMailer.php';
require 'Functions/PHPMailer/SMTP.php';
require 'smtp.params.php';

/**
 * Envoi d'un mail de réinitialisation du mot de passe ) l'utilisateur
 * @param $mail
 * @return void
 */
function sendResetLink($email)
{
    global $host, $username, $password, $email_admin;
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = $host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom($email_admin, 'Bot TaupeMusique');
        $mail->addAddress($email, 'Joe User');
        $mail->isHTML(true);
        $mail->Subject = 'Réinitialisation de votre mot de passe';
        $mail->Body    = 'Voici le lien de réinitialisation pour votre mot de passe :  <b>lien</b>';
        $mail->AltBody = 'Voici le lien de réinitialisation pour votre mot de passe : lien';

        $mail->send();
    } catch (Exception $e) { echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";}

}

$content = file_get_contents('php://input');
$data = json_decode($content);

if (isset($data->email))
    if (existByEmail($data->email))
        sendResetLink($data->email);
