<?php
session_start();
include_once("Database/DB.php");

function isValidCaptcha($captcha): bool
{
    return $captcha == $_SESSION['captcha_text2'];
}

function cleanCaptcha()
{
    $_SESSION['captcha_text2'] = rand();
}
$data = json_decode(file_get_contents('php://input'));


/* ---- Login ---- */
if (!isset($data->login))
    $return["loginVal"] = "Le login n'est pas valide";
else if (!preg_match("/^[a-zA-Z'\-\_0-9]+$/", $data->login))
    $return["loginVal"] = "Votre login ne peut contenir que : Lettres, Chiffres, -, _";


/* ---- Password ---- */
if (!(isset($data->password)))
    $return["emptyPassword"] = "Veuillez saisir un mot de passe";
else if (!preg_match("#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#", $data->password))
    $return["InvalidPassword"] = "Veuillez saisir un mot de passe avec au moins 8 caractères dont une majuscule, une minuscule et un chiffre";


/* ---- Email ---- */
if (!isset($data->email))
    $return["emptyEmail"] = 'Veuillez saisir une adresse email';
else if (!filter_var($data->email, FILTER_VALIDATE_EMAIL))
    $return["InvalidEmail"] = 'Veuillez saisir une adresse email valide';


/* ---- Name ---- */
if (!isset($data->nom))
    $return["emptyName"] = "Veuillez saisir un nom";
else if (!preg_match("/^[a-zA-Z'\-]+$/", $data->nom))
    $return["InvalidName"] = "Veuillez saisir un nom valide";

/* ---- Prénom ---- */
if (!isset($data->prenom))
    $return['emptyFirstName'] = 'Veuillez saisir un prénom';
else if (!preg_match("/^[a-zA-Z'\-]+$/", $data->prenom))
    $return["InvalidFirstName"] = "Le prénom est invalide";


/* ---- Adresse ---- */
if (!isset($data->adresse))
    $return["emptyAddress"] = "Veuillez saisir une adresse";
else if (!preg_match("/^[a-zA-Z0-9'\- ]+$/", $data->adresse))
    $return["InvalidAddress"] = "Veuillez saisir une adresse valide";

/* ---- Ville ---- */
if (!isset($data->ville))
    $return['emptyCity'] = 'Veuillez saisir une ville';
else if (!preg_match("/^[a-zA-Z0-9'\-]+$/", $data->ville))
    $return["InvalidCity"] = "Veuillez saisir une ville valide";


/* ---- Code postal ---- */
if (!isset($data->codepostal))
    $return["emptyCodePostal"] = "Veuillez saisir un code postal";
else if (!preg_match("/[0-9]{5}/", $data->codepostal))
    $return["InvalidCodePostal"] = "Veuillez saisir un code postal à 5 chiffres";


/* ---- Date de naissance ---- */
if (!isset($data->date))
    $return['InvalidDate'] = 'Date de naissance invalide';
elseif (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data->date))
    $return['InvalidDate'] = 'Date de naissance invalide';


/* ---- Téléphone ---- */
if (!isset($data->telephone))
    if (!preg_match("/^[0-9]{9,15}$/", $data->telephone))
        $return['telephoneVal'] = 'Numéro de téléphone est invalide';


/* ---- Sexe ---- */
if (!isset($data->sexe) || !in_array($data->sexe, ['Homme', 'Femme']))
    $return['sexe'] = 'Genre inexistant ?';


/* ---- Check email / Login existence ---- */
if (!isset($return)) {
    if (emailExist($data->email))
        $return['dejaEmail'] = "L'email saisie est déja enregistré";

    if (loginExist($data->login))
        $return['dejaLogin'] = 'Le login saisi est déjà enregistré';
}

if (!isValidCaptcha($data->captcha2 ?? ''))
    $return['captcha'] = 'Captcha invalide';


// ============ SI TOUT VALIDE, INSCRIPTION ============ //
header('Content-Type: application/json;');

if (isset($return))
    echo json_encode(array("ok" => false, 'error' => true, 'errors' => $return));
else {
    $_SESSION["user"] = $data->login;
    registerUser($data->login, $data->email, $data->password, $data->nom, $data->prenom, $data->date, $data->sexe, $data->adresse, $data->codepostal, $data->ville, $data->telephone);
    cleanCaptcha();
    migrateCookiesToBDD($data->login);
    echo json_encode(array("ok" => true, 'error' => false, 'errors' => array()));
}