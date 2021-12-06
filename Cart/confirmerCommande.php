<?php
session_start();
include_once("Database/DB.php");
if (isLogged()) {

    $db = Database::getInstance();
    $req = $db->prepare("replace into commande (ID_PROD,ID_CLIENT,DATE,CIVILITE,NOM,PRENOM,ADRESSE,CP,VILLE,TELEPHONE) values (:item,:login,:date,:civilite,:nom,:prenom,:adresse,:cp,:ville,:telephone);");
    $user = getUser($_COOKIE['user']);

    foreach ($panier as $item)
        $req->execute(array(
            ':item' => $item,
            ':login' => $user->login,
            ':date' => date('d/m/Y'),
            ':civilite' => $user->sexe,
            ':nom' => $user->nom,
            ':prenom' => $user->prenom,
            ':adresse' => $user->adresse,
            ':cp' => $user->codep,
            ':ville' => $user->ville,
            ':telephone' => $user->telephone
        ));

    setcookie("panier", "", time() - 3600, "/");

    $_SESSION["paiement"] = "opération réussie";

} else {
    $_SESSION["paiement"] = "donnees incorrectes <br/> Veuillez essayer de nouveau";
}

header('location: panier.php');

