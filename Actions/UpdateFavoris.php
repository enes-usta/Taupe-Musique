<?php
session_start();
include 'Database/DB.php';

$content = file_get_contents('php://input');
$data = json_decode($content);

if(isLogged())
    $res = updateFavoris(getLogin(), $data->id_produit);
else
    $res = updateFavorisCookies($data->id_produit);


header('Content-Type: application/json;');
echo json_encode(array('state' => $res, 'favoris' => getFavorisCookies()));
