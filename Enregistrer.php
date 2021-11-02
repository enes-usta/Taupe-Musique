<?php

session_start();
require("Database/DB.php");
require("Database/Database.php");

$content = file_get_contents('php://input');
$data = json_decode($content);

$ok = true;
$db = Database();


if ((isset($data->loginbdd)))
    if (empty($data->loginbdd)) {
        $return["loginVal"] = "Veuillez saisir un login valide";
        $ok = false;
    } else {
        $login = $data->loginbdd;
        if (!preg_match("/^[a-zA-Z'\-\_0-9 ]+$/", $data->loginbdd)) {
            $return["loginVal"] = "le login ne peut contenir que des lettres, des chiffres, des - et _";
            $login = NULL;
            $ok = false;
        }

        if (strlen($login) > 100) {
            $return["loginLong"] = "Le login est trop long";
            $ok = false;
            $login = NULL;
        }
    }
else {
    $return["loginVal"] = "Le login n'est pas valide";
    $ok = false;
}

if ((isset($data->passwordbdd)))
    if (empty($data->passwordbdd)) {
        $return["pass"] = "Le mot de passe est trop court";
        $ok = false;
    } else {
        $pass = $data->passwordbdd;
        if (strlen($pass) > 100) {
            $return["passLong"] = "Le mot de passe est trop long";
            $ok = false;
        }
    }
else {
    $return["passVal"] = "Le mot de passe est invalide";
    $ok = false;
}

// ============ EMAIL ============ //

$email = NULL;
if (isset($data->emailbdd))
    if (!filter_var($data->emailbdd, FILTER_VALIDATE_EMAIL))
        $return["emailVal"] = "Veuillez saisir une adresse email valide";
    else
        $email = $data->emailbdd;
else
    $return["mailEmpty"] = "Veuillez saisir une adresse email";


// ============ NOM ============ //

$nom = NULL;

if (isset($data->nombdd)) {
    if (empty($data->nombdd))
        $return["Nom"] = "Veuillez saisir un nom";
    else {
        $nom = $data->nombdd;
        if (!preg_match("/^[a-zA-Z'\- ]+$/", $data->nombdd)) {
            $return["Nom"] = "Le nom est pas invalide";
            $nom = NULL;
        } else if (strlen($nom) > 50) {
            $return["Nom"] = "Le nom est trop long";
            $ok = false;
        }
    }
} else {
    $ok = false;
    $return["nameEmpty"] = "Veuillez saisir un nom";
}


// ============ PRENOM ============ //


$prenom = NULL;

if (isset($data->prenombdd))
    if (!empty($data->prenombdd)) {
        $prenom = $data->prenombdd;
        if (!preg_match("/^[a-zA-Z'\- ]+$/", $data->prenombdd)) {
            $return["Prenom"] = "Le prénom est invalide";
            $prenom = NULL;
        } else if (strlen($prenom) > 50) {
            $return["Prenom"] = "Le prénom est trop long";
            $ok = false;
        }
    } else {
        $ok = false;
        $return["prenomEmpty"] = "Veuillez saisir un prénom";
    }


// ============ ADRESSE ============ //

$adresse = NULL;
if (isset($data->adressebdd))
    if (empty($data->adressebdd)) {
        $ok = false;
        $return["Empty"] = "Veuillez saisir une adresse";
    } else {
        $adresse = $data->adressebdd;
        if (strlen($adresse) > 500) {
            $return["Adresse"] = "L'adresse est invalide";
            $ok = false;
        }
    }
else {
    $return["Adresse"] = "Veuillez saisir une adreddsse";
    $ok = false;
}


// ============ VILLE ============ //

$ville = NULL;
if (isset($data->villebdd))
    if (!empty($data->villebdd)) {
        $ville = $data->villebdd;
        if (strlen($ville) > 50) {
            $return["ville"] = "La ville n'est pas valide";
            $ok = false;
        }
    }


// ============ CODE POSTAL ============ //
$codepostal = NULL;
if (isset($data->codepostalbdd))
    if (!empty($data->codepostalbdd)) {
        $codepostal = $data->codepostalbdd;
        if (strlen($codepostal) > 50) {
            $return["codepostal"] = "Le code postal est invalide";
            $ok = false;
        }
    }


// ============ DATE ============ //
$date = NULL;
if (isset($data->datebdd))
    if (!empty($data->datebdd)) {
        $date = $data->datebdd;
        if (strlen($date) > 50) {
            $return["date"] = "la date n'est pas valid";
            $ok = false;
        }
    }


// ============ TELEPHONE ============ //


$telephone = NULL;
if (isset($data->telephonebdd))
    if (!preg_match("/^[0-9]{9,15}$/", $data->telephonebdd))
        $return["telephoneVal"] = "Le numéro de téléphone est invalide";
    else
        $telephone = $data->telephonebdd;


// ============ SEXE ============ //

if (isset($data->optradio))
    $sexe = $data->optradio;
else
    $sexe = NULL;


// ============ EXISTENCE LOGIN ============ //

if (isset($email)) {
    if (emailExist($email)) {
        $ok = false;
        $return["dejaEmail"] = "L'email saisie est déja enregistré";
    }
}
if (isset($login))
    if (loginExist($login)) {
        $ok = false;
        $return["dejaLogin"] = "Le login saisi est déjà enregistré";
    } else
        $ok = false;


// ============ SI TOUT VALIDE, INSCRIPTION ============ //

if ($ok === true) {
    registerUser($login, $email, $data->passwordbdd, $nom, $prenom, $date, $sexe, $adresse, $codepostal, $ville, $telephone);
    //setcookie('user',$login,time() + 3600);
    unset($return);
//    header('location: index.php');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("ok" => true, 'error' => false));
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("ok" => false, 'error' => true, 'errors' => $return));
}
//    $_SESSION["inscription"] = $return;

//echo "<meta http-equiv='refresh' content='0'>";

