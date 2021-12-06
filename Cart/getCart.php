<?php
session_start();
include('Database/DB.php');

if(isLogged())
    $res = ['panier' => getPanier(getLogin())];
else
    $res = ['panier' => getPanierCookies(), 'cookies' => panierCookies()];


header('Content-Type: application/json;');
echo json_encode($res);
