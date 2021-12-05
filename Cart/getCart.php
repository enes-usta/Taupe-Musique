<?php
session_start();
include 'Database/DB.php';

$content = file_get_contents('php://input');
$data = json_decode($content);

if(isLogged())
    $res = getPanier(getLogin());
else
    $res = getPanierCookies();

header('Content-Type: application/json;');
echo json_encode(array('panier' => $res));
