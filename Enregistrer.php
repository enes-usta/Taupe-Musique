<?php
session_start();
require ("Database/DB.php");


$ok = true;
$result["msg"] = "invalide";
$db = Database();


if ((isset($_POST["loginbdd"])) && (isset($_POST["passwordbdd"]))) {
    if (empty($_POST["loginbdd"]) || empty($_POST["passwordbdd"])) {
        $return["pass"] = "Le mot de passe est trop court";
        $return["loginVal"] = "Veuillez saisir un login valide";
        $ok = false;
    } else {
        $pass = $_POST["passwordbdd"];
        $login = $_POST["loginbdd"];
//				 $pass = mysqli_real_escape_string($mysqli,$_POST["passwordbdd"]);
//				 $login = mysqli_real_escape_string($mysqli,$_POST["loginbdd"]);
        $matches[] = NULL;
        if (!preg_match("/^[a-zA-Z'\-\_0-9 ]+$/", $_POST["loginbdd"])) {
            $return["loginVal"] = "le login ne peut contenir que des lettres, des chiffres, des - et _";
            $login = NULL;
        }


        if (strlen($login) > 100) {
            $return["loginLong"] = "Le login est trop long";
            $ok = false;
        }

        if (strlen($pass) > 100) {
            $return["passLong"] = "le mot de pass est trop long";
            $ok = false;
        }

    }

} else {
    $return["loginVal"] = "Le login n'est pas valide";;
    $return["passVal"] = "le mot de pass n'est pas valide";
    $ok = false;
}

// ============ EMAIL ============ //

$email = NULL;
if (isset($_POST["emailbdd"]))
    if (!filter_var($_POST["emailbdd"], FILTER_VALIDATE_EMAIL))
        $return["emailVal"] = "Veuillez saisir une adresse email valide";
    else
        $email = $_POST["emailbdd"];


// ============ NOM ============ //

$nom = NULL;

if (isset($_POST["nombdd"]))
    if (empty($_POST["nombdd"]))
        $return["Nom"] = "le Nom est pas invalide";
    else {
        $nom = $_POST["nombdd"];
        if (!preg_match("/^[a-zA-Z'\- ]+$/", $_POST["nombdd"])) {
            $return["Nom"] = "Le nom est pas invalide";
            $nom = NULL;
        } else if (strlen($nom) > 50) {
            $return["Nom"] = "Le nom est trop long";
            $ok = false;
        }
    }


// ============ PRENOM ============ //


$prenom = NULL;

if (isset($_POST["prenombdd"]))
    if (!empty($_POST["prenombdd"])) {
        $prenom = $_POST["prenombdd"];
        if (!preg_match("/^[a-zA-Z'\- ]+$/", $_POST["prenombdd"])) {
            $return["Prenom"] = "Le prénom est invalide";
            $prenom = NULL;
        } else if (strlen($prenom) > 50) {
            $return["Prenom"] = "Le prénom est trop long";
            $ok = false;
        }
    }


// ============ ADRESSE ============ //

$adresse = NULL;
if (isset($_POST["adressebdd"]))
    if (!empty($_POST["adressebdd"])) {
        $adresse = $_POST["adressebdd"];
        if (strlen($adresse) > 500) {
            $return["Adresse"] = "L'adresse est invalide";
            $ok = false;
        }
    }


// ============ VILLE ============ //

$ville = NULL;
if (isset($_POST["villebdd"]))
    if (!empty($_POST["villebdd"])) {
        $ville = $_POST["villebdd"];
        if (strlen($ville) > 50) {
            $return["ville"] = "La ville n'est pas valide";
            $ok = false;
        }
    }


// ============ CODE POSTAL ============ //
$codepostal = NULL;
if (isset($_POST["codepostalbdd"]))
    if (!empty($_POST["codepostalbdd"])) {
        $codepostal = $_POST["codepostalbdd"];
        if (strlen($codepostal) > 50) {
            $return["codepostal"] = "Le code postal est invalide";
            $ok = false;
        }
    }


// ============ DATE ============ //
$date = NULL;
if (isset($_POST["datebdd"]))
    if (!empty($_POST["datebdd"])) {
        $date = $_POST["datebdd"];
        if (strlen($date) > 50) {
            $return["date"] = "la date n'est pas valid";
            $ok = false;
        }
    }


// ============ TELEPHONE ============ //


$telephone = NULL;
if (isset($_POST["telephonebdd"]))
    if (!preg_match("/^[0-9]{9,15}$/", $_POST["telephonebdd"]))
        $return["telephoneVal"] = "Le numéro de téléphone est invalide";
    else
        $telephone = $_POST["telephonebdd"];


// ============ SEXE ============ //

if (isset($_POST["optradio"]))
    $sexe = $_POST["optradio"];
else
    $sexe = NULL;


// ============ EXISTENCE LOGIN ============ //

if (isset($email)) {
    if (emailExist($email)) {
        $ok = false;
        $return["dejaEmail"] = "L'email saisie est déja enregistré";
    }

    if (loginExist($login)) {
        $ok = false;
        $return["dejaLogin"] = "Le login saisi est déjà enregistré";
    }
} else
    $ok = false;


// ============ SI TOUT VALIDE, INSCRIPTION ============ //

if ($ok === true) {
    registerUser($login, $email, $_POST["passwordbdd"], $nom, $prenom, $date, $sexe, $adresse, $codepostal, $ville, $telephone);
    //setcookie('user',$login,time() + 3600);
    unset($return);
    header('location: index.php');
} else
    $_SESSION["inscription"] = $return;

echo "<meta http-equiv='refresh' content='0'>";

