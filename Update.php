<?php

session_start();
include_once("Database/DB.php");
include_once("Database/Database.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$db = Database();
$ok = true;

// ==== USER ==== //
if ((isset($data->loginbdd) && !empty($data->loginbdd))) {
    unset($data->loginbdd);
} else {
    $login = $data->loginbdd;
    if (!preg_match("/^[a-zA-Z'\-\_0-9 ]+$/", $data->loginbdd) || strlen($login) > 100)
        $login = NULL;
}

// ==== PASSWORD ==== //

if (isset($data->passwordbdd) && !empty($data->passwordbdd)) {
    $return["pass"] = "Le mot de passe est trop court";
    $ok = false;
} else {
    $pass = $data->passwordbdd;
    if (strlen($pass) > 100) {
        $return["passLong"] = "Le mot de passe est trop long";
        $ok = false;
    }
}

// ============ EMAIL ============ //

$email = NULL;
if (isset($data->emailbdd) && !empty($data->emailbdd))
    if (!filter_var($data->emailbdd, FILTER_VALIDATE_EMAIL)) {
        $return["emailVal"] = "Veuillez saisir une adresse email valide";
        $ok = false;
    } else
        $email = $data->emailbdd;
else
    $return["mailEmpty"] = "Veuillez saisir une adresse email";


// ============ NOM ============ //

$nom = NULL;

if (isset($data->nombdd) && !empty($data->nombdd)) {
    $nom = $data->nombdd;
    if (!preg_match("/^[a-zA-Z'\- ]+$/", $data->nombdd) || strlen($nom) > 50) {
        $return["Nom"] = "Le nom est trop long";
        $ok = false;

    } else
        $return["Nom"] = "Veuillez saisir un nom";
}
