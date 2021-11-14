<?php
include($_SERVER['TAUPE_SRC']."Database/DB.php");
session_start();

$content = file_get_contents('php://input');
$data = json_decode($content);

$isValid = false;
if (!isLogged() && isset($data->login) && isset($data->password)) {
    $isValid = isValid($data->login, $data->password);
    if ($isValid)
        $_SESSION["user"] = $data->login;
}

header('Content-Type: application/json;');
echo json_encode(array('ok' => $isValid, 'data' => $data));
