<?php
session_start();
include("Database/DB.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$res = getAlbumListFiltered($data->filter ?? '', $data->categories ?? array(), $data->favOnly ?? false);

header('Content-Type: application/json;');
echo json_encode($res);