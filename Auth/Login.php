<?php
include("Database/DB.php");
session_start();

function isValidCaptcha($captcha): bool
{
    return $captcha == $_SESSION['captcha_text'];
}

function cleanCaptcha()
{
    $_SESSION['captcha_text'] = rand();
}

$content = file_get_contents('php://input');
$data = json_decode($content);

$isValid = false;
$captcha = isValidCaptcha($data->captcha ?? '');

if ($captcha)
    if (!isLogged() && isset($data->login) && isset($data->password)) {
        $isValid = isValid($data->login, $data->password);
        if ($isValid) {
            $_SESSION["user"] = $data->login;
            migrateCookiesToBDD($data->login);
            cleanCaptcha();
        }
    }


header('Content-Type: application/json;');
echo json_encode(array('ok' => $isValid, 'captcha' => $captcha));
