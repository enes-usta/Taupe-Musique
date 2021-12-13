<?php
session_start();
include('Auth/log_authorized.php');

include_once("Database/DB.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$db = Database::getInstance();
$ok = true;

/* ---- Login ---- */
if (isset($data->loginbdd) && preg_match("/^[a-zA-Z'\-\_0-9 ]+$/", $data->loginbdd) && !loginExist($data->loginbdd))
    $login = $data->loginbdd;

/* ---- Password ---- */
if (isset($data->passwordbdd) && preg_match("#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#", $data->passwordbdd))
    $pass = $data->passwordbdd;

/* ---- Email ---- */
if (isset($data->emailbdd) && filter_var($data->emailbdd, FILTER_VALIDATE_EMAIL) && !emailExist($data->loginbdd))
    $email = $data->emailbdd;

/* ---- Name ---- */
if (isset($data->nombdd) && preg_match("/^[a-zA-Z'\- ]+$/", $data->nombdd))
    $nom = $data->nombdd;

/* ---- Prénom ---- */
if (isset($data->prenombdd) && preg_match("/^[a-zA-Z'\- ]+$/", $data->prenombdd))
    $prenom = $data->prenombdd;


/* ---- Adresse ---- */
if (isset($data->adressebdd) && preg_match("/^[a-zA-Z0-9'\- ]+$/", $data->adressebdd))
    $adresse = $data->adressebdd;

/* ---- Ville ---- */
if (isset($data->villebdd) && preg_match("/^[a-zA-Z0-9'\- ]+$/", $data->villebdd))
    $ville = $data->villebdd;

/* ---- Code postal ---- */
if (isset($data->postalbdd) && preg_match("/[0-9]{5}/", $data->postalbdd))
    $codepostal = $data->postalbdd;

/* ---- Date de naissance ---- */
if (isset($data->datebdd) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data->datebdd))
    $date = $data->datebdd;

/* ---- Téléphone ---- */
if (isset($data->telephonebdd) && preg_match("/^[0-9]{9,15}$/", $data->telephonebdd))
    $telephone = $data->telephonebdd;


/* ---- Sexe ---- */
if (isset($data->optradio) && in_array($data->optradio, ['Homme', 'Femme']))
    $sexe = $data->optradio;

$user = getUser($_SESSION['user']);
$db = Database::getInstance();

$req = $db->prepare('UPDATE users SET LOGIN = :login, EMAIL = :email, PASS = :pass, DATE = :date, SEXE = :sexe, ADRESSE = :adresse, CODEP = :codepostal, VILLE = :ville, TELEPHONE = :telephone, NOM = :nom, PRENOM = :prenom WHERE LOGIN = :current_login;');
$req->execute(array(
    ':login' => ($login ?? $user->login),
    ':email' => ($email ?? $user->email),
    ':pass' => (password_hash($pass, PASSWORD_DEFAULT) ?? $user->pass),
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
