<?php
session_start();
include("Database/DB.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$res = array();
if (isLogged())
    $res = getAlbumListCustom($_SESSION['user'], $data->categories ?? array(), $data->filter ?? '', $data->favOnly ?? false);
else if (isset($_COOKIE['favoris']))
    $res = json_decode($_COOKIE['favoris'], true);


header('Content-Type: application/json;');
echo json_encode(array());