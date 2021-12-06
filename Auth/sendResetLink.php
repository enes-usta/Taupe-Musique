<?php
include("Database/DB.php");
session_start();

$content = file_get_contents('php://input');
$data = json_decode($content);

if (isset($data->email))
    if (existByEmail($data->email))
        sendResetLink($data->email);
