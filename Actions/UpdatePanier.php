<?php
session_start();
include("Database/DB.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

if(isLogged())
    $state = updatePanier($data->album ?? -1, $data->amount ?? 1);
else
    $state = updatePanierCookies($data->album ?? -1, $data->amount ?? 1);

header('Content-Type: application/json;');
echo json_encode(array('state' => $state));
