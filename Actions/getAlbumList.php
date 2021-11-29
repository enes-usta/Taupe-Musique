<?php
session_start();
include("Database/DB.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$favAlbums = array();

if (isLogged()) {
    $favAlbums = getAlbumListCustom($_SESSION['user'], $data->categories ?? array(), $data->filter ?? '', $data->favOnly ?? false);
} else if (isset($_COOKIE['favoris']))
    $favAlbums = json_decode($_COOKIE['favoris'], true);
else
    $favAlbums = array();

header('Content-Type: application/json;');
echo json_encode($favAlbums);