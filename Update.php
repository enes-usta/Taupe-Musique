<?php

session_start();
include_once("Database/DB.php");
include_once("Database/Database.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$db = Database();
$ok = true;

// ==== USER ==== //
if ((isset($data->loginbdd) && !empty($data->loginbdd)))
    if (preg_match("/^[a-zA-Z'\-\_0-9 ]+$/", $data->loginbdd) && strlen($data->loginbdd) > 100 && !loginExist($data->loginbdd))
        $login = $data->loginbdd;

// ==== PASSWORD ==== //
if (isset($data->passwordbdd) && !empty($data->passwordbdd))
    if (strlen($data->passwordbdd) <= 100)
        $pass = $data->passwordbdd;

// ============ EMAIL ============ //
if (isset($data->emailbdd) && !empty($data->emailbdd))
    if (filter_var($data->emailbdd, FILTER_VALIDATE_EMAIL) && !emailExist($data->loginbdd))
        $email = $data->emailbdd;


// ============ NOM ============ //
if (isset($data->nombdd) && !empty($data->nombdd))
    if (preg_match("/^[a-zA-Z'\- ]+$/", $data->nombdd) || strlen($data->nombdd) > 50)
        $nom = $data->nombdd;

// ============ PRENOM ============ //
if (isset($data->prenombdd) && !empty($data->prenombdd))
    if (preg_match("/^[a-zA-Z'\- ]+$/", $data->prenombdd) && strlen($data->prenombdd) < 50)
        $prenom = $data->prenombdd;

// ============ ADRESSE ============ //
if (isset($data->adressebdd) && !empty($data->adressebdd))
    if (strlen($data->adressebdd) < 500)
        $adresse = $data->adressebdd;

// ============ VILLE ============ //

if (isset($data->villebdd) && !empty($data->villebdd) && strlen($data->villebdd) < 50)
    $ville = $data->villebdd;

// ============ CODE POSTAL ============ //
if (isset($data->postalbdd) && !empty($data->postalbdd) && strlen($data->postalbdd) < 50)
    $codepostal = $data->postalbdd;

// ============ DATE ============ //
if (isset($data->datebdd) && !empty($data->datebdd))
    $date = $data->datebdd;

// ============ TELEPHONE ============ //
if (isset($data->telephonebdd))
    if (preg_match("/^[0-9]{9,15}$/", $data->telephonebdd))
        $telephone = $data->telephonebdd;


// ============ SEXE ============ //
if (isset($data->optradio))
    $sexe = $data->optradio;

$user = getUser($_COOKIE['user']);
$db = Database();

$req = $db->prepare('UPDATE users SET LOGIN = :login, EMAIL = :email, PASS = :pass, DATE = :date, SEXE = :sexe, ADRESSE = :adresse, CODEP = :codepostal, VILLE = :ville, TELEPHONE = :telephone, NOM = :nom, PRENOM = :prenom WHERE LOGIN = :current_login;');
$req->execute(array(
    ':login' => ($login ?? $user->login),
    ':email' => ($email ?? $user->email),
    ':pass' => (password_hash($pass,PASSWORD_DEFAULT) ?? $user->pass),
    ':date' => ($date ?? $user->date),
    ':sexe' => ($sexe ?? $user->sexe),
    ':adresse' => ($adresse ?? $user->adresse),
    ':codepostal' => ($codepostal ?? $user->codep),
    ':ville' => ($ville ?? $user->ville),
    ':telephone' => ($telephone ?? $user->telephone),
    ':nom' => ($nom ?? $user->nom),
    ':prenom' => ($prenom ?? $user->prenom),
    ':current_login' => $user->login
));
